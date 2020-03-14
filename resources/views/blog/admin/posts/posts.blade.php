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
          @if ( ! $posts->isEmpty() )
            @foreach ( $posts as $post )
              <li class="d-flex justify-content-between align-items-center">
                <div class="">
                  <h6 class="@if ($post->isScheduled()) mb-10 @else mb-0 @endif">
                    {{ $post->title }}
                  </h6>

                  <p class="mb-0">
                    @if ($post->isScheduled())
                      Set to publish: {{ $post->published_at->diffForHumans() }}
                    @endif
                  </p>
                </div>

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
              </li>

              @if (! $loop->last)
                <hr>
              @endif
            @endforeach
          @endif
        </ul>
      </div>
    </div>
  </div><!-- container -->

@endsection
