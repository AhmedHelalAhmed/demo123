@csrf
<div class="form-group">
    <label for="title">Title</label>
    <input @if(isset($data['post'])&&$data['post']->title) value= '{{ $data['post']->title }}' @endif name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter title">
    <small id="titleHelp" class="form-text text-muted">* max 30 characters </small>
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" class="form-control" id="content" aria-describedby="contentHelp" placeholder="Enter content">@if(isset($data['post'])&&$data['post']->content) {{ $data['post']->content }} @endif</textarea>
    <small id="contentHelp" class="form-text text-muted">* max 255 characters </small>
</div>


<div class="form-group">
    <label for="photo">Photo</label>
    <input name='photo' type="file" class="form-control" id="photo">
</div>

<button type="submit" class="btn btn-primary">Submit</button>