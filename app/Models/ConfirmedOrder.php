<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ConfirmedOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date'];

    protected $dates = ['date'];

    // Define headers with their display names and validation rules
    protected static $headers = [

        'Invoice ID' => [
            'display' => 'Invoice ID',
            'validation' => 'required|string',
            'width' => '100px'
        ],
        'Name' => [
            'display' => 'Name',
            'validation' => 'required|string',
            'width' => '150px'
        ],
        'Phone' => [
            'display' => 'Phone',
            'validation' => 'required|string',
            'width' => '120px'
        ],
        // 'Email' => [
        //     'display' => 'Email',
        //     'validation' => 'required|email',
        //     'width' => '150px'
        // ],
        'Address' => [
            'display' => 'Address',
            'validation' => 'required|string',
            'width' => '200px'
        ],
        'Total' => [
            'display' => 'Total',
            'validation' => 'required|numeric',
            'width' => '100px'
        ],
        // 'Order Date' => [
        //     'display' => 'Order Date',
        //     'validation' => 'required|date',
        //     'width' => '100px'
        // ],
        'Quantity' => [
            'display' => 'Quantity',
            'validation' => 'required|numeric',
            'width' => '80px'
        ]
    ];

    public function excels()
    {
        return $this->hasMany(Excel::class);
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

    public function validateExcelHeaders(array $headers)
    {
        $expectedHeaders = self::getHeaderDisplayNames()->toArray();
        $trimmedHeaders = array_map('trim', $headers);
        $missingHeaders = array_diff($expectedHeaders, $trimmedHeaders);

        if (!empty($missingHeaders)) {
            throw new \Exception('Missing required headers: ' . implode(', ', $missingHeaders));
        }

        return true;
    }

    public function getFormattedExcelData()
    {
        return $this->excels
            ->groupBy('property')
            ->map(function($items) {
                return $items->pluck('value');
            });
    }

    public function getFormattedDate()
    {
        return $this->date->format('d M, Y');
    }

    // Helper method to validate excel row data
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
}
