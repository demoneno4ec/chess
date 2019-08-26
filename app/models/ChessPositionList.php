<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ChessPositionList
 *
 * @property int $id
 * @property int $position_id
 * @property int $chess_id
 * @property int $sort
 * @method static Builder|ChessPositionList newModelQuery()
 * @method static Builder|ChessPositionList newQuery()
 * @method static Builder|ChessPositionList query()
 * @method static Builder|ChessPositionList whereChessId($value)
 * @method static Builder|ChessPositionList whereId($value)
 * @method static Builder|ChessPositionList wherePositionId($value)
 * @method static Builder|ChessPositionList whereSort($value)
 * @mixin Eloquent
 * @property-read Chess $Chess
 * @property-read Collection|ChessFigure[] $ChessFigures
 * @property-read Position $Position
 */
class ChessPositionList extends Model
{
    protected $table = 'chess_position_lists';

    protected $guarded = [];
    public $timestamps = false;

    public function Position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function Chess(): BelongsTo
    {
        return $this->belongsTo(Chess::class, 'chess_id', 'id');
    }

    public function ChessFigures(): HasMany
    {
        return $this->hasMany(ChessFigure::class, 'position_id', 'id');
    }
}
