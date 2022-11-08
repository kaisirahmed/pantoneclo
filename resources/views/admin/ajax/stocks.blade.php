<script type="text/javascript"> 
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    var _commonModal = $('#commonModal');

    function editStock(route){ 
        _commonModal.modal('show');
        _commonModal.find(".modal-title").html('Order Edit');
        _commonModal.find('.modal-success').html('');
        _commonModal.find('.modal-danger').html('');
        _commonModal.find(".modal-body").html('Loading');
        $.get(route, function(data){
            _commonModal.find(".modal-body").html(data);
        })
        //.load("{{ route('account.user.edit') }}",{order_id:orderId,_token: "{{ csrf_token() }}"});
    }


    function updateStock(route){ 
        var stockId = route.substring(route.lastIndexOf('/') + 1);
 
        var stockFormData = $("#stockForm").serialize();
        $.ajax({
            type: "POST",
            url: route,
            data: stockFormData,
            dataType: "json",
            success: function(data) {
                $('#quantityStock'+stockId).html($('#quantity').val());
                $('.modal-success').html(data.message);
                setTimeout(function() {
                    _commonModal.modal('hide');
                }, 500);
                
            },
            error: function(data) {
                $('.modal-danger').html(data.warning);
            }
        });
    }
    
</script>