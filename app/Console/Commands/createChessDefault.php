<?php

namespace App\Console\Commands;

use App\Models\Chess;
use App\Models\ChessFigure;
use App\models\Color;
use App\models\ColorFigure;
use App\Models\Figure;
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

    protected $defaultColors = [
        [
            'code' => 'white',
            'name_ru' => 'Белый'
        ],
        [
            'code' => 'black',
            'name_ru' => 'Черный'
        ],
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
        /** @var ColorFigure $colorFigure */

        $chessID = $this->createChess();

        $this->createColors();

        $this->createFigures($chessID);
    }

    private function createChess(): int
    {
        $chess = Chess::firstOrCreate(
            ['code' => 'default'],
            ['name_ru' => 'Шахматы по умолчанию']
        );

        $chessID = $chess->id;

        if ($chessID <= 0) {
            $this->error('Шахматы отсутсвуют');
            die();
        }

        return $chessID;
    }

    private function createColors(): void
    {
        /** @var Color $color*/

        foreach ($this->defaultColors as $key => $arColor) {
            $color = Color::firstOrCreate(
                ['code' => $arColor['code']],
                ['name_ru' => $arColor['name_ru']]
            );

            $colorID = $color->id;

            if ($colorID <= 0) {
                $this->error('Цвет не был создан');
            }

            $this->defaultColors[$key]['id'] = $colorID;
        }
    }

    private function createFigures($chessID): void
    {

        foreach ($this->defaultFigures as $key => $arFigure) {
            $figure = Figure::firstOrCreate(
                ['code' => $arFigure['code']],
                ['name_ru' => $arFigure['name_ru']]
            );

            $figureID = $figure->id;

            if ($figureID <= 0) {
                $this->error('Фигура отсутстует'.$arFigure['name_ru']);
            }

            $this->defaultFigures[$key]['id'] = $figureID;

            foreach ($this->defaultColors as $arColor){
                $colorID = $arColor['id'];

                if ($colorID <= 0){
                    continue;
                }

                $colorFigure = ColorFigure::firstOrCreate(
                    ['figure_id' => $figureID, 'color_id' => $colorID]
                );

                $colorFigureID = $colorFigure->id;
                if ($colorFigureID <= 0) {
                    $this->error('Фигура: '.$arFigure['name_ru'].' с цветом: '.$arColor['name_ru'].' отсутствует');
                    continue;
                }

                $chessFigure = ChessFigure::firstOrCreate(
                    ['figure_id' => $colorFigureID, 'chess_id' => $chessID]
                );

                if (!($chessFigure instanceof ChessFigure)) {
                    $this->error('Фигура: '.$arFigure['name_ru'].' с цветом: '.$arColor['name_ru'].' отсутствует,'.'id шахматной доски: '.$chessID);
                    continue;
                }
            }
        }
    }
}
