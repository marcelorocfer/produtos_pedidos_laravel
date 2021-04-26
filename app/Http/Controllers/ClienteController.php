<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        $clientes = $this->cliente->paginate('10');

        return response()->json($clientes, Response::HTTP_OK);
    }

    public function store(ClienteRequest $request)
    {
        $data = $request->all();
        $data['data_cadastro'] = Carbon::now();

        try {

            $this->cliente->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Cliente cadastrado com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function show($id)
    {
        try {

            $clientes = $this->cliente->findOrFail($id);

            return response()->json([
                'data' => $clientes
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(ClienteRequest $request, $id)
    {
        $data = $request->all();

        try {

            $clientes = $this->cliente->findOrFail($id);
            $clientes->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Cliente atualizado com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy($id)
    {
        try {

            $clientes = $this->cliente->findOrFail($id);
            $clientes->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Cliente removido com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}
