<?php
foreach ($var as $value) {
?>

<blockquote>
    <h4><?= $value["title"] ?></h4>

    <?php
    if ($value["image"]) {
    ?>
        <img src="<?=SITE.$value["image"]?>" alt="img<?=$value["id"]?>">
    <?php
    }
    ?>
    <p>
        <?= $value["text"] ?>
    </p>
    <footer><?= $value["createDate"] ?>
        <cite title="Source Title">
            <?= $value["name"]." ".$value["l_name"] ?>
            <div><img src="<?=SITE.$value["avatar"]?>" alt=""></div>
        </cite>

        <?php
        if ($value['idUser'] === $var2) {
        ?>
            <br><a href="news.php?articleId=<?=$value["id"]?>" class="delete-articles">Delete Article</a>
            <br><a href="addNews.php?articleId=<?=$value["id"]?>" class="modify-articles">Modify the Text</a>
        <?php
        }
        ?>

    </footer>
</blockquote>

<?php
}
?>
