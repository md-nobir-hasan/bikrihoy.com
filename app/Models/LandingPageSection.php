<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageSection extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'is_with_previous', 'image', 'video_link', 'title', 'sub_title', 'description', 'button', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
