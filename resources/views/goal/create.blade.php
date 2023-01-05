@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>New Hotel</h2>
                </div>
                <div class="card-body">
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
@endsection