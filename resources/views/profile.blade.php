@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-12 col-md-offset-1 border  border-light rounded mb-0">
        <img src="/Laravel/weBlogs/public/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"> 
        <h1 style="padding-top:50px;">{{ $user->name }}</h1>
        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#bd-example-modal-sm" style="width:20px; height:20px; padding-top:5px; float:right;"><i class="fas fa-user-edit" style="width:40px; height:30px; opacity:0.4;"></i>
        </button>
        
        <div class="modal" id="bd-example-modal-sm" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Upload image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="btn blue-gradient btn-sm float-left">
                    <i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i>
                    <form enctype="multipart/form-data" action="{{ route('updateDP') }}" method="POST">
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" style="font-size: 15px; padding:10px 15px 10px 15px;">
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-md-12 col-md-offset-1">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-flag" style="padding-right: 5px; font-size: 13pt;"></i>Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="far fa-comment-dots" style="padding-right: 5px; font-size: 14pt;"></i>Comments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-users" style="padding-right: 5px; font-size: 14pt;"></i>Friends</a>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          
            <div class="col-md-12 col-md-offset-1">
              <form action="{{ route('getPost') }}" method="POST">
              {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}"> 
                    <input type="text" name="title" class="form-control" placeholder="Enter title">
                  @if($errors->has('title'))
                    <small class="text-danger float-left">{{ $errors->first('title') }}</small>
                  @endif
                  </div>
                  <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}"> 
                    <textarea name="body" rows="8" cols="80" class="form-control" placeholder="Write your post here"></textarea>
                    @if($errors->has('body'))
                    <small class="text-danger float-left">{{ $errors->first('body') }}</small>
                    @endif
                  </div>
                  <div>
                  <input type="submit" value="Post" class="btn btn-info float-right">
                  </div>
                </div>
              </form>
            </div>

            <div class="col-md-12 col-md-offset-1">            
              @foreach($posts as $post)
              <div class="card mt-2" data-postid="{{ $post->id }}">
                <div class="card-header" id="postTitle">
                  {{ $post->title}}
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p id="postBody">{{ $post->body }}</p>
                    <footer class="blockquote-footer">Posted by<cite title="Source Title">&nbsp{{ $post->user->name }}</cite></footer>
                  </blockquote>
                </div>
                <div class="footer float-left" style="margin-left: 30px;">
                  <!-- <i class="far fa-thumbs-up" style="font-size: 13pt; display: inline-block; margin: 0 30px 2px 0;"></i> -->
                  <!-- <i class="far fa-thumbs-down" style="font-size: 13pt; display: inline-block; margin: 0 30px 0 31px;"></i> -->
                  <a href="#" class="like" style="font-size: 13pt; display: inline-block; margin: 0 30px 2px 0;">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You liked it!' : 'Like' : 'Like'}}</a>|<a href="#" class="like" style="font-size: 13pt; display: inline-block; margin: 0 30px 0 31px;">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You disliked it!' : 'Dislike' : 'Dislike' }}</a>
                  @if(Auth::user() == $post->user)
                    |<a href="#" class="edit" id="edit"><i class="fas fa-pen" style="font-size: 10pt; display: inline-block; margin: 0 0 2px 31px;"></i><b style="font-size: 12pt; display: inline-block; margin: 0 30px 0 1px;">Edit</b></a>|
                    <a href="{{ route('deletePost', ['post_id' => $post->id]) }}"><i class="fas fa-trash-alt" style="font-size: 10pt; display: inline-block; margin: 0 0 2px 31px;"></i><span style="font-size: 12pt; display: inline-block; margin: 0 0 0 1px;">Remove</span></a>
                  @endif
                </div>
              </div>
            @endforeach
            </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="text" name="title" id="post-Title" class="form-control" placeholder="Enter title">
          <textarea name="body" rows="8" cols="80" class="form-control" id="post-Body" placeholder="Write your post here"></textarea>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  </div>
</div>

<script src="{{ asset('mdbootstrap4/ajax/jquery/3.4.1/jquery.min.js') }}"></script>
<script>
  
var token = '{{ Session::token() }}';
var urlLike = '{{ route('likePost') }}';

var postId = 0;

$(function () {
          $("a[class='edit']").click(function (event) {
            event.preventDefault();
              var postTitle = $('#postTitle').text();
              var postBody = $('#postBody').text();
              $('#post-Title').val(postTitle);
              $('#post-Body').val(postBody);
              $("#editPostModal").modal("show");
              return false;
          });
      });

$(function () {
        $("a[class='like']").click(function (event) {
        event.preventDefault();
        postId = event.target.parentNode.parentNode.dataset['postid'];
        var isLike = event.target.previousElementSibling == null;
        $.ajax({
          method: 'POST',
          url: urlLike,
          data: {
                  isLike: isLike, 
                  postId: postId, 
                  _token: token
                }
        })
        .done(function() {
          event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You liked it!' : 'Like' : event.target.innerText == 'Dislike' ? 'You disliked it!' : 'Dislike';
          if(isLike) {
            event.target.nextElementSibling.innerText = 'Dislike';
          }
          else {
            event.target.previousElementSibling.innerText = 'Like';
          }
        });
      });
    });
  
</script>
  
@endsection


