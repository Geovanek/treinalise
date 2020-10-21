<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use Uuid;
    
    protected $fillable = ['name', 'url', 'price', 'price_details', 'description', 'discount', 'icon', 'state_color', 'active'];

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
