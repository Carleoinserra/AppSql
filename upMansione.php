<?php
// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal form
    $nome = $_POST['nome'];
    $mansione = $_POST['mansione'];

    // Collegati al database SQLite
    $db = new SQLite3('dipendenti.db');

    // Crea la tabella dipendenti (se non esiste già)
    $query = 'CREATE TABLE IF NOT EXISTS dipendenti (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        mansione TEXT NOT NULL
    )';
    $db->exec($query);

    // Aggiorna la mansione nella tabella dipendenti usando prepared statements
    $stmt = $db->prepare('UPDATE dipendenti SET mansione = :mansione WHERE nome = :nome');
    $stmt->bindValue(':mansione', $mansione, SQLITE3_TEXT);
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);

    // Esegui la query e controlla il risultato
    if ($stmt->execute()) {
        if ($db->changes() > 0) {
            echo "Mansione del dipendente aggiornata con successo.";
        } else {
            echo "Errore: nessun dipendente trovato con il nome specificato.";
        }
    } else {
        echo "Errore nell'aggiornamento della mansione: " . $db->lastErrorMsg();
    }

    // Chiudi la connessione al database
    $db->close();
}
?>
