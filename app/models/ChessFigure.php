<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ChessFigure
 *
 * @property int id
 * @method static Builder|ChessFigure newModelQuery()
 * @method static Builder|ChessFigure newQuery()
 * @method static Builder|ChessFigure query()
 * @mixin Eloquent
 * @property int $figure_id
 * @property int $chess_id
 * @method static Builder|ChessFigure whereChessId($value)
 * @method static Builder|ChessFigure whereFigureId($value)
 * @property int $position_id
 * @method static Builder|ChessFigure wherePositionId($value)
 * @property-read ChessPositionList $ChessPositionList
 * @property-read Figure $Figure
 */

class ChessFigure extends Model
{
    protected $table = 'chess_figures';
    protected $with = ['Figure'];

    protected $guarded = [];
    public $timestamps = false;

    public function Figure(): BelongsTo
    {
        return $this->belongsTo(Figure::class, 'figure_id', 'id');
    }

    public function ChessPositionList(): BelongsTo
    {
        return $this->belongsTo(ChessPositionList::class, 'position_id', 'id');
    }
}
