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
            <br><a href="<?=SITE?>news/modifyNews?modifyArticleId=<?=$value["id"]?>" class="modify-articles">Modify article</a>
            <br><a href="<?=SITE?>news/newsAction?deleteArticleId=<?=$value["id"]?>" class="delete-articles">Delete article</a>
        <?php
        }
        ?>

    </footer>

    <blockquote id="comment">
        <h5>Комментарии:</h5>
        <form action="<?=SITE?>news/commentAction" method="post">
            <div class="form-group">
                <textarea name="text" type="text" class="form-control" placeholder="Comment text"></textarea>
            </div>
            <button type="submit" name="idArticle" class="btn btn-default" value="<?=$value["id"]?>">Submit</button>
        </form>
        <hr>

        <?php
        foreach ($var3 as $value3) {
            if ($value["id"] === $value3['idArticles']) {
        ?>
            <header><?= $value3["createDate"] ?>
                <cite title="Source Title">
                    <?= $value3["name"] . " " . $value3["l_name"] ?>
                    <div><img src="<?= SITE . $value3["avatar"] ?>" alt=""></div>
                </cite>
            </header>
            <p>
                <?= $value3["text"] ?>
            </p>
            <hr>
        <?php
            }
        }
        ?>

    </blockquote>
</blockquote>

<?php
}
?>
