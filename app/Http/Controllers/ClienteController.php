<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::all();

        $clienteComImagem = $cliente->map(function($cliente){
            return[
                'nome' => $cliente->nome,
                'endereco' => $cliente->endereco,
                'telefone' => $cliente-> telefone,
                'email' => $cliente-> email,
                'cpf' => $cliente-> cpf,
                'senha' => $cliente-> senha,
                'imagem' => asset('storage/' . $cliente->imagem)
            ];
        });



        return response()->json($clienteComImagem);
    }

    public function store(Request $request){
        $clienteData = $request->all();

    if($request->hasFile('imagem')){
        $imagem = $request->file('imagem');
        $nomeImagem = time().'.'.$imagem->getClientOriginalExtension();
        $caminhoImagem = $imagem->storeAs('imagens/clientes', $nomeImagem, 'public');
        $produtoData['imagem'] = $caminhoImagem;
    }
    $cliente = Cliente::create($clienteData);
    return response()->json(['cliente'=>$cliente], 201); 
    }

}
