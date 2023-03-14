<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'keyword',
        'search_time',
        'search_results',
        'total_results',
        'search_engine',
        'search_type',
        'user_name',
        'ip_address',
        'device_type',
        'browser_type',
        'language',
        'clicked_result',
        'time_spent',
        'is_section_active'
    ];
}
