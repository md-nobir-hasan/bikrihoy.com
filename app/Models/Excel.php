<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Excel extends Model
{
    use HasFactory;

    protected $fillable = ['confirmed_order_id', 'property', 'value','row'];

    /*
        * Invoice
        * Name
        * Address
        * Phone
        * Amount
        * Note
    */
    protected static $headers = [
        'Invoice' => [
            'display' => 'Invoice',
            'validation' => 'required|string',
            'width' => '100px'
        ],
        'Name' => [
            'display' => 'Name',
            'validation' => 'required|string',
            'width' => '150px'
        ],
        'Address' => [
            'display' => 'Address',
            'validation' => 'required|string',
            'width' => '200px'
        ],
        'Phone' => [
            'display' => 'Phone',
            'validation' => 'required|string',
            'width' => '120px'
        ],
        'Amount' => [
            'display' => 'Amount',
            'validation' => 'required|numeric',
            'width' => '100px'
        ],
        'Note' => [
            'display' => 'Note',
            'validation' => 'nullable|string',
            'width' => '200px'
        ],
        // 'Total' => [
        //     'display' => 'Total',
        //     'validation' => 'required|numeric',
        //     'width' => '100px'
        // ],
        // 'Quantity' => [
        //     'display' => 'Quantity',
        //     'validation' => 'required|numeric',
        //     'width' => '80px'
        // ]
    ];

    public function confirmedOrder()
    {
        return $this->belongsTo(ConfirmedOrder::class);
    }

    public static function getHeaders()
    {
        return collect(self::$headers);
    }

    public static function getHeaderDisplayNames()
    {
        return self::getHeaders()->pluck('display');
    }

    public static function getHeaderWidths()
    {
        return self::getHeaders()->pluck('width');
    }

    public static function getHeaderValidations()
    {
        return self::getHeaders()->pluck('validation');
    }

    public static function validateExcelHeaders(array $headers)
    {
        $expectedHeaders = self::getHeaderDisplayNames()->toArray();
        $trimmedHeaders = array_map('trim', $headers);
        $missingHeaders = array_diff($expectedHeaders, $trimmedHeaders);

        if (!empty($missingHeaders)) {
            throw new \Exception('Missing required headers: ' . implode(', ', $missingHeaders));
        }

        return true;
    }

    public static function validateRowData($rowData, $headers)
    {
        $validator = Validator::make(
            array_combine($headers, $rowData),
            self::getHeaderValidations()->toArray()
        );

        if ($validator->fails()) {
            throw new \Exception('Invalid row data: ' . json_encode($validator->errors()));
        }

        return true;
    }

    public static function formatExcelData($excelRecords)
    {
        return $excelRecords
            ->groupBy('property')
            ->map(function($items) {
                return $items->pluck('value');
            });
    }

    public static function isValidProperty($property)
    {
        return array_key_exists($property, self::$headers);
    }

    public static function getValidProperties()
    {
        return array_keys(self::$headers);
    }
}
