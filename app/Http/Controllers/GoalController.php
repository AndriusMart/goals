<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('goal.index', [
            'goals' => Goal::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'days' => 'required|numeric',
                'about' => 'required|min:20',
            ],
        );


        Goal::create([
            'title' => $request->title,
            'days' => $request->days,
            'done' => $request->done,
            'about' => $request->about,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('home')->with('ok', 'New goal created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        return view('goal.show', [
            'goal' => $goal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        return view('goal.edit', [
            'goal' => $goal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'days' => 'required|numeric',
                'about' => 'required|min:20',
            ],
        );


        $goal->update([
            'title' => $request->title,
            'days' => $request->days,
            'done' => $request->done,
            'about' => $request->about,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('home')->with('ok', 'Goal '.$request->title .' updated');
    }
    public function done(Request $request, Goal $goal)
    {

        $goal->update([
            'done' => $request->done,
        ]);

        return redirect()->route('home')->with('ok', 'Goal '.$request->title .' accomplished');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('g_index')->with('ok', 'deleted');
    }
}
