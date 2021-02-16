<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poseicon extends Model
{
    use HasFactory;
    protected $primaryKey = 'icons_id';
    protected $guarded = ['icons_id'];
}
