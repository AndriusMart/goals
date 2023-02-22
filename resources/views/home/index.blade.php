@extends('layouts.app')

@section('content')
<h1 class="title mid"><span>My</span>Goals</h1>
<div>
    <div class="container">
        <h2>Weather with JavaScript</h2>
        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="city" placeholder="Enter city" name="city">
            </div>
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </form>
        <div id="weather-result"></div>
        <h2 class="mt-5">Weather with Laravel</h2>
        <div class="form-group">
            <form method="get" action="{{ route('home') }}">
                <label for="search_city">Search City:</label>
                <input type="text" class="form-control" name="search_city" id="search_city">
                <input type="submit" value="Search">
            </form>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$city}}</h5>
                    <p class="card-text">Temperature {{$temp}} &#8451;</p>
                    <p class="card-text">Weather {{$weather}}</p>
                </div>
            </div>
        </div>
    </div>
            <div class="list-items container mt-5">
                <div class="filter">
                    <div class="card filter">
                        <span class="fs-5 fw-semibold">Add new goal</span>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{route('g_store')}}" method="post" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Titile</span>
                                            <input type="text" name="title" class="form-control"
                                                value="{{old('title')}}">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">About</span>
                                            <input type="text" name="about" class="form-control"
                                                value="{{old('about')}}">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Days to do</span>
                                            <input type="text" name="days" class="form-control" value="{{old('days')}}">
                                        </div>
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                        <input type="hidden" value="1" name="done">

                                        @csrf
                                        <button type="submit" class="btn btn-secondary mt-4">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="  carousel-border">
                        <div class="card">
                            <span class="fs-5 fw-semibold">Goals</span>
                            <div class="card-img mt-3 ">
                                <ul class="list-group">
                                    @forelse($goals as $goal)
                                    @if($goal->done == 1)
                                    <li class="list-group-item myDiv">
                                        <div class="hotels-list">
                                            <div class="content">
                                                <h2><span>Title: </span>{{$goal->title}}</h2>
                                                <h4><span>Days to do: </span>{{$goal->days}}</h4>
                                                <h4><span>left: </span>
                                                    <div class="left-value left-days">
                                                        {{$time_now->diffInDays($goal->created_at->addDays($goal->days),
                                                        false)}}</div>
                                                </h4>

                                                <h4><span>till:
                                                    </span>{{$goal->created_at->addDays($goal->days)->format('d/m/Y')}}
                                                </h4>
                                            </div>
                                            <div class="buttons">
                                                <a href="{{route('g_show', $goal)}}" class="btn btn-info border border-dark">Info</a>
                                                <a href="{{route('g_edit', $goal)}}" class="btn btn-success border border-dark">Edit</a>
                                                <form action="{{route('g_done', $goal)}}" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" value="2" name="done">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-danger border border-dark">Done</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @empty
                                    <li class="list-group-item">No goals found</li>
                                    @endforelse
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="  carousel-border">
                        <div class="card">
                            <span class="fs-5 fw-semibold">Accomplished Goals</span>
                            <div class="card-img mt-3 ">
                                <ul class="list-group">
                                    @forelse($goals as $goal)
                                    @if($goal->done == 2)
                                    <li class="list-group-item">
                                        <div class="hotels-list">
                                            <div class="content">
                                                <h2><span>Title: </span>{{$goal->title}}</h2>
                                            </div>
                                            <div class="buttons">
                                                <a href="{{route('g_show', $goal)}}" class="btn btn-info border border-dark">Info</a>
                                                <a href="{{route('g_edit', $goal)}}" class="btn btn-success border border-dark">Edit</a>
                                                <form action="{{route('g_done', $goal)}}" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" value="1" name="done">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-danger border border-dark">Undo</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>

                                    @endif
                                    @empty
                                    <li class="list-group-item">No goals found</li>
                                    @endforelse
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
        </body>

        @endsection