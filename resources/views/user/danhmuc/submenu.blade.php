@extends('layout')
@section('contentuser')
     <style>
          .margin{
               margin-bottom: 20px;
          }
          .menuchude {
          list-style-type: none;
          padding: 0;
          height: 100%;
          display: flex;
          align-items: center;
          background-color: #f8f8f8;
          border-bottom: 1px solid #ddd;
          padding-left: 17px;
          font-family: 'Roboto-Bold';
          
          }

          .menuchude li {
          margin-right: 15px;
          }

          .menuchude a {

          color: #333;
          transition: color 0.3s ease;
          }

          .menuchude a.active {
          color: #2667e4;
          }
     </style>
     <!-- Menu desktop -->
     <nav class="menu-desktop margin">
          <ul class="menuchude">
               <h3 class="f1-m-2 cl12 tab01-title">
                    <a href="{{ route('admin.hienthidanhmuc', ['id' => $ttdanhmuc->IDDM]) }}">{{ $ttdanhmuc->TenDanhMuc }}</a>
               </h3>
               <!-- Nav tabs -->
               <ul class="nav">
                    @foreach($menuchude as $key => $chude)
                         <li class="nav-item">
                              <a class="nav-link {{ $chude->IDCD == $selectedChudeID ? 'active' : '' }}" href="{{ route('admin.hienthichude', ['id' => $chude->IDCD, 'iddm' => $chude->DanhMucID]) }}">
                              {{ $chude->TenChuDe }}
                              </a>
                         </li>
                    @endforeach
               </ul>
          </ul>
     </nav>

     @yield('danhmuc')
     @yield('chude')
@endsection