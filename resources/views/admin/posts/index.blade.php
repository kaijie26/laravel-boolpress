@extends('layouts.dashboard')

@section('content')

    <h1>Lista Post</h1>

    <div class="row row-cols-3">
        @foreach ($posts as $post)
            {{-- Single-Col --}}
            <div class="col">
                {{-- Single-Card --}}
                <div class="card mt-3">
                    {{-- Card-Content --}}
                    <div class="card-body">
                        @if($post->cover)
                            <img class="w-100" src="{{asset('storage/' . $post->cover)}}" alt="{{ $post->title }}">
                        @endif
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Mostra di più</a>
                    </div>
                </div>

            </div>
            
        @endforeach

    </div>
    
@endsection