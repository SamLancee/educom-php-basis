<?php
$page = $_GET["page"] ?? "home";

?>

<html>
    <head>
        <title> Meerdere pagina's</title>
    </head>
    <body>
        <nav>
            <a href="menu_paginas.php?page=home">Home</a>
            <a href="menu_paginas.php?page=over_ons">Over ons</a>
            <a href="menu_paginas.php?page=contact">Contact</a>
        </nav>
    <?php
    switch ($page){
        case "home":
            ?>
            <h1> Welkom op home pagina</h1>
            <img src="home.jpg">
            <?php
            break;

        case "over_ons":
            ?>
            <h1>Over ons</h1>
            <p>Dit bedrijf is ooit begonnen...</p>
            <?php
            break;

        case "contact":
            ?>
            <h1>Contact</h1>
            <img src="contact.jpg">
            <?php
            break;
    }
    ?>

    </body>
</html>
