<?php

namespace App\Http\Controllers;

use App\Models\Chess;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chess  $chess
     * @return Response
     */
    public function show(Chess $chess)
    {
        dump($chess);
        return view('index', ['chess' => $chess]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chess  $chess
     * @return Response
     */
    public function edit(Chess $chess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chess  $chess
     * @return Response
     */
    public function update(Request $request, Chess $chess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chess  $chess
     * @return Response
     */
    public function destroy(Chess $chess)
    {
        //
    }
}
