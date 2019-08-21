<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 */

class ChessFigure extends Model
{
    protected $table = 'chess_figures';
    protected $with = ['colorFigures'];

    protected $guarded = [];
    public $timestamps = false;

    public function colorFigures(): BelongsTo
    {
        return $this->belongsTo(ColorFigure::class, 'figure_id', 'id');
    }
}
