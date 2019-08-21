<?php

namespace App\Http\Controllers;

use App\Models\Chess;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $codeChess
     * @return Factory|View
     */
    public function show($codeChess)
    {
        $chess = Chess::with('chessFigures')->where('code', $codeChess)->firstOrFail();

        $table = $chess;

        return view('index', ['table' => $table]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Chess  $chess
     * @return void
     */
    public function edit(Chess $chess): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Chess  $chess
     * @return void
     */
    public function update(Request $request, Chess $chess): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Chess  $chess
     * @return void
     */
    public function destroy(Chess $chess): void
    {
        //
    }
}
