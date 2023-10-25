<?php

use App\Http\Controllers\Api\NoticiaController;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('noticias', NoticiaController::class);

    Route::patch('/noticias/{noticia}', function(Noticia $noticia, Request $request){
        $user = auth('sanctum')->user();

        if(! $user->can('update', $noticia)){
            return response()->json('Nao Autorizado', 401);
        }

        $noticia->titulo = $request->titulo;
        $noticia->save();
        return $noticia;
    });
});

Route::post('/login', function(Request $request){
    $credenciais = $request->only(['name', 'email', 'password']);
    
    if(Auth::attempt($credenciais) === false){
        return response()->json('Nao Autorizado', 401);
    }

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token');
    
    //dd($token);
    return response()->json(['token' => $token->plainTextToken]);
    
});
