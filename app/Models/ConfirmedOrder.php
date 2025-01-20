<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ConfirmedOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date'];

    protected $dates = ['date'];

    public function excels()
    {
        return $this->hasMany(Excel::class);
    }

    public function getFormattedExcelData()
    {
        return Excel::formatExcelData($this->excels);
    }

    public function getFormattedDate()
    {
        return $this->date->format('d M, Y');
    }
}
