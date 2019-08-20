<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Chess
 *
 * @property int id
 */
class Chess extends Model
{
    protected $table = 'chesses';

    protected $guarded = [];
    public $timestamps = false;

}
