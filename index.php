<?php 

require_once('appvars.php');
require_once('connectvars.php');

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guitar Wars | High Scores</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1>Guitar Wars - High Scores</h1>
        <p class="center">Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="large-8 large-offset-2 columns">
        <?php
          // Connect to the database
          $dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
          
          // Retrieve the score data from MySQL
          $query = "SELECT * FROM guitar_wars ORDER BY score DESC, DATE ASC";
          $data = mysqli_query($dbc, $query);

          // Loop through the array of score data, formatting it as HTML
          echo '<table class="scoretable">';
          $i = 0;

          while ($row = mysqli_fetch_array($data)) {
          
            // Display the score data
            if ($i == 0) {
              echo '<tr><td colspan="2" class="topheader">Top Score: ' . $row['score'] . '</td></tr>';
            }
            echo '<tr><td class="scoreinfo">';
            echo '<span class="score">' . $row['score'] . '</span><br />';
            echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
            echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
            if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
                echo '<td class="scoreimg"><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score Image." /></td></tr>';
            } else {
                echo '<td class="scoreimg"><img src="img/unverified.gif" alt="Unverified Score." /></td></tr>';
            }
            $i++;
          }
          echo '</table>';
          mysqli_close($dbc);
        ?>
      </div>
    </div>


    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
