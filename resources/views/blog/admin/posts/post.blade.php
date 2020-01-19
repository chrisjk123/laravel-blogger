@extends('blog.layout.app')

@section('content')

  <post-component
  :post_object="{{ $post }}"
  :categories="{{ $categories }}"
  :tags="{{ $tags }}"
  ></post-component>

@endsection
