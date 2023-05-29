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
        $groupSort = $request->groupSort;

        if ($groupSort == 'asc') {
            $nextGroupSort = null;
            $sessions = $request->user()->sessions()->orderBy('isGroup');
        }
        else if ($groupSort == 'desc') {
            $nextGroupSort = 'asc';
            $sessions = $request->user()->sessions()->orderBy('isGroup', 'desc');
        }
        else {
            $nextGroupSort = 'desc';
            $sessions = $request->user()->sessions();
        }

        $sessions = $sessions->orderBy('date', 'desc')->get();

        return view('sessions.index')
                ->with('sessions', $sessions)
                ->with('groupSort', $groupSort)
                ->with('nextGroupSort', $nextGroupSort);
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
     * Return a csv export of all sessions
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $fileName = 'sessions.csv';
        $sessions = $request->user()->sessions()->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($sessions) {
            $file = fopen('php://output', 'w');

            $columns = array('Date', 'Time', 'Duration', 'IsGroup');

            fputcsv($file, $columns);

            foreach ($sessions as $session) {
                $row['Date']  = $session->date;
                $row['Time']    = $session->time;
                $row['Duration']    = $session->duration;
                $row['IsGroup']  = $session->isGroup;

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
