<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $password = 'password';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $self = $this;
        factory(\App\Models\User::class, 1)
            ->make([
                'name' => 'Geovane Krüger',
                'email' => 'admin@user.com',
            ])->each(function ($user) use ($self){
                \App\Models\Admin::createUser([
                'user' => $self->userToArray($user)
                ]);
            });

        //\Tenant::setTenant(Company::find(1));
        factory(\App\Models\User::class, 1)
            ->make([
                'name' => 'Geovane Krüger',
                'email' => 'geovanek@gmail.com',
                'phone' => '00000000',
                'cpf' => '01234567890',
            ])->each(function ($user) use ($self){
                \App\Models\Coach::createUserAndAthlete([
                'user' => $self->userToArray($user),
                'company_id' => 1,
                'role' => 1,
                ]);
            });

        //\Tenant::setTenant(Company::find(1));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'coach1@user.com',
            ])->each(function ($user) use ($self){
                \App\Models\Coach::createUserAndAthlete([
                'user' => $self->userToArray($user),
                'role' => 2,
                'company_id' => 1,
                ]);
            });

        //\Tenant::setTenant(Company::find(2));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'coach2@user.com',
            ])->each(function ($user) use ($self){
                \App\Models\Coach::createUserAndAthlete([
                'user' => $self->userToArray($user),
                'role' => 1,
                'company_id' => 2,
                ]);
            });

        //\Tenant::setTenant(Company::find(1));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'athlete1@user.com',
            ])->each(function ($user) use ($self){
                \App\Models\Athlete::createUser([
                'user' => $self->userToArray($user),
                'company_id' => 1,
                'coach_id' => 1,
                ]);
            });

        //\Tenant::setTenant(Company::find(1));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'athlete2@user.com',
            ])->each(function ($user) use ($self){
                \App\Models\Athlete::createUser([
                'user' => $self->userToArray($user),
                'company_id' => 1,
                'coach_id' => 2,
                ]);
            });

        //\Tenant::setTenant(Company::find(2));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'athlete3@user.com',
            ])->each(function ($user) use ($self){
                \App\Models\Athlete::createUser([
                'user' => $self->userToArray($user),
                'company_id' => 2,
                'coach_id' => 3,
                ]);
            });
    }

    private function userToArray($user)
    {
        return $user->toArray() + ['password' => $this->password];
    }
}
