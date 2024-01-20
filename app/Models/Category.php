<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','description','image'];

    public function getImageAttribute($image) {
        return \Storage::disk('s3')->temporaryUrl($image,now()->addMinute());
    }
}
