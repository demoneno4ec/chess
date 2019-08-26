<?php

namespace App\Console\Commands;

use App\Models\Chess;
use App\Models\ChessFigure;
use App\Models\ChessPositionList;
use App\Models\Figure;
use App\Models\FigureTemplate;
use App\Models\Position;
use App\Models\TemplatesFigure;
use Illuminate\Console\Command;

class CreateChessDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chess:createDefault';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create default chess';

    protected $defaultFigures = [
        [
            'code' => 'king',
            'name_ru' => 'Король'
        ],
        [
            'code' => 'queen',
            'name_ru' => 'Королева'
        ],
        [
            'code' => 'rook',
            'name_ru' => 'Ладья'
        ],
        [
            'code' => 'bishop',
            'name_ru' => 'Слон'
        ],
        [
            'code' => 'knight',
            'name_ru' => 'Конь'
        ],
        [
            'code' => 'pawn',
            'name_ru' => 'Пешка'
        ],
    ];

    protected $defaultColors = ['white', 'black'];
    protected $defaultTemplate = 'default';
    protected $chessID = 0;
    protected $templateFigureIDs = [
        [
            'code' => 'white_king',
            'name' => 'белый король',
            'htmlCode' => '♔',
            'position' => ['e1'],
            'id' => 0,
        ],
        [
            'code' => 'white_queen',
            'name' => 'белая королева',
            'htmlCode' => '♕',
            'position' => ['d1'],
            'id' => 0,
        ],
        [
            'code' => 'white_rook',
            'name' => 'белая ладья',
            'htmlCode' => '♖',
            'position' => ['a1', 'h1'],
            'id' => 0,
        ],
        [
            'code' => 'white_bishop',
            'name' => 'белый слон',
            'htmlCode' => '♗',
            'position' => ['c1', 'f1'],
            'id' => 0,
        ],
        [
            'code' => 'white_knight',
            'name' => 'белый конь',
            'htmlCode' => '♘',
            'position' => ['b1', 'g1'],
            'id' => 0,
        ],
        [
            'code' => 'white_pawn',
            'name' => 'белая пешка',
            'htmlCode' => '♙',
            'position' => ['a2', 'b2', 'c2', 'd2', 'e2', 'f2', 'g2', 'h2'],
            'id' => 0,
        ],

        [
            'code' => 'black_king',
            'name' => 'черный король',
            'htmlCode' => '♚',
            'position' => ['e8'],
            'id' => 0,
        ],
        [
            'code' => 'black_queen',
            'name' => 'черная королева',
            'htmlCode' => '♛',
            'position' => ['d8'],
            'id' => 0,
        ],
        [
            'code' => 'black_rook',
            'name' => 'черная ладья',
            'htmlCode' => '♜',
            'position' => ['a8', 'h8'],
            'id' => 0,
        ],
        [
            'code' => 'black_bishop',
            'name' => 'черный слон',
            'htmlCode' => '♝',
            'position' => ['c8', 'f8'],
            'id' => 0,
        ],
        [
            'code' => 'black_knight',
            'name' => 'черный конь',
            'htmlCode' => '♞',
            'position' => ['b8', 'g8'],
            'id' => 0,
        ],
        [
            'code' => 'black_pawn',
            'name' => 'черная пешка',
            'htmlCode' => '♟',
            'position' => ['a7', 'b7', 'c7', 'd7', 'e7', 'f7', 'g7', 'h7'],
            'id' => 0,
        ],
    ];
    protected $positions = [
        'columns'   => ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'],
        'rows'      => ['8', '7', '6', '5', '4', '3', '2', '1'],
        'ids'       => [],
        'chess_ids' => [],
    ];



    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Figure $figure */

        $this->createChess();

        $this->createPositions();

        $this->setTemplateFigureIDs();

        $this->createFigures();

        $this->createTemplateFigures();

        $this->createChessPositions();

        $this->createChessFigurePositions();

//        $this->createColors();
//
//        $this->createFigures($chessID);
    }

    private function createChess(): void
    {
        $chess = Chess::firstOrCreate(
            ['code' => 'default'],
            ['name_ru' => 'Шахматы по умолчанию']
        );

        $this->chessID = $chess->id;
    }

    private function createFigures(): void
    {
        $this->checkChessID();
        $this->checkPositions();

        $figures = collect($this->defaultFigures);
        $colors = collect($this->defaultColors);

        $colors->each(function($color) use ($figures){
            $figures->each(function ($arFigure, $key) use ($color){

                $figureCode = $arFigure['code'];

                $figure = Figure::firstOrCreate(
                    ['code' => $arFigure['code'], 'color' => $color],
                    ['name_ru' => $arFigure['name_ru']]
                );
                $figureID = $figure->id;

                if ($figureID <= 0) {
                    $this->error('Фигура отсутстует'.$arFigure['name_ru']);
                    die();
                }

                $code = $color.'_'.$figureCode;
                $this->templateFigureIDs[$code]['figure_id'] = $figureID;
            });
        });
    }

    private function createPositions(): void
    {
        $this->checkChessID();

        $columns = collect($this->positions['columns']);

        $rows = collect($this->positions['rows']);

        $rows->each(function ($row) use ($columns){
            $columns->each(function ($column) use ($row){
                $code = $column.$row;
                $position = Position::firstOrCreate(
                    ['code' => $code]
                );
                $this->positions['ids'][$code] = $position->id;
            });
        });

        $this->info($this->chessID);
    }

    private function checkChessID(): void
    {
        if ($this->chessID <= 0) {
            $this->error('Шахматы отсутсвуют');
            die();
        }
    }

    private function checkPositions(): void
    {
        $ids = $this->positions['ids'];
        if (empty($ids) || count($ids) !== 64){
            $this->error('Присутствуют не все поля');
            die();
        }
    }

    private function setTemplateFigureIDs(): void
    {
        $templateFigureIDs = collect($this->templateFigureIDs)->keyBy('code');
        $this->templateFigureIDs = $templateFigureIDs->toArray();
    }

    private function createTemplateFigures(): void
    {
        $this->checkChessID();
        $this->checkPositions();

        $templateFigures = collect($this->templateFigureIDs);

        $templateFigures->each(function($arTemplateFigure, $key){
            $code = $arTemplateFigure['code'];

            $templateFigure = TemplatesFigure::firstOrCreate(
                ['code' => $code],
                [
                    'name_ru' => $arTemplateFigure['name'],
                    'html_template' => $arTemplateFigure['htmlCode'],
                    'template' => $this->defaultTemplate,
                ]
            );

            $templateFigureID = $templateFigure->id;

            if ($templateFigureID <= 0) {
                $this->error('Шаблон для фигуры отсутстует'.$arTemplateFigure['name']);
                die();
            }

            $this->templateFigureIDs[$code]['template_id'] = $templateFigureID;
            $figureID = $this->templateFigureIDs[$code]['figure_id'];


            $figureTemplate = FigureTemplate::firstOrCreate(
                ['figure_id' => $figureID, 'template_id' => $templateFigureID]
            );

            if (!($figureTemplate instanceof FigureTemplate)){
                $this->error('Шаблон для фигуры не был привязан '.$arTemplateFigure['name']);
                die();
            }
        });
    }

    private function createChessPositions(): void
    {
        $this->checkChessID();
        $this->checkPositions();

        $chessID = $this->chessID;
        $positions = collect($this->positions['ids']);

        $positions->each(function($position, $code) use ($chessID){
            $chessPosition = ChessPositionList::firstOrCreate(
                ['position_id' => $position, 'chess_id' => $chessID],
                ['sort' => $position]
            );

            $chessPositionID = $chessPosition->id;

            if ($chessPositionID <= 0) {
                $this->error('Позиция для доски не была создана '.$code);
                die();
            }

            $this->positions['chess_ids'][$code] = $chessPositionID;
        });
    }

    private function createChessFigurePositions(): void
    {
        $this->checkChessID();
        $this->checkPositions();

        $positions = collect($this->positions['chess_ids']);
        $figures = collect($this->templateFigureIDs);

        $figures->each(function($arFigure) use ($positions){
            $figureID = $arFigure['figure_id'];
            $figurePositions = $arFigure['position'];
            foreach ($figurePositions as $figurePosition) {
                $positionID = $positions->get($figurePosition);

                $chessFigure = ChessFigure::firstOrCreate(
                    ['figure_id' => $figureID, 'position_id' => $positionID]
                );

                if (!($chessFigure instanceof ChessFigure)){
                    $this->error('Фигура для позиции не создана '.$arFigure['name'].' на позиции '.$figurePosition);
                    die();
                }
            }
        });


    }
}
