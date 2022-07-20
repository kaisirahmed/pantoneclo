<script>


$(document).ready(function() {

       $( "#parentId" ).change(function () {
              if($( "select option:selected" ).val() !== '') {
                     $('.icon').parent().remove();
              } else {
                     $('.menu-icon').append('<div class="form-group"><label for="icon">Menu Icon <i title="Icon for category menu." class="ti-help-alt"></i></label><div class="input-group mb-4 icon"><div class="input-group-prepend"><span class="input-group-text">Upload</span></div><div class="custom-file"><input type="file" required class="custom-file-input" name="icon" id="icon"><label class="custom-file-label" id="iconChoose" for="inputGroupFile01">Choose file</label></div> </div></div>');
              }
       })


       $("#reset, #reset1").on('click', function() {
              $('#bannerChoose').text('Choose file');
              $('#imageChoose').text('Choose file');
              $('#iconChoose').text('Choose file');
       })

       $('#banner').change(function () {
              var filename = $(this)[0].value.split("\\").pop();
              if ($(this).val() == "") {
                      $('#bannerChoose').text('Choose file');
               }else{
                     $('#bannerChoose').text(filename);
              }
       });

       $('#categoryImage').change(function () {
              var filename = $(this)[0].value.split("\\").pop();
              if ($(this).val() == "") {
                     $('#imageChoose').text('Choose file');
              }else{
                     $('#imageChoose').text(filename);
              }
       });


       $('#icon').change(function () {
              var filename = $(this)[0].value.split("\\").pop();
              if ($(this).val() == "") {
                     $('#iconChoose').text('Choose file');
              }else{
                     $('#iconChoose').text(filename);
              }
       });
})

      
</script>
