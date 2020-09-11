<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Uuid;
    
    protected $fillable = [
        'name', 'document_number', 'email', 'url', 'logo', 'active',
        'subscription', 'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
