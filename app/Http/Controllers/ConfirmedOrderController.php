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
        $expectedHeaders = ConfirmedOrder::getHeaderDisplayNames()->toArray();
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
                'Invoice ID' => 'required|string',
                'Name' => 'required|string',
                'Phone' => 'required|string',
                'Address' => 'required|string',
                'Total' => 'required|numeric',
                'Quantity' => 'required|numeric'
            ], [
                'Invoice ID.required' => 'Row ' . ($rowIndex + 1) . ': Invoice ID is required',
                'Name.required' => 'Row ' . ($rowIndex + 1) . ': Customer name is required',
                'Phone.required' => 'Row ' . ($rowIndex + 1) . ': Phone number is required',
                'Address.required' => 'Row ' . ($rowIndex + 1) . ': Address is required',
                'Total.required' => 'Row ' . ($rowIndex + 1) . ': Total amount is required',
                'Total.numeric' => 'Row ' . ($rowIndex + 1) . ': Total amount must be a number',
                'Quantity.required' => 'Row ' . ($rowIndex + 1) . ': Quantity is required',
                'Quantity.numeric' => 'Row ' . ($rowIndex + 1) . ': Quantity must be a number'
            ]);

            if ($validator->fails()) {
                return back()->with('error', 'Error in Excel data: ' . implode(', ', $validator->errors()->all()));
            }

            $validatedData[] = $rowData;
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
            foreach ($validatedData as $rowData) {
                foreach ($rowData as $header => $value) {
                    Excel::create([
                        'confirmed_order_id' => $confirmedOrder->id,
                        'property' => $header,
                        'value' => $value
                    ]);
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
        $request->validate([
            'date' => 'required|date',
            'excel_data' => 'required|array',
            'excel_data.*.Invoice_ID' => 'required|string',
            'excel_data.*.Name' => 'required|string',
            'excel_data.*.Phone' => 'required|string',
            'excel_data.*.Address' => 'required|string',
            'excel_data.*.Total' => 'required|numeric',
            'excel_data.*.Quantity' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $confirmedOrder = ConfirmedOrder::findOrFail($id);
            $confirmedOrder->update(['date' => $request->date]);

            // Delete existing excel data
            Excel::where('confirmed_order_id', $id)->delete();

            // Insert new excel data
            foreach ($request->excel_data as $rowData) {
                foreach ($rowData as $property => $value) {
                    Excel::create([
                        'confirmed_order_id' => $id,
                        'property' => str_replace('_', ' ', $property),
                        'value' => $value
                    ]);
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

    public function getItem($orderId, $index)
    {
        $order = ConfirmedOrder::with('excels')->findOrFail($orderId);
        $excelData = $order->getFormattedExcelData();

        $itemData = [];
        foreach(ConfirmedOrder::getHeaderDisplayNames() as $header) {
            $itemData[str_replace(' ', '_', $header)] = $excelData[$header][$index] ?? '';
        }

        return response()->json($itemData);
    }

    public function updateItem(Request $request, $orderId)
    {
        DB::beginTransaction();
        try {
            $order = ConfirmedOrder::findOrFail($orderId);

            foreach($request->except(['_token', 'excel_id']) as $property => $value) {
                Excel::updateOrCreate(
                    [
                        'confirmed_order_id' => $orderId,
                        'property' => str_replace('_', ' ', $property)
                    ],
                    ['value' => $value]
                );
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
        $orders = ConfirmedOrder::whereIn('id', $orderIds)
            ->with('excels') // Eager load excel data
            ->get();

        if ($orders->isEmpty()) {
            return back()->with('error', 'No orders found to print');
        }

        return view('backend.pages.confirmed_order.labels', compact('orders'));
    }

    // Add other resource methods as needed...
}
