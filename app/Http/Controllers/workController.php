<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Task;
use App\Work;
use Auth;

use App\Http\Requests;

class workController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::with('task', 'user')->orderBy('started_at')->get();
        return view('work.index', ['works'=>$works]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = Task::orderBy('title')->get();
        return view('work.create', ['tasks'=>$tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->works()->attach([$request->task =>['started_at'=>$request->started_at,'ended_at'=>$request->ended_at, 'description'=>$request->description, 'date'=>$request->date]]);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work = Work::with('user', 'task')->findorfail($id);
        return view('work.show', ['work'=>$work]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work = Work::with('user', 'task')->findorfail($id);
        $tasks = Task::get();
        return view('work.edit',['work'=>$work, 'tasks'=>$tasks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $work = Work::with('user', 'task')->findorfail($id);

        $work->description = $request->description;
        $work->started_at = $request->started_at;
        $work->ended_at = $request->ended_at;
        $work->date = $request->date;
        if($request->has('task')){
            $task = Task::findorfail($request->task);
            $work->task()->associate($task);
        }
        else{
            $work->task()->dissociate();
        }

        $work->save();
        return redirect()->route('works.show', [$work->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Work::destroy($id);
        return back();
    }
}