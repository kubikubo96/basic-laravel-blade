<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColearnCrawler extends Model
{
    protected $table = 'colearn_crawler';

    protected $appends = ['href'];

    protected $fillable = [
        'name_subject', 'name_topic', 'name', 'tag', 'question', 'image_question', 'image_names', 'option', 'solution', 'answer', 'correct_answer', 'note'
    ];

    protected $casts = [
        'image_question' => 'array',
        'option' => 'array',
        'image_names' => 'array',
    ];


    public function getHrefAttribute()
    {
        return str_replace("https://vungoi.vn/","",$this->url_question);
    }
}
