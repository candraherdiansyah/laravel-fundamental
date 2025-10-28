<?php
namespace App\Http\Controllers;

// import Model Post
use App\Models\Post;
// import package Request
use Illuminate\Http\Request;

class PostController extends Controller
{

    // beri middleware 'auth' untuk mengecek sudah login atau belum
    public function __construct()
    {
        $this->middleware('auth');
    }

    // daftar post
    public function index()
    {
        // menampilkan semua data dari model post
        $post = Post::all();
        return view('post.index', compact('post'));

    }

    // menampilkan halaman formulir create
    public function create()
    {
        return view('post.create');
    }

    // menambah data ke storage(database)
    public function store(Request $request)
    {
        // membuat data baru untuk table 'posts'
        // melalui model Post
        $post          = new Post;
        $post->title   = $request->title;
        $post->content = $request->content;
        $post->save(); // disimpan ke db
        return redirect()->route('post.index');
    }

    // menampilkan data berdasarkan parameter id
    public function show($id)
    {
        // mencari data post berdasarkan parameter 'id'
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));

    }

    // menampilkan formulir edit data post
    public function edit($id)
    {
        // mencari data post berdasarkan parameter 'id'
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));

    }

    public function update(Request $request, $id)
    {
        // mencari data post berdasarkan parameter 'id'
        $post          = Post::findOrFail($id);
        $post->title   = $request->title;
        $post->content = $request->content;
        $post->save(); // disimpan ke db
                       // di alihkan ke halaman post melalui route post.index
        return redirect()->route('post.index');

    }

    // menghapus data berdasarkan parameter id
    public function destroy($id)
    {
        // mencari data post berdasarkan parameter 'id'
        $post = Post::findOrFail($id);
        $post->delete(); // setelah data ditemukan kemudian di delete
        return redirect()->route('post.index');
    }
}
