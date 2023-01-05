@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>goals</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($goals as $goal)
                        <li class="list-group-item">
                            <div class="hotels-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{$goal->title}}</h2>
                                    <h4><span>Days: </span>{{$goal->days}}</h4>
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
</div>
@endsection