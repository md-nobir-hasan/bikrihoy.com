<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excel extends Model
{
    use HasFactory;

    protected $fillable = ['confirmed_order_id', 'property', 'value'];

    public function confirmedOrder()
    {
        return $this->belongsTo(ConfirmedOrder::class)->orderBy('id', 'asc');
    }


}
