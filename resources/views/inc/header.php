<a id="main-logo" href="" title="Skill Project | Home"><img src="img/logo-header.png" /></a>

<div id="header-right">
    <nav id="top-user-nav">
        <ul>
            <li><a class="white-link register-link" href="<?= \Controller\Router::url("register"); ?>" title="Register"><?= _("Sign up"); ?></a></li>
             | <li><a class="login-link" href="<?= \Controller\Router::url("login"); ?>" title="Login"><?= _("Sign in"); ?></a></li>
            <?php include("../View/inc/language_menu.php"); ?>
        </ul>
    </nav>

    <nav id="top-main-nav">
        <ul>
            <li><a class="<?= ($pageName == "graph") ? "active" : "" ; ?>" href="<?= \Controller\Router::url("graph"); ?>" title="<?= _("THE SKILLS"); ?>"><?= _("THE SKILLS"); ?></a></li>
            <li><a class="<?= ($pageName == "project") ? "active" : "" ; ?>" href="<?= \Controller\Router::url("project"); ?>" title="<?= _("THE PROJECT"); ?>"><?= _("THE PROJECT"); ?></a></li>
            <?php if (Utils\SecurityHelper::userIsLogged() && in_array(Utils\SecurityHelper::getRole(), array("admin", "superadmin")) ) { ?>
                <li><a class="<?= ($lastPageName == "editor_dashboard") ? "active" : "" ; ?>" href="<?= \Controller\Router::url("editorDashboard"); ?>" title="<?= _("Editor Dashboard"); ?>">
                    <?php
                        if ($GLOBALS["lang"] == "en") echo _("Editor Dashboard");
                        elseif ($GLOBALS["lang"] == "fr") echo _("Moderation");
                    ?>
                </a></li>
            <?php } ?>

            <?php if (!Utils\SecurityHelper::userIsLogged() or !in_array(Utils\SecurityHelper::getRole(), array("admin", "superadmin")) ) { ?>
                <li><a class="<?= ($pageName == "apply") ? "active" : "" ; ?>" href="<?= \Controller\Router::url("apply"); ?>" title="<?= _("Become an Editor!"); ?>"><?= _("APPLY"); ?></a></li>
            <?php } ?>
            <li class="last"><a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>"><?= _("COMMUNITY"); ?></a></li>
        </ul>
    </nav>
</div>