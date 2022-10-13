// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    window.addEventListener('load', function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation')
  
      // Loop over them and prevent submission
      Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    }, false)

    $('#same-address').change(function(){
      if($(this).is(":checked")){
        $('.shipping-address').hide(500);
        $(this).val(1);
      } else {
        $('.shipping-address').show(500);
        $(this).val(0);
      }
    })
    $('#default-address').change(function(){
      if($(this).is(":checked")){
        $('#billingId').prop("checked", true);
        $('#shippingId').prop("checked", true);
        $('#billing-address').hide(500);
        $(this).val(1);
      } else {
        $('#billingId').prop("checked", false);
        $('#shippingId').prop("checked", false);
        $('#billing-address').show(500);
        $(this).val(0);
      }
    })

  }())