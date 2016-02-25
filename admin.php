<?php

require_once('auth.php');
require_once('appvars.php');
require_once('connectvars.php');

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guitar Wars | High Scores Admin</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1>Guitar Wars</h1>
        <h2>High Scores Admin</h2>
      </div>
    </div>

    <div class="row">
      <div class="large-6 large-offset-3 columns">
				<?php

					//Connect to database
					$dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

					//Retrieve the socre data
					$query = "SELECT * FROM guitar_wars ORDER BY score DESC, date ASC";
					$data = mysqli_query($dbc, $query);

					//Loop thtough the array of score data, formatting it as HTML
					echo '<table class="admintable">';
					while ($row = mysqli_fetch_array($data)) {
						//Display the score data
						echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
						echo '<td>' . $row['date'] . '</td>';
						echo '<td>' . $row['score'] . '</td>';
						echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Remove</a>';
            if ($row['approved'] == 0) {
              echo ' / <a href="approve.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Approve</a>';
            }
            echo '</td></tr>';

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
