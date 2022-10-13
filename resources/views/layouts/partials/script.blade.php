<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script> --}}
<script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('assets/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('assets/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('assets/plugins/scrollUp/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/notify/notify.js') }}"></script>
<script src="{{ asset('assets/js/notify/notify.min.js') }}"></script>

<!--Sweet Alert -->
<script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>
<script>
    function confirmDelete(Id) {
        swal({
        title: "Are you sure to delete?",
        text: "",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonColor: "#1ed49c",
        confirmButtonText: "Yes",
        closeOnConfirm: false
        },
        function(isConfirm){
            if (isConfirm) {
                document.getElementById('delete'+Id).submit();

                //$('form #delete'+Id).submit();

                swal({
                    title: "Processing..",
                    showConfirmButton: false,
                    showCancelButton: false,
                });
            }
        });
    }
</script>