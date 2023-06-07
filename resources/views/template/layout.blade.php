@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        <input type="hidden" value="{{ $PREFIX }}" id="prefix">
        {{-- Preloader Animation --}}
        @if($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

        @php( $def_container_class = 'container' )

        {{-- Default Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">


            <div class="content-header">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }} col-12">
                    @yield('content_header')
                </div>
            </div>


            {{-- Main Content --}}
            <div class="content">
                <div class="{{ config('adminlte.classes_content') ?: $def_container_class }} col-12">
                    @yield('content')
                </div>
            </div>

        </div>

        
        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    <!-- helpers -->
    <script src="{{ asset('js/helpers.js?') . date('dmYHis') }}"></script>

    @stack('js')
    @yield('js')

@stop
