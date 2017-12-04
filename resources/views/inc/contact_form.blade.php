<form method="POST" action="" id="contact-form">
    {{csrf_field()}}
    <div class="row">
        <div>
            <label for="email"><?= _("Your email") ?></label>
            <input type="email" name="email" id="email" value="<?php if(Auth::guest()){ echo "";}else{ echo Auth::user()->email;} ?>" required />
        </div>
        <div class="r">
            <label for="real_name"><?= _("Your real name") ?></label>
            <input type="text" name="real_name" id="real_name" required />
        </div>
    </div>
    <div class="profile-section">
        <label for="message-textarea"><?= _("Your message"); ?></label>
        <textarea name="message" id="message-textarea" required></textarea>
    </div>
    <div class="submit-container">
        <input class="pink-submit" type="submit" value="<?= _("SEND") ?>" />
    </div>
</form>