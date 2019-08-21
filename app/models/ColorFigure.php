<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ColorFigure
 *
 * @property int id
 * @method static Builder|ColorFigure newModelQuery()
 * @method static Builder|ColorFigure newQuery()
 * @method static Builder|ColorFigure query()
 * @mixin Eloquent
 * @property int $figure_id
 * @property int $color_id
 * @method static Builder|ColorFigure whereColorId($value)
 * @method static Builder|ColorFigure whereFigureId($value)
 * @method static Builder|ColorFigure whereId($value)
 */

class ColorFigure extends Model
{
    protected $table = 'color_figures';
    protected $with = ['figures', 'colors'];
    protected $guarded = [];
    public $timestamps = false;

    public function figures(): BelongsTo
    {
        return $this->belongsTo(Figure::class, 'figure_id', 'id');
    }

    public function colors(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
