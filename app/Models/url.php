<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class url extends Model
{
    use HasFactory,SoftDeletes;

    const package = ['Basic' => 10,'Advanced' => 1000,'Enterprise' => -1];

    protected $fillable = [
        'user_id',
        'encryptUrl',
        'orgUrl',
        'status'
    ];
}
