<div class="fixed">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="http://tmilner.co.uk/index">Thomas Milner</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
            <!-- Left Nav Section -->
            <ul class="left">
                <li  <?php if($active=='home') { ?> class="active" <?php } ?> >
                    <a href="http://tmilner.co.uk/index">Home</a>
                </li>
                <li <?php if($active=='about') { ?> class="active" <?php } ?>>
                    <a href="http://tmilner.co.uk/about">About Me</a>
                </li>
                <li  <?php if($active=='archive') { ?> class="active" <?php } ?> >
                    <a href="http://tmilner.co.uk/archive">Archive</a>
                </li>
            </ul>
            <!-- Right Nav Section -->
            <ul class="right">
                <?php if($is_loggedin){ ?>
                    <li <?php if($active=='admin') { ?> class="active" <?php } ?>>
                        <a href="http://tmilner.co.uk/admin">Admin</a>
                    </li>
                    <li>
                        <a href="http://tmilner.co.uk/admin/logout">Logout</a>
                    </li>
                <?php }else{ ?>
                    <li>
                        <a href="#" data-reveal-id="loginModal">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </nav>
</div>
