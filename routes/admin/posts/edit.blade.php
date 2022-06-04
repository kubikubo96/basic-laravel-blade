<button style="padding: 10px;margin-top: 10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" style="float: right;">&times;</span>
</button>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0;">Sửa tin tức </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12" style="padding-bottom:15px;">
            <form enctype="multipart/form-data" id="editPost" name="editPost" class="form-horizontal"
                style="width: 90%; margin: 0 auto;">
                {{--                            meta name="csrf-token"...  => phải có mới dùng đc ajax--}}
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ @$post->id }}">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" value="{{@$post->title}}" id="title"
                        placeholder="Nhập title" />
                </div>
                <div class="form-group">
                    <label>slug</label>
                    <input class="form-control" name="slug" value="{{@$post->slug}}" id="slug"
                        placeholder="Nhập slug" />
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" rows="3" name="content"
                        id="content_edit">{!! @$post->content !!}</textarea>
                    <script>
                        CKEDITOR.replace('content_edit');
                    </script>

                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" id="image" />
                    <img style="margin-top:20px;" src="images/{{ @$post->image}}" width="100" height="100px" />
                </div>
                <div style="margin-top: 20px;">
                    <p class="error_post text-danger hidden"></p>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal-footer" style="margin-top: 10px;">
    <button type="button" onclick="editPostInModal()" id="saveEditPost" class="btn btn-primary">Save changes
    </button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
