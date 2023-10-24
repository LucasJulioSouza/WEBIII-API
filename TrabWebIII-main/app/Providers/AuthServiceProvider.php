<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        GATE::define('excluir-noticia', function (User $user, Noticia $noticia){
            return $user->id === $noticia->user_id;
        });
        GATE::define('visualizar-noticia', function (User $user, Noticia $noticia){
            return $user->id === $noticia->user_id;
        });
        GATE::define('editar-noticia', function (User $user, Noticia $noticia){
            return $user->id === $noticia->user_id;
        });

        //
    }
}
