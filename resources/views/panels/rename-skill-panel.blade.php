<div id="rename-skill-panel" class="panel-content">

    <?php include("subpanel-top.blade.php") ?>

    <h3><?= _("RENAME"); ?></h3>
    <form method="POST" action="<?= "/api/renameSkill"; ?>" id="rename-skill-form">
        <input type="hidden" name="skillUuid" id="skillUuid" value="<?= $param['skill']->getUuid(); ?>" />
        <div>
            <input type="text" name="skillName" id="rename-skillName" maxlength="45" value="<?= $param['skill']->getLocalName(); ?>" />
        </div>
        <div>
            <input type="submit" value="<?= _("OK") ?>" />
            <span class="message-zone"></span>
        </div>
    </form>

    <?php if (count($param['previousNames']) > 0): ?>
        <hr />
        <div>
            <h4><?php echo _("PREVIOUS NAMES"); ?></h4>
            <ul>
                <?php foreach($param['previousNames'] as $name): ?>
                <li>"<?php echo $name; ?>"</li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php include("panel-bottom.blade.php"); ?>
</div>