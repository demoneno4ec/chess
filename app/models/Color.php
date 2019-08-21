<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Color
 *
 * @property int id
 * @method static Builder|Color newModelQuery()
 * @method static Builder|Color newQuery()
 * @method static Builder|Color query()
 * @mixin \Eloquent
 * @property string $code
 * @property string $name_ru
 * @method static Builder|Color whereCode($value)
 * @method static Builder|Color whereId($value)
 * @method static Builder|Color whereNameRu($value)
 */

class Color extends Model
{
    protected $table = 'colors';
    protected $guarded = [];
    public $timestamps = false;

}
