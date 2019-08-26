<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $code
 * @method static Builder|Position newModelQuery()
 * @method static Builder|Position newQuery()
 * @method static Builder|Position query()
 * @method static Builder|Position whereCode($value)
 * @method static Builder|Position whereId($value)
 * @mixin Eloquent
 */
class Position extends Model
{
    protected $table = 'positions';

    protected $guarded = [];
    public $timestamps = false;

}
