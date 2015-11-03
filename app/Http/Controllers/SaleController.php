<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ViewTrait;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;

class SaleController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'controllers.sale';
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->middleware('auth');
        $this->sale = $sale;
        $this->fixViewFolder($this->viewFolder);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Sale $sale)
    {
        $sales = $this->sale->full()->paginate(20);
        return view($this->viewFolder . 'index', [
            'sales'    => $sales,
            'paginate' => $this->renderPaginate($sales)
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $sale_id = Sale::create([
            'seller_id'   => $request->input('sale.seller.id'),
            'customer_id' => $request->input('sale.customer.id'),
            'shipping_id' => $this->createShipping($request)
        ])->id;

        $total_price = $this->createItems($request, $sale_id);

        Sale::find($sale_id)->update([
            'total_price' => $total_price
        ]);

        return redirect()
            ->route('sale.show', ['id' => $sale_id])
            ->with('status', ['success' => 'Venda fechada']);
   }

    private function createShipping(Request $request)
    {
        $shipping = $request->input('sale.shipping');

        if (!empty($shipping)) {
            return SaleShipping::create([
                'street' => $shipping['street'],
                'street_number'  => $shipping['street_number'],
                'state_province' => $shipping['state_province'],
                'country'  => $shipping['country'],
                'postcode' => $shipping['postcode'],
                'date'     => null,
                'price'    => $shipping['price']
            ])->id;
        }

        return null;
    }

    private function createItems(Request $request, $sale_id)
    {
        $total_price = 0;
        $products = $request->input('sale.products');

        if (! empty($products)) {
            foreach($products['id'] as $key => $id) {
                $product = Product::find($id);
                if (! isset($products['quantity'][$key]) || ! $product->count()) {
                    continue;
                }

                SaleItem::create([
                    'product_id' => $id,
                    'sale_id'    => $sale_id,
                    'quantity'   => $products['quantity'][$key],
                    'product_price' => (float) $product->price
                ]);

                $total_price += (float) $product->price * (float) $products['quantity'][$key];
            }
        }

        return $total_price;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view($this->viewFolder . 'show', ['sale' => Sale::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view($this->viewFolder . 'edit', ['sale' => Sale::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ValidationSaleRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ValidationSaleRequest $request, $id)
    {
        Sale::update($request->input('sale'), $id);

        return redirect('sale.edit')
            ->with('status', ['success' => 'Venda alterado'])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Sale::delete($id);

        return redirect('sale.index')
            ->with('status', ['success' => 'Venda removida']);
    }
}
