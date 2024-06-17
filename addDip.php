<?php
// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal form
    $nome = $_POST['nome'];
    $mansione = $_POST['mansione'];

    // Collegati al database SQLite
    $db = new SQLite3('dipendenti.db');

    

    // Inserisci dati nella tabella usando prepared statements
    $stmt = $db->prepare('INSERT INTO dipendenti (nome, mansione) VALUES (:nome, :mansione)');
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':mansione', $mansione, SQLITE3_TEXT);

    // Esegui la query e controlla il risultato
    if ($stmt->execute()) {
        echo "Nuovo dipendente inserito con successo.";
    } else {
        echo "Errore nell'inserimento del dipendente: " . $db->lastErrorMsg();
    }

    // Chiudi la connessione al database
    $db->close();
}
?>

