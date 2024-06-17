<?php
// Collegati a un nuovo database (verrà creato se non esiste)
$db = new SQLite3('dipendenti.db');



// Seleziona dati dalla tabella
$query = 'SELECT * FROM dipendenti';
$result = $db->query($query);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: " . $row['id'] . " - Nome: " . $row['nome'] . " - mansione: " . $row['mansione'] . "<br>";
}

// Chiudi la connessione al database
$db->close();
?>
