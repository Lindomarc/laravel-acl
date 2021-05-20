<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        return redirect()->route('user.edit',$user->id);
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
        $user = User::where('id',$id)->first();
        return view('users.edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \app\Http\Requests\UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::where('id',$id)->first();
        $user->fill($request->all());
        $user->save();
        return redirect()->route('user.edit',$user->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        $user->delete();
        return redirect()->route('user.index');
    }


    public function permissions($id)
    {
        $permissions = Permission::all();
        $user = User::where('id',$id)->first();

        if ($permissions) {

            foreach ($permissions as  $permission){
                $permission->can = $user->hasPermissionTo($permission->name);
            }
        }

        return view('users.permissions',[
            'permissions' => $permissions,
            'user' => $user
        ]);
    }

    public function permissionsSync(Request $request,$user_id)
    {
        $permissionsRequest = $request->except('_token','_method');

        if ($permissionsRequest) {
            foreach ($permissionsRequest as $key => $value){
                $permissions[] = Permission::findById($key);
            }
        }

        $user = User::where('id',$user_id)->first();

        if (!empty($permissions)) {
            $user->syncPermissions($permissions);
        }else {
            $user->syncPermissions(null);
        }

        return redirect()->route('user.permissions',[
            'user' => $user->id
        ]);
    }
}
