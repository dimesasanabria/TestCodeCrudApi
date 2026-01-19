<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    use HasFactory;      
    protected $fillable = ['UDDI', 'name', 'description', 'code', 'status'];
}
