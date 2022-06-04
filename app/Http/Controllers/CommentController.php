<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $postRepository;

    public function __construct(
        CommentRepository $commentRepository,
        PostRepository $postRepository
    ) {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
    }

    public function getComment()
    {
        $comment = $this->commentRepository->getAll();
        return view('admin.comments.index', ['comment' => $comment]);
    }

    public function postComment(Request $request)
    {
        $content = $request->input('content', '');
        if (!$content) {
            $post = $this->postRepository->find($request->id_post);
            return view('pages.row_detail', [
                'post' => $post,
                'error_comment' => 'Bạn chưa nhập comment!'
            ]);
        }
        $comment = $this->commentRepository->create_comment($request);
        $post = $comment->post;
        return view('pages.row_detail', ['post' => $post]);
    }

    public function postDelete(Request $request)
    {
        $comment = $this->commentRepository->find($request->id);
        $post = $this->postRepository->find($comment->post_id);
        //quyền chỉ được delete những comment bài viết của mình
        $this->authorize($post, 'postDelete');
        $comment->delete();
        $comment = $this->commentRepository->getAll();
        return view('admin.comments.row_comment', compact('comment'));
    }
}
