<?php
  session_start();
  $connection = mysqli_connect('localhost', 'simulazione_admin', 'simulazione', 'simulazione')
                or die('Something went horribly wrong with the connection' . mysqli_connect_error());

  $startDate = date('Y-m-d', strtotime($_POST['datainizio']));
  $endDate = date('Y-m-d', strtotime($_POST['datafine']));

  $query_film = "SELECT Film.Titolo, COUNT(*) AS Visualizzazioni
                   FROM Film
                    JOIN Visualizza ON Film.Id = Visualizza.IdFilm
                   WHERE Visualizza.DataVisualizza BETWEEN $startDate AND $endDate
                   GROUP BY Film.Id
                   ORDER BY Visualizzazioni
                   LIMIT 1";

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
  <p>
    Il film con il maggior numero di visualizzazioni &egrave;
<?php
    $res = mysqli_fetch_assoc($result);
    echo $res['Titolo'];
?>
  </p>
</div>
