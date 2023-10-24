<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SpatieSeeder extends Seeder
{
    /*
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Exemplo de comando utilizado para criar um papel
        $roleAdmin = Role::create(['name' => 'admin']);
        Aqui e utilizado o metodo findOrCreate para encontrar ou criar um papel
        */
        $roleAdmin = Role::findOrCreate('admin');
        $roleEditor = Role::findOrCreate('editor');
        $roleRevisor = Role::findOrCreate('revisor');
        /*
        Exemplo de comando utilizado para criar uma permissao
        $permissionViewNoticia = Permission::create(['name' => 'viewNoticia']);
        Aqui e utilizado o metodo findOrCreate para encontrar ou criar uma
        permissao
        */
        $permissionViewNoticia = Permission::findOrCreate('viewNoticia');
        $permissionCreateNoticia = Permission::findOrCreate('createNoticia');
        $permissionUpdateNoticia = Permission::findOrCreate('updateNoticia');
        $permissionDeleteNoticia = Permission::findOrCreate('deleteNoticia');
    
    }
}