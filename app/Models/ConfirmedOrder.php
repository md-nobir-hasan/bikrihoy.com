<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfirmedOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date'];

    public function excels()
    {
        return $this->hasMany(Excel::class);
    }
}
