<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "status",
        "ip_address",
        "user_agent",
        "url",
        "response",
    ];
}
