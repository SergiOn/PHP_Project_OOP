<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=SITE?>">Newsbook</a>
        </div>
        <div class="collapse navbar-collapse">
            
<?php
//    if (checkAuth()) {
?>
            <ul class="nav navbar-nav">
                <li><a href="<?=SITE?>news">News</a></li>
                <li><a href="<?=SITE?>news/getMy">My News</a></li>
                <li><a href="<?=SITE?>news/subscribe">Subscribe</a></li>
                <li><a href="<?=SITE?>user">Users</a></li>
    <?php
//        if (checkAuth() === "1") {
    ?>
                <li><a href="<?=SITE?>users/addCity">Add City</a></li>
    <?php
//        }
    ?>
                <li><a href="<?=SITE?>news/addNews">Add News</a></li>
            </ul>
            <form class="quit" action="<?=SITE?>user/quitAction" method="post">
                <button type="submit">Quit</button>
            </form>
            <div class="user">
                <img src="<?=SITE?>images/idUsers/1.jpg" alt="">
                <div class="user-info">
                    <ul>
                        <li>Info about User</li>
                        <li><a href="#">Visit my cabinet</a></li>
                    </ul>
                    
                </div>
            </div>
<?php
//    } else {
?>
<!--            <ul class="nav navbar-nav">-->
<!--                <li><a href="login.php">Login</a></li>-->
<!--                <li><a href="registration.php">Registration</a></li>-->
<!--            </ul>-->
<?php
//    }
?>
   
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container">

    <div class="starter-template">
        <h1><s>The</s> Newsbook</h1>
        <p class="lead">It's our new portal. With Black Jack and cats</p>
    </div>

        
