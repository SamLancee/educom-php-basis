
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
        echo "<li>";
        echo "Titel: " . htmlspecialchars($book->title). "<br>";
        echo "Isbn: " . htmlspecialchars($book ->isbn). "<br>";
        echo "Authors: ";
        $author_list = [];
        foreach ($book->authors->author as $author) {
            $author_list[] = htmlspecialchars($author);
        }
        echo implode(", ", $author_list);
        echo "Publisher: " . htmlspecialchars($book -> publisher) . "<br>";
        echo "Price: " . htmlspecialchars($book->price) . "<br>";
        echo "Pubdate: " . htmlspecialchars($book->pubdate) . "<br>";
    }
    echo "</ul>";

}
?>
</body>
</html>
