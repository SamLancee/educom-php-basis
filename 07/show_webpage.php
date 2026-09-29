<?php 
include ("classes_webpage.php");
$page = new WebPage("Dit is mijn pagina");

$page -> showContent(
    "<p> Hier kan de volle body komen </p>"
);
$page -> showFooter();

?>
