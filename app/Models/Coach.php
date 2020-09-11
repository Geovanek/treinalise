<?php
declare(strict_types=1);

namespace App\Models;

use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 */

class Coach extends Model
{
    use TenantModels, Uuid;

    const ROLE_HEAD_COACH = 1;
    const ROLE_COACH = 2;

    protected $fillable = [
        'company_id', 'role'
    ];

    public static function createUserAndAthlete(array $attributes) //criar Coach e Athlete
    {
        $coach = self::createUser($attributes);
        $athlete = Athlete::create([
            'company_id' => $attributes['company_id'],
            'coach_id' => $coach->id,
        ]);
        $user = $coach->user; //aqui uso o recurso 'user' devido ao método getUserAttribute()
        $athlete->users()->sync($user->id);
        return ['coach' => $coach, 'athlete' => $athlete];
    }
    
    public static function createUser(array $attributes): Coach
    {
        $coach = self::create([
            'company_id' => $attributes['company_id'],
            'role' => $attributes['role'],
        ]);
        $coach->users()->create($attributes['user']);
        return $coach;
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
