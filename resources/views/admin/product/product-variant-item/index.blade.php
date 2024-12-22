@extends('admin.layouts.master')
@section('title')
{{$settings->site_name}} || Variant Items
@endsection
@section('section')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header" style="padding-left: 20px;">
            <h1>Product Variant Items</h1>
          </div>
          <div class="mb-3"style="padding-left: 20px;" >
            <a href="{{route('products-variant.index', ['product' => $product->id])}}" class="btn btn-primary">Back</a>
          </div>
          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Variant: {{$variant->name}} </h4>
                    <div class="card-header-action">
                        <a href="{{route('products-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id])}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
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
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('products-variant-item.changes-status')}}",
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
