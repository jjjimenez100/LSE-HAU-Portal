<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Event;
Use Illuminate\Support\Facades\Schema;
use Storage;
use Validator;
use Carbon\Carbon;
use Response;
class EventsController extends Controller
{
    protected $rootAlias = 'storage/images/';
    protected $rootDirectory = '/public/images/';

    public function getValidationRules($addOrUpdate){
        $yesterdayDate = new Carbon('yesterday');
        $yesterdayDate = $yesterdayDate->format('Y-m-d');

        if($addOrUpdate == 1){
            return [
                'eventName' => 'required|string|min:6|max:50',
                'seatCount' => 'required|integer|min:0',
                'eventDate' => 'required|date|after:'.$yesterdayDate,
                'file' => 'required|image'
            ];
        }

        else{
            return [
                'eventName' => 'required|string|min:6|max:50',
                'seatCount' => 'required|integer|min:0',
                'eventDate' => 'required|date|after:'.$yesterdayDate,
                'id' => 'required|integer|min:1'
            ];
        }
    }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(Input::all(), $this->getValidationRules(1));


        if($validation->fails()){
            return Response::json(
                array("errors" => $validation->getMessageBag()->toArray())
                    , 404
            );
        }

        else{
            $newEvent = new Event;
            $newEvent->eventName = preg_replace('/[^a-z0-9]/i', ' ', $request->eventName);
            $newEvent->seatCount = $request->seatCount;
            $newEvent->eventDate = $request->eventDate;
            $newEvent->posterPath = null;
            $newEvent->posterFileName = null;
            $newEvent->save();

            if($request->hasFile('file')) {
                $file = $request->file('file');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $newEvent->id . "." . $fileExtension;
                $filePath = $this->rootAlias . $fileName;

                Storage::putFileAs($this->rootDirectory, $file, $fileName);
                $newEvent->posterPath = $filePath;
                $newEvent->posterFileName = $fileName;
            }
            $newEvent->save();

            return response()->json($newEvent);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make(Input::all(), $this->getValidationRules(2));

        if($validation->fails()){
            return Response::json(
                array("errors" => $validation->getMessageBag()->toArray())
                , 404
            );
        }

        else{
            if($request->has('id')){
                $event = Event::findOrFail($request->id);
                $event->eventName = preg_replace('/[^a-z0-9]/i', ' ', $request->eventName);
                $event->seatCount = $request->seatCount;
                $event->eventDate = $request->eventDate;
                if($request->hasFile('file')){
                    $file = $request->file('file');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = $event->id . "." . $fileExtension;
                    $filePath = $this->rootAlias . $fileName;

                    Storage::putFileAs($this->rootDirectory, $file, $fileName);
                    $event->posterPath = $filePath;
                    $event->posterFileName = $fileName;
                }
                $event->save();

                return response()->json($event);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->has('id')) {
            $event = Event::findOrFail($request->id);
            $data = $event;
            $filePath = $this->rootDirectory . $event->posterFileName;
            Storage::delete($filePath);
            $event->delete();

            return Response::json(array(
                "success: " => "true",
                "message: " => "deleted event",
                "data: " => array(
                    $data
                )
            ));
        }

        else{
            return Response::json(array(
               "success" => "false",
                "message" => "no member id was provided"
            ), 404);
        }
    }
}
