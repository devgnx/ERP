<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Http\Controllers\Traits\ViewTrait;
use App\Repositories\ProductRepository as Product;
use App\Models\ProductCategory as Category;

use App\Http\Requests\ValidationProductRequest;

use App\Extensions\HSThreePresenter as PaginatePresenter;

class ProductController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'controllers.product';
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
    public function index(Request $request)
    {
        if ($request->input('filter')) {
            $products = $this->filter($request)->paginate(2);
        } else {
            $products = $this->product->paginate(2);
        }

        return view($this->viewFolder . 'index', [
            'products'   => $products,
            'categories' => Category::all(),
            'filter'     => $request->input('filter'),
            'paginate'   => $products->render(new PaginatePresenter($products))
        ]);
    }


    private function filter(Request $request)
    {
        $produt = $this->product;
        $filter = $request->input('filter');

        if ($filter['name']) {
            $product->where('name', $filter['name']);
        }

        if ($filter['categories']) {
            $product->with(['categories' => function($query) {
                $query->whereIn('id', $filter['categories']);
            }]);
        }

        return $product;
    }


    /**
     * Display a listing of the filtred resource.
     *
     * @return Response
     */
    public function search($request)
    {
        return view($this->viewFolder . 'index', [
            'products' => $this->product
                ->with('categories')
                ->find('')
                ->paginate(20)
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
     * Show the form for editing the specified resource.
     *
     * @param  class Models\Product $product
     * @return Response
     */
    public function edit($product)
    {
        return view($this->viewFolder . 'edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Request  $request
     * @param  string  $slug
     * @return Response
     */
    public function update(ValidationProductRequest $request, $slug)
    {
        $product = $this->product
            ->where('slug', $slug)
            ->update( $request->input('product') );

        $category_ids = [];
        foreach ($request->input('category') as $id => $val) {
            $category_ids[] = $id;
        }

        $test = $product->categories->sync($category_ids);

        dd($test);

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
        $validator = Validator::make($request->all(), []);
        $friendly_names = [];

        foreach($request->get('product') as $id => $value) {
            $validator->mergeRules("product.{$id}.price", ['required', 'regex:/^\d{1,3}(\.\d{3})*(\,\d{2})?$/']);
            $friendly_names["product.{$id}.price"] = 'PREÇO';
        }

        $validator->setAttributeNames($friendly_names);

        if (!$validator->fails()) {
            $product = $this->product->update([
                'price' => str_replace(',', '.', str_replace('.', '', $request->input("product.{$id}.price") ) )
            ], $id);
        }

        return response()->json([
            'data' => !$validator->fails() ?
                ['status' => ['success' => true] ] :
                ['status' => ['error'   => $validator->errors()->all()] ]
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
