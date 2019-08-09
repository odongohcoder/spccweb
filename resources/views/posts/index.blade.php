@extends('layouts.app', ['title' => 'Posts'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">
        @if(count($posts) > 0)
          <div class="row mt-5">
              @foreach ($posts as $post)
              <div class="col-xl-4 mb-5 mb-xl-0">
                  <div class="card shadow">
                      <img class="card-img-top" src="{{ asset('argon/img/theme/team-4-800x800.jpg') }}" alt="Card image cap">
                      <div class="card-body">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        <p class="card-text">
                          {!! str_limit(strip_tags($post->body), 135) !!}
                        </p>
                        <p><small>Written by Joeylene Rivera | {{ $post->created_at->format('M d, Y') }}</small></p>
                        <div class="button-group row">
                          <div class="col-8">
                            <a href="/posts/{{ $post->post_id }}" class="btn btn-outline-primary btn-sm">View</a>
                            <a href="/posts/{{$post->post_id}}/edit" class="btn btn-outline-info btn-sm">Edit</a>
                          </div>
                          <div class="col-4 text-right">
                              <form method="POST" action="{{ action('PostsController@destroy', $post->post_id) }}" style="display: inline;">
                                  @csrf
                                  @method('DELETE')

                                  <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                              </form>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>

          <div class="row mt-5">
            {{ $posts->links() }}
          </div>
        @else
          <div class="row mt-9 mb-9">
            <div class="col text-center">
                <p class="lead">No posts found</p>
                <br>
                <a href="/posts/create" class="btn btn-primary btn-lg">Create Post</a>
            </div>
          </div>
        @endif

        @include('layouts.footers.auth')
    </div>
@endsection