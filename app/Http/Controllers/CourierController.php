<?php
use App\Services\SteadFastCourierService;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    protected $steadfastService;

    public function __construct(SteadFastCourierService $steadfastService)
    {
        $this->steadfastService = $steadfastService;
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'invoice' => 'required|string',
            'recipient_name' => 'required|string|max:100',
            'recipient_phone' => 'required|string|size:11',
            'recipient_address' => 'required|string|max:250',
            'cod_amount' => 'required|numeric|min:0',
            'note' => 'nullable|string'
        ]);

        try {
            $response = $this->steadfastService->createOrder($request->all());
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createBulkOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array|max:500',
            'orders.*.invoice' => 'required|string',
            'orders.*.recipient_name' => 'required|string|max:100',
            'orders.*.recipient_phone' => 'required|string|size:11',
            'orders.*.recipient_address' => 'required|string|max:250',
            'orders.*.cod_amount' => 'required|numeric|min:0',
            'orders.*.note' => 'nullable|string'
        ]);

        try {
            $response = $this->steadfastService->createBulkOrder($request->orders);
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function trackOrder(Request $request, $type, $id)
    {
        try {
            $response = match($type) {
                'consignment' => $this->steadfastService->getStatusByConsignmentId($id),
                'invoice' => $this->steadfastService->getStatusByInvoice($id),
                'tracking' => $this->steadfastService->getStatusByTrackingCode($id),
                default => throw new Exception('Invalid tracking type')
            };
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getBalance()
    {
        try {
            $response = $this->steadfastService->getBalance();
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
