<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produts = Product::orderBy('name')->paginate(Product::TOTAL_PAGE);

        return response()->json($produts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = validator($data, $this->product->rules());
        if ($validate->fails()) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages], 422);
        }

        if (!$insert = $this->product->create($data)) {
            return response()->json(['error' => 'Erro ao inserir usuário'], 500) ;
        }

        return response()->json(['data' => $insert], 201) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->product->find($id)) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);    
        }

        return response()->json(['data' => $product]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validate = validator($data, $this->product->rules($id));
        if ($validate->fails()) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages], 422);
        }

        if (!$product = $this->product->find($id)) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);    
        }

        if (!$update = $product->update($data)) {
            return response()->json(['error' => "Falha ao atualizar produto com id: $id"], 500);    
        }

        return response()->json(['data' => $update]);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->product->find($id)) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);    
        }

        if (!$deleted = $product->delete($id)) {
            return response()->json(['error' => "Falha ao deletar produto com id: $id"], 500);    
        }

        return response()->json(['data' => $deleted]);    
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $validate = validator($data, [
            'q' => 'required'
        ]);
        if ($validate->fails()) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages], 422);
        }

        $products = $this->product->search($request);

        return response()->json(['data' => $products]);
    }
}
