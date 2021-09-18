<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        if (Category::all()->isEmpty()) {
            return response()->json(['Message' => 'Nenhuma categoria encontada!'], 404);
        } else {
            return Category::all();
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'titulo' => 'required|min:2',
            'descricao' => 'required|min:2',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->toJson();
        } else {
            Category::create($request->all());
            return response()->json(['Message' => 'Categoria cadastrada com sucesso!'], 201);
        }
    }

    public function show($id)
    {
        if (Category::find($id)) {
            return Category::find($id);
        } else {
            return response()->json(['Message' => 'Categoria não encontrada!'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (Category::find($id)) {
            $validation = Validator::make($request->all(), [
                'titulo' => 'min:2',
                'descricao' => 'min:2',
            ]);

            if ($validation->fails()) {
                $errors = $validation->errors();
                return $errors->toJson();
            } else {
                $produto = Category::find($id);
                $produto->update($request->all());
                return response()->json(['Message' => 'Categoria atualizada!'], 200);
            }
        } else {
            return response()->json(['Message' => 'Categoria não encontrada!'], 404);
        }
    }

    public function destroy($id)
    {
        if (Category::find($id)) {
            $produto = Category::find($id);
            $produto->delete();
            return response()->json(['Message' => 'Categoria exluida com sucesso!'], 200);
        } else {
            return response()->json(['Message' => 'Categoria não encontrada!'], 404);
        }
    }
}
