<?php

namespace App\Models;

use Eloquent;
use DB;
use App;
use Auth;
use Notifynder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Models\SaleShipping as Shipping;
use App\Models\Seller;
use App\Models\SaleStatus;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\ProductCategory as Category;

class Sale extends Eloquent
{
    protected $table    = 'module_sale';
    protected $fillable = ['seller_id', 'customer_id', 'shipping_id', 'subtotal_price', 'total_price'];

    public function status()
    {
        return $this->belongsTo(SaleStatus::class, 'status_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    public function getTotalPriceAttribute()
    {
        return number_format($this->attributes['total_price'], 2, ',', '.');
    }

    public function scopeLastMonth($query)
    {
        return $query->whereRaw($this->table . '.created_at >= CURDATE() - INTERVAL 1 MONTH')
            ->whereRaw($this->table . '.created_at <= CURDATE()');
    }

    public function scopeLastWeek($query)
    {
        return $query->whereRaw($this->table . '.created_at >= CURDATE() - INTERVAL 1 WEEK')
            ->whereRaw($this->table. '.created_at <= CURDATE()');
    }

    public function scopeToday($query)
    {
        return $query->whereRaw($this->table . '.created_at >= CURDATE() - INTERVAL 1 DAY')
            ->whereRaw($this->table . '.created_at <= CURDATE()');
    }

    public function scopeFull($query)
    {
        return $query->with(['items.product', 'customer', 'shipping']);
    }

    public function scopeProducts($query)
    {
        return $query->with(['items.product', 'items.product.categories']);
    }

    public function scopeCountBySale($query)
    {
        $customer_table  = App::make(Customer::class)->getTable();

        $select = [
            'COUNT(' . $this->table . '.id) AS count',
            $this->table    . '.id',
            $customer_table . '.name',
            $this->table    . '.created_at'
        ];

        return $query->select( DB::raw(implode($select, ', ')) )
            ->join( $customer_table, $customer_table . '.id', '=', $this->table . '.customer_id')
            ->groupBy( $this->table . '.customer_id' )
            ->orderBy( 'count', $this->table . '.created_at' )
            ->limit(5);
    }

    public function scopeCountByProduct($query)
    {
        $sale_item_table = App::make(SaleItem::class)->getTable();
        $product_table   = App::make(Product::class)->getTable();
        $pivot_category_table = App::make(Product::class)->getPivotCategoryTable();

        $select = [
            'SUM(' . $sale_item_table . '.quantity) AS count',
            $product_table . '.id',
            $product_table . '.name',
            $this->table   . '.created_at'
        ];

        return $query->select( DB::raw(implode($select, ', ')) )
            ->join( $sale_item_table, $sale_item_table . '.sale_id', '=', $this->table . '.id' )
            ->join( $product_table, $product_table . '.id', '=', $sale_item_table . '.product_id' )
            ->groupBy( $sale_item_table . '.sale_id' )
            ->orderby( 'count', $this->table . '.created_at' )
            ->limit(10);
    }

    public function scopeCountByCategory($query)
    {
        $sale_item_table = App::make(SaleItem::class)->getTable();
        $category_table  = App::make(Category::class)->getTable();
        $pivot_category_table = App::make(Product::class)->getPivotCategoryTable();

        $select = [
            'SUM(' . $sale_item_table . '.quantity) AS count',
            $category_table . '.id',
            $category_table . '.name',
            $this->table    . '.created_at'
        ];

        return $query->select( DB::raw(implode($select, ', ')) )
            ->join( $sale_item_table, $sale_item_table . '.sale_id', '=', $this->table . '.id' )
            ->join( $pivot_category_table, $sale_item_table . '.product_id', '=', $pivot_category_table . '.product_id' )
            ->join( $category_table, $category_table . '.id', '=', $pivot_category_table . '.category_id' )
            ->groupBy( $pivot_category_table . '.category_id' )
            ->orderby( 'count', $this->table . '.created_at' )
            ->limit(10);
    }

    public function scopeCountBySeller($query)
    {
        $sale_item_table = App::make(SaleItem::class)->getTable();
        $seller_table    = App::make(Seller::class)->getTable();

        $select = [
            'SUM(' . $sale_item_table . '.quantity) AS count',
            $seller_table . '.id',
            $seller_table . '.name',
            $this->table  . '.created_at'
        ];

        return $query->select( DB::raw(implode($select, ', ')) )
            ->join( $sale_item_table, $sale_item_table . '.sale_id', '=', $this->table . '.id' )
            ->join( $seller_table, $seller_table . '.id', '=', $this->table  . '.seller_id' )
            ->groupBy( $this->table . '.seller_id' )
            ->orderby( 'count', $this->table . '.created_at' )
            ->limit(10);
    }

    public function scopeCountByCustomer($query)
    {
        $sale_item_table = App::make(SaleItem::class)->getTable();
        $customer_table  = 'module_customer';

        $select = [
            'SUM(' . $sale_item_table . '.quantity) AS count',
            $customer_table . '.id',
            $customer_table . '.name',
            $this->table    . '.created_at'
        ];

        return $query->select( DB::raw(implode($select, ', ')) )
            ->join( $sale_item_table, $sale_item_table . '.sale_id', '=', $this->table . '.id' )
            ->join( $customer_table, $customer_table . '.id', '=', $this->table  . '.customer_id' )
            ->groupBy( $this->table . '.customer_id' )
            ->orderby( 'count', $this->table . '.created_at' )
            ->limit(10);
    }

    public function getNewSales($user = null)
    {
        if ($user === null) {
            $user = Auth::user();
        }

        $notifications = $user->getNotificationsNotRead(false, false, 'desc', function($query) {
            return $query->byCategory('sale.new');
        });

        return $notifications;
    }

    public function createNotification(User $user = null)
    {
        if (User::all()->COUNT() > 1) {
            $user = $user === null || Auth::user() ? Auth::user() : false;

            if ($user) {

                return Notifynder::loop(
                    User::where('id', '<>', $user->id)->get(),
                    function(NotifynderBuilder $builder, $other_user)
                    {
                        $builder->category('sale.new')
                            ->from($user->id)
                            ->to($other_user->id)
                            ->url(route('product.edit', ['id' => 1]))
                            ->extra(['sale' => $this->id]);
                    }
                )->send();
            }
        }

        return false;
    }
}
