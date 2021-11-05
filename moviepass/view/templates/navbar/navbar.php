<?php

use view\View;
use model\models\User;
?>

<div class="container-fluid">
    <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>"><?php echo PAGE_TITLE; ?> </a>

    <div class="navbar-nav me-auto">
        <?php
        switch ((isset($user) && $user instanceof User) ? $user->role : GUEST_ROLE_NAME) {
            case ADMIN_ROLE_NAME:
                echo View::render("navbar\\adminnavbar");
                break;
            case CLIENT_ROLE_NAME:
                echo View::render("navbar\\clientnavbar");
                break;
            default:
                echo View::render("navbar\\guestnavbar");
                break;
        }
        ?>
    </div>

    <div class="navbar-nav ms-auto">
        <?php echo View::render("navbar\\sign\\navsign", ["user" => (isset($user)) ? $user : null]); ?>
    </div>
</div>