<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Noticia::class, 'noticia');
    // }

    public function index(){
        return response()->json(Noticia::all());
    }

    public function store(Request $request){
        $user = auth('sanctum')->user();

        if(! $user->can('create', Noticia::class)){
            return response()->json('Nao Autorizado', 401);
        }

        $noticia = Noticia::create($request->all());
        return response()->json($noticia, 201);
    }

    public function show(Noticia $noticia){
        $user = auth('sanctum')->user();
        
        if(! $user->can('view', $noticia)){
            return response()->json('Nao Autorizado', 401);
        }

        return response()->json($noticia, 200);
    }

    public function update(Noticia $noticia, Request $request){
        $user = auth('sanctum')->user();

        if(! $user->can('update', $noticia)){
            return response()->json('Nao Autorizado', 401);
        }
        
        $noticia->titulo = $request->titulo;
        $noticia->descricao = $request->descricao;
        $noticia->user_id = $request->user_id;
        $noticia->save();

        return response()->json($noticia, 200);
    }

    public function destroy(Noticia $noticia){
        $user = auth('sanctum')->user();

        if(! $user->can('delete', $noticia)){
            return response()->json('Nao Autorizado', 401);
        }

        Noticia::destroy($noticia->id);
        return response()->noContent();
    }
}