<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"{!! theme()->printHtmlAttributes('html') !!} {{ theme()->printHtmlClasses('html') }}>
{{-- begin::Head --}}
<head>
    <meta charset="utf-8"/>
    <title>{{ ucfirst(theme()->getOption('meta', 'title')) }}</title>
    <meta name="description" content="{{ ucfirst(theme()->getOption('meta', 'description')) }}"/>
    <meta name="keywords" content="{{ theme()->getOption('meta', 'keywords') }}"/>
    <link rel="canonical" href="{{ ucfirst(theme()->getOption('meta', 'canonical')) }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="{{ getAsset(theme()->getOption('assets', 'favicon')) }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- begin::Fonts --}}
    {{ theme()->includeFonts() }}
    {{-- end::Fonts --}}

    @if (theme()->hasVendorFiles('css'))
        {{-- begin::Page Vendor Stylesheets(used by this page) --}}
        @foreach (array_unique(theme()->getVendorFiles('css')) as $file)
            @if(util()->isExternalURL($file))
                <link rel="stylesheet" href="{{ $file }}" sha256="sha256-8x79V4hKje9JJjwY4mh5Z3OSc8e4CLNcMJm6Mg/y9TA=" />
            @else
                {!! preloadCss(getAsset($file)) !!}
            @endif
        @endforeach
        {{-- end::Page Vendor Stylesheets --}}
    @endif

    @if (theme()->hasOption('page', 'assets/custom/css'))
        {{-- begin::Page Custom Stylesheets(used by this page) --}}
        @foreach (array_unique(theme()->getOption('page', 'assets/custom/css')) as $file)
            {!! preloadCss(getAsset($file)) !!}
        @endforeach
        {{-- end::Page Custom Stylesheets --}}
    @endif

    @if (theme()->hasOption('assets', 'css'))
        {{-- begin::Global Stylesheets Bundle(used by all pages) --}}
        @foreach (array_unique(theme()->getOption('assets', 'css')) as $file)
            @if (strpos($file, 'plugins') !== false)
                {!! preloadCss(getAsset($file)) !!}
            @else
                <link href="{{ getAsset($file) }}" rel="stylesheet" type="text/css" sha256="sha256-8x79V4hKje9JJjwY4mh5Z3OSc8e4CLNcMJm6Mg/y9TA=" />
            @endif
        @endforeach
        {{-- end::Global Stylesheets Bundle --}}
    @endif

    @if (theme()->getViewMode() === 'preview')
        {{ theme()->getView('partials/trackers/_ga-general') }}
        {{ theme()->getView('partials/trackers/_ga-tag-manager-for-head') }}
    @endif

    @yield('styles')
</head>
{{-- end::Head --}}

{{-- begin::Body --}}
<body {!! theme()->printHtmlAttributes('body') !!} {!! theme()->printHtmlClasses('body') !!} {!! theme()->printCssVariables('body') !!} data-kt-name="metronic" data-kt-app-sidebar-minimize="off" >

@yield('content')

{{-- begin::Javascript --}}
@if (theme()->hasOption('assets', 'js'))
    {{-- begin::Global Javascript Bundle(used by all pages) --}}
    @foreach (array_unique(theme()->getOption('assets', 'js')) as $file)
        <script src="{{ getAsset($file) }}" sha256="sha256-8x79V4hKje9JJjwY4mh5Z3OSc8e4CLNcMJm6Mg/y9TA=" ></script>
    @endforeach
    {{-- end::Global Javascript Bundle --}}
@endif

@if (theme()->hasVendorFiles('js'))
    {{-- begin::Page Vendors Javascript(used by this page) --}}
    @foreach (array_unique(theme()->getVendorFiles('js')) as $file)
        @if(util()->isExternalURL($file))
            <script src="{{ $file }}" sha256="sha256-8x79V4hKje9JJjwY4mh5Z3OSc8e4CLNcMJm6Mg/y9TA=" ></script>
        @else
            <script src="{{ getAsset($file) }}" sha256="sha256-8x79V4hKje9JJjwY4mh5Z3OSc8e4CLNcMJm6Mg/y9TA=" ></script>
        @endif
    @endforeach
    {{-- end::Page Vendors Javascript --}}
@endif

@if (theme()->hasOption('page', 'assets/custom/js'))
    {{-- begin::Page Custom Javascript(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/custom/js')) as $file)
        <script src="{{ getAsset($file) }}" sha256="sha256-8x79V4hKje9JJjwY4mh5Z3OSc8e4CLNcMJm6Mg/y9TA=" ></script>
    @endforeach
    {{-- end::Page Custom Javascript --}}
@endif
{{-- end::Javascript --}}

@if (theme()->getViewMode() === 'preview')
    {{ theme()->getView('partials/trackers/_ga-tag-manager-for-body') }}
@endif

@yield('scripts')
</body>
{{-- end::Body --}}
</html>
