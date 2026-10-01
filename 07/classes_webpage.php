<?php 
class Webpage {

    private $title;

    public function __construct($title = "") {
        $this->title = $title;
    }

    public function showHeader() {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                
                <title><?= htmlspecialchars($this->title) ?></title>
                <style>
                    body {
                        min-height: 100vh;
                        margin: 0;
                        display: grid;
                        grid-template-rows: auto 1fr auto;
                    }
                </style>
            </head>
            <body>
                <h1><?= htmlspecialchars($this->title) ?></h1>
        <?php
    }

    public function showContent($content) {
        echo $content;
    }

    public function showFooter() {
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