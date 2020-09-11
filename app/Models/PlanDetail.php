<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    protected $fillable = ['name'];
    
    public function plan()
    {
        $this->belongsTo(Plan::class);
    }
}
