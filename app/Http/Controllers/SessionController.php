<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sessions = $request->user()->sessions;
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = new Session;

        $session->date = $request->date;
        $session->time = $request->time;
        $session->duration = $request->duration;
        $session->isGroup = $request->isGroup;
        $session->notes = $request->notes;
        $session->tags = $request->tags;
        $session->user_id = $request->user()->id;

        $session->save();

        return redirect('sessions')->with('success', 'Session created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Not routed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::findOrFail($id);
        return view('sessions.edit')->with('session', $session);
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
        $session = Session::find($id);

        $session->date = $request->date;
        $session->time = $request->time;
        $session->duration = $request->duration;
        $session->isGroup = $request->isGroup;
        $session->notes = $request->notes;
        $session->tags = $request->tags;
        $session->user_id = $request->user()->id;

        $session->save();

        return redirect('sessions')->with('success', 'Session updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::destroy($id);
        return redirect('sessions')->with('success', 'Session deleted!');
    }
}
