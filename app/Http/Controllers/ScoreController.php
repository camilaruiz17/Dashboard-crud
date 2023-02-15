<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    /***
     * 
     * display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
            $this->middleware('permission:see-score|create-score|edit-score|delete-score')->only('index');
            $this->middleware('permission:crear-score', ['only'=>['create', 'store']]);
            $this->middleware('permission:edit-score', ['only'=>['edit', 'update']]);
            $this->middleware('permission:delete-score', ['only'=>['destroy']]);
    }

        /**
     * dsiplay a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     * 
     */
public function index()
{
    $currentUserRol = \Illuminate\Support\Facades\Auth::user()->roles[0]->name;
    $currentUserId = \Illuminate\Support\Facades\Auth::user()->id;

    $scores = DB::table('scores')
            ->join('users', 'scores.users_id', '=', 'users.id')
            ->select('scores.*', 'users.name')
            ->paginate(5);

    if($currentUserRol == 'Students') {
        $scores = DB::table('scores')
            ->join('users', 'scores.users_id', '=', 'users.id')
            ->select('scores.*', 'users.name')
            ->where('scores.users_id', '=', $currentUserId)
            ->paginate(5);
    }

    return view('scores.index', compact('scores'));
}

/**
 * 
 * show the form for creating a new resource
 * @return \Illuminate\Http\Resources\Response
 */
public function create()
{
    $usersAll = User::all();
    $users = [];
    foreach ($usersAll as $user) {
        $permission = array_keys($user->roles->pluck('name', 'name')->all(), 'Students');
        if (count($permission) > 0) {
            array_push($users, $user);
        }
   }
    return view('scores.crear', compact('users'));
}

/**
 * 
 * store a newly created resource in storage
 * @param \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Resources\Response
 */
public function store(Request $request)
{
    request()-> validate ([
        'users_id'=> 'required',
        'academicYear'=> 'required',
        'course'=> 'required',
        'subject' => 'required',
        'quarter'=> 'required'
    ]);
    Score::create($request->all());
    return redirect()->route('scores.index');
        
}


/**
 * 
 * show the form  for editing the resource
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function edit(Score $score)
{

    return view('scores.edit', compact('score'));

}

/**
 * 
 * update the specified resource in storage
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, Score $score)
{
    request()->validate([
        'id'=> 'required',
        'academicYear'=> 'required',
        'course'=> 'required',
        'subject' => 'required',
        'quarter'=> 'required'
]);
$score->update($request->all());
return redirect()->route('scores.index');

}


/**
 * 
 * Remove the specified resource from storage
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function destroy(Score $score)
{
    $score->delete();
    return redirect()->route('scores.index');

}
}

