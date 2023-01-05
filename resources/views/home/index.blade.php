@extends('layouts.app')

@section('content')
<h1 class="title mid"><span>My</span>Goals</h1>
<div class="items bg-foto">
    <div class="col-9 bg-foto">
        <div class="list-items">
            <div class="filter">
                <div class="card filter">
                    <span class="fs-5 fw-semibold">Add new goal</span>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('g_store')}}" method="post" enctype="multipart/form-data">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Titile</span>
                                        <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">About</span>
                                        <input type="text" name="about" class="form-control" value="{{old('about')}}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Days to do</span>
                                        <input type="text" name="days" class="form-control" value="{{old('days')}}">
                                    </div>
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
            
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
                        <div class="card-img ">
                            <ul class="list-group">
                                @forelse($goals as $goal)
                                <li class="list-group-item">
                                    <div class="hotels-list">
                                        <div class="content">
                                            <h2><span>Title: </span>{{$goal->title}}</h2>
                                            <h4><span>Days to do : </span>{{$goal->days}}</h4>
                                            <h4><span>left : </span>{{$time_now->diffInDays($goal->created_at->addDays($goal->days), false)}}</h4>
                                        </div>
                                        <div class="buttons">
                                            <a href="{{route('g_show', $goal)}}" class="btn btn-info">Show</a>
                                            @if(Auth::user()->role >=10)
                                            <a href="{{route('g_edit', $goal)}}" class="btn btn-success">Edit</a>
                                            <form action="{{route('g_delete', $goal)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </li>
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
                    <span class="fs-5 fw-semibold">My info</span>
                    <div class="card-img ">
                        <ul class="list-group">
                            balaslbdblas
                        </ul>
                      
                </div>

            </div>
        </div>
    </div>
    
        </div>
    
</div>
</body>
@endsection