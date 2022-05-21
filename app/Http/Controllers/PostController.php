<?php

namespace App\Http\Controllers;

use App\Jobs\ElasticSearchJob;
use App\Library\CGlobal;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepository;
use App\Http\Requests\Postrequests\PostAddRequest;
use App\Http\Requests\Postrequests\PostEditRequest;

class PostController extends Controller
{
    /**3
     * @var PostRepository|\App\Repositories\RepositoryInterface
     * @var ...
     */
    protected $postRepository;
    protected $postAddRequest;
    protected $postEditRequest;


    public function __construct(
        PostRepository $postRepository,
        PostAddRequest $postAddRequest,
        PostEditRequest $postEditRequest
    ) {
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
        $this->authorize('view-post');

        if ($this->postAddRequest->rules($request)) {
            return $this->postAddRequest->rules($request);
        }

        $data = $this->postRepository->create_post($request);
        if($data) {
        ElasticSearchJob::dispatch($data->id, CGlobal::ELASTIC_CREATE);
        }

        $post = $this->postRepository->getAll();

        //compact : Truyền dữ liệu ra View
        return view('admin.posts.row_post', compact('post'));
    }

    public function openEditModal(Request $request)
    {
        //quyền chỉ author mới sữa được posts
        $this->authorize('view-post');

        $post = $this->postRepository->find($request->id);

        //quyền author chỉ được edit những bài viết của mình
        $this->authorize($post, 'openEditModal');

        $post = $this->postRepository->openEditModal_post($request);


        return view('admin.posts.edit', compact('post'));
    }

    public function postEdit(Request $request)
    {
        if ($this->postEditRequest->rules($request)) {
            return $this->postEditRequest->rules($request);
        }

        $data = $this->postRepository->postEditRepo($request);
        if($data) {
            ElasticSearchJob::dispatch($data->id, CGlobal::ELASTIC_UPDATE);
        }

        $post = $this->postRepository->getAll();

        return view('admin.posts.row_post', compact('post'));
    }

    public function postDelete(Request $request)
    {
        //quyền chỉ author ms được delete
        $this->authorize('view-post');

        $post = $this->postRepository->find($request->id);

        //quyền author chỉ được delete những bài viết của mình
        $this->authorize($post, 'postDelete');

        $data = $this->postRepository->delete($request->id);
        if($data) {
            ElasticSearchJob::dispatch($request->id, CGlobal::ELASTIC_DELETE);
        }

        $post = $this->postRepository->getAll();

        return view('admin.posts.row_post', compact('post'));
    }
}
