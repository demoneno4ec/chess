<?php

namespace App\Console\Commands;

use App\Models\Chess;
use App\Models\ChessFigure;
use App\Models\Figure;
use Illuminate\Console\Command;

class createChessDefault extends Command
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
        /** @var Chess $chess */
        /** @var Figure $figure */

        $chess = Chess::firstOrCreate(
            ['code' => 'default'],
            ['name_ru' => 'Шахматы по умолчанию']
        );

        $this->info($chess);

        $chessID = $chess->id;

        if ($chess->id <= 0) {
            $this->error('Шахматы отсутсвуют');
            die();
        }

        foreach ($this->defaultFigures as $arFigure) {
            $figure = Figure::firstOrCreate(
                ['code' => $arFigure['code']],
                ['name_ru' => $arFigure['name_ru']]
            );

            $figureID = $figure->id;

            if ($figureID <= 0) {
                $this->error('Фигура отсутстует' . $arFigure['name_ru']);
                die();
            }

            ChessFigure::firstOrCreate(
                ['chess_figure' => $chessID, 'figure_chess' => , 'color'],

            );

            $this->info($figure);
        }


        $this->info($chess instanceof Chess);
    }
}
