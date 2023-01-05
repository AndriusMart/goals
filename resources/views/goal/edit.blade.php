@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Update Goal</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('g_update', $goal)}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control" value="{{old('title', $goal->title)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Days to do</span>
                            <input type="text" name="days" class="form-control" value="{{old('isbn', $goal->days)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">About</span>
                            <input type="text" name="about" class="form-control" value="{{old('about', $goal->about)}}">
                        </div>
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-secondary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection