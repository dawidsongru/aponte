<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class StatusController extends Controller
{
    public function mudarStatus(Request $request, $postId)
    {

        
        // Valide os dados da requisição conforme necessário
        // $request->validate([
        //     'current_status' => 'required|in:public,private', // Adapte conforme seus status
        // ]);

        // Encontre o post pelo ID
        $post = Post::findOrFail($postId);

        // Atualize o status do post
        $post->update([
            'status' => $request->input('status'),
        ]);

        // Redirecione de volta para a página de posts com a mensagem de sucesso
        return redirect()->route('posts.index')->with('sucesso', 'Status do post alterado com sucesso');
    }
}
