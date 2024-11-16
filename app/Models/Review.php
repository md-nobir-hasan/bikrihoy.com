<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'reviewer_name',
        'rating',
        'review_text',
        'is_active'
    ];
    

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }

    public function scopeGlobal($query)
    {
        return $query->whereNull('product_id');
    }

    public function scopeForProduct($query, $productId)
    {
        return $query->where(function($q) use ($productId) {
            $q->where('product_id', $productId)
              ->orWhereNull('product_id');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
