<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // La tua chiave API di OMDB
    $apiKey = 'e28a4655';

    // Ottieni il titolo del film dal form
    $title = $_POST['title'];

    // Costruisci l'URL per la richiesta API
    $url = "http://www.omdbapi.com/?apikey=$apiKey&t=" . urlencode($title);

    // Usa file_get_contents per fare la richiesta HTTP
    $response = file_get_contents($url);

    // Controlla se la richiesta ha avuto successo
    if ($response === FALSE) {
        die('Errore nella richiesta API');
    }

    // Decodifica la risposta JSON in un array PHP
    $data = json_decode($response, true);

    // Controlla se la decodifica ha avuto successo
    if ($data === NULL) {
        die('Errore nella decodifica della risposta JSON');
    }

    // Verifica se il film è stato trovato
    if ($data['Response'] === 'True') {
        echo "<h2>Risultati della ricerca per: " . htmlspecialchars($title) . "</h2>";
        echo "Titolo: " . htmlspecialchars($data['Title']) . "<br>";
        echo "Anno: " . htmlspecialchars($data['Year']) . "<br>";
        echo "Regista: " . htmlspecialchars($data['Director']) . "<br>";
        echo "Genere: " . htmlspecialchars($data['Genre']) . "<br>";
        echo "Trama: " . htmlspecialchars($data['Plot']) . "<br>";
        echo "Poster: <br><img src='" . htmlspecialchars($data['Poster']) . "' alt='Poster del film'><br>";
    } else {
        echo "<h2>Film non trovato!</h2>";
    }
}
?>
