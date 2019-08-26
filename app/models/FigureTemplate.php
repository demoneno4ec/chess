<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\FigureTemplate
 *
 * @property int $figure_id
 * @property int $template_id
 * @method static Builder|FigureTemplate newModelQuery()
 * @method static Builder|FigureTemplate newQuery()
 * @method static Builder|FigureTemplate query()
 * @method static Builder|FigureTemplate whereFigureId($value)
 * @method static Builder|FigureTemplate whereTemplateId($value)
 * @mixin Eloquent
 * @property-read Figure $Figure
 * @property-read TemplatesFigure $TemplateFigure
 */
class FigureTemplate extends Model
{
    protected $table = 'figure_templates';

    protected $with = ['TemplateFigure'];
    protected $guarded = [];
    public $timestamps = false;

    public function TemplateFigure(): BelongsTo
    {
        return $this->belongsTo(TemplatesFigure::class, 'template_id', 'id');
    }

    public function Figure(): BelongsTo
    {
        return $this->belongsTo(Figure::class, 'figure_id', 'id');
    }
}
