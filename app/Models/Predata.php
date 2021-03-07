<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predata extends Model
{
    use HasFactory;
    protected $primaryKey = 'predata_id';
    protected $fillable = ['predata_cat_name','predata_name','number','pose_one','pose_two','pose_three'];
}
