<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
Use Illuminate\Support\Facades\Schema;
use Storage;
use Illuminate\Http\File;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $columnNames = Schema::getColumnListing('events');
        return view('manageevents')
            ->with('events', $events)
            ->with('columnNames', $columnNames);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$newEvent = new Event;
        $newEvent->eventName = $request->eventName;
        $newEvent->seatCount = $request->seatCount;
        $newEvent->eventDate = $request->eventDate;
        $newEvent->posterPath = $request->posterPath;*/

        Storage::putFileAs('/public/images', $request->file('file'), //works
            $request->eventName.".".$request->file('file')->getClientOriginalExtension());
        Storage::delete('/public/images/ssssss.jpg'); //works
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
