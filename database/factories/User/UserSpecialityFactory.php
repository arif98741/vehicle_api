<?php

namespace Database\Factories\User;

use App\Models\Speciality;
use App\Models\User;
use App\Models\User\UserSpeciality;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSpecialityFactory extends Factory
{
    protected $model = UserSpeciality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(),
            'speciality_id' => Speciality::all()->random(),
        ];
    }
}
