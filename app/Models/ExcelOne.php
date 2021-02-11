<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelOne extends Model
{
    use HasFactory;
    protected $fillable = ['first_column','second_column','third_column','forth_column'];
}
