<div class="col-md-3 order-0">
  <div class="sticky-top pt-4">
    <ul class="list-group">
      <li class="list-group-item"><a href="{{route('users.home.index', Auth::id())}}"><i class="fas fa-home mr-2"></i>Home</a></li>
      <li class="list-group-item"><a href="{{route('users.search', Auth::id())}}"><i class="fas fa-search mr-2"></i>Explore</a></li>
      <li class="list-group-item"><a href="{{route('users.denims.index', Auth::id())}}"><i class="far fa-folder-open mr-2"></i>Collection</a></li>
      <li class="list-group-item"><a href="{{route('users.show', Auth::id())}}"><i class="fas fa-user mr-2"></i>Profile</a></li>
      <li class="list-group-item"><a href="{{route('users.edit', Auth::id())}}"><i class="fas fa-cog mr-2"></i>Settings</a></li>
    </ul><!-- /.list-group -->
  </div><!-- /.sticky-top -->
  
</div><!-- /.col-md-4 -->
  