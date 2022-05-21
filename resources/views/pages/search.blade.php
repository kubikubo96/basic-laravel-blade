@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="container" style="margin-top: 0px;">
            <div class="row">
                <div class="col-md-9 c1" style=" ">
                    <form class="form-search" method="get" action="">
                        <div class="input-group mb-3">
                            <input type="text" name="key" class="form-control" placeholder="Nhập từ cần tìm">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($post as $pt)
                            <div class="col-5 c7">
                                <img src="images/{{$pt['image']}}" width="100%"/>
                            </div>
                            <div class="col-7 c7">
                                <h4><a style="text-decoration: none;color: #000000;"
                                       href="detail/{{$pt['id']}}/{{$pt['title_link']}}.html">{{$pt['title']}}</a></h4>
                                <p><b>Sống</b> - 2 giờ trước</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 cc" style="text-align: center;">
                    <img class="c9" src="images/qc1.JPG" width="80%"/>
                    <img class="c9" src="images/qc2.JPG" width="80%"/>
                    <img class="c9" src="images/qc3.JPG" width="80%"/>
                </div>
            </div>
        </div>
    </div>
@endsection
