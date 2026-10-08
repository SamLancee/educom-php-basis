<?php
$fields = ["voornaam", "achternaam", "adres", "postcode", "telefoon", "email"];
$data = [];
$errors = [];

$is_submitted = ($_SERVER['REQUEST_METHOD'] === "POST");

foreach ($fields as$field) {
    $data[$field] = trim($_POST[$field] ?? '');
}

if ($is_submitted) {
    // 1. Verplichte velden
    foreach ($data as $key =>$value) {
        if ($value === '') {
            $errors[] = ucfirst($key) . " is verplicht.";
        }
    }

    // 2. Postcode check (bijv. 1234 AB of 1234AB)
    $zipcode_pattern = '/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/';
    if ($data['postcode'] !== '' && !preg_match($zipcode_pattern, $data['postcode'])) {$errors[] = "Ongeldige postcode (bv. 1234 AB).";
    }

    // 3. Telefoon check (10 cijfers startend met 0)
    $clean_phone = str_replace([' ', '-'], '',$data['telefoon']);
    $phone_pattern = '/^0[0-9]{9}$/';
    if ($data['telefoon'] !== '' && !preg_match($phone_pattern, $clean_phone)) {$errors[] = "Ongeldig Nederlands telefoonnummer (10 cijfers, startend met 0).";
    }

    // 4. E-mail check
    if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {$errors[] = "Ongeldig e-mailadres.";
    }
}
?>

<html>
<head>
    <title>Volledig formulier met JS & PHP</title>
</head>
<body>
    <h2>Vul uw gegevens in!</h2>

    <!-- Container voor JavaScript foutmeldingen -->
    <div id="js-errors" class="error-box" style="display: none;"></div>

    <!-- PHP Server-side foutmeldingen -->
    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errors as$error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="contactForm" method="post" action="">
        <label for="voornaam">Voornaam:</label><br>
        <input type="text" id="voornaam" name="voornaam" value="<?= htmlspecialchars($data["voornaam"] ?? '') ?>"><br><br>

        <label for="achternaam">Achternaam:</label><br>
        <input type="text" id="achternaam" name="achternaam" value="<?= htmlspecialchars($data["achternaam"] ?? '') ?>"><br><br>

        <label for="adres">Adres:</label><br>
        <input type="text" id="adres" name="adres" value="<?= htmlspecialchars($data["adres"] ?? '') ?>"><br><br>

        <label for="postcode">Postcode:</label><br>
        <input type="text" id="postcode" name="postcode" value="<?= htmlspecialchars($data["postcode"] ?? '') ?>"><br><br>

        <label for="telefoon">Telefoon:</label><br>
        <input type="text" id="telefoon" name="telefoon" value="<?= htmlspecialchars($data["telefoon"] ?? '') ?>"><br><br>

        <label for="email">E-mail:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($data["email"] ?? '') ?>"><br><br>

        <input type="submit" value="Verzenden">
    </form>

    <?php if ($is_submitted && empty($errors)): ?>
        <hr>
        <h3>Ingevulde gegevens:</h3>
        <p>Voornaam: <?= htmlspecialchars($data['voornaam']) ?></p>
        <p>Achternaam: <?= htmlspecialchars($data['achternaam']) ?></p>
        <p>Adres: <?= htmlspecialchars($data['adres']) ?></p>
        <p>Postcode: <?= htmlspecialchars($data['postcode']) ?></p>
        <p>Telefoon: <?= htmlspecialchars($data['telefoon']) ?></p>
        <p>E-mail: <?= htmlspecialchars($data['email']) ?></p>
    <?php endif; ?>

    <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        const errorContainer = document.getElementById('js-errors');
        const errors = [];

        // Waarden ophalen en trimmen
        const voornaam = document.getElementById('voornaam').value.trim();
        const achternaam = document.getElementById('achternaam').value.trim();
        const adres = document.getElementById('adres').value.trim();
        const postcode = document.getElementById('postcode').value.trim();
        const telefoon = document.getElementById('telefoon').value.trim();
        const email = document.getElementById('email').value.trim();

        // 1. Aanwezigheidscheck (alle velden verplicht)
        const velden = [
            { naam: 'Voornaam', waarde: voornaam },
            { naam: 'Achternaam', waarde: achternaam },
            { naam: 'Adres', waarde: adres },
            { naam: 'Postcode', waarde: postcode },
            { naam: 'Telefoon', waarde: telefoon },
            { naam: 'E-mail', waarde: email }
        ];

        //alle items doorlopen
        velden.forEach(veld => { 
            if (veld.waarde === '') {
                errors.push(`${veld.naam} is verplicht.`);
            }
        });

        // 2. Postcode check: 4 cijfers (1000-9999), optionele spatie, 2 letters
        const postcodepattern = /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/;
        if (postcode !== '' && !postcodepattern.test(postcode)) {
            errors.push('Ongeldige postcode (bv. 1234 AB).');
        }

        // 3. Telefoon check: spaties/streepjes weghalen, moet starten met 0 en 10 cijfers lang zijn
        const cleanPhone = telefoon.replace(/[\s-]/g, '');
        const phonePattern = /^0[0-9]{9}$/;
        if (telefoon !== '' && !phonePattern.test(cleanPhone)) {
            errors.push('Ongeldig Nederlands telefoonnummer (10 cijfers, startend met 0).');
        }

        // 4. E-mail check
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email !== '' && !emailPattern.test(email)) {
            errors.push('Ongeldig e-mailadres.');
        }

        // Als er fouten zijn: tegenhouden en tonen
        if (errors.length > 0) {
            event.preventDefault(); // Blokkeert het versturen naar PHP
            errorContainer.innerHTML = '<ul>' + errors.map(err => `<li>${err}</li>`).join('') + '</ul>';
            errorContainer.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            errorContainer.style.display = 'none';
        }
    });
    </script>
</body>
</html>