<?php
$xml_input = $_POST['xml_data'] ?? '';
$xslt_input = $_POST['xslt_data'] ?? '';
$resultaat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml_doc = new DOMDocument(); // eigen container
    $xslt_doc = new DOMDocument();// eigen container

    $xml_doc->loadXML($xml_input); //inladen
    $xslt_doc->loadXML($xslt_input); //inladen

    $processor = new XSLTProcessor(); //ingebouwde XSLT engine gebruiken
    $processor->importStylesheet($xslt_doc);
    $resultaat = $processor->transformToXml($xml_doc); // voert transformatie uit
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Opdracht 33</title>
</head>
<body>

    <form method="post" action="">
        <label>XML:</label><br>
        <textarea name="xml_data" rows="10" cols="50"><?= htmlspecialchars($xml_input) ?></textarea>
        <br><br>

        <label>XSLT:</label><br>
        <textarea name="xslt_data" rows="10" cols="50"><?= htmlspecialchars($xslt_input) ?></textarea>
        <br><br>

        <input type="submit" value="Transformeer">
    </form>

    <?php if ($resultaat): ?>
        <hr>
        <h3>Resultaat:</h3>
        <?= $resultaat ?>
    <?php endif; ?>

</body>
</html>