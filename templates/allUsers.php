<div class="row">

<?php
foreach ($var as $user) {
	if ($user["id"] === $var2) continue;

    if ($user["idUser"] === $var2) {
        $statusSub = "Subscribed Yet";
        $status = "delete";
    } else {
        $statusSub = "Subscribe";
        $status = "insert";
    }
?>

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="img">
                <img src="<?= $user["avatar"] ?>" alt="user<?= $user["id"] ?>">
            </div>
            <div class="caption">
                <h3><?= $user["name"]." ".$user["l_name"] ?></h3>
                <p><a href="<?=SITE?>user/subsAction?id=<?=$user["id"]?>&status=<?=$status?>" class="btn btn-primary" role="button"><?=$statusSub?></a></p>
            </div>
        </div>
    </div>

<?php
}
?>

</div>