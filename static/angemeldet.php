<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldungen ISST 2024</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <h1>Anmeldungen ISST 2024</h1>

    <?php
    // Pfad zur CSV-Datei
    $csvFile = '/var/private/isv/isst25.csv';

    // Überprüfen, ob die Datei existiert
    if (file_exists($csvFile)) {
        echo '<table>';
        
        // Tabelle mit festem Header erstellen
        echo '<tr>';
        echo '<th>Vorname</th>';
        echo '<th>Nachname</th>';
        echo '<th>Verein</th>';
        echo '<th>Geburtsdatum</th>';
        echo '<th>Handynummer</th>';
        echo '<th>Email</th>';
        echo '<th>Rabattberechtigung</th>';
        echo '<th>Bestätigung</th>';
        echo '<th>AGB Zustimmung</th>';
        echo '</tr>';
        
        // Datei öffnen und Daten auslesen
        if (($handle = fopen($csvFile, 'r')) !== FALSE) {
            // Zeilen der CSV-Datei durchlaufen
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                echo '<tr>';
                foreach ($data as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                }
                echo '</tr>';
            }
            fclose($handle);
        } else {
            echo '<p style="color: red; text-align: center;">Fehler: Die CSV-Datei konnte nicht gelesen werden.</p>';
        }

        echo '</table>';
    } else {
        echo '<p style="color: red; text-align: center;">Fehler: Die CSV-Datei existiert nicht.</p>';
    }
    ?>

</body>
</html>
