<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

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
    $scores = Score::paginate(5);
    return view('scores.index', compact('scores'));
}

/**
 * 
 * show the form for creating a new resource
 * @return \Illuminate\Http\Resources\Response
 */
public function create()
{
    
    return view('scores.crear');
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
        'id_students'=> 'required',
        'academicyear'=> 'required',
        'course'=> 'required',
        'subject' => 'required',
        'trimester'=> 'required'
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
        'ID'=> 'required',
        'academicyear'=> 'required',
        'course'=> 'required',
        'subject' => 'required',
        'trimester'=> 'required'
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

