<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index',[
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        return redirect()->route('role.edit',$role->id);
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

        $role = Role::findById($id);

        return view('roles.edit',[
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findById($id);
        $role->fill($request->all());
        $role->save();
        return redirect()->route('role.edit',$role->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return redirect()->route('role.index');

    }

    public function permissions($id)
    {
        $permissions = Permission::all();
        $role = Role::findById($id);

        foreach ($permissions as  $permission){
            $permission->can = $role->hasPermissionTo($permission->name);
        }

        return view('roles.permissions',[
            'permissions' => $permissions,
            'role' => $role
        ]);
    }

    public function permissionsSync(Request $request,$role_id)
    {
        $permissionsRequest = $request->except('_token','_method');

        if ($permissionsRequest) {
            foreach ($permissionsRequest as $key => $value){
                $permissions[] = Permission::findById($key);
            }
        }

        $role = Role::findById($role_id);

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }else {
            $role->syncPermissions(null);
        }

        return redirect()->route('role.permissions',[
            'role' => $role->id
        ]);
    }
}
