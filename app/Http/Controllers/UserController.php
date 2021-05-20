<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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


    public function roles($id)
    {
        $roles = Role::all();
        $user = User::where('id',$id)->first();

        if ($roles) {
            foreach ($roles as  $role){

                $role->can = $user->hasRole($role->name);
            }
        }

        return view('users.roles',[
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function rolesSync(Request $request,$user_id)
    {
        $rolesRequest = $request->except('_token','_method');
        if ($rolesRequest) {
            foreach ($rolesRequest as $key => $value){
                $roles[] = Role::findById($key);
            }
        }

        $user = User::where('id',$user_id)->first();

        if (!empty($roles)) {
            $user->syncRoles($roles);
        }else {
            $user->syncRoles(null);
        }

        return redirect()->route('user.roles',[
            'user' => $user->id
        ]);
    }
}
