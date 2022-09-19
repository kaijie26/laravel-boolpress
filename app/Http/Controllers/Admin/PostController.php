<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione
        $request->validate($this->getValidationRules());

        // Richiedo tutti i dati
        $form_data = $request->all();

        // Cover
        if(isset($form_data['cover'])){
            $img_path = Storage::put('posts-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
            
           
        }

        // Salvo nel db i dati e creo una nuovo riga
        $new_post = new Post();
        $new_post->fill($form_data);

        $new_post->slug = $this->getFreeSlug($new_post->title);

        $new_post->save();
        // Tags
        if(isset($form_data['tags'])){
            $new_post->tags()->sync($form_data['tags']);

        }

       
        
        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $tags = Tag::all();

        $categories = Category::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validazione
        $request->validate($this->getValidationRules());

        $form_data = $request->all();
        

        $post_to_update = Post::findOrFail($id);

        // Slug
        if($form_data['title'] !== $post_to_update->title){

            $form_data['slug'] = $this->getFreeSlug($form_data['title']);

        }else{
            $form_data['slug'] = $post_to_update->slug;

        }

        // Cover
        if(isset($form_data['cover'])){

            if($post_to_update->cover){
                Storage::put('posts-covers', $form_data['cover']);

            }

            $img_path = Storage::put('posts-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
            
        }

        $post_to_update->update($form_data);

        // Tags
        if(isset($form_data['tags'])){
            $post_to_update->tags()->sync($form_data['tags']);

        }else{
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);
        // Cancello il post con l'immagine solo se è esiste
        if($post_to_delete->cover){
            Storage::delete($post_to_delete->cover);

        }
        
        // Cancello con il sync il post selezionato
        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
    }

    protected function getFreeSlug($title){
        $slug_to_save = Str::slug($title, '-');
        
        // Controllo nel db se c'è già un slug esistente a quallo generato
        $exsisting_slug = Post::where('slug', '=', $slug_to_save)->first();
        $slug_base = $slug_to_save;

        // Finchè troverà uno slug già esistente appenderò nel finale il count 
        // incremnetandolo di 1 ad ogni nuovo duplicato creato come nuovo slug della singola card
        $counter = 1;
        while($exsisting_slug == true){
            $slug_to_save = $slug_base . '-' . $counter;
            $exsisting_slug = Post::where('slug', '=', $slug_to_save)->first();
            $counter++;
        };

        return $slug_to_save;
    }

    protected function getValidationRules(){
        return [
            'title' => 'required|max:300',
            'content' => 'required|max:70000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id', 
            'cover' => 'nullable|file|mimes:jpeg,bmp,png,svg,jpg|max:1024',
            
        ];
    }
}
