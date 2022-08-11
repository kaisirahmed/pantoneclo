<script>
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    $('#billing_country').change(function(){
      var countryId = $(this).find('option:selected').val();
      $('#billing_city').html('<option value="0">Choose....</option>');
      $.ajax({ 
            type:"post", 
            url: "{{ route('checkout.state') }}",
            data:{ 
                country_id: countryId,
                _token: "{{ csrf_token() }}"
            }, 
            dataType: "json", 
            success:function(data){  
            // alert(JSON.parse(data.states))
                $('#billing_state').html('<option value="0">Choose....</option>');
                $('#billing_state').css("border","1px solid #185ec7 !important");
                $.each(JSON.parse(data.states), function(index, state){
                    $('#billing_state').append('<option value="'+state.id+'">'+state.name+'</option>');
                });
                setTimeout(function() {
                    $('#billing_state').css("border","1px solid #dfdfdf");
                }, 2000);
            } 
        });            
    })

    $('#billing_state').change(function(){
      var stateId = $(this).find('option:selected').val();
      $.ajax({ 
            type:"post", 
            url: "{{ route('checkout.city') }}",
            data:{ 
                state_id: stateId,
                _token: "{{ csrf_token() }}"
            }, 
            dataType: "json", 
            success:function(data){  
            // alert(JSON.parse(data.states))
                $('#billing_city').html('<option value="0">Choose....</option>');
                $('#billing_city').css("border","1px solid #185ec7 !important");
                $.each(JSON.parse(data.cities), function(index, city){
                    $('#billing_city').append('<option value="'+city.id+'">'+city.name+'</option>');
                });
                setTimeout(function() {
                    $('#billing_city').css("border","1px solid #dfdfdf");
                }, 2000);
            } 
        });       
    });


    $('#shipping_country').change(function(){
      var countryId = $(this).find('option:selected').val();
      $('#shipping_city').html('<option value="0">Choose....</option>');
      $.ajax({ 
            type:"post", 
            url: "{{ route('checkout.state') }}",
            data:{ 
                country_id: countryId,
                _token: "{{ csrf_token() }}"
            }, 
            dataType: "json", 
            success:function(data){  
            // alert(JSON.parse(data.states))
                $('#shipping_state').html('<option value="0">Choose....</option>');
                $('#shipping_state').css("border","1px solid #185ec7 !important");
                $.each(JSON.parse(data.states), function(index, state){
                    $('#shipping_state').append('<option value="'+state.id+'">'+state.name+'</option>');
                });
                setTimeout(function() {
                    $('#shipping_state').css("border","1px solid #dfdfdf");
                }, 2000);
            } 
        });            
    })

    $('#shipping_state').change(function(){
      var stateId = $(this).find('option:selected').val();
      $.ajax({ 
            type:"post", 
            url: "{{ route('checkout.city') }}",
            data:{ 
                state_id: stateId,
                _token: "{{ csrf_token() }}"
            }, 
            dataType: "json", 
            success:function(data){  
            // alert(JSON.parse(data.states))
                $('#shipping_city').html('<option value="0">Choose....</option>');
                $('#shipping_city').css("border","1px solid #185ec7 !important");
                $.each(JSON.parse(data.cities), function(index, city){
                    $('#shipping_city').append('<option value="'+city.id+'">'+city.name+'</option>');
                });
                setTimeout(function() {
                    $('#shipping_city').css("border","1px solid #dfdfdf");
                }, 2000);
            } 
        });       
    })
</script>