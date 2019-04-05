<?php
  session_start();
  $connection = mysqli_connect('localhost', 'simulazione_admin', 'simulazione', 'simulazione')
                or die('Something went horribly wrong with the connection' . mysqli_connect_error());

  $query_utenti = <<<FINE
  SELECT DISTINCT Utenti.Cognome, Utenti.Nome
  FROM Utenti
  WHERE Utenti.CF NOT IN (
    SELECT Utenti.CF
    FROM Utenti
      JOIN Visualizza ON Visualizza.CFUtente = Utenti.CF
    GROUP BY Utenti.CF
  )
  ORDER BY Utenti.Cognome, Utenti.Nome
  FINE;

  if(!$result = mysqli_query($connection,$query_utenti)) {
    echo "Something went horribly wrong with the query utenti\n";
    echo "Errno: " . $connection -> errno . "\n";
    echo "Error: " . $connection -> error . "\n";
    exit;
  }

  if ($result -> num_rows === 0) {
    echo "Something went horribly wrong with the query result";
    echo "Errno: " . $connection -> errno . "\n";
    echo "Error: " . $connection -> error . "\n";
    exit;
  }
?>
<div id='container'>
  <table>
    <thead>
      <th>
        <td>Cognome</td>
        <td>Nome</td>
      </th>
    </thead>
    <tbody>
<?php
  while ($res = mysqli_fetch_assoc($result)) {
?>
      <tr>
        <td><?php echo $res['Cognome']; ?></td>
        <td><?php echo $res['Nome']; ?></td>
      </tr>
<?php
  }
?>
    </tbody>
  </table>
</div>
