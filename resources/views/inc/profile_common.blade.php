<header id="profile-header">
    <div class="container">
        <?php
        $user = Auth::user();
        ?>
        <h2><?= strtoupper($user->username); ?>'s PROFILE</h2>
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
            <a href="/profile/edit/{{Auth::user()->id}}" title="<?= _("Edit your profile"); ?>"><b><?= _("Edit your profile"); ?></b></a>
        </div>