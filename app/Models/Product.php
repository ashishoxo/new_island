<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "category_id",
        "name",
        "description",
        "image",
        "is_available"
    ];

    /**
     * Get the comments for the blog post.
     */
    public function varients(): HasMany
    {
        return $this->hasMany(ProductVarient::class);
    }

    public function getImageAttribute($image) {
        return \Storage::disk('s3')->temporaryUrl($image,now()->addMinute());
    }
}
