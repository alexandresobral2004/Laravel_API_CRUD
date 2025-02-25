@extends('layouts.app')
@section('content')
<div class="container">

  <div class="row">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Conteúdo</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>
              <a href="{{ route('posts.update', $post->id) }}" class="btn btn-primary">Editar</a>
              <a href="#" class="btn btn-danger">Excluir</a>
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection
