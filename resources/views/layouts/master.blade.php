<!doctype html>
<html class="no-js " lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{env('SITE_RTL') == 'on'?'rtl':''}}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ env('APP_NAME', 'Laravel') }}</title>
      <link rel="icon" href="favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="{{ asset('/css/luno.style.min.css') }}">
      @stack('stylesheets')
   </head>
   <body id="layout-1" data-luno="theme-yellow">
      <!-- start: body area -->
      <div class="wrapper">
         <!-- start: page body -->
         <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
               <div class="row">
                  @yield('auth-content')
               </div>
               <!-- End Row -->
            </div>
         </div>
      </div>
      <script src="{{ asset('/bundles/libscripts.bundle.js') }}"></script>
      <script src="{{ asset('/bundles/toastr.min.js') }}"></script>
      @stack('scripts')
      @if(Session::has('success'))
        <script>
            show_toastr("{{__('Success') }}", "{!! session('success') !!}", 'success');
        </script>
      @endif
      @if(Session::has('error'))
        <script>
            show_toastr("{{__('Error') }}", "{!! session('error') !!}", 'error');
        </script>
      @endif
   </body>
</html>
