<?php
$error = false;

// Überprüfen, ob das Formular über POST übermittelt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eingabedaten aus dem Formular sichern und speichern
    $vorname = htmlspecialchars($_POST['vorname']);
    $nachname = htmlspecialchars($_POST['nachname']);
    $verein = isset($_POST['verein']) ? htmlspecialchars($_POST['verein']) : '';
    $geburtsjahr = htmlspecialchars($_POST['geburtsjahr']);
    $handy = isset($_POST['handy']) ? htmlspecialchars($_POST['handy']) : 'Nicht angegeben';
    $email = htmlspecialchars($_POST['email']);
    $rabatt = htmlspecialchars($_POST['rabatt']);
    $bestaetigung = isset($_POST['bestaetigung']) ? 'Ja' : 'Nein';
    $agb = isset($_POST['agb']) ? 'Ja' : 'Nein';

    // Honeypot Spam-Schutz
    if (!empty($_POST['honeypot'])) {
        die("<p style='color:red;'><strong>Fehler:</strong> Spam erkannt.</p>");
    }

    // Anmeldedatum und Uhrzeit im gewünschten Format
    $anmeldedatum = date('d-m-Y'); // DD-MM-YYYY
    $uhrzeit = date('H:i:s');      // HH:MM:SS

    // Dateipfad zur CSV-Datei
    $dateipfad = '/var/private/isv/isst25.csv';

    // Validierung des Geburtsjahres (z.B. vierstellige Zahl)
    if (!ctype_digit($geburtsjahr) || strlen($geburtsjahr) !== 4) {
        echo "<p style='color:red;'><strong>Fehler:</strong> Bitte geben Sie ein gültiges Geburtsjahr ein.</p>";
        $error = true;
    }

    if ($error == false) {
        // Öffnen der Datei im Anhängemodus
        if (($datei = fopen($dateipfad, 'a')) !== FALSE) {
            // Datenzeile, die in die CSV-Datei geschrieben wird
            $datenzeile = [
                $anmeldedatum,
                $uhrzeit,
                $vorname,
                $nachname,
                $verein,
                $geburtsjahr,
                $handy,
                $email,
                $rabatt,
                $bestaetigung,
                $agb
            ];

            // Schreiben der Datenzeile in die CSV-Datei
            if (fputcsv($datei, $datenzeile) === FALSE) {
                echo "<p style='color:red;'><strong>Fehler:</strong> Daten konnten nicht in die CSV-Datei geschrieben werden.</p>";
            } else {
                echo "<p style='color:green;'><strong>Erfolg:</strong> Ihre Daten wurden erfolgreich gespeichert.</p>";
            }

            // Schließen der Datei
            fclose($datei);
        } else {
            echo "<p style='color:red;'><strong>Fehler:</strong> CSV-Datei konnte nicht geöffnet oder erstellt werden. Überprüfen Sie den Dateipfad und die Berechtigungen.</p>";
        }
    }

    // Tabelle nur anzeigen, wenn kein Fehler aufgetreten ist
    if (!$error) {
        echo '<table>';
        echo '<tr><th>Feld</th><th>Wert</th></tr>';
        echo '<tr><td>Vorname</td><td>' . $vorname . '</td></tr>';
        echo '<tr><td>Nachname</td><td>' . $nachname . '</td></tr>';
        echo '<tr><td>Verein</td><td>' . $verein . '</td></tr>';
        echo '<tr><td>Geburtsjahr</td><td>' . $geburtsjahr . '</td></tr>';
        echo '<tr><td>Handynummer</td><td>' . $handy . '</td></tr>';
        echo '<tr><td>E-Mail-Adresse</td><td>' . $email . '</td></tr>';
        echo '<tr><td>Rabattberechtigung</td><td>' . $rabatt . '</td></tr>';
        echo '<tr><td>Bestätigung gewünscht</td><td>' . $bestaetigung . '</td></tr>';
        echo '<tr><td>AGB Zustimmung</td><td>' . $agb . '</td></tr>';
        echo '</table>';
    }
}
?>
