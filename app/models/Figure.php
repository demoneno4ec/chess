<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 */

class Figure extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
