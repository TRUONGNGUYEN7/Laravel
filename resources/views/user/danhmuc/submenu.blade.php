@extends('layout')
@section('contentuser')

    <!-- Menu desktop -->
    <nav class="menu-desktop margin">
        <ul class="menuchude">
            <h3 class="f1-m-2 cl12 tab01-title">
                <a class="{{ $ttdanhmuc->id == $selectedChudeID ? 'active' : '' }}"
                    href="{{ route("$moduleName/view", ['id' => $ttdanhmuc->id]) }}">{{ $ttdanhmuc->name }}</a>
            </h3>
            <!-- Nav tabs -->
            <ul class="nav">
                @foreach ($menuchude as $key => $chude)
                    <li class="nav-item">
                        <a class="nav-link {{ $chude->id == $selectedChudeID ? 'active' : '' }}"
                            href="{{ route("$moduleName/view", ['id' => $chude->id, 'iddm' => $chude->danhmucID]) }}">
                            {{ $chude->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </ul>
    </nav>

    @yield('danhmuc')
    @yield('chude')
@endsection
