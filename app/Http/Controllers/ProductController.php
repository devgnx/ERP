<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Http\Controllers\Traits\ViewTrait;
use App\Models\Product;
use App\Models\ProductCategory as Category;

use App\Http\Requests\ValidationProductRequest;

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
        $products = $this->product->paginate(15);
        return view($this->viewFolder . 'index', [
            'products'   => $products,
            'categories' => Category::all(),
            'paginate'   => $this->renderPaginate($products)
        ]);
    }

    /**
     * Display a filtered listing of the resource.
     *
     * @return Response
     */
    public function filter(Request $request)
    {
        $filter   = array_filter($request->input('filter'));
        $products = $this->product;

        if (!empty($filter['product']['name'])) {
            $products = $products
                ->where('name', 'like', '%' . $filter['product']['name'] . '%')
                ->orWhere('code', 'like', '%' . $filter['product']['name'] . '%');

        } elseif (!empty($filter['category'])) {
            $products = $products->whereHas('categories', function($query) use ($filter) {
                $query->whereIn('category_id', $filter['category']);
            });
        }

        $products = $products->paginate(15);

        return view($this->viewFolder . 'index', [
            'products'   => $products,
            'categories' => Category::all(),
            'filter'     => $filter,
            'paginate'   => $products->appends($request->input())->render(new PaginatePresenter($products))
        ]);
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
     * @return json
     */
    public function updatePrice(Request $request)
    {
        $rules = [
            'id' => 'required|numeric',
            'product.price' => 'required|regex:/^\d{1,3}(\.\d{3})*(\,\d{2})?$/'
        ];

        $friendly_names = ['product.price' => 'PREÇO'];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($friendly_names);

        if (! $validator->fails()) {
            $price   = str_replace(',', '.', str_replace('.', '', $request->input("product.price")) );
            $product = $this->product->where('id', $request->input('id'))->update(['price' => $price ]);
        }

        return response()->json(
            ! $validator->fails() ?
            ['status' => ['success' => true] ] :
            ['status' => ['error'   => $validator->errors()->all()] ]
        );
    }

    /**
     * Loads the products with the matched query
     * @param  Request $request
     * @return json
     */
    public function load(Request $request)
    {
        $response  = ['suggestions' => []];
        $validator = $this->validate($request, [
            'query' => 'required'
        ]);

        $sellers = $this->product
            ->where('name' ,  'like', '%' . $request->input('query') . '%')
            ->orWhere('code', 'like', '%' . $request->input('query') . '%');

        foreach($sellers->get() as $value) {
            $response['suggestions'][] = [
                'value' => $value->code . ': ' . $value->name,
                'data'  => $value->id,
                'price' => $value->price
            ];
        }

        return response()->json($response);
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
