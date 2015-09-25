<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\ViewTrait;
use App\Repositories\SaleRepository as Sale;

class SaleController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'sale_controller';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Sale $sale)
    {
        return view($this->viewFolder . 'index', [
            'sales' => $sale::paginate(20)
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
     * @param  ValidationSaleRequest  $request
     * @return Response
     */
    public function store(ValidationSaleRequest $request)
    {
        $sale = Sale::create($request->input('sale'));
        //$sale->save();

        echo 'test Sale' . PHP_EOL;
        dd($sale);

        return redirect('sale.show')
            ->withInput($request->input('id', $sale->id))
            ->with('status', ['success' => 'Venda fechada']);
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
