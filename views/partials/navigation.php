<nav class="navbar-container">
  <div class="menu-wrapper">
    <div class="menu">
      <i class="bi menu-icon bi-list"></i>
    </div>
    <a href="/">
      <div class="logo">
        <div class="logo-img"></div>
      </div>
    </a>
  </div>
  <div class="search-bar">
    <form action="#" method="post" style="width: 100%">
      <div class="search-bar">
        <input
          class="search-input"
          type="text"
          name=""
          value="<?php if (isset($searchTerm)) echo $searchTerm;
                  else echo ""; ?>"
          id="searchInput"
          placeholder="Search for a course or category" />
        <div id="liveSearchResults" class="search-results"></div>
      </div>
    </form>
  </div>
  <div class="main-navigation">
    <div class="nav-items">
      <ul class="site-navigation">
        <li <?= urlIs('/') ? 'class="selected"' : '' ?>>Home</li>
        <li <?= urlIs('/categories') ? 'class="selected"' : '' ?>>Categories</li>
        <li <?= urlIs('/my-courses') ? 'class="selected"' : '' ?>>My courses</li>
        <li <?= urlIs('/wishlist') ? 'class="selected"' : '' ?>>Wishlist</li>
      </ul>
    </div>

    <div class="nav-auth">
      <ul class="auth-navigation">
        <li class="login">Login</li>
        <li class="signup">Signup</li>
      </ul>
    </div>
  </div>
</nav>