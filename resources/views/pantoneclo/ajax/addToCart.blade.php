<script type="text/javascript"> 
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    function addToCart(productId) { 
        
        var variants = [];
        $.each($(".variants option:selected"), function(){            
            if($(this).val() != '') variants.push($(this).val());
        });
       
        var quantity = $('#quantity_input').val();
        if (variants.length > 1) { 
            $.ajax({ 
                type:"post", 
                url: "{{ route('cart.add') }}",
                data:{ 
                    product_id : productId,
                    variants : variants,
                    quantity : quantity,
                    _token: "{{ csrf_token() }}"
                }, 
                dataType: "json", 
                success:function(data){ console.log(data);
                    $.notify("Cart Item Added Successfully!","success");
                    $('.cart_price').text(data.cartTotal)
                    $('.cart_count').html('<span>'+data.cartTotalQuantity+'</span>')
                } 
            }); 
        } else {
            $(".product_size").notify("Please choose Options.");
        }
    }

    function clearCart(){
        swal({
            title: 'Do you want to clear the cart!',
            html: true,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            },
            function(isConfirm){
            /* Read more about isConfirmed, isDenied below */
            if (isConfirm) {
                $.ajax({ 
                    type:"post", 
                    url: "{{ route('cart.clear') }}",
                    data:{ 
                        _token: "{{ csrf_token() }}"
                    }, 
                    dataType: "json", 
                    success:function(data){ 
                        $('.cart_price').text(data.cartTotal);
                        $('.cart_count').html('<span>'+data.cartTotalQuantity+'</span>');
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
        swal({
            title: 'Do you want to delete the item!',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            },
            function(isConfirm){
            /* Read more about isConfirmed, isDenied below */
            if (isConfirm) {
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
                        $('.cart_count').html('<span>'+data.cartTotalQuantity+'</span>');
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
                $('.cart_count').html('<span>'+data.cartTotalQuantity+'</span>');
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
                $('.cart_count').html('<span>'+data.cartTotalQuantity+'</span>');
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