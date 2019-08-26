<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Figure
 *
 * @property int id
 * @method static Builder|Figure newModelQuery()
 * @method static Builder|Figure newQuery()
 * @method static Builder|Figure query()
 * @mixin Eloquent
 * @property string $code
 * @property string $name_ru
 * @method static Builder|Figure whereCode($value)
 * @method static Builder|Figure whereId($value)
 * @method static Builder|Figure whereNameRu($value)
 * @property string $color
 * @method static Builder|Figure whereColor($value)
 * @property-read Collection|FigureTemplate[] $FigureTemplates
 */
class Figure extends Model
{
    protected $table = 'figures';

    protected $with = ['FigureTemplates'];
    protected $guarded = [];
    public $timestamps = false;

    public function FigureTemplates(): HasMany
    {
        return $this->HasMany(FigureTemplate::class, 'figure_id', 'id');
    }
}
