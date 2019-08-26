<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TemplatesFigure
 *
 * @property int $id
 * @property string $code
 * @property string $name_ru
 * @property string $html_template
 * @property string $template
 * @method static Builder|TemplatesFigure newModelQuery()
 * @method static Builder|TemplatesFigure newQuery()
 * @method static Builder|TemplatesFigure query()
 * @method static Builder|TemplatesFigure whereCode($value)
 * @method static Builder|TemplatesFigure whereHtmlTemplate($value)
 * @method static Builder|TemplatesFigure whereId($value)
 * @method static Builder|TemplatesFigure whereNameRu($value)
 * @method static Builder|TemplatesFigure whereTemplate($value)
 * @mixin Eloquent
 */
class TemplatesFigure extends Model
{
    protected $table = 'templates_figures';

    protected $guarded = [];
    public $timestamps = false;
}
