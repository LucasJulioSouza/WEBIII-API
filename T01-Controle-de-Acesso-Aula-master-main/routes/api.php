<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Noticia;
use App\Http\Controllers\Api\NoticiasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/noticias', NoticiasController::class);

    Route::patch('/noticias/{noticia}', function(Request $request, Noticia $noticia) {
        if ($request->has('titulo')) {
            $noticia->titulo = $request->titulo;
        }
    
        if ($request->has('descricao')) {
            $noticia->descricao = $request->descricao;
        }
    
        if ($request->has('user_id')) {
            $noticia->user_id = $request->user_id;
        }
    
        $noticia->save();
    
        return response()->json($noticia, 200);
    });
});



Route::post('/login', function(Request $request){


    $credenciais = $request -> only(['name','email','password']);

    if(Auth::attempt($credenciais)=== false){

        return response()->json('credenciais invalidas', 401);

    }

    $user=Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token');


    return response()->json(['token'=>$token->plainTextToken]);

    

});