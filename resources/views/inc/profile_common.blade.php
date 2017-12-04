<header id="profile-header">
    <div class="container">
        <?php
        $user = Auth::user();
        ?>
        <h2><?= sprintf(_("%s'S PROFILE"),strtoupper($user->username), "utf-8"); ?></h2>
    </div>
</header>
<section>
    <div class="container">
        <div id="left-column">
            <div id="avatar-rect">
                <div id="avatar-inside">
                    <?php if ($user->role == "admin") : ?>
                    <img class="avatar" src="img/SKP-profile-avatar-defaut-admin.png" />
                    <?php else: ?>
                    <img class="avatar" src="img/SKP-profile-avatar-defaut-logged.png" />
                    <?php endif; ?>
                    <p>
                        <?= strtoupper($user->username); ?>
                    </p>
                    <p>
                        <?= _("Member since"); ?><br />
                        <?= date(_("Y-m-d"), strtotime($user->created_at)); ?>
                    </p>
                    <p>
                        <?= strtoupper($user->role); ?>
                    </p>
                </div>
            </div>
            <br />
            <?php
            //own profile ?
            $loggedUser = Auth::user();
            if ($loggedUser->username == $user->username):
            ?>
            <a href="" title="<?= _("Edit your profile"); ?>"><b><?= _("Edit your profile"); ?></b></a>
            <?php endif; ?>
        </div>
    </div>
</section>