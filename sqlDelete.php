<?php
// Collegati al database SQLite
$db = new SQLite3('dipendenti.db');

// Comando SQL per cancellare tutti i dati dalla tabella
$query = 'DELETE FROM dipendenti';

// Esegui il comando
$result = $db->exec($query);

if ($result) {
    echo "Tutti i dati sono stati cancellati dalla tabella 'dipendenti'.";
} else {
    echo "Errore nella cancellazione dei dati: " . $db->lastErrorMsg();
}

// Chiudi la connessione al database
$db->close();
?>
