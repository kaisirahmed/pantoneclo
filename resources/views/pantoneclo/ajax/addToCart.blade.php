<script type="text/javascript"> 
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    function addToCart(slug) { 
        var size = $('#size').val();
        var quantity = $('#quantity').val();
        var slug = slug; 
        if (slug != '' && size != null) { 
            $.ajax({ 
                type:"post", 
                url: "{{ route('cart.add') }}",
                data:{ 
                    slug : slug,
                    size : size,
                    quantity : quantity,
                    _token: "{{ csrf_token() }}"
                }, 
                dataType: "json", 
                success:function(data){ 
                    $.notify("Cart Item Added Successfully!","success");
                    $('.cart_price').text(data.cartTotal)
                    $('.cart_count').text(data.cartTotalQuantity)
                } 
            }); 
        } else {
            $(".product_size").notify("Please choose product size.");
        }
    }

    function clearCart(){

    }
</script>