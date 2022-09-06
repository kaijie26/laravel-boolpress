@extends('layouts.dashboard')

@section('content')
    {{-- Titolo --}}
    <h1>{{ $post->title }}</h1>
    {{-- Date e Slug --}}
    <div>
        <div>Cretato il: {{$post->created_at}}</div>
        <div>Aggiornato il: {{$post->updated_at}}</div>
        <div>Slug: {{$post->slug}}</div>
    </div>
    <br>
    {{-- Contenuto --}}
    <p>{{ $post->content }}</p>

    <a class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id])}}">Modifica</a>
    
@endsection