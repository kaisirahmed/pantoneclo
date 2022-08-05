<script type="text/javascript"> 
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    function addToCart(slug) { 
        var size = $('#size').val();
        var quantity = $('#quantity_input').val();
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
        Swal.fire({
            title: '<h4>Do you want to clear the cart!</h4>',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({ 
                    type:"post", 
                    url: "{{ route('cart.clear') }}",
                    data:{ 
                        _token: "{{ csrf_token() }}"
                    }, 
                    dataType: "json", 
                    success:function(data){ 
                        $('.cart_price').text(data.cartTotal);
                        $('.cart_count').text(data.cartTotalQuantity);
                        $('.cart_list').remove();
                        $('.order_total').remove();
                        $('.cart_buttons').remove();
                        $('.cart_items').append('<div class="order_total"><div class="order_total_content text-md-center"><div class="order_total_title"><i class="fa fa-shopping-cart"></i> Empty Cart</div></div></div>')
                        //$.notify("Cart has been cleared Successfully!","success");
                        $.notify(data.message, "success");
                        Swal.fire('Cart Cleared!', '', 'success')
                    } 
                }); 
                
            } else if (result.isDenied) {
                //Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }
    // Cart item delete
    function cartDelete(itemId){
        itemId = itemId;
        Swal.fire({
            title: '<h4>Do you want to delete the item!</h4>',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({ 
                    type:"post", 
                    url: "{{ route('cart.delete') }}",
                    data:{ 
                        itemId: itemId,
                        _token: "{{ csrf_token() }}"
                    }, 
                    dataType: "json", 
                    success:function(data){ 
                        $('#'+itemId).remove();
                        $('.cart_price').text(data.cartTotal);
                        $('.cart_count').text(data.cartTotalQuantity);
                        $('.order_total_amount').html('&#36;'+data.cartTotal);
                        //$.notify("Cart has been cleared Successfully!","success");
                        $.notify(data.message, "success");
                        //Swal.fire('Cart Cleared!', '', 'success')
                    } 
                }); 
                
            } else if (result.isDenied) {
                //Swal.fire('Changes are not saved', '', 'info')
            }
        });
    }

    // cart item quantity update
    function itemUpdate(itemId){
        var quantity = $('#quantity_input'+itemId).val();
        var items = $('#cartTable tbody tr#'+itemId);
        itemId = itemId;
       //alert(quantity)
        $.ajax({ 
            type:"post", 
            url: "{{ route('cart.item.update') }}",
            data:{ 
                quantity: quantity,
                itemId: itemId,
                _token: "{{ csrf_token() }}"
            }, 
            dataType: "json", 
            success:function(data){ 
                $('#productTotalPrice'+itemId).html('&#36;'+data.price)
                $('.cart_price').text(data.cartTotal);
                $('.cart_count').text(data.cartTotalQuantity);
                $('.order_total_amount').html('&#36;'+data.cartTotal);
                //$.notify("Cart has been cleared Successfully!","success");
                $.notify(data.message, "success");
                //Swal.fire('Cart Cleared!', '', 'success')
                items.css("background-color","aliceblue");
                setTimeout(function() {
                    items.css("background-color","#FFFFFF");
                }, 1000);
            } 
        });            
    }
    // cart quantity update
    function cartUpdate(){
        var items = $('#cartTable tbody tr.selected');
        var cartItems = items.map(function() {
            var quantity = $('#quantity_input'+this.id).val();
            let items = {
                itemId: this.id, 
                quantity: quantity
            }
            return items;
        }).get();
       
        $.ajax({ 
            type:"post", 
            url: "{{ route('cart.update') }}",
            data:{ 
                items: cartItems,
                _token: "{{ csrf_token() }}"
            }, 
            dataType: "json", 
            success:function(data){  
             
                $.each(JSON.parse(data.items), function(index, item){
                    $('#productTotalPrice'+item.itemId).html('&#36;'+item.price)
                });
               
                $('.cart_price').text(data.cartTotal);
                $('.cart_count').text(data.cartTotalQuantity);
                $('.order_total_amount').html('&#36;'+data.cartTotal);
                //$.notify("Cart has been cleared Successfully!","success");
                $.notify(data.message, "success");
                //Swal.fire('Cart Cleared!', '', 'success')

                items.css("background-color","aliceblue");
                setTimeout(function() {
                    items.css("background-color","#FFFFFF");
                }, 1000);
            } 
        });            
    }
   
</script>