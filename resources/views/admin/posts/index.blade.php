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
                        <h5 class="card-title">{{ $post->title }}</h5>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>

            </div>
            
        @endforeach

    </div>
    
@endsection