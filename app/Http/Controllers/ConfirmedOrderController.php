<?php

namespace App\Http\Controllers;

use App\Models\ConfirmedOrder;
use App\Models\Excel;
use App\Http\Requests\StoreConfirmedOrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ConfirmedOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check:Confirmed Order']);
    }

    public function index()
    {
        $orders = ConfirmedOrder::with('excels')->orderBy('id', 'asc')->get();
        // dd($orders);
        return view('backend.pages.confirmed_order.index', compact('orders'));
    }

    public function create()
    {
        return view('backend.pages.confirmed_order.create');
    }

    public function store(StoreConfirmedOrderRequest $request)
    {
        // Load Excel file
        $spreadsheet = IOFactory::load($request->file('excel_file'));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Get and validate headers
        $headers = array_map('trim', array_shift($rows));
        $expectedHeaders = Excel::getHeaderDisplayNames()->toArray();
        $missingHeaders = array_diff($expectedHeaders, $headers);

        if (!empty($missingHeaders)) {
            return back()->with('error', 'Your Excel file is missing these required columns: ' . implode(', ', $missingHeaders));
        }

        // Prepare and validate all row data first
        $validatedData = [];
        foreach ($rows as $rowIndex => $row) {
            // Check if row is empty (all values are null or empty string)
            if (empty(array_filter($row, function($value) {
                return $value !== null && $value !== '';
            }))) {
                continue; // Skip empty rows
            }

            $rowData = [];
            foreach ($headers as $index => $header) {
                $rowData[$header] = $row[$index] ?? null;
            }

            $validator = Validator::make($rowData, [
                'Invoice' => 'required|string',
                'Name' => 'required|string',
                'Address' => 'required|string',
                'Phone' => 'required|string',
                'Amount' => 'required|numeric',
                'Note' => 'nullable|string'
            ], [
                'Invoice.required' => 'Row ' . ($rowIndex + 1) . ': Invoice is required',
                'Name.required' => 'Row ' . ($rowIndex + 1) . ': Customer name is required',
                'Phone.required' => 'Row ' . ($rowIndex + 1) . ': Phone number is required',
                'Address.required' => 'Row ' . ($rowIndex + 1) . ': Address is required',
                'Amount.required' => 'Row ' . ($rowIndex + 1) . ': Amount is required',
                'Amount.numeric' => 'Row ' . ($rowIndex + 1) . ': Amount must be a number',
            ]);


            if ($validator->fails()) {
                return back()->with('error', 'Error in Excel data: ' . implode(', ', $validator->errors()->all()));
            }

            $validatedData[] = [
                'data' => $rowData,
                'row_number' => $rowIndex + 1  // Store the row number
            ];
        }

        // Check if we have any valid data to process
        if (empty($validatedData)) {
            return back()->with('error', 'No valid data found in the Excel file');
        }

        // If all validations pass, start inserting data
        DB::beginTransaction();
        try {
            // Create confirmed order
            $confirmedOrder = ConfirmedOrder::create([
                'date' => $request->date
            ]);

            // Insert all validated excel data
            foreach ($validatedData as $validatedRow) {
                $rowData = $validatedRow['data'];
                $rowNumber = $validatedRow['row_number'];

                foreach ($rowData as $header => $value) {
                    // Only insert if header is defined in Excel model
                    if (Excel::isValidProperty($header)) {
                        Excel::create([
                            'confirmed_order_id' => $confirmedOrder->id,
                            'property' => $header,
                            'value' => $value,
                            'row' => $rowNumber  // Add the row number here
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('confirmed-order.index')
                            ->with('success', sprintf(
                                'Order data has been imported successfully. Processed %d valid rows.',
                                count($validatedData)
                            ));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $confirmedOrder = ConfirmedOrder::with('excels')->findOrFail($id);
        return view('backend.pages.confirmed_order.edit', compact('confirmedOrder'));
    }

    public function update(Request $request, $id)
    {
        $validationRules = [
            'date' => 'required|date',
            'excel_data' => 'required|array',
        ];

        // Add validation rules for each valid property
        foreach (Excel::getValidProperties() as $property) {
            $validationRules['excel_data.*.' . str_replace(' ', '_', $property)] = Excel::getHeaders()[$property]['validation'];
        }

        $request->validate($validationRules);

        DB::beginTransaction();
        try {
            $confirmedOrder = ConfirmedOrder::findOrFail($id);
            $confirmedOrder->update(['date' => $request->date]);

            // Delete existing excel data
            Excel::where('confirmed_order_id', $id)->delete();

            // Insert new excel data
            foreach ($request->excel_data as $rowData) {
                foreach ($rowData as $property => $value) {
                    $propertyName = str_replace('_', ' ', $property);
                    if (Excel::isValidProperty($propertyName)) {
                        Excel::create([
                            'confirmed_order_id' => $id,
                            'property' => $propertyName,
                            'value' => $value
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('confirmed-order.index')
                            ->with('success', 'Order updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $confirmedOrder = ConfirmedOrder::findOrFail($id);

            // Delete related excel data first
            Excel::where('confirmed_order_id', $id)->delete();

            // Delete the confirmed order
            $confirmedOrder->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDestroy(Request $request)
    {
        if (!$request->has('ids') || empty($request->ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No orders selected'
            ]);
        }

        DB::beginTransaction();
        try {
            // Delete related excel data first
            Excel::whereIn('confirmed_order_id', $request->ids)->delete();

            // Delete the confirmed orders
            ConfirmedOrder::whereIn('id', $request->ids)->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Selected orders deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete orders: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getItem($orderId, $row)
    {
        $excelData = Excel::where('confirmed_order_id', $orderId)
                          ->where('row', $row)
                          ->pluck('value', 'property');

        $formattedData = [];
        foreach(Excel::getHeaderDisplayNames() as $header) {
            $formattedData[str_replace(' ', '_', $header)] = $excelData[$header] ?? '';
        }

        return response()->json($formattedData);
    }

    public function updateItem(Request $request, $orderId)
    {
        DB::beginTransaction();
        try {
            $order = ConfirmedOrder::findOrFail($orderId);
            $row = $request->input('row');

            foreach($request->except(['_token', 'excel_id', 'row']) as $property => $value) {
                $propertyName = str_replace('_', ' ', $property);
                if (Excel::isValidProperty($propertyName)) {
                    Excel::updateOrCreate(
                        [
                            'confirmed_order_id' => $orderId,
                            'property' => $propertyName,
                            'row' => $row  // Add row to the condition
                        ],
                        [
                            'value' => $value,
                            'row' => $row  // Add row to the update values
                        ]
                    );
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function printLabels(Request $request)
    {
        $orderIds = explode(',', $request->ids);
        $rows = explode(',', $request->rows);

        // Decode styles from request
        $styles = json_decode($request->input('styles'), true) ?? [];

        $orders = ConfirmedOrder::whereIn('id', $orderIds)
            ->with(['excels' => function($query) use ($rows) {
                $query->whereIn('row', $rows);
            }])
            ->get();

        $groupedData = [];
        foreach ($orders as $order) {
            foreach ($order->excels->groupBy('row') as $row => $excelData) {
                $groupedData[] = [
                    'order' => $order,
                    'excelData' => [
                        'Invoice' => $excelData->where('property', 'Invoice')->first()->value ?? '',
                        'Name' => $excelData->where('property', 'Name')->first()->value ?? '',
                        'Phone' => $excelData->where('property', 'Phone')->first()->value ?? '',
                        'Address' => $excelData->where('property', 'Address')->first()->value ?? ''
                    ]
                ];
            }
        }

        return view('backend.pages.confirmed_order.labels', [
            'groupedData' => $groupedData,
            'styles' => $styles
        ]);
    }

    public function deleteRow($orderId, $row)
    {
        DB::beginTransaction();
        try {
            Excel::where('confirmed_order_id', $orderId)
                 ->where('row', $row)
                 ->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Row deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete row: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        if (!$request->has('rows') || empty($request->rows)) {
            return response()->json([
                'success' => false,
                'message' => 'No rows selected'
            ]);
        }

        DB::beginTransaction();
        try {
            foreach ($request->rows as $rowData) {
                Excel::where('confirmed_order_id', $rowData['orderId'])
                     ->where('row', $rowData['row'])
                     ->delete();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Selected rows deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete rows: ' . $e->getMessage()
            ], 500);
        }
    }

    public function printSingleLabel($orderId, $row, Request $request)
    {
        $order = ConfirmedOrder::with(['excels' => function($query) use ($row) {
            $query->where('row', $row);
        }])->findOrFail($orderId);

        if ($order->excels->isEmpty()) {
            return back()->with('error', 'No data found to print');
        }

        // Decode the styles from JSON
        $styles = json_decode($request->input('styles'), true) ?? [];

        // Format data to match bulk print structure
        $groupedData = [[
            'order' => $order,
            'excelData' => [
                'Invoice' => $order->excels->where('property', 'Invoice')->first()->value ?? '',
                'Name' => $order->excels->where('property', 'Name')->first()->value ?? '',
                'Phone' => $order->excels->where('property', 'Phone')->first()->value ?? '',
                'Address' => $order->excels->where('property', 'Address')->first()->value ?? ''
            ]
        ]];

        return view('backend.pages.confirmed_order.labels', [
            'groupedData' => $groupedData,
            'styles' => $styles
        ]);
    }

    // Add other resource methods as needed...
}
