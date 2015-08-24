<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Http\Controllers\Controler;

class ProductsController extends Controller
{
    public $product;
    public $products;

    public function getProduct($id)
    {
        $this->product = Product::findOrFail($id);

        dd($this->product);
        dd($this->product->stock->quantity);

        return;
    }

    public function getList()
    {
        $this->products = Product::all();

       /* foreach ($this->products as $product) {
            echo 'código:', $product->code;
            echo '<br>';
            echo 'nome: ', $product->name;

            echo '<br>';
            echo '<br>';
        }*/

        $menu = (object) [
            'home' => url('/'),
            'products' => url('produtos/')
        ];

        $main = (object) [
            'title' => 'Highlander Bros.', //$store->title
            'nav' => (object) ['title' => 'Highlander Bros.' /*$store->name*/],
            'menu' => $menu
        ];

        return view('products', ['main' => $main, 'products' => $this->products]);
    }
}