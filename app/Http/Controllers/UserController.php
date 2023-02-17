<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Cloudinary;



class UserController extends Controller
{
    function __construct()
    {
            $this->middleware('permission:see-users|create-users|edit-users|delete-users')->only('index');
            $this->middleware('permission:crear-users', ['only'=>['create', 'store']]);
            $this->middleware('permission:edit-users', ['only'=>['edit', 'update']]);
            $this->middleware('permission:delete-users', ['only'=>['destroy']]);
    }
    /**
     * dsiplay a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     * 
     */
public function index()
{
    $users = User::paginate(5);
    return view('users.index', compact('users'));
}

/**
 * 
 * show the form for creating a new resource
 * @return \Illuminate\Http\Resources\Response
 */
public function create()
{
    $roles = Role::pluck('name', 'name')->all();
    return view('users.crear', compact('roles'));
}

/**
 * 
 * store a newly created resource in storage
 * @param \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Resources\Response
 */
public function store(Request $request)
{
    $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|same:confirm-password',
            'roles => required'
    ]);

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);

    $user = User::create($input);
    $user -> assignRole($request->input('roles'));

    return redirect()->route('users.index');
}

/**
 * 
 * show the form  for editing the resource
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $user = User::find($id);
    $roles = Role::pluck('name', 'name')->all();
    $userRole = $user->roles->pluck('name', 'name')->all();
    return view('users.edit', compact('user', 'roles', 'userRole'));

}

/**
 * 
 * update the specified resource in storage
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name'=> 'required',
        'email'=> 'required|email|unique:users,email,'.$id,
        'password'=> 'same:confirm-password',
        'roles => required'
]);

$input= $request->all();
if (!empty($input['password'])){
    $input['password']= Hash::make($input['password']);
}else{
        $input = Arr::except($input, array('password'));
    }

    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id', $id)->delete();

    $user->assignRole($request->input('roles'));
    return redirect()->route('users.index');
}


/**
 * 
 * Remove the specified resource from storage
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    User::find($id)->delete();
    return redirect()->route('users.index');

}

 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Student $student
     * @return \Illuminate\Http\Response
     */

    public function uploadImage(Request $request) {

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            \Cloudinary::config(array(
                "cloud_name" =>"nzjflbyz",
                "api_key" => "538186616621336",
                "api_secret" => "-ClbHTso7_lwrIqn4uRKi-wOAPM"
            ));

            $upload = \Cloudinary\Uploader::upload($file);
            return $upload['secure_url'];
        }
    }
}