<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Pedido;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PedidoController extends Controller
{
    private $cliente;
    private $produto;

    public function __construct(Cliente $cliente, Produto $produto, Pedido $pedido)
    {
        $this->pedido  = $pedido;
        $this->cliente = $cliente;
        $this->produto = $produto;
    }

    public function index()
    {
        $data = Pedido::with($this->cliente->toArray())->paginate('10');
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $pedido = new Pedido();

        $clientes = $this->cliente->pluck('id')->toArray();
        $produtos = $this->produto->pluck('id')->toArray();

        try {
            if(in_array($request->input('cliente'), $clientes) &&
                in_array($request->input('produto'), $produtos)) {

                $pedido->cliente_id = $request->input('cliente');
                $pedido->produto_id = $request->input('produto');
                $pedido->save();

                return response()->json([
                    'data' => [
                        'msg' => 'Pedido cadastrado com sucesso!'
                    ]
                ], Response::HTTP_OK);

            } else {
                return response()->json(['error' => 'O cliente e/ou o produto não existem.'], Response::HTTP_UNAUTHORIZED);
            }

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function show($id)
    {
        try {

            $pedidos = Pedido::with($this->cliente->toArray())->findOrFail($id);

            return response()->json([
                'data' => $pedidos
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $clientes = $this->cliente->pluck('id')->toArray();
        $produtos = $this->produto->pluck('id')->toArray();

        if(in_array($request->input('cliente'), $clientes) &&
            in_array($request->input('produto'), $produtos)) {
            try {

                $data['cliente_id'] = $request->input('cliente');
                $data['produto_id'] = $request->input('produto');

                $pedido = $this->pedido->findOrFail($id);

                $pedido->update($data);

                return response()->json([
                    'data' => [
                        'msg' => 'Pedido atualizado com sucesso!'
                    ]
                ], Response::HTTP_OK);

            } catch(\Exception $e) {
                return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response()->json(['error' => 'O cliente e/ou o produto não existem.'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy($id)
    {
        try {

            $pedido = $this->pedido->findOrFail($id);
            $pedido->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Pedido removido com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}
