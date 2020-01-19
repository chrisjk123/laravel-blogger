@extends('blog.layout.app')

@section('content')

<div class="container"><!-- container -->
  <div class="card">
    <div class="card-header">
      <div class="row justify-content-end">
        <div class="col-4 my-auto text-center">
          Posts
        </div>
        <div class="col-4 text-right">
          <a href="{{ route('posts.create') }}" class="btn btn-primary" name="button">Add</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <ul class="list-unstyled m-0">
        @if ( ! empty($posts) )
          @foreach ( $posts as $post )
            <li class="clearfix">
              <div class="float-left">
                {{ $post->title }}
              </div>
              <div class="float-right">
                <div class="dropdown">
                  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post->id]) }}" >Edit</a>
                    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                      @csrf
                      {{ method_field('DELETE') }}
                      <a class="dropdown-item" onclick="$(this).closest('form').submit();" href="javascript:void(0);">Delete</a>
                    </form>
                  </div>
                </div>
              </div>
            </li>
            <hr>
          @endforeach
        @endif
      </ul>
    </div>
  </div>
</div><!-- container -->

@endsection
