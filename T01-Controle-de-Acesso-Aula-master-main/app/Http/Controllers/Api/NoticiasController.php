<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::all();
        return response()->json($noticias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $novaNoticia = $request->all();

       $user = auth('sanctum')->user();

        if (! $user->can('create', $novaNoticia)) {
            return response()->json('Nao autorizado', 401);
        }

       $novaNoticiaCriada = Noticia::create($novaNoticia);

       return response()->json($novaNoticiaCriada, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Noticia $noticia)
    {
        $this->authorize('view',$noticia);

        $user = auth('sanctum')->user();

        if (! $user->can('view', $noticia)) {
            return response()->json('Nao autorizado', 401);
        }

        return response()->json($noticia, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Noticia $noticia)
    {
        $noticia->titulo= $request->titulo;
        $noticia->descricao = $request->descricao;
        $noticia->user_id=$request->user_id;

        $user = auth('sanctum')->user();

        if (! $user->can('update', $noticia)) {
            return response()->json('Nao autorizado', 401);
        }

        $noticia->save();

        return response()->json($noticia, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
    {
        $user = auth('sanctum')->user();

        if (! $user->can('delete', $noticia)) {
            return response()->json('Nao autorizado', 401);
        }

        Noticia::destroy($noticia->id);

        return response()->noContent();
    }

    
}



