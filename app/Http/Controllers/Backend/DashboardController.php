<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kecamatan = DB::select(DB::raw("SELECT COUNT(dm.id_kecamatan) as total, k.name FROM data_markets dm JOIN kecamatans k ON dm.id_kecamatan=k.id GROUP BY k.name"));
        $type = DB::select(DB::raw("SELECT COUNT(dm.tipe_market) as total, dm.tipe_market FROM data_markets dm GROUP BY dm.tipe_market"));
        foreach($kecamatan as $kc){
            $markets = DB::select(DB::raw("SELECT COUNT(dm.tipe_market) as total, dm.tipe_market FROM data_markets dm JOIN kecamatans k ON dm.id_kecamatan=k.id WHERE k.name='$kc->name' GROUP BY dm.tipe_market "));
            $kc->market = $markets;
        }
        return view('backend.dashboard', compact('kecamatan', 'type'));
    }
}
