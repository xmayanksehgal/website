<!DOCTYPE html>
<?php $page = Route::getFacadeRoot()->current()->uri();
if ($page == '/')
    $page = 'home';
?>
<html class="page <?= $page?>">
<head>
@include('inc/page_head')
</head>
<body class="page">
<div id="wrapper">
    <header id="header">
        <div id="header-container">
            @include("inc.header")
        </div>
    </header>
    <div id="main-content">
        @yield('content')
    </div>
</div>
<div id="page-footer">
    <div id="footer-container" class="container">
        <a id="footer-logo" href="<?= "/" ?>" title="Skill Project | Home"><img src="img/logo-small.png" /></a>
        <span class="copyright">Copyright &copy;2014</span>
        <nav id="footer-nav">
            <ul>
                <li><a href="" title=""><?= _("The Skills"); ?></a></li>
                <li><a title="" href="/project"><?= _("The project"); ?></a></li>
                <?php
                        if(Auth::user())
                            {?>
                                <li><a href="/profile" title="<?= _("Register!"); ?>"><?= _("Profile"); ?></a></li>
                            <?php
                            }
                ?>
                <li><a href="/apply" title="<?= _("Become part of the project!"); ?>"><?= _("Apply"); ?></a></li>
                <li><a href="http://vanilla.skill-project.org/" title="The Skill Project Community"><?= _("Community"); ?></a></li>
                <li><a href="/contact" title="<?= _("Contact us"); ?>"><?= _("Contact"); ?></a></li>
                <li class="last"><a href="/legal" title=""><?= _("Terms of Use"); ?></a></li>
            </ul>
        </nav>
    </div>
</div>
{{--<script src="{{asset('js/app.js')}}"></script>--}}
</body>
</html>
