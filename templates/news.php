<?php
foreach ($var as $value) {
?>

<blockquote>
    <h4><?= $value["title"] ?></h4>

    <?php
    if ($value["image"]) {
        echo '<img src="'.SITE.$value["image"].'" alt="img'.$value["id"].'">';
    }
    ?>
    <p>
        <?= $value["text"] ?>
    </p>
    <footer><?= $value["createDate"] ?>
        <cite title="Source Title">
            <?= $value["name"]." ".$value["l_name"] ?>
        </cite>

        <?php
        if ($value['idUser'] === $idUser) {
            echo '<br><a href="news.php?articleId='.$value["id"].'">Delete Article</a>';
            echo '<br><a href="addNews.php?articleId='.$value["id"].'">Modify the Text</a>';
        }
        ?>

    </footer>
</blockquote>

<?php
}
?>
