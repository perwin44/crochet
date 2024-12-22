@extends('admin.layouts.master')
@section('title')
{{$settings->site_name}} || Card 2
@endsection
@section('section')
   <!-- Main Content -->
   <section class="section">
    <div class="section-header" style="padding-left: 10px;">
      <h1>Card 2</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4>Simple Table</h4> --}}
              <div class="card-header-action">
                  <a href="{{route('banner.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
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

<script>

$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{route('banner.change-status')}}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })

        })
    })
</script>
@endpush