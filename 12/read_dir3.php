<!DOCTYPE html>
<html>
<head>
   
    <title>Directory Listing</title>
    
</head>
<body>

<h2>Overzicht van geüploade afbeeldingen</h2>

<?php
$dir = "upload/";

if (is_dir($dir) && ($handle = opendir($dir))) {
    echo "<table>";
    echo "<tr>
            <th>Thumbnail</th>
            <th>Bestandsnaam</th>
            <th>Afmetingen</th>
            <th>MIME-type</th>
            <th>Grootte</th>
            <th>Laatst gewijzigd</th>
          </tr>";

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $path = $dir . $entry;

            if (is_file($path)) {
                // Afbeeldingsinformatie
                $imageInfo = getimagesize($path);

                
                if ($imageInfo !== false) {
                    $width = $imageInfo[0];              // Breedte in pixels
                    $height = $imageInfo[1];             // Hoogte in pixels
                    $mimeType = $imageInfo['mime'];      // Bijv: image/jpeg of image/png
                    $dimensions = $width . " x " . $height . " px";

                    // Grootte en datum ophalen
                    $size = round(filesize($path) / 1024, 2) . " KB";
                    $date = date("d-m-Y H:i:s", filemtime($path));

                    echo "<tr>";
                    //thumbnail 
                    echo "<td>
                            <a href='" . htmlspecialchars($path) . "' target='_blank'>
                                <img src='" . htmlspecialchars($path) . "' alt='thumbnail' width='40'>
                            </a>
                          </td>";
                    
                    //Klikbaar
                    echo "<td><a href='" . htmlspecialchars($path) . "' target='_blank'>" . htmlspecialchars($entry) . "</a></td>";
                    
                    
                    echo "<td>" . $dimensions . "</td>";
                    
                    echo "<td>" . htmlspecialchars($mimeType) . "</td>";
                    
                    
                    echo "<td>" . $size . "</td>";
                    echo "<td>" . $date . "</td>";
                    echo "</tr>";
                }
            }
        }
    }

    echo "</table>";
    closedir($handle);
} else {
    echo "<p>Map niet gevonden.</p>";
}
?>

</body>
</html>