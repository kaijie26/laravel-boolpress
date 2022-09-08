@extends('layouts.dashboard')

@section('content')
    {{-- Titolo --}}
    <h1>{{ $post->title }}</h1>
    {{-- Date e Slug --}}
    <div>
        <div>Cretato il: {{$post->created_at->format(' j F Y')}}</div>
        <div>Aggiornato il: {{$post->updated_at->format('j F Y')}}</div>
        <div>Slug: {{$post->slug}}</div>
        <div>Categoria: {{$post->category ? $post->category->name : 'Nessuna'}}</div>
        <div>Tags:
            @forelse ($post->tags as $tag)
                {{$tag->name}}{{!$loop->last ? ',' : ''}}
                
            @empty
                Nessuna 
            @endforelse
            
        </div>  
        
    </div>
    <br>
    {{-- Contenuto --}}
    <p>{{ $post->content }}</p>

    <a class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id])}}">Modifica</a>
    
    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')

        <input class="btn btn-danger" type="submit" value="Cancella" onClick="return confirm('Sei sicuro di voler cancellare?')">
    </form>
    
@endsection