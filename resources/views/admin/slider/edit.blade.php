@extends('admin.layouts.master')

@section('section')

  <!-- Main Content -->
  <section class="section">
    <div class="section-header" style="padding-left: 10px;">
      <h1>Slider</h1>

    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4>Edit Slider</h4> --}}
            </div>
            <div class="card-body">
              <form action="{{route('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label>Preview</label>
                      <br>
                      <img width="200" src="{{asset($slider->image)}}" alt="">
                  </div>
                  <div class="form-group">
                      <label>Image</label>
                      <input type="file" class="form-control" name="image">
                  </div>

                  <div class="form-group">
                      <label>Type</label>
                      <input type="text" class="form-control" name="type" value="{{$slider->type}}">
                  </div>
                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" name="title"  value="{{$slider->title}}">
                  </div>
                  <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" class="form-control summernote">{!!$slider->description!!}</textarea>
                  </div>
                  <div class="form-group">
                      <label>Button Url</label>
                      <input type="text" class="form-control" name="btn_url" value="{{$slider->btn_url}}">
                  </div>
                  <div class="form-group">
                      <label>Serial</label>
                      <input type="text" class="form-control" name="serial" value="{{$slider->serial}}">
                  </div>
                  <div class="form-group">
                      <label for="inputState">Status</label>
                      <select id="inputState" class="form-control" name="status">
                        <option {{$slider->status == 1 ? 'selected': ''}} value="1">Active</option>
                        <option {{$slider->status == 0 ? 'selected': ''}} value="0">Inactive</option>
                      </select>
                    </div>
                  <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@push('scripts')
<script type="text/javascript">

  $(document).ready(function() {

    $('.summernote').summernote();

  });

</script>
@endpush