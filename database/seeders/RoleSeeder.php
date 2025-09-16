<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'member']);
}
}
