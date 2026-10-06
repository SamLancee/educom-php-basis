
<html>
<head>
    
    <title>Directory Listing</title>
    
</head>
<body>

<h2>Overzicht van geüploade bestanden</h2>

<?php
$dir = "upload/";

if (is_dir($dir) && ($handle = opendir($dir))) {
    echo "<table>";
    echo "<tr>
            <th>Bestandsnaam</th>
            <th>Grootte</th>
            <th>Laatst gewijzigd</th>
          </tr>";

    while (false !== ($entry = readdir($handle))) {
        
        if ($entry != "." && $entry != "..") {
            $path = $dir . $entry;

            
            if (is_file($path)) {
                // Bestandsgrootte afronden naar KB
                $size = round(filesize($path) / 1024, 2) . " KB";
                
                // Upload-/wijzigingsdatum
                $date = date("d-m-Y H:i:s", filemtime($path));
                echo "<tr>";
                echo "<td>". $entry ."</td>";
                echo "<td>" . $size . "</td>";
                echo "<td>" . $date . "</td>";
                echo "</tr>";
                
        }
    }
    }
    echo "</table>";
    closedir($handle);
} else {
    echo "<p>Map niet gevonden of kan niet geopend worden.</p>";
}
?>

</body>
</html>