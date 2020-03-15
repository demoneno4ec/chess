<?php

namespace App\Http\Controllers;

use App\Models\Chess;
use App\Models\ChessFigure;
use App\Models\ChessPositionList;
use App\Models\FigureTemplate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionSup;
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
     * @var string
     */
    private $code = '';
    /**
     * @var Collection|static[]
     */
    private $positions;
    /**
     * @var Collection|static[]
     */
    private $chessFigures;
    /**
     * @var Collection|static[]
     */
    private $figureTemplate;

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
     * @param $code
     * @return Factory|View
     */
    public function show($code)
    {
        $this->setCode($code);

        $this->setPositions();

        $this->setFigures();

        $this->setFigureTemplate();

        $table = $this->getTable();

        return view('chess/index', ['table' => $table]);
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
        return $this->isBlackSquare($indexPosition) ? 'black' : 'white';
    }

    private function isBlackSquare($indexPosition): bool
    {
        return ($indexPosition % 8 + (int) $indexPosition / 8) % 2;

        /*my
        $isBlack = (boolean) ($indexPosition % 2);

        return ($indexPosition % 16 === $indexPosition % 8) ? $isBlack : !$isBlack;
        */
    }

    /**
     * @return CollectionSup
     */
    private function getTable(): CollectionSup
    {
        $table = collect();

        $this->getPositions()->map(function (ChessPositionList $chessPosition, $index) use (&$table) {
            $field = [
                'code' => $chessPosition->Position->code,
            ];
            $color = $this->getColorSquare($index);
            $field['color'] = $color;

            $chessFigure = $this->getChessFigures()
                ->firstWhere('position_id', $chessPosition->position_id);

            if (!empty($chessFigure)) {
                $templateFigure = $this->getFigureTemplate()
                    ->firstWhere('figure_id', $chessFigure->figure_id)
                    ->TemplateFigure;
                $field['figure'] = [
                    'code' => $templateFigure->code,
                    'template' => $templateFigure->html_template
                ];
            }

            $table->push($field);
        });

        return $table;
    }


    /**setters*/
    /**
     * @param $code
     */

    private function setCode($code): void
    {
        $this->code = strip_tags($code);
    }

    private function setFigures(): void
    {
        $chessFigures = ChessFigure::whereHas('Figure', function ($query) {
            $query->where(function ($queryFigure) {
                $color = 'white';
                $queryFigure->where('color', $color)->whereIn('code', $this->figures[$color]);
            })->orWhere(function ($queryFigure) {
                $color = 'black';
                $queryFigure->where('color', $color)->whereIn('code', $this->figures[$color]);
            });
        })
            ->whereHas('ChessPositionList', function ($query) {
                $query->whereIn('position_id', $this->getPositions()->pluck('id'));
            });

        if ($chessFigures->count() > 0) {
            $this->chessFigures = $chessFigures->get();
        }
    }

    private function setPositions(): void
    {
        $checkPositionList = ChessPositionList::with('Position')->whereHas('Chess', function ($query) {
            $query->where('code', $this->getCode());
        });

        if ($checkPositionList->count() > 0) {
            $this->positions = $checkPositionList->get();
        }
    }

    private function setFigureTemplate(): void
    {
        $figureIDs = $this->getChessFigures()->pluck('figure_id')->unique();

        $figureTemplates = FigureTemplate::whereHas('TemplateFigure', function ($query) {
            $query->where('template', $this->templateFigure);
        })->whereHas('Figure', static function ($query) use ($figureIDs) {
            $query->whereIn('id', $figureIDs);
        });

        if ($figureTemplates->count() > 0) {
            $this->figureTemplate = $figureTemplates->get();
        }

    }


    /**getters*/

    /**
     * @return Collection|static[]
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * @return Collection|static[]
     */
    public function getChessFigures()
    {
        return $this->chessFigures;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return Collection|static[]
     */
    public function getFigureTemplate()
    {
        return $this->figureTemplate;
    }
}
