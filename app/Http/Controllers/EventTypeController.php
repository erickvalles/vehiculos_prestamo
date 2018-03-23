<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event_Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // = Event_Type::all();
        $events = DB::table('event_types')
            ->join('categories', 'event_types.categories_id', '=', 'categories.id')
            ->select('categories.id AS id_cat','categories.nombre as categoria', 'event_types.*')
            ->get();
        //dd($events);
        return view('manage_events',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('add_events',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'categories_id' => 'required|integer|not_in:0'
        ]);
        Event_Type::created($request->all());
        //dd($request);
        return redirect('tipo_evento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function show(Event_Type $event_Type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Event_Type $event_Type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event_Type $event_Type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event_Type  $event_Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event_Type $event_Type)
    {
        //
    }
}
