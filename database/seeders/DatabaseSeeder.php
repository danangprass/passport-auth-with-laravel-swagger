<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = ['candidate.view','candidate.create','candidate.update','candidate.delete'];
        $roles = ['Senior HRD', 'HRD'];
        foreach ($permissions as $value) {
            Permission::create(['name' => $value, 'guard_name' => 'api']);
        }
        $product_view = Permission::where('name', 'candidate.view')->first();
        foreach ($roles as $value) {
            # code...
            Role::create(['name' => $value ,'guard_name' => 'api']);
        }
        $admin = Role::where('name', 'Senior HRD')->first();
        $viewer = Role::where('name', 'HRD')->first();
        $admin->givePermissionTo(Permission::all());
        $viewer->givePermissionTo($product_view);
        User::factory()->create(['name' => 'Mr. Jhon','email' => 'admin@email.com'])->assignRole($admin);
        User::factory()->create(['name' => 'Mrs. Lee','email' => 'hrd@email.com'])->assignRole($viewer);
        $this->call(CandidateSeeder::class);
    }
}
