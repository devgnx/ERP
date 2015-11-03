<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\ViewTrait;
use App\Models\ProductCategory as Category;
use App\Models\Supplier;
use App\Extensions\HSThreePresenter as PaginatePresenter;

class SupplierController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'controllers.supplier';
    private $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->middleware('auth');
        $this->supplier = $supplier;
        $this->fixViewFolder($this->viewFolder);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = $this->supplier->paginate(20);
        return view($this->viewFolder  . 'index', [
            'suppliers'  => $suppliers,
            'categories' => Category::all(),
            'paginate'   => $this->renderPaginate($suppliers)
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
        $suppliers = $this->supplier;

        if (!empty($filter['supplier']['name'])) {
            $suppliers = $suppliers
                ->where('name', 'like', '%' . $filter['supplier']['name'] . '%')
                ->orWhere('code', 'like', '%' . $filter['supplier']['name'] . '%');

        } elseif (!empty($filter['category'])) {
             $suppliers = $suppliers->whereHas('products', function($query) use ($filter) {
                $query->whereHas('categories', function($query) use ($filter) {
                    $query->whereIn('category_id', $filter['category']);
                });
            });
        }

        $suppliers = $suppliers->paginate(15);

        return view($this->viewFolder . 'index', [
            'suppliers'   => $suppliers,
            'categories' => Category::all(),
            'filter'     => $filter,
            'paginate'   => $suppliers->appends($request->input())->render(new PaginatePresenter($suppliers))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
