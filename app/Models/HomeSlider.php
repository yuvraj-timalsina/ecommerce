<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeSlider extends Model
{
    use HasFactory;

    protected $fillable = ['top_title', 'title', 'sub_title', 'offer', 'link', 'image', 'status'];
}
