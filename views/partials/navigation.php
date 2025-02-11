<?php if (isset($_SESSION['custom_session']['message'])): ?>
  <div class="message-widget <?= $_SESSION['custom_session']['message']['type'] ?>-widget"><?= $_SESSION['custom_session']['message']['content'] ?></div>
<?php endif ?>
<div class="message-widget" style="display: none;"></div>
<div class="outside-container">
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
          <a href="/" <?= urlIs('/') ? 'class="selected"' : '' ?>>
            <li>Home</li>
          </a>
          <a href="/categories" <?= urlIs('/categories') ? 'class="selected"' : '' ?>>
            <li>Categories</li>
          </a>
          <a href="/my-courses" <?= urlIs('/my-courses') ? 'class="selected"' : '' ?>>
            <li>My courses</li>
          </a>
          <a href="/wishlist" <?= urlIs('/wishlist') ? 'class="selected"' : '' ?>>
            <li>Wishlist</li>
          </a>
        </ul>
      </div>

      <div class="nav-auth">
        <ul class="auth-navigation">
          <?php if (isset($_SESSION['student'])): ?>
            <?php if (isset($_SESSION['student']['profilePath']) && $_SESSION['student']['profilePath'] !== ""): ?>
              <img src="<?= base_url("ewkethub_shared_assets/images/students/profile_images/{$_SESSION['student']['profilePath']}") ?>" class="profile-image" alt="Profile Image" />
            <?php else: ?>
              <img src="<?= base_url() ?>assets/images/user-avatar.png" class="profile-image" alt="Profile Image" />
            <?php endif ?>
            <a href=""><?= $_SESSION['student']['username'] ?></a>
            <form id="logout-form" method="POST" action="/logout">
              <a href="#" class="logout" onclick="document.getElementById('logout-form').submit();">Log Out</a>
            </form>
          <?php else: ?>
            <li class="login">
              <a href="/login">Login</a>
            </li>
            <li class="signup">
              <a href="/signup">Signup</a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php if (isset($categories)): ?>
    <div class="categories-div">
      <?php foreach ($categories as $category): ?>
        <a href="/category/<?= $category['slug'] ?>" class="category-nav-item <?= categoryIs($category['slug']) ? 'category-selected' : '' ?> "><?= $category['name'] ?></a>
      <?php endforeach ?>
    </div>
  <?php endif ?>
</div>