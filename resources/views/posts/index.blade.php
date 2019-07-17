@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All posts</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <a class="btn btn-primary" href="{{ route('posts.create') }}">create new post</a>
@foreach($data['posts'] as $post)

                                <div class="card" >
                                    <a href="{{ route('posts.show',$post->id) }}"><img class="card-img-top" src="{{$post->photo}}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <h5 class="card-title">{{ $post->user->name }}</h5>

                                        <p class="card-text">{{ $post->content }}</p>
                                        <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary">Edit</a>

                                        <form method="post" action="{{ route('posts.destroy',$post->id)}}">
                                           @csrf
                                            @method('DELETE')
                                            <button  type="submit" class="btn btn-danger">Delete</button>

                                        </form>

                                    </div>
                                </div>
    @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
