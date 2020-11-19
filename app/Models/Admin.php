<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 */

class Admin extends Model
{
    /**
    * Função para criar User e Admin via seeder.
    */
    public static function createUser(array $attributes): Admin
    {
        $admin = self::create([]);

        $admin->users()->create($attributes['user']);

        return $admin;
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
