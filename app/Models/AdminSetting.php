<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_settings';
    protected $fillable = [
        'config_key',
        'config_value',
        'type'
    ];
}
