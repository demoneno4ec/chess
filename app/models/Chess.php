<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Chess
 *
 * @property int id
 * @method static Builder|Chess newModelQuery()
 * @method static Builder|Chess newQuery()
 * @method static Builder|Chess query()
 * @mixin Eloquent
 * @property string $code
 * @property string $name_ru
 * @method static Builder|Chess whereCode($value)
 * @method static Builder|Chess whereId($value)
 * @method static Builder|Chess whereNameRu($value)
 * @property-read Collection|ChessFigure[] $chessFigures
 * @property-read Collection|ChessPositionList[] $ChessPositions
 */

class Chess extends Model
{
    protected $table = 'chesses';

    protected $guarded = [];
    public $timestamps = false;

    public function ChessPositions(): HasMany
    {
        return $this->hasMany(ChessPositionList::class, 'chess_id', 'id');
    }
}
