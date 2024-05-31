<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-color: #014a94 !important;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="color: #fff">
            @guest
            Perhitungan Gaji Lembur
            @else
            <span style="font-size: 14px">{{ Auth::user()->role->display_name ?? '' }}</span>
            @endguest
        </a>
    </div>
</nav>