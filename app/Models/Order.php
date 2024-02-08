<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "is_available",
        "delivery_address",
        "phone_no",
    ];

    /**
     * Get the comments for the blog post.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
