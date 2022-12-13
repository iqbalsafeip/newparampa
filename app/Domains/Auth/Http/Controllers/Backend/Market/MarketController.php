<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Market;

use App\Domains\Auth\Http\Requests\Backend\Role\DeleteRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\EditRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use App\Models\DataMarket;
use App\Models\ImageMarket;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

/**
 * Class RoleController.
 */
class MarketController
{
    /**
     * @var RoleService
     */
    protected $marketServices;

    /**
     * @var PermissionService
     */

    /**
     * RoleController constructor.
     *
     * @param  RoleService  $roleService
     * @param  PermissionService  $permissionService
     */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.market.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('backend.auth.market.create', compact('kecamatan'));
    }

    /**
     * @param  StoreRoleRequest  $request
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(Request $request)
    {

        $market = new DataMarket();
        $data = $request->all();
        foreach ($data as $d => $f) {

            if (in_array($d, ['nama_permohonan', 'nama_perusahaan', 'alamat', 'nomor_izin', 'tanggal_izin', 'tipe_market', 'id_kecamatan', 'longitude', 'latitude'])) {

                $market->$d = $f;
            }
        }


        if ($market->save()) {
            $index = 0;
            foreach ($request->gambar as $file) {
                $image = new ImageMarket();
                $image->id_market = $market->id;
                $ext = $file->getClientOriginalExtension();
                $imageName = time() . '.ID-' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('gambar'), $imageName);
                $image->doc = $imageName;
                $image->save();
                $index++;
            }
        }
        return redirect()->route('admin.auth.market.index')->withFlashSuccess(__('Market was successfully created.'));
    }

    /**
     * @param  EditRoleRequest  $request
     * @param  Role  $role
     * @return mixed
     */
    public function edit(Request $request, DataMarket $market)
    {
        $kecamatan = Kecamatan::all();
        return view('backend.auth.market.edit', compact('market', 'kecamatan'));
    }

    public function map(DataMarket $market)
    {
        return view('backend.auth.market.map', compact('market'));
    }

    /**
     * @param  UpdateRoleRequest  $request
     * @param  Role  $role
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(Request $request, DataMarket $market)
    {

        $data = $request->all();
        foreach ($data as $d => $f) {
            if (in_array($d, ['nama_permohonan', 'nama_perusahaan', 'alamat', 'nomor_izin', 'tanggal_izin', 'tipe_market', 'id_kecamatan', 'longitude', 'latitude'])) {
                if ($f) {
                    $market->$d = $f;
                }
            }
        }


        $index = 0;
        if ($request->gambar) {

            foreach ($request->gambar as $file) {
                $image = new ImageMarket();
                $image->id_market = $market->id;
                $ext = $file->getClientOriginalExtension();
                $imageName = time() . '.ID-' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('gambar'), $imageName);
                $image->doc = $imageName;
                $image->save();
                $index++;
            }
        }
        $market->update();
        return redirect()->route('admin.auth.market.index')->withFlashSuccess(__('Market was successfully updated.'));
    }

    /**
     * @param  DeleteRoleRequest  $request
     * @param  Role  $role
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy(Request $request, DataMarket $market)
    {
        $market->delete();

        return redirect()->route('admin.auth.market.index')->withFlashSuccess(__('Market was successfully deleted.'));
    }
}
