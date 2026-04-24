<!-- app/view/partials/sidebar.php -->

<div class="sidebar">
    <div class="menu-top">
        <a href="<?= home_url(); ?>"><img class="logo" src="<?= get_template_directory_uri(); ?>/assets/img/logo-nobg.png" alt="DeepState Logo"></a>
        <a class="bars"><i class="fa-solid fa-bars"></i></a>
    </div>
    <div class="menu">
        <ul>
            <li class="nav-item"><i class="glyph-icon fa-solid fa-magnifying-glass"></i> Search</li>
            <li class="nav-item"><i class="glyph-icon fa-solid fa-circle-plus"></i> Chat</li>
            <li class="nav-item"><i class="glyph-icon fa-solid fa-circle-plus"></i> Project</li>
        </ul>
        <button id="projects" class="nav-item dropdown-button">Projects<i class="glyph-icon fa-solid fa-arrow-right"></i></button>
        <ul>
            <li class="nav-item"><i class="glyph-icon fa-solid fa-diagram-project"></i>Project Name</li>
        </ul>
        <button id="chats" class="nav-item dropdown-button">Chats<i class="glyph-icon fa-solid fa-arrow-right"></i></button>
        <ul>
            <li class="nav-item"><i class="glyph-icon fa-solid fa-diagram-project"></i>Project Name</li>
        </ul>
    </div>
    <div class="menu-bottom">
        <ul>
            <li class="nav-item"><i class="glyph-icon fa-solid fa-gear"></i> Settings</li>
        </ul>
    </div>
</div>