<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'url', 'price', 'price-details', 'description', 'discount', 'active'];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function details()
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }
}
