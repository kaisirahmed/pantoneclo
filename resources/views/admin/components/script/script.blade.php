<!-- jQuery -->
<script src="{{ asset('admin/assets/vendor/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('admin/assets/vendor/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/bootstrap.min.js') }}"></script>

<!-- Perfect Scrollbar -->
<script src="{{ asset('admin/assets/vendor/perfect-scrollbar.min.js') }}"></script>

<!-- DOM Factory -->
<script src="{{ asset('admin/assets/vendor/dom-factory.js') }}"></script>

<!-- MDK -->
<script src="{{ asset('admin/assets/vendor/material-design-kit.js') }}"></script>

<!-- Range Slider -->
<script src="{{ asset('admin/assets/vendor/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/ion-rangeslider.js') }}"></script>

<!--Sweet Alert -->
<script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>

<!-- App -->
<script src="{{ asset('admin/assets/js/toggle-check-all.js') }}"></script>
<script src="{{ asset('admin/assets/js/check-selected-row.js') }}"></script>
<script src="{{ asset('admin/assets/js/dropdown.js') }}"></script>
<script src="{{ asset('admin/assets/js/sidebar-mini.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.js') }}"></script>

<!-- App Settings (safe to remove) -->
<script src="{{ asset('admin/assets/js/app-settings.js') }}"></script>


<!-- Flatpickr -->
<script src="{{ asset('admin/assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/flatpickr.js') }}"></script>

<!-- DateRangePicker -->
<script src="{{ asset('admin/assets/vendor/moment.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/assets/js/daterangepicker.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('admin/assets/vendor/toastr.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/toastr.js') }}"></script>
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