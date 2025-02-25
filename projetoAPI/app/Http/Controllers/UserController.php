<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{

  protected $client;//client guzzle
  protected $baseUrl;


   public function __construct() {
   $this->client = new Client(); // Inicialize o cliente Guzzle
   $this->baseUrl = 'http://localhost:3000'; // Seu URL base
   }
  


    public function index(){

        return view('layouts.app');
    }

    public function newPost(){

        return view('posts.create');
    }

    public function posts(){
      $myPosts = json_encode($this->getAllPosts());

     $posts = json_decode($myPosts,false);
    
    // dd($myPosts);
     

        return view('posts.list',compact('posts') );
    }

    public function getAllPosts()
    {
        $response = $this->client->get("{$this->baseUrl} /posts");
        $body = $response->getBody();
        $posts = json_decode($body,true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
        // Trate erros de decodificação JSON
        Log::error("Erro ao decodificar JSON: " . json_last_error_msg());
        return null; // Ou um array vazio, ou lance uma exceção
        }
   
      return $posts;
      

     
      
    }

    public function getPost($id){
        $response = $this->client->get("{$this->baseUrl} /posts/{$id}");
        $body = $response->getBody();
        $post = json_decode($body,true);

         if (json_last_error() !== JSON_ERROR_NONE) {
         // Trate erros de decodificação JSON
         Log::error("Erro ao decodificar JSON: " . json_last_error_msg());
         return null; // Ou um array vazio, ou lance uma exceção
         }
        
        return $post;
    }
    public function createPost(Request $request){  
       try {
        $data = $request->validate([
            'title'=>'required|string',
            'body'=>'required|string',
          
        ]);
        $response = $this->client->post("{$this->baseUrl} /posts",[
            'json'=>$data // Envia os dados validados como JSON
        ]);
        $body = $response->getBody();
        $newPost = json_decode($body,true);

         if (json_last_error() !== JSON_ERROR_NONE) {
         Log::error("Erro ao decodificar JSON: " . json_last_error_msg());
         return response()->json(['error' => 'Erro ao decodificar JSON'], 500);
         }

         $return = json_encode($this->getAllPosts(),true);//converte em json
         $posts = json_decode($return,false); //converte em array php

         return view('posts.list',compact('posts')); // Retorna o novo post criado e o código 201 (Created)

       } catch (\Exception $e) {
            dd($e);
             Log::error("Erro na requisição: " . $e->getMessage());
             return response()->json(['error' => 'Erro na requisição'], 500);
       }
    }


    public function updatePost($id){
        $post = $this->getPost($id);
        // dd($post);
        return view('posts.edit',compact('post'));
    }
    public function updatePostSave(Request $request){
        try {
            $data = $request->validate([
                'title'=>'required|string',
                'body'=>'required|string',
                'id'=>'required|string',
              
               
            ]);

            
            $response = $this->client->put("{$this->baseUrl} /posts/{$request->id}",[
                'json'=>$data // Envia os dados validados como JSON
            ]);
            $body = $response->getBody();
            $newPost = json_decode($body,true);

             if (json_last_error() !== JSON_ERROR_NONE) {
             Log::error("Erro ao decodificar JSON: " . json_last_error_msg());
             return response()->json(['error' => 'Erro ao decodificar JSON'], 500);
             }

            $return = json_encode($this->getAllPosts(),true);//converte em json
            $posts = json_decode($return,false); //converte em array php

            return view('posts.list',compact('posts')); // Retorna o novo post criado e o código 201 (Created)

           } catch (\Exception $e) {
                 Log::error("Erro na requisição: " . $e->getMessage());
                 return response()->json(['error' => 'Erro na requisição'], 500);
           }
        }



        public function delPost($id){
            try {
                $response = $this->client->delete("{$this->baseUrl} /posts/{$id}");
                $body = $response->getBody();
                $newPost = json_decode($body,true);
    
                 if (json_last_error() !== JSON_ERROR_NONE) {
                 Log::error("Erro ao decodificar JSON: " . json_last_error_msg());
                 return response()->json(['error' => 'Erro ao decodificar JSON'], 500);
                 }
    
                 return response()->json($newPost, 201); // Retorna o novo post criado e o código 201 (Created)
    
               } catch (\Exception $e) {
                     Log::error("Erro na requisição: " . $e->getMessage());
                     return response()->json(['error' => 'Erro na requisição'], 500);
               }
            }
}
