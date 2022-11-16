<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Role;

use App\Domains\Auth\Http\Requests\Backend\Role\DeleteRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\EditRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

/**
 * Class RoleController.
 */
class KecamatanAja
{
    /**
     * @var RoleService
     */
    protected $kecamatanService;

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
        return view('backend.auth.kecamatan.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.kecamatan.create');
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
        $kecamatan = new Kecamatan();
        $data= $request->all();
        foreach($data as $d => $f){
            $kecamatan->$d = $f;
        }
        $kecamatan->save();
        return redirect()->route('admin.auth.kecamatan.index')->withFlashSuccess(__('Kecamatan was successfully created.'));
    }

    /**
     * @param  EditRoleRequest  $request
     * @param  Role  $role
     * @return mixed
     */
    public function edit(Request $request, Kecamatan $kecamatan)
    {
        return view('backend.auth.kecamatan.edit');
    }

    /**
     * @param  UpdateRoleRequest  $request
     * @param  Role  $role
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {

        $data= $request->all();
        foreach($data as $d => $f){
            $kecamatan->$d = $f;
        }
        $kecamatan->update();
        return redirect()->route('admin.auth.kecamatan.index')->withFlashSuccess(__('Kecamatan was successfully updated.'));
    }

    /**
     * @param  DeleteRoleRequest  $request
     * @param  Role  $role
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy(Request $request, Kecamatan $kecamatan)
    {
        $kecamatan->delete();

        return redirect()->route('admin.auth.kecamatan.index')->withFlashSuccess(__('Keamatan was successfully deleted.'));
    }
}
