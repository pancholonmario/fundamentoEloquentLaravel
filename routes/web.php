<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Post;

Route::get('eloquent', function () {
    
    // para poder ver todos los posts ustilzo: $posts = Post::all();

    //ahora voy a ver a lista todos los posts del 1 al 20 ordenados descendetemente pero solo los 3 elementos

    $posts = Post::where('id', '>=', '20')
    ->orderBy('id', 'desc')
    ->take(3)
    ->get();

    foreach($posts as $post){

        echo "$post->id $post->title <br>";

    }

});


Route::get('posts', function () {
    

    $posts = Post::get();

    foreach($posts as $post){
        //voy a imprimir el nombre del usuario que creo ese post, el user pertenece al método del modelo Post, coloco entre laves porque tengo varios niveles
        //get_title para ver las mayusculas
        echo "
        $post->id 
    
      <strong>  {$post->user->get_name}    </strong>    
        $post->get_title <br>";

    }

});

//imprimir usuarios y ver cuantos Posts tiene cada usuario
use App\User;
Route::get('users', function () {
    

    $users = User::get();

    foreach($users as $user){
        //voy a imprimir el nombre del usuario que creo ese post, el user pertenece al método del modelo Post, coloco entre laves porque tengo varios niveles
        //le pongo get_name para controlar que sean mayusculas
        echo "
        $user->id 
    
      <strong>  $user->get_name    </strong>    
        {$user->posts->count()} posts<br>";

    }

});

//COLECCIONES:

Route::get('collections', function () {
    

    $users = User::get();

       // dd($users);
       //verificar si mi colección contiene el item número 4: dd($users->contains(4));
       //ver todos los usuarios excepto el 1,2 y el 3: dd($users->except([1, 2, 3]));
       //quiero ver solo el usuario con id 4: dd($users->only(4));
    // para buscar un único elemento podemos usar find: dd($users->find(4));
//traeme los usuarios cargando esa relacion con los posts, dentro de load se pone el nombre del método que está en User: dd($users->load('posts'));
    dd($users->load('posts'));
       
       
});

//SERIALIZACIONES:

Route::get('serialization', function () {
    // get y all casi lo mismo
    $users = User::all();


    //devuelve un array : dd($users->toArray());
    //quiero que se coloque el Id con el usuario 1: $user = $users->find(1); 
    
    //Método para retorna un JSON:
    $user = $users->find(1);
    dd($user->toJson());
    
    
       
       
});