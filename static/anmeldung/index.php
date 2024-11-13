<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulardaten</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <form action="https://isst25.ilmenauer-schachverein.de/anmeldung/submit.php" method="POST">
        <label for="vorname">Vorname*</label>
        <input type="text" id="vorname" name="vorname" required>

        <label for="nachname">Nachname*</label>
        <input type="text" id="nachname" name="nachname" required>

        <label for="verein">Verein (falls vorhanden)</label>
        <input type="text" id="verein" name="verein">

        <label for="fideID">Fide-ID*</label>
        <input type="text" id="fideID" name="fideID" required>

        <label for="federation">Schachföderation* (z.B. Deutscher Schachbund)</label>
        <input type="text" id="federation" name="federation" required>

        <label for="geburtsjahr">Geburtsjahr*</label>
        <input type="text" id="geburtsjahr" name="geburtsjahr" required>

        <label for="handy">Handynummer*</label>
        <input type="text" id="handy" name="handy" required>

        <label for="email">E-Mail-Adresse*</label>
        <input type="email" id="email" name="email" required>

        <label>Rabattberechtigt ?</label>
        <div class="radio-group">
            <input type="radio" id="nein" name="rabatt" value="nein" checked>
            <label for="nein">Nein</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="u18" name="rabatt" value="ja_U18">
            <label for="u18">U18 (Stichtag 01.01)</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="student" name="rabatt" value="ja_Student">
            <label for="student">Student</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="renter" name="rabatt" value="ja_Rentner">
            <label for="renter">Rentner</label>
        </div>

        <br><br>
        <label>Sonstiges</label>
        <div class="checkbox-group">
            <input type="checkbox" id="bestaetigung" name="bestaetigung">
            <label for="bestaetigung">Ich wünsche eine Bestätigung der Anmeldung per E-Mail</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="agb" name="agb" required>
            <label for="agb">Ich stimme den AGB und der Nutzung meiner Daten zu*</label>
        </div>

        <!-- Honey Pot Field (hidden from users) -->
        <div style="display:none;">
            <label for="honeypot">Leave this field empty</label>
            <input type="text" id="honeypot" name="honeypot">
        </div>
        <br>
        <input type="submit" value="Absenden">
    </form>

</body>

</html>