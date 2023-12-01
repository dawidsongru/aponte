<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            // Se a requisição for AJAX, retorne as categorias como JSON
            return response()->json(['categorias' => $categories]);
        }

        // Se for uma requisição não-AJAX, retorne a visão Blade com as categorias
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorias = new Category();
        $categorias->name = $request->name;
        $categorias->save();

        return redirect()->route('categories.create');

        $categorias = Category::all();

        return response()->json(['categorias' => $categorias]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        return response()->json(['categoria' => $category]);
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoria = Category::findOrFail($id);
        $categoria->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Categoria atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['message' => 'Categoria excluída com sucesso'], 200);
        } catch (\Exception $e) {
            // Se ocorrer algum erro durante a exclusão, você pode tratar aqui
            return response()->json(['error' => 'Erro ao excluir a categoria'], 500);
        }
    }
}
