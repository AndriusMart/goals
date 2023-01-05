@extends('layouts.app')
@section('content')

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-back">
                            <h2>goal</h2>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="content">
                            <div class="show-l">
                                <div class="show-info">

                                    <div class="line"><span>title: </span>
                                        <h5>{{$goal->title}}</h5>
                                    </div>
                                    <div class="line"><span>Days to do: </span>
                                        <h5>{{$goal->days}}</h5>
                                    </div>

                                </div>
                            </div>
                            <h2 class="title mt-5">About!</h2>
                            <div class="line">
                                <p>{{$goal->about}}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
@endsection