<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class SteadFastCourierService
{
    protected $apiKey;
    protected $secretKey;
    protected $baseUrl;
    protected $headers;

    public function __construct()
    {
        $this->apiKey = config('services.steadfast.api_key');
        $this->secretKey = config('services.steadfast.secret_key');
        $this->baseUrl = config('services.steadfast.base_url', 'https://portal.packzy.com/api/v1');
        $this->headers = [
            'Api-Key' => $this->apiKey,
            'Secret-Key' => $this->secretKey,
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * Create a single order
     *
     * @param array $orderData
     * @return array
     * @throws Exception
     */
    public function createOrder(array $orderData)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->post($this->baseUrl . '/create_order', $orderData);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Failed to create order: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('SteadFast API Error: ' . $e->getMessage());
        }
    }

    /**
     * Create bulk orders (max 500 items)
     *
     * @param array $orders
     * @return array
     * @throws Exception
     */
    public function createBulkOrder(array $orders)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->post($this->baseUrl . '/create_order/bulk-order', [
                    'data' => json_encode($orders)
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Failed to create bulk orders: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('SteadFast API Error: ' . $e->getMessage());
        }
    }

    /**
     * Get status by consignment ID
     *
     * @param string $consignmentId
     * @return array
     * @throws Exception
     */
    public function getStatusByConsignmentId($consignmentId)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get($this->baseUrl . '/status_by_cid/' . $consignmentId);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Failed to get status: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('SteadFast API Error: ' . $e->getMessage());
        }
    }

    /**
     * Get status by invoice ID
     *
     * @param string $invoiceId
     * @return array
     * @throws Exception
     */
    public function getStatusByInvoice($invoiceId)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get($this->baseUrl . '/status_by_invoice/' . $invoiceId);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Failed to get status: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('SteadFast API Error: ' . $e->getMessage());
        }
    }

    /**
     * Get status by tracking code
     *
     * @param string $trackingCode
     * @return array
     * @throws Exception
     */
    public function getStatusByTrackingCode($trackingCode)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get($this->baseUrl . '/status_by_trackingcode/' . $trackingCode);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Failed to get status: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('SteadFast API Error: ' . $e->getMessage());
        }
    }

    /**
     * Get current balance
     *
     * @return array
     * @throws Exception
     */
    public function getBalance()
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get($this->baseUrl . '/get_balance');

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Failed to get balance: ' . $response->body());
        } catch (Exception $e) {
            throw new Exception('SteadFast API Error: ' . $e->getMessage());
        }
    }
}
