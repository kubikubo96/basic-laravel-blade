<?php

namespace App\Repositories\Post;

use App\Repositories\BaseRepository;
use App\Post;
use App\Services\PostService;

class PostRepository extends BaseRepository
{
    use PostService;

    public function getModel(): string
    {
        return Post::class;
    }

    public function getAll()
    {
        return $this->_model->with('comment', 'user')->get();
    }

    //xử lý postAdd bên PostController
    public function create_post($attributes)
    {
        $data = $attributes->all();

        $data['image'] = $this->updateImage($attributes->file('image'));

        return $this->create($data);
    }

    //xử lý openEditModal bên PostController
    public function openEditModal_post($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];

        return $this->find($id);
    }

    //xử lý postEdit bên PostController
    public function postEditRepo($attributes)
    {
        $data = $attributes->except('image');

        if ($attributes->hasFile('image')) {
            $data['image'] = $this->updateImage($attributes->file('image'));
        }

        return $this->update($data['id'], $data);
    }

    public function postPaginate($limit = 5)
    {
        return $this->_model->paginate($limit);
    }

    public function postHotNews()
    {
        return $this->_model->first();
    }

    public function postHotNews2()
    {
        return $this->_model->all()->skip(1)->take(3);
    }
}
