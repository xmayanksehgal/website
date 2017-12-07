<?php
$pageLangName = str_replace(".php", "", $page);
$pageName = "graph";

$pageNames = explode("/", $pageName);
$lastPageName = $pageNames[count($pageNames) - 1];
?>
<!DOCTYPE html>
<html lang="fr" class="graph">
<head>
    @include("inc/page_head"); ?>
</head>
<body class="<?= $userClass . " " . $pageLangName ?>">
<?php include("../View/pages/" . $page); ?>
</body>
</html>