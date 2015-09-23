<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\ViewTrait;
use App\Repositories\ProductRepository as Product;

class ProductController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'product_controller';
    private $product;

    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
        $this->fixViewFolder($this->viewFolder);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view($this->viewFolder . 'index', [
            'products' => $this->product->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view($this->viewFolder . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ValidationProductRequest  $request
     * @return Response
     */
    public function store(ValidationProductRequest $request)
    {
        $product = $this->product->create($request->input('product'));

        /*$product = new Product;
        $product->name  = $request->input('product.name');
        $product->code  = $request->input('product.code');
        $product->price = $request->input('product.price');
        $product->save();*/

        echo 'test product' . PHP_EOL;
        dd($product);

        return redirect('product.show')
            ->withInput($request->input('slug', $product->slug))
            ->with('status', ['success' => 'Produto Criado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        return view($this->viewFolder . 'show', [
            'product' => $this->product->where('slug', $slug)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  class Models\Product $product
     * @return Response
     */
    public function edit($product)
    {
        return view($this->viewFolder . 'edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ValidationProductRequest  $request
     * @param  string  $slug
     * @return Response
     */
    public function update(ValidationProductRequest $request, $slug)
    {
        $product = $this->product
            ->where('slug', $slug)
            ->update( $request->input('product') );

        return redirect('product.show')
            ->with('status', ['success' => 'Produto "' . $product->name . '" alterado'])
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
            $product = $this->product->update([
                'price' => $request->input('product.price')
            ], $id);
        }

        return response()->json([
            'data' => $validator ?
                ['status' => ['success' => true] ] :
                ['status' => ['error' => $validate->errors()->all()] ]
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
        $this->product->delete($id);

        return redirect('product.index')
            ->with('status', ['success' => 'Produto Removido']);
    }
}
