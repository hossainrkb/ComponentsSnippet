<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadTestFile extends Model
{
    use HasFactory;
    protected $fillable  = ['path','extention','original_name','rename_name'];
  
}
