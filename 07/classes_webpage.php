<?php 
class Webpage {

    private $title;

    function __construct($title = ""){
        $this ->title = $title;
        ?>
        <html>
            <head>
                <title><?= htmlspecialchars( $this -> title) ?> </title>
                <style>
                    body{
                        min-height: 100vh;
                        margin: 0;
                        display: grid;
                        grid-template-rows: auto 1fr auto;
                    }
                </style>
            </head>
            <body>
                <h1> <?= htmlspecialchars($this -> title) ?></h1>
                <?php

    }
    function showContent($content){
        echo $content;

    }
    function showFooter(){
        ?>
        <hr>
        <footer>
            <p>Dit is de footer</p>
        </footer>
        </body>
        </html>
        <?php

    }
}
?>