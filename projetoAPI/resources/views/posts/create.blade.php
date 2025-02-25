@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row">
    <div class="col-12">
      <form action="{{ route('posts.createPost') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Título</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Conteúdo</label>
          <textarea class="form-control" id="cor" name="body" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
    </div>
  </div>
</div>
@endsection
