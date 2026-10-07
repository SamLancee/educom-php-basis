
<html>
    <head>
        <title> Boeken overzicht</title>
    </head>
    <body>
        <h2>Boeken</h2>
<?php 
$xml_file = "library.xml";

if (file_exists($xml_file)){
    $library = simplexml_load_file($xml_file);
    if ($library == false){
        die("Fout!");
    }
    echo "<ul>";
    foreach ($library -> book as $book){
        echo "<hr>";
        echo "<li>";
        echo "<strong> Titel: </strong>" . htmlspecialchars($book->title). "<br>";
        echo "<strong>Isbn: </strong>" . htmlspecialchars($book ->isbn). "<br>";
        echo "<strong>Authors: </strong>";
        $author_list = [];
        foreach ($book->authors->author as $author) {
            $author_list[] = htmlspecialchars($author);
        }
        echo implode(", ", $author_list). "<br>";
        echo "<strong>Publisher: </strong>" . htmlspecialchars($book -> publisher) . "<br>";
        echo "<strong>Price: </strong>" . htmlspecialchars($book->price) . "<br>";
        echo "<strong>Pubdate: </strong>" . htmlspecialchars($book->pubdate) . "<br>";
    }
    echo "</ul>";
    echo "<hr>";

}
?>
</body>
</html>
