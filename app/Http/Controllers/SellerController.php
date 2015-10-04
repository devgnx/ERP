<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\ViewTrait;
use App\Repositories\SellerRepository as Seller;

class SellerController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'controllers.seller';
    private $seller;

    public function __construct(Seller $seller)
    {
        $this->middleware('auth');
        $this->seller = $seller;
        $this->fixViewFolder($this->viewFolder);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Seller $seller)
    {
        return view($this->viewFolder . 'index', ['sellers' => $seller->paginate(20)]);
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
     * @param  ValidationSellerRequest  $request
     * @return Response
     */
    public function store(ValidationSellerRequest $request)
    {
        $seller = Seller::create($request->input('seller'));
        echo 'test_seller: ' . PHP_EOL;
        dd($seller);
        return redirect('seller.show')
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view($this->viewFolder . 'show', ['seller' => Seller::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  class Models\Seller $seller
     * @return Response
     */
    public function edit($seller)
    {
        return view($this->viewFolder . 'edit', ['seller' => $seller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ValidationSellerRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ValidationSellerRequest $request, $id)
    {
        $seller = Seller::update($request->input('seller'), $id);

        return redirect('seller.edit')
            ->with('status', ['success' => 'Dados do vendedor "' . $seller->name . '" alterados'])
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
        Seller::delete($id);

        return redirect('seller.index')
            ->with('status', ['success' => 'Vendedor removido']);
    }
}
