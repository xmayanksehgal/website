<form method="POST" action="" enctype="multipart/form-data">
    <div class="profile-section">
        <h3 class="first special"><?= _("PERSONAL INFORMATION"); ?></h3>
        <div class="row">
            <div>
                <label for="username"><?= _("Username") ?></label>
                <input type="text" name="username" id="username" value="" required />
            </div>
            <div class="r">
                <label for="email"><?= _("Email") ?></label>
                <input type="email" name="email" id="email" value="" required />
            </div>
        </div>
        <div class="row">
            <div>
                <label for="languages"><?= _("Languages-s (Comma separated please)") ?></label>
                <input type="text" name="languages" id="languages" value="" />
            </div>
            <div class="r">
                <label for="country"><?= _("Country") ?></label>
                <input type="text" name="country" id="country" value="" />
            </div>
        </div>
    </div>
    <div class="profile-section">
        <div>
            <label for="interests"><?= _("SKILLS OF INTEREST") ?></label>
            <input type="text" name="interests" id="interests" value="" />
        </div>
    </div>
    <div class="profile-section">
        <label for="bio-textarea"><?= _("SAY SOMETHING ABOUT YOURSELF"); ?></label>
        <textarea name="bio" id="bio-textarea"></textarea>
    </div>
    <div class="submit-container">
        
        <input class="pink-submit" type="submit" value="<?= _("Save") ?>" />
        <?php
            if (!empty($errors)):
            echo '<div class="errors">';
            foreach($errors as $name => $message){
                echo $message . "<br />";
            }
            echo '</div>';
            endif;
        ?>
    </div>

</form>
