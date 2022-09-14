<script type="text/javascript"> 
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    });
    
    $('#variants').on('change', function(){

        var variants = [];
        $.each($(".variants option:selected"), function(){            
            if($(this).val() != '') variants.push($(this).val());
        });
       
        var productId = $('#productId').val();
        if (variants.length > 1) { 
            $.ajax({ 
                type:"post", 
                url: "{{ route('variation.product') }}",
                data:{ 
                    product_id : productId,
                    variants : variants,
                    quantity : quantity,
                    _token: "{{ csrf_token() }}"
                }, 
                dataType: "json", 
                success:function(data){ console.log(data);
                     
                } 
            }); 
        } else {
            $(".product_size").notify("Please choose Options.");
        }
    });
    
</script>