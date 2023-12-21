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
    // public function index()
    // {
    //     $userId = auth()->user()->id;

    //     $posts = Post::where('user_id', $userId)
    //     ->orderBy('created_at', 'desc')
    //     ->paginate(6);
    
    //     return view('posts.index', ['posts' => $posts]);
    // }
    public function index()
{
    $user = auth()->user();

    if ($user->level == 'admin') {
        // Se o usuário for um administrador, busque todos os posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
    } else {
        // Se o usuário não for um administrador, busque apenas os posts do usuário
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }

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
    public function edit(Post $post)
    {
        $category = Category::all(); // Substitua 'Categoria' pelo nome do seu modelo de categoria
    
        return view('posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'titulo' => 'required|max:255',
            'categoria_id' => 'required',
            'telefone' => 'required|max:15',
            'endereco' => 'required|max:255',
            'descricao' => 'required',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Adicione outras regras de validação conforme necessário
        ]);
    
        // Obtém o post a ser atualizado
        $post = Post::findOrFail($id);
    
        // Atualiza os dados do post
        $post->titulo = $request->titulo;
        $post->categoria_id = $request->categoria_id;
        $post->telefone = $request->telefone;
        $post->endereco = $request->endereco;
        $post->descricao = $request->descricao;
    
        // Atualiza a imagem, se fornecida
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens');
            $post->imagem = $imagemPath;
        }
    
        // Salva as alterações
        $post->save();
    
        // Redireciona com uma mensagem de sucesso
        return redirect()->route('posts.index')->with('success', 'Post atualizado com sucesso.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
 
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post excluído com sucesso.');
    }

    

}
