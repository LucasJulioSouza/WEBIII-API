<?php

/** Script para ativar o funcionamento básico do SPATIE no Laravel */
/** Permitindo acesso aos métodos das classes Role e Permission */
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

// Carregue o autoload do Composer
require __DIR__.'/vendor/autoload.php';

// Inicialize o aplicativo Laravel
$app = require_once __DIR__.'/bootstrap/app.php';

// Carregue as configurações do aplicativo
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Agora você pode usar as classes do Laravel e do Spatie Permission

/**
 * Exemplo de comando utilizado para criar um papel
 */
$roleAdmin = Role::findOrCreate('admin');
$roleEditor = Role::findOrCreate('editor');
$roleRevisor = Role::findOrCreate('revisor');

/**
 * Exemplo de comando utilizado para criar uma permissão
 */
$permissionViewNoticia = Permission::findOrCreate('viewNoticia');
$permissionCreateNoticia = Permission::findOrCreate('createNoticia');
$permissionUpdateNoticia = Permission::findOrCreate('updateNoticia');
$permissionDeleteNoticia = Permission::findOrCreate('deleteNoticia');

/**
 * O método assignRole é utilizado para atribuir um papel a uma permissão
 */
$permissionViewNoticia->assignRole($roleAdmin);
$permissionCreateNoticia->assignRole($roleAdmin);
$permissionUpdateNoticia->assignRole($roleAdmin);
$permissionDeleteNoticia->assignRole($roleAdmin);

/**
 * Buscamos o usuário com ID igual a 1 e atribuímos o papel de admin a ele
 */
$user = User::find(1);
$user->assignRole('admin');

/**
 * Buscamos o usuário com ID igual a 2 e atribuímos o papel de editor a ele
 */
$user = User::find(2);
$user->assignRole('editor');