@include('inc.profile_common')
<?php
$user = Auth::user();
$editor = \App\Model\EditorRequest::where('applied_by', '=', $user->id)->first();
?>
    <div id="right-column">
        <div class="profile-section">
            <h3 class="first"><?= _("BIO"); ?></h3>
            <p><?php if (!empty($editor->prof_activity)): ?>
            <?= $editor->prof_activity ?>
            <?php else: ?>
            <?= _("No bio!"); ?>
            </p>
            <?php endif; ?>
        </div>
        <div class="profile-section personnal-info">
            <h3><?= _("PERSONAL INFORMATION"); ?></h3>
            <p><span class="pale-label"><?= _("Country:"); ?></span> <?php echo ($editor->country) ? ($editor->country) : _("not set!"); ?></p>
            <p><span class="pale-label"><?= _("Languages:"); ?></span> <?php echo ($editor->languages) ? ($editor->languages) : _("not set!"); ?></p>
            <p><span class="pale-label"><?= _("Interests:"); ?></span> <?php echo ($editor->skills_of_interest) ? ($editor->skills_of_interest) : _("not set!"); ?></p>
        </div>
        <div class="profile-section">
            <h3><?= _("RECENT ACTIVITY"); ?></h3>
            <?php _("Created"); _("Moved"); _("Translated"); _("Modified"); //possible activity ?>
            <?php if (!empty($latestActivity)): ?>
                <ul class="latest-activity">
                <?php foreach($latestActivity as $la): ?>
                    <li><?= date(_("Y-m-d H:i"), $la['timestamp']); ?>: <?= _(ucfirst(strtolower(_($la['action'])))); ?> <span class="skill-name">"<?= $la['skillName']; ?>"</span></li>
                <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <?= _("No activity yet!"); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</section>

