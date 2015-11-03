<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;
use Notifynder;
use App\Models\User;
use App\Models\ProductStock as Stock;
use App\Models\ProductCategory as Category;
use App\Models\Supplier;
use App\Models\Sale;
use App\Models\SaleItem;

class Product extends Eloquent
{
    use SoftDeletes;
    protected $table = 'module_product';
    protected $pivotCategoryTable = 'module_product_in_category';
    protected $pivotSupplierTable = 'module_product_in_supplier';
    protected $fillable = ['code', 'name', 'price'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, $this->pivotCategoryTable, 'product_id', 'category_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, $this->pivotSupplierTable, 'product_id');
    }

    public function sales()
    {
        return $this->hasMany(SaleItem::class)->belongsTo(Sale::class);
    }

    public function scopeCategories($query, $category)
    {
        return $query->whereHas('categories', function($query) use ($category) {
            if (is_array($category)) {
                $query->whereIn('category_id', $category);
            } else {
                $query->find($category);
            }
        });
    }

    public function hasCategory( $category_id )
    {
        foreach($this->categories as $value) {
            if ($value['id'] == $category_id) return true;
        }

        return false;
    }

    public function getPivotCategoryTable()
    {
        return $this->pivotCategoryTable;
    }

    public function getPivotSupplierTable()
    {
        return $this->pivotSupplierTable;
    }

    public function createNotification(User $user = null)
    {
        if (User::all()->count() > 1) {
            $user = $user === null || Auth::user() ? Auth::user() : false;

            if ($user) {

                return Notifynder::loop(
                    User::where('id', '<>', $user->id)->get(),
                    function(NotifynderBuilder $builder, $other_user)
                    {
                        $builder->category('product.new')
                            ->from($user->id)
                            ->to($other_user->id)
                            ->url(route('product.edit', ['id' => 1]))
                            ->extra(['product' => $this->id]);
                    }
                )->send();
            }
        }

        return false;
    }
}