<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    function index(){
        $events= Event::inRandomOrder()->take(4)->get();
        return view('events.event')->with(['events'=>$events]);
    }

    function home(){
        $events= Event::paginate(6);
        return view('events.home')->with(['events'=>$events]);
    }

    function manageEvents($id){
        $events= Event::where('user_id','LIKE', $id)->get();
        return view('events.manage')->with(['events'=>$events]);
    }

    function manageInsert($id){
        return view('events.insert');
    }

    function manageEdit($id){
        $event= Event::where('event_id', $id)->get()->first();
        return view('events.edit')->with(['event'=>$event]);
    }

    function searchEvents(Request $request){
        $events= Event::where('title', 'LIKE', "%$request->input_search%")->simplePaginate(10);
        return view('events.home')->with(['events'=>$events, 'search'=>$request->input_search]);
    }

    function saveEvents(Request $request, $id){
        $rules=[
            'event_title' => 'required',
            'event_description'=> 'required',
            'event_contact'=> 'required',
            'event_registration'=> 'required',
            'image' => 'image|mimes:jpg,png'
        ];
        $validator= Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event= new Event();
        $event->title = $request->event_title;
        $event->user_id = $id;
        $event->description = $request->event_description;
        $event->contact = $request->event_contact;
        $event->registration = $request->event_registration;
        $fileName = $request->file('event_image')->getClientOriginalName();
        $request->file('event_image')->move('img/event/', $fileName);
        $event->image= $fileName;
        $event->save();

        return redirect()->back();
    }

    function deleteEvents($id){
        $event= Event::where('event_id', $id);
        $event->delete();
        return redirect()->back();
    }

    function editEvents(Request $request, $id){
        $rules=[
            'event_title' => 'required',
            'image' => 'image|mimes:jpg,png'
        ];
        $validator= Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event=Event::where('event_id',$id)->get()->first();
        $event->title = $request->event_title;
        $event->event_id = $id;
        $event->user_id= $request->user_id;
        $event->description = $request->event_desc;
        $event->contact = $request->event_contact;
        $event->registration = $request->event_registration;
        $fileName = $request->file('event_image')->getClientOriginalName();
        $request->file('event_image')->move('img/event/', $fileName);
        $event->image= $fileName;

        $event->update();

        return redirect('/home');
    }
}
