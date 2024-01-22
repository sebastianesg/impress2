<!-- BEGIN: Vendor CSS-->
@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/vendors-rtl.min.css')) }}" />
@else
  <link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/vendors.min.css')) }}" />
@endif

<link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('cms/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('cms/css/base/plugins/forms/form-validation.css')) }}">

@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset(mix('cms/css/core.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('cms/css/base/themes/dark-layout.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('cms/css/base/themes/bordered-layout.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('cms/css/base/themes/semi-dark-layout.css')) }}" />

@php $configData = Helper::applClasses(); @endphp

<!-- BEGIN: Page CSS-->
@if ($configData['mainLayoutType'] === 'horizontal')
  <link rel="stylesheet" href="{{ asset(mix('cms/css/base/core/menu/menu-types/horizontal-menu.css')) }}" />
@else
  <link rel="stylesheet" href="{{ asset(mix('cms/css/base/core/menu/menu-types/vertical-menu.css')) }}" />
@endif

{{-- Page Styles --}}
@yield('page-style')

<!-- laravel style -->
<link rel="stylesheet" href="{{ asset(mix('cms/css/overrides.css')) }}" />

<!-- BEGIN: Custom CSS-->

@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset(mix('cms/css-rtl/custom-rtl.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('cms/css-rtl/style-rtl.css')) }}" />

@else
  {{-- user custom styles --}}
  <link rel="stylesheet" href="{{ asset(mix('cms/css/style.css')) }}" />
@endif

@livewireStyles
