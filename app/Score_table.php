<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score_table extends Model
{
    //
    protected $fillable = [
        'rank', 'pre_rank','week_rank', 'week_pre_rank','month_rank', 'month_pre_rank','user_id', 'points','week_points','month_points',
    ];
}
