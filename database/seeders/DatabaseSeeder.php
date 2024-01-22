<?php

namespace Database\Seeders;

use App\Models\ExtraVariable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        if (!ExtraVariable::find(1)){
            ExtraVariable::create(['name' => 'SMAIL_SMTP', 'value' => 0, 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_HOST', 'value' => 'localhost', 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_PORT', 'value' => 25, 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_AUTH', 'value' => 0, 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_USERNAME', 'value' => '', 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_PASSWORD', 'value' => '', 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_DEBUG', 'value' => '0', 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_SECURE', 'value' => 'no', 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_FROM', 'value' => 'test@test.com', 'module' => 1]);
            ExtraVariable::create(['name' => 'SMAIL_EMAIL', 'value' => 'test@test.com', 'module' => 1]);

            ExtraVariable::create(['name' => 'OGG_TITLE', 'value' => '', 'module' => 2]);
            ExtraVariable::create(['name' => 'OGG_DESCRIPTION', 'value' => '', 'module' => 2]);
            ExtraVariable::create(['name' => 'OGG_IMAGE', 'value' => '', 'module' => 2]);
        }
    }
}
