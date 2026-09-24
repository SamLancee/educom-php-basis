<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"] ?? null;

    switch ($number) {
        case 4:
            $message = "4 is your favorite number";
            break;
        case 5:
            $message = "5 is your favorite number";
            break;
        case 6:
            $message = "6 is your favorite number";
            break;
        case "":
        case null:
            $message = "Did not give a number";
            break;
        default:
            $message = "Number $number is your favorite number";
            break;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Switch demo</title>
    </head>
    <body>
        <h2>Enter a number</h2>
        
        <form method="POST">
            <input type="number" id="number" name="number">
            <button type="submit">Verstuur</button>
        </form>

        <p><?php echo $message; ?></p>

    </body>
</html>