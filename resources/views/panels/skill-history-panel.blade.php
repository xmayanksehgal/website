<div id="skill-history-panel" class="panel-content">

    @include("panels/subpanel-top")

    <h3><?= _("History"); ?></h3>
    <form method="GET" action="<?= "/skillHistory" ?>" id="skill-history-form">
        <input type="hidden" name="skillUuid" id="history-skillUuid" value="<?= $param['skill']->getUuid(); ?>" />
    </form>
    
    <div id="skill-history-content"></div>
    @include("panels.panel-bottom")
</div>