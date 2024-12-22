<script>
        

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
            method: 'POST',
            data: formData,
            url: "{{ route('add-to-cart') }}",
            success: function(data) {
                if(data.status === 'success'){
                    getCartCount()
                    fetchSidebarCartProducts()
                    $('.mini_cart_actions').removeClass('d-none');
                    toastr.success(data.message);
                    console.log(data.message);
                }else if (data.status === 'error'){
                    toastr.error(data.message);
                }
            },
            error: function(data) {

            }
        })
    })

})
        
    </script>