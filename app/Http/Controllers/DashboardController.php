<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sale;
use App\Http\Controllers\Traits\ViewTrait;

class DashboardController extends Controller
{
    use viewTrait;

    private $viewFolder = 'controllers.dashboard';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd( Sale::countBySale()->lastMonth()->get() );
        //dd( Sale::countByProduct()->get() );
        //dd($this->groupDashboardData( Sale::countBySeller()->lastWeek() ), $this->groupDashboardData( Sale::countByCustomer()->lastWeek()));

        $dashboardData = [
            'sale'     => $this->groupDashboardData( Sale::countBySale()->lastMonth() ),
            'product'  => $this->groupDashboardData( Sale::countByProduct()->lastWeek() ),
            'category' => $this->groupDashboardData( Sale::countByCategory()->today() ),
            'seller'   => $this->groupDashboardData( Sale::countBySeller()->lastWeek() ),
            'customer' => $this->groupDashboardData( Sale::countByCustomer()->lastWeek() )
       ];

       //dd(json_encode($dashboardData));

        return view($this->viewFolder . 'index', [
            'dashboardData' => json_encode($dashboardData)
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

    private function getLastKey($array)
    {
        end( $array );
        $last_key = key( $array );
        reset( $array );

        return $last_key;
    }

    private function groupDashboardData($data, $type = null) {
        setlocale(LC_TIME, 'pt_BR.ISO-8859-1');

        $grouped = [
            'categories' => [],
            'series'     => []
        ];

        $temp_data = [];

        foreach ($data->get() as $key => $item) {
            $date = Carbon::parse($item->created_at)->formatLocalized('%d %B');
            $grouped['categories'][$date] = $date;
            $temp_data[$item->id][$date]  = intval($item->count);

            if (! isset($grouped['series'][$item->id])) {
                $grouped['series'][$item->id] = [
                    'name'  => $item->name,
                    'data'  => []
                ];
            }
        }

        $grouped['categories'] = array_values( $grouped['categories'] );
        $last_categories_key   = $this->getLastKey($grouped['categories']);

        foreach ($temp_data as $item_id => $item_data) {
            $grouped_data =& $grouped['series'][$item_id]['data'];

            foreach ($grouped['categories'] as $key => $category) {
                if (isset($item_data[$category])) {
                    $grouped_data[$key] = $item_data[$category];

                } else {
                    $grouped_data[$key] = 0;
                }
            }

            $grouped_data = array_values($grouped_data);
        }

        $grouped['series'] = array_values($grouped['series']);

        return $grouped;
    }
}
