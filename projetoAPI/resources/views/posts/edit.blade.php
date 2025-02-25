@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row">
    <div class="col-12">
      <form action="{{ route('posts.updatePostSave') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $post['id'] }}">
        <div class="mb-3">
          <label for="title" class="form-label">Título</label>
          <input type="text" class="form-control" id="title" name="title" value="{{ $post['title'] }}">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Conteúdo</label>
          <input class="form-control" id="body" name="body" value="{{  $post['body'] }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
    </div>
  </div>
</div>
@endsection
