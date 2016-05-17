<div class="row">

<?php
//foreach ($users as $user) {
//  $resultSubs = checkSubscribe($user["id"]);
//	if ($user["id"] === $idUser) {
//        continue;
//    }
//    if ($resultSubs) {
//        $status = "Subscribed Yet";
//    } else {
//        $status = "Subscribe";
//    }
?>

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="img">
                <img src="<?= $user["avatar"] ?>" alt="user<?= $user["id"] ?>">
            </div>
            <div class="caption">
                <h3><?= $user["name"]." ".$user["l_name"] ?></h3>
                <p><a href="addSubscribe.php?id=<?= $user["id"] ?>" class="btn btn-primary" role="button"><?= $status ?></a></p>
            </div>
        </div>
    </div>

<?php
//}
?>

</div>