@extends('layouts.dashboard')

@section('content')
    <h1>Modifica Post</h1> 

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')

        {{-- Titolo --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>

        {{-- Select --}}
        <div class="mb-3">
            <label for="category_id">Categoria</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Nessuna</option>
                {{-- Stampo la categoria --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>{{ $category->name}}</option>
                    
                @endforeach
            </select>
        </div>

        {{-- Tags --}}
        <div class="mb-3">
            <h5>Tags:</h5>

            @foreach ($tags as $tag)

                {{-- Se sono prensenti errori valuto la old() per capire dove collocare i vari checked  --}}
                @if($errors->any())
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                        value="{{ $tag->id }}"
                        id="tag-{{ $tag->id }}"
                        name="tags[]"
                        {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{$tag->name}}
                        </label>
                    </div>

                {{-- Se non ci sono errori di validazione carico la collection dei tags --}} 
                @else
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                        value="{{ $tag->id }}"
                        id="tag-{{ $tag->id }}"
                        name="tags[]"
                        {{$post->tags->contains($tag) ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{$tag->name}}
                        </label>
                    </div>
                    
                @endif

            @endforeach

       </div>

        {{-- Contenuto --}}
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="8">{{ old('content', $post->content) }}</textarea>
        </div> 
        
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="cover" name="cover">
            <label class="input-group-text" for="cover">Upload</label>
        </div>
        
        @if($post->cover)
            <div>
                <div>immagine inserita</div>
                <img class="w-25" src="{{asset('storage/' . $post->cover)}}" alt="{{ $post->title }}">
            </div>
        @endif
          
        <button class="btn btn-primary" >Salva Modifica</button>
    </form>

@endsection