<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ControllerTrait;

use App\Respositories\ProductRepository as Product;

class ProductController extends Controller
{
    use ControllerTrait;

    private $viewFolder = 'product_controller';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Product $product)
    {
        return view($this->viewFolder . 'index', [
            'products' => $product::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view($this->viewFolder . 'create', [
            'product' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ValidationProductRequest $request)
    {
        $product = Product::create($request->input('product'));

        /*$product = new Product;
        $product->name  = $request->input('product.name');
        $product->code  = $request->input('product.code');
        $product->price = $request->input('product.price');
        $product->save();*/

        echo 'test product' . PHP_EOL;
        dd($product);

        return redirect('product.show')
            ->withInput($request->input('id', $product->id))
            ->with('product.status', 'Produto Criado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view($this->viewFolder . 'show', ['product' => Product::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view($this->viewFolder . 'edit', ['product' => Product::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ValidationProductRequest $request, $id)
    {
        Product::update($request->input('product'), $id);

        return redirect('product.edit')
            ->with('product.status', 'Produto Alterado')
            ->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function updatePrice(Request $request, $id)
    {
        $validator = Validator::make($request, [
            'product.price' => 'required|decimal:10,2'
        ]);

        if (!$validator->fails()) {
            $product = Product::update(['price' => $request->input('product.price')], $id);
        }

        return response()->json([
            'data' => $validator ?
                ['status' => 'success'] :
                ['status' => 'error', 'message' => $validate->errors()->all()]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Product::delete($id);

        return redirect('product.index')
            ->with('product.status', 'Produto Removido');
    }
}
