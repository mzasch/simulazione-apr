<?php
  session_start();
  $connection = mysqli_connect('localhost', 'simulazione_admin', 'simulazione', 'simulazione')
                or die('Something went horribly wrong with the connection' . mysqli_connect_error());

  $query_film = "SELECT Film.* FROM Film ORDER BY Film.Genere, Film.Anno";

  if(!$result = mysqli_query($connection,$query_film)) {
    echo "Something went horribly wrong with the query film\n";
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
        <td>Titolo</td>
        <td>Anno</td>
        <td>Genere</td>
        <td>Trama</td>
        <td>Trailer</td>
        <td>Durata</td>
      </th>
    </thead>
    <tbody>
<?php
  while ($res = mysqli_fetch_assoc($result)) {
?>
      <tr>
        <td><?php echo $res['Titolo']; ?></td>
        <td><?php echo $res['Anno']; ?></td>
        <td><?php echo $res['Genere']; ?></td>
        <td><?php echo $res['Trama']; ?></td>
        <td><?php echo $res['Trailer']; ?></td>
        <td><?php echo $res['Durata']; ?></td>
      </tr>
<?php
  }
?>
    </tbody>
  </table>
</div>
