<?php

namespace App\Http\Controllers;

use App\Models\Chess;
use ArrayObject;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ChessController extends Controller
{
    protected $startPosition = [
        [
            'name' => 'a8',
            'figure' => 'rook',
            'color' => 'black',
            'htmlCode' => '♜',
        ],
        [
            'name' => 'b8',
            'figure' => 'knight',
            'color' => 'black',
            'htmlCode' => '♞',
        ],
        [
            'name' => 'c8',
            'figure' => 'bishop',
            'color' => 'black',
            'htmlCode' => '♝',
        ],
        [
            'name' => 'd8',
            'figure' => 'queen',
            'color' => 'black',
            'htmlCode' => '♛',
        ],
        [
            'name' => 'e8',
            'figure' => 'king',
            'color' => 'black',
            'htmlCode' => '♚',
        ],
        [
            'name' => 'f8',
            'figure' => 'bishop',
            'color' => 'black',
            'htmlCode' => '♝',
        ],
        [
            'name' => 'g8',
            'figure' => 'knight',
            'color' => 'black',
            'htmlCode' => '♞',
        ],
        [
            'name' => 'h8',
            'figure' => 'rook',
            'color' => 'black',
            'htmlCode' => '♜',
        ],
        [
            'name' => 'a7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'b7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'c7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'd7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'e7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'f7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'g7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        [
            'name' => 'h7',
            'figure' => 'pawn',
            'color' => 'black',
            'htmlCode' => '♟',
        ],
        ['name' => 'a6'],
        ['name' => 'b6'],
        ['name' => 'c6'],
        ['name' => 'd6'],
        ['name' => 'e6'],
        ['name' => 'f6'],
        ['name' => 'g6'],
        ['name' => 'h6'],

        ['name' => 'a5'],
        ['name' => 'b5'],
        ['name' => 'c5'],
        ['name' => 'd5'],
        ['name' => 'e5'],
        ['name' => 'f5'],
        ['name' => 'g5'],
        ['name' => 'h5'],

        ['name' => 'a4'],
        ['name' => 'b4'],
        ['name' => 'c4'],
        ['name' => 'd4'],
        ['name' => 'e4'],
        ['name' => 'f4'],
        ['name' => 'g4'],
        ['name' => 'h4'],

        ['name' => 'a3'],
        ['name' => 'b3'],
        ['name' => 'c3'],
        ['name' => 'd3'],
        ['name' => 'e3'],
        ['name' => 'f3'],
        ['name' => 'g3'],
        ['name' => 'h3'],
        [
            'name' => 'a2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'b2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'c2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'd2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'e2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'f2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'g2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],
        [
            'name' => 'h2',
            'figure' => 'pawn',
            'color' => 'white',
            'htmlCode' => '♙',
        ],

        [
            'name' => 'a1',
            'figure' => 'rook',
            'color' => 'white',
            'htmlCode' => '♖',
        ],
        [
            'name' => 'b1',
            'figure' => 'knight',
            'color' => 'white',
            'htmlCode' => '♘',
        ],
        [
            'name' => 'c1',
            'figure' => 'bishop',
            'color' => 'white',
            'htmlCode' => '♗',
        ],
        [
            'name' => 'd1',
            'figure' => 'queen',
            'color' => 'white',
            'htmlCode' => '♕',
        ],
        [
            'name' => 'e1',
            'figure' => 'king',
            'color' => 'white',
            'htmlCode' => '♔',
        ],
        [
            'name' => 'f1',
            'figure' => 'bishop',
            'color' => 'white',
            'htmlCode' => '♗',
        ],
        [
            'name' => 'g1',
            'figure' => 'knight',
            'color' => 'white',
            'htmlCode' => '♘',
        ],
        [
            'name' => 'h1',
            'figure' => 'rook',
            'color' => 'white',
            'htmlCode' => '♖',
        ],
    ];


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

//        $table = $chess;

        $table = $this->createTable();

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

    private function createTable(): Collection
    {
        $table = $this->insertSquares();

        return $table;
    }

    /**
     * @return Collection
     */
    private function insertSquares(): Collection
    {
        $squares = collect();

        $startPositions = collect($this->startPosition);

        $startPositions->each(function($position, $indexPosition) use (&$squares){
            $square = $this->getSquare($indexPosition);
            $squares->push($square);
        });

        return $squares;
    }

    private function getSquare($indexPosition): ArrayObject
    {
        $square = new ArrayObject();

        $position = $this->startPosition[$indexPosition];
        $square->name = $position['name'];
        $square->color = $this->getColorSquare($indexPosition);
        if (isset($position['figure'])){
            $square->figure = $this->getFigure($position);
        }

        return $square;
    }

    private function getColorSquare($indexPosition): string
    {
        return $this->isBlackSquare($indexPosition) ? 'black': 'white';
    }

    private function isBlackSquare($indexPosition): bool
    {
        $isBlack = (boolean) ($indexPosition%2);

        return ($indexPosition%16 === $indexPosition%8) ? $isBlack : !$isBlack;
    }

    private function getFigure($position)
    {
        $figure = new ArrayObject();

        $figure->name = $position['figure'];
        $figure->color = $position['color'];
        $figure->html = $position['htmlCode'];

        return $figure;
    }


}
