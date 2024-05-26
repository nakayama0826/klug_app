<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportsPost extends Model
{
    // コントローラーはreportsPostだがテーブルはweekly_reportsなので名前を変更
    protected $table = 'weekly_reports';

    use HasFactory;
}
