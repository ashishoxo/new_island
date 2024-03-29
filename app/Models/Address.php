<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "line1",
        "line2",
        "city",
        "state",
        "zip",
        "country",
        "type",
        "is_default"
    ];
}
