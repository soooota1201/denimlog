<div class="sp-menu">
  <div class="row justify-content-center align-items-center">
    <div class="col-2 sp-menu__item text-center">
      <a class="text-center" href="{{route('users.home.index', Auth::id())}}"><i class="fas fa-home"></i></a>
    </div><!-- /.col-2 -->
    <div class="col-2 sp-menu__item text-center">
      <a class="text-center" href="{{route('users.search', Auth::id())}}"><i class="fas fa-search"></i></a>
    </div><!-- /.col-2 -->
    <div class="col-2 sp-menu__item text-center">
      <a class="text-center" href="{{route('users.denims.index', Auth::id())}}"><i class="fas fa-folder-open"></i></a>
    </div><!-- /.col-2 -->
    <div class="col-2 sp-menu__item text-center">
      <a class="text-center" href="{{route('users.show', Auth::id())}}"><i class="fas fa-user"></i></a>
    </div><!-- /.col-2 -->
  </div><!-- /.row -->
</div><!-- /.sp-menu -->