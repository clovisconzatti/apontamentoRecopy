<?php

namespace Database\Seeders;

use App\Models\menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::truncate();

        $User=[
            [
                'name' => 'Clovis Dorival Conzatti',
                'email' => 'clovis@plannersolucoes.com.br',
                'password' => bcrypt('Cczt4752')
            ]
        ];
        User::insert($User);
    }
}
