<?php

namespace App\Http\Controllers;

use App\Models\ConfirmedOrder;
use App\Models\Excel;
use App\Http\Requests\StoreConfirmedOrderRequest;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ConfirmedOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check:Confirmed Order']);
    }

    public function index()
    {
        $orders = ConfirmedOrder::with('excels')->get();
        return view('backend.pages.confirmed_order.index', compact('orders'));
    }

    public function create()
    {
        return view('backend.pages.confirmed_order.create');
    }

    public function store(StoreConfirmedOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create confirmed order
            $confirmedOrder = ConfirmedOrder::create([
                'date' => $request->date
            ]);

            // Process Excel file
            $spreadsheet = IOFactory::load($request->file('excel_file'));
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Assuming first row contains headers
            $headers = array_shift($rows);

            // Process each row
            foreach ($rows as $row) {
                foreach ($row as $index => $value) {
                    if ($value !== null) {
                        Excel::create([
                            'confirmed_order_id' => $confirmedOrder->id,
                            'property' => $headers[$index],
                            'value' => $value
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('confirmed-order.index')
                           ->with('success', 'Order created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    // Add other resource methods as needed...
}
