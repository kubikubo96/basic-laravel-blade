<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Comment::class;
    }

    public function getAll()
    {
        return Comment::with('user', 'post')->get();
    }

    //xử lý postAdd bên UserController
    public function create_comment($attributes)
    {
        $data = array();
        $post_id = $attributes->id_post;
        $user_id = $attributes->id_user;
        $data['post_id'] = $post_id;
        $data['user_id'] = $user_id;
        $data['content'] = $attributes->content;

        return $this->create($data);
    }
}
