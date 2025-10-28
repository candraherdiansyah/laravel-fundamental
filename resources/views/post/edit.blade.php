@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <fieldset>
                <legend>Edit Data Post</legend>
                <form action="{{ route('post.update',$post->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="">content</label>
                        <textarea name="content" class="form-control" required> {{ $post->content }} </textarea>
                    </div>
                    <div class="mb3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>
@endsection