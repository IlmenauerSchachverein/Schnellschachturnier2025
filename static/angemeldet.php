<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldungen ISST 2024 - Vergleich mit Webtabelle</title>
    <style>
        table {
            width: 90%;
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
        .highlight {
            background-color: #ffcccc; /* Hellrot für Übereinstimmungen */
        }
    </style>
</head>
<body>
    <h1>Anmeldungen ISST 2024 - Vergleich mit Webtabelle</h1>

    <?php
    // Pfad zur CSV-Datei
    $csvFile = '/var/private/isv/isst25.csv';
    $csvNames = [];

    // Öffne die CSV-Datei und extrahiere die Namen
    if (file_exists($csvFile)) {
        if (($handle = fopen($csvFile, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // Vor- und Nachnamen aus der CSV-Datei extrahieren
                $csvNames[] = trim($data[2]) . ' ' . trim($data[3]); // Annahme: Vorname in $data[2] und Nachname in $data[3]
            }
            fclose($handle);
        }
    } else {
        echo '<p style="color: red; text-align: center;">Fehler: Die CSV-Datei existiert nicht.</p>';
    }

    // Lade die HTML-Inhalte von der Webseite
    $url = 'https://chess-results.com/tnr1056111.aspx?lan=0';
    $html = file_get_contents($url);

    if ($html !== FALSE) {
        // Nutze DOMDocument und DOMXPath, um die Tabelle zu parsen
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Finde die Zeilen in der Tabelle
        $rows = $xpath->query("//table[@class='CRs1']//tr");

        echo '<table>';
        echo '<tr><th>Nr.</th><th>Name</th><th>FideID</th><th>Land</th><th>Elo</th><th>Verein/Ort</th></tr>';

        foreach ($rows as $index => $row) {
            // Überspringe die Header-Zeile
            if ($index === 0) continue;

            // Hole die Zellenwerte
            $cells = $row->getElementsByTagName('td');
            if ($cells->length < 7) continue; // Wenn es nicht genug Zellen gibt, überspringen

            // Extrahiere die relevanten Daten
            $number = trim($cells->item(0)->nodeValue);
            $name = trim($cells->item(3)->nodeValue);
            $fideID = trim($cells->item(4)->nodeValue);
            $country = trim($cells->item(5)->nodeValue);
            $elo = trim($cells->item(6)->nodeValue);
            $club = trim($cells->item(7)->nodeValue);

            // Prüfe, ob der Name in der CSV-Liste existiert
            $highlightClass = in_array($name, $csvNames) ? 'highlight' : '';

            // Zeile in die Tabelle ausgeben, ggf. mit Hervorhebung
            echo "<tr class='{$highlightClass}'>";
            echo "<td>{$number}</td>";
            echo "<td>{$name}</td>";
            echo "<td>{$fideID}</td>";
            echo "<td>{$country}</td>";
            echo "<td>{$elo}</td>";
            echo "<td>{$club}</td>";
            echo "</tr>";
        }

        echo '</table>';
    } else {
        echo '<p style="color: red; text-align: center;">Fehler: Die Webtabelle konnte nicht geladen werden.</p>';
    }
    ?>

</body>
</html>
