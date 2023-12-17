<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $posts = Post::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->paginate(6);
    
        return view('posts.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $categorias = Category::all();
        

        return view('posts.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateRequest $request)
    {

        $image_path = $request->file('imagem')->store('posts', 'public');
        $data['imagem'] = $image_path;
        
        // Upload da imagem
       $image_path = $request->file('imagem')->store('posts', 'public');

       // Criação do post
       $post = Post::create([
        'user_id' => $request->input('user_id'),
        'titulo' => $request->input('titulo'),
        'categoria_id' => $request->input('categoria_id'),
        'telefone' => $request->input('telefone'),
        'status' => 'Pendente', // 'pendente'
        'endereco' => $request->input('endereco'),
        'descricao' => $request->input('descricao'),
        'imagem' => $image_path,
        ]);
        
        return redirect()->route('posts.create')->with('success', 'Post cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
