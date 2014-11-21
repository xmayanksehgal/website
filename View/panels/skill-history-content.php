<?php
foreach($history as $item) {
?>
<div class="item">
	<div class="when-who">
		<abbr title="<?=$item["exactTime"]?>"><?=$item["diffHuman"]?></abbr> <?=sprintf(_("by %s"), "<a href='" . $item["userProfileURL"] . "'>" . $item["userProps"]["username"] . "</a>")?>
	</div>
	<div class="action">
		<?=$item["actionName"]?>
	</div>
	<div class="details">
		<?=$item["actionDetails"]?>
	</div>
</div>

<?php
}
?>