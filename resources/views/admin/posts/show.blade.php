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
    
@endsection