<?php

namespace App\Http\Controllers\Frontend;

use App\Models\DataMarket;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $market = DataMarket::with('kecamatan', 'gambar');
        if($request->get('tipe_market')){
            $market->where('tipe_market', $request->get('tipe_market'));
        }

        if($request->get('id_kecamatan')){
            $market->where('id_kecamatan', $request->get('id_kecamatan'));
        }

        $id_kecamatan = $request->get('id_kecamatan');

        $market = $market->get();
        $kecamatan = Kecamatan::all();
        return view('frontend.index', compact('market', 'kecamatan', 'id_kecamatan'));
    }
}
