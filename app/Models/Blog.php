<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'author', 'author_image', 'slug', 'content', 'image', 'status', 'deleted_at','created_at','updated_at'];
    protected $appends = ['status_formatted'];

    public function getStatusFormattedAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
