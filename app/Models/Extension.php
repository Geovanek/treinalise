<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['name', 'url', 'price', 'icon', 'state_color', 'active'];


    /**
     * Get Companies
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Get Plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * Get Details
     */
    public function details()
    {
        return $this->hasMany(ExtensionDetail::class);
    }
}
