<script type="text/javascript"> 
    $.ajaxSetup({ 
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    var _commonModal = $('#commonModal');

    $('.editUser').on('click',function(){
        var userId = $(this).attr('user-id');
        _commonModal.modal('show');
        _commonModal.find(".modal-title").html('Edit User');
        _commonModal.find('.modal-success').html('');
        _commonModal.find('.modal-danger').html('');
        _commonModal.find(".modal-body").html('Loading');
        _commonModal.find(".modal-body").load("{{ route('account.user.edit') }}",{user_id:userId,_token: "{{ csrf_token() }}"});
    })


    function updateUser(){
        var userUpdateForm = $("#userUpdateForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('account.user.update') }}",
            data: userUpdateForm,
            dataType: "json",
            success: function(data) {
                $('.account-name').html(data.user.name);
                $('.account-email').html(data.user.email);
                $('.account-phone').html(data.user.phone);
                $('.modal-success').html(data.message);
                setTimeout(function() {
                    _commonModal.modal('hide');
                }, 500);
                
            },
            error: function(data) {
                $('.modal-danger').html(data.message);
            }
        });
    }
    
</script>