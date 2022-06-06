<?php

namespace App\Http\Controllers;

use App\Http\Requests\Postrequests\PostAddRequest;
use App\Http\Requests\Postrequests\PostEditRequest;
use App\Jobs\ElasticSearchJob;
use App\Library\CGlobal;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected $postRepository;
    protected $postAddRequest;
    protected $postEditRequest;


    public function __construct(
        PostRepository $postRepository,
        PostAddRequest $postAddRequest,
        PostEditRequest $postEditRequest
    )
    {
        $this->postRepository = $postRepository;
        $this->postAddRequest = $postAddRequest;
        $this->postEditRequest = $postEditRequest;
    }

    public function index()
    {
        $post = $this->postRepository->getAll();

        return view('admin.posts.index', compact('post'));
    }

    public function postAdd(Request $request)
    {
        if ($this->postAddRequest->rules($request)) {
            return $this->postAddRequest->rules($request);
        }
        $data = $this->postRepository->create_post($request);
        /*
         *@todo elasticsearch
         * if($data) {
        ElasticSearchJob::dispatch($data->id, CGlobal::ELASTIC_CREATE);
        }*/

        $post = $this->postRepository->getAll();

        //compact : Truyền dữ liệu ra View
        return view('admin.posts.row_post', compact('post'));
    }

    public function openEditModal(Request $request)
    {
        $user = Auth::user();
        $post = $this->postRepository->find($request->id);
        $this->authorize('updatePost', $post); //quyền author chỉ được update những bài viết của mình
        $post = $this->postRepository->openModalUpdate($request);
        return view('admin.posts.edit', compact('post'));
    }

    public function postEdit(Request $request)
    {
        $post = $this->postRepository->find($request->id);
        $this->authorize('updatePost', $post); //quyền author chỉ được update những bài viết của mình
        if ($this->postEditRequest->rules($request)) {
            return $this->postEditRequest->rules($request);
        }
        $data = $this->postRepository->postEditRepo($request);
        /*
         * @todo elasticsearch
         * if($data) {
            ElasticSearchJob::dispatch($data->id, CGlobal::ELASTIC_UPDATE);
        }*/
        $post = $this->postRepository->getAll();

        return view('admin.posts.row_post', compact('post'));
    }

    public function postDelete(Request $request)
    {
        $post = $this->postRepository->find($request->id);
        $this->authorize('deletePost', $post); //quyền author chỉ được delete những bài viết của mình
        $data = $this->postRepository->delete($request->id);
        if ($data) {
            ElasticSearchJob::dispatch($request->id, CGlobal::ELASTIC_DELETE);
        }
        $post = $this->postRepository->getAll();
        return view('admin.posts.row_post', compact('post'));
    }
}
