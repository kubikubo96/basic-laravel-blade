<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColearnCrawler extends Model
{
    protected $table = 'colearn_crawler';

    protected $appends = ['href'];

    protected $fillable = [
        'url_question', 'category_id', 'category_name', 'topic_id', 'topic_name', 'topic_parent_name', 'topic_parent_name_no_accents', 'class_id', 'class_name', 'name', 'tag', 'content', 'images', 'new_images', 'option', 'solution', 'answer', 'correct_answer', 'note'
    ];

    protected $casts = [
        'images' => 'array',
        'new_images' => 'array',
        'option' => 'array'
    ];


    public function getHrefAttribute()
    {
        return str_replace("https://vungoi.vn/", "", $this->url_question);
    }
}
