<?php include $this -> resolve("/partials/_header.php") ?>
<main>
    <!-- Login er por welcome message ashbe ekhane, flash function ta oi message return korbe
     so age check kore nite hobe je oi value true naki. 
     Upore ekta message box ashbe almost alert er moto but alert na, oitay cross button thake jetay click kore remove hoye jabe. pura HTML thakbe ei if block er vitore -->
    <?php if(flash('message'))
        {
            $m = flash('message');
            echo "{$m}<br>";
        } 
    ?>
    <h1>Home Page UwU</h1>
    <p>name : <?php echo e($name) ?> </p>
    <p>age : <?php echo e($age) ?> </p>
</main>

<?php include $this -> resolve("partials/_footer.php") ?>