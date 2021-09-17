<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        if (Product::all()->isEmpty()) {
            return response()->json(['Message' => 'Nenhum produto encontrado!'], 404);
        } else {
            return Product::all();
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nome' => 'required|min:5',
            'categoria_id' => 'required|min:1',
            'descricao' => 'required|min:1',
            'valor' => 'required|min:1',
            'quantidade' => 'required|min:1'
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->toJson();
        } else {
            Product::create($request->all());
            return response()->json(['Message' => 'Produto Cadastrado com Sucesso!'], 201);
        }
    }

    public function show($id)
    {
        if (Product::find($id)) {
            return Product::find($id);
        } else {
            return response()->json(['Message' => 'Produto não encontrado!'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (Product::find($id)) {
            $validation = Validator::make($request->all(), [
                'nome' => 'min:5',
                'categoria' => 'min:5',
                'descricao' => 'min:5',
                'valor' => 'min:1',
                'quantidade' => 'min:1'
            ]);

            if ($validation->fails()) {
                $errors = $validation->errors();
                return $errors->toJson();
            } else {
                $produto = Product::find($id);
                $produto->update($request->all());
                return response()->json(['Message' => 'Produto atualizado!'], 200);
            }
        } else {
            return response()->json(['Message' => 'Produto não encontrado!'], 404);
        }
    }

    public function destroy($id)
    {
        if (Product::find($id)) {
            $produto = Product::find($id);
            $produto->delete();
            return response()->json(['Message' => 'Produto exluido com sucesso!'], 200);
        } else {
            return response()->json(['Message' => 'Produto não encontrado!'], 404);
        }
    }
}
