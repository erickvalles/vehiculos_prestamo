<?php

namespace App\Http\Controllers;

use App\Licence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function show(Licence $licence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function edit(Licence $licence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licence $licence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licence $licence)
    {
        //
    }
}
