<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('cms/vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('cms/vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('cms/js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('cms/js/core/app.js')) }}"></script>

<script src="{{ asset(mix('cms/vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/jszip.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
<script src="{{ asset(mix('cms/vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('cms/js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('cms/js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

@stack('modals')
@livewireScripts
<script defer src="{{ asset(mix('cms/vendors/js/alpinejs/alpine.js')) }}"></script>
