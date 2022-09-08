@extends('layouts.dashboard')

@section('content')
    <h1>Crea Card</h1> 

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.posts.store') }}" method="POST"> 
        @csrf

        {{-- Titolo --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        {{-- Select --}}
        <div class="mb-3">
            <label for="category_id">Categoria</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Nessuna</option>
                {{-- Stampo la categoria --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : '' }}  >{{ $category->name}}</option>
                    
                @endforeach
            </select>
        </div>

        {{-- Tags --}}
       <div class="mb-3">
            <h5>Tags:</h5>
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                     value="{{ $tag->id }}"
                     id="tag-{{ $tag->id }}"
                     name="tags[]"
                     {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                     >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                    {{$tag->name}}
                    </label>
                </div>
                
            @endforeach

       </div>

        {{-- Contenuto --}}
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="8">{{ old('content') }}</textarea>
        </div>  
    
          <button>Salva</button>
    </form>
@endsection