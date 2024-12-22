@extends('admin.layouts.master')
@section('title')
{{$settings->site_name}} || Slider
@endsection
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
              {{-- <h4>Simple Table</h4> --}}
              <div class="card-header-action">
                  <a href="{{route('slider.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
              </div>
            </div>
            <div class="card-body">
              {{ $dataTable->table() }}
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush