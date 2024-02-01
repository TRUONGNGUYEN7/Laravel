<style>

</style>
<div class="wrap-main-nav">
     <div style="background-color: #c4dbff; color: white" class="main-nav">
          <!-- Menu desktop -->
          <nav class="menu-desktop">
               <ul class="main-menu">

                    <a style="margin-left: -10px; margin-right: 10px; font-size: 18px"
                         href="{{ route('user.home') }}"><i class="fa fa-home"></i> </a>

                    @foreach($menuCategory as $category)
                    <li>
                         <a
                              href="{{ route('user.hienthi', ['id' => $category->IDDM]) }}">{{ $category->TenDanhMuc }}</a>
                         @if($category->chudes->isNotEmpty())
                         <ul class="sub-menu">
                              @foreach($category->chudes as $chude)
                              <li><a
                                        href="{{ route('user.hienthi', ['id' => $chude->IDCD, 'iddm' => $category->IDDM]) }}">{{ $chude->TenChuDe }}</a>
                              </li>
                              @endforeach
                         </ul>
                         @endif
                    </li>
                    @endforeach
               </ul>
          </nav>
     </div>
</div>