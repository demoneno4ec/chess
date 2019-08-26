<?php

namespace App\Http\Controllers;

use App\Models\Chess;
use App\Models\ChessFigure;
use App\Models\ChessPositionList;
use App\Models\FigureTemplate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChessController extends Controller
{
    protected $figures = [
        'white' => ['king', 'queen', 'bishop', 'knight', 'rook', 'pawn'],
        'black' => ['king', 'queen', 'bishop', 'knight', 'rook', 'pawn'],
    ];

    protected $templateFigure = 'default';

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
        $chessPositions = ChessPositionList::with('Position')->whereHas('Chess', static function($query) use ($codeChess) {
            $query->where('code', $codeChess);
        })->get();

        $chessPositionIDs = $chessPositions->pluck('id');

        $chessFigures = ChessFigure::whereHas('Figure', static function($query){

                $query->where(static function($queryFigure){
                    $color = 'white';
                    $queryFigure->where('color', $color)->whereIn('code', $this->figures[$color]);
                })->orWhere(static function($queryFigure){
                    $color = 'black';
                    $queryFigure->where('color', $color)->whereIn('code', $this->figures[$color]);
                });
            })
            ->whereHas('ChessPositionList', static function($query) use ($chessPositionIDs){
                $query->whereIn('position_id', $chessPositionIDs);
            })->get();

        $figureIDs = $chessFigures->pluck('figure_id')->unique();

        $figureTemplates = FigureTemplate::whereHas('TemplateFigure', static function ($query) use ($templateFigure) {
                $query->where('template', $templateFigure);
            })->whereHas('Figure', static function ($query) use ($figureIDs) {
                $query->whereIn('id', $figureIDs);
            })->get();

        $table = collect();

        $chessPositions->map(function (ChessPositionList $chessPosition, $index) use (&$table, $chessFigures, $figureTemplates){


            $field = [
                'code' => $chessPosition->Position->code,
            ];
            $color = $this->getColorSquare($index);
            $field['color'] = $color;

            $chessFigure = $chessFigures->firstWhere('position_id', $chessPosition->position_id);

            if (!empty($chessFigure)){
                $templateFigure = $figureTemplates->firstWhere('figure_id', $chessFigure->figure_id)->TemplateFigure;
                $field['figure'] = [
                    'code' => $templateFigure->code,
                    'template' => $templateFigure->html_template
                ];
            }

            $table->push($field);
        });

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

    private function getColorSquare($indexPosition): string
    {
        return $this->isBlackSquare($indexPosition) ? 'black': 'white';
    }

    private function isBlackSquare($indexPosition): bool
    {
        $isBlack = (boolean) ($indexPosition%2);

        return ($indexPosition%16 === $indexPosition%8) ? $isBlack : !$isBlack;
    }
}
