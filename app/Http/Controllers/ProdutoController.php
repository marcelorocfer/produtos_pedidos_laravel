<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Produto;
use Illuminate\Http\Response;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index()
    {
        $produtos = $this->produto->paginate('10');

        return response()->json($produtos, Response::HTTP_OK);
    }

    public function store(ProdutoRequest $request)
    {
        $data = $request->all();
        $foto = $request->file('foto');

        try {

            $pathFoto = $foto->store('fotos', 'public');
            $data['foto'] = $pathFoto;

            $this->produto->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Produto cadastrado com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function show($id)
    {
        try {

            $produtos = $this->produto->findOrFail($id);

            return response()->json([
                'data' => $produtos
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(ProdutoRequest $request, $id)
    {
        $data = $request->all();
        $foto = $request->file('foto');

        try {

            $pathFoto = $foto->store('fotos', 'public');
            $data['foto'] = $pathFoto;

            $produtos = $this->produto->findOrFail($id);
            $produtos->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Produto atualizado com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy($id)
    {
        try {

            $produtos = $this->produto->findOrFail($id);
            $produtos->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Produto removido com sucesso!'
                ]
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}
