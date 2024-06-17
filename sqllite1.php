<?php
try {
    // Collegati a un nuovo database (verrà creato se non esiste)
    $db = new SQLite3('dipendenti.db');

    // Crea una tabella
    $query = 'CREATE TABLE IF NOT EXISTS dip (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        mansione TEXT NOT NULL,
        stipendio TEXT NOT NULL
    )';
    $db->exec($query);

    // Query per verificare l'esistenza della tabella dipendenti
    $query = "SELECT name FROM sqlite_master WHERE type='table' AND name='dipendenti';";
    $result = $db->query($query);

    // Controlla il risultato
    if ($result->fetchArray()) {
        echo "La tabella 'dipendenti' esiste.";
    } else {
        echo "La tabella 'dipendenti' non esiste.";
    }
    
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
} finally {
    // Chiudi la connessione al database
    $db->close();
}
?>
