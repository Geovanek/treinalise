<?php
declare(strict_types=1);

namespace App\Models;

use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 */

class Athlete extends Model
{
    use TenantModels;

    protected $fillable = [
        'company_id','coach_id'
    ];
    
    public static function createUser(array $attributes): Athlete
    {
        $athlete = self::create([
            'company_id' => $attributes['company_id'],
            'coach_id' => $attributes['coach_id']
        ]);
        $athlete->users()->create($attributes['user']);
        return $athlete;
    }

    public function getUserAttribute()
    {
        return $this->users->first();
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'userable');
    }
}
