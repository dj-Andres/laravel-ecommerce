<!DOCTYPE html>
<html lang="es">
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @yield('styles')

<body>
    <div>
        @yield('header')
    </div>
    <main>
        @yield('content')
    </main>
    <section>
        @yield('firmas')
    </section>
    @include('layouts.reports.footer')
</body>

</html>
