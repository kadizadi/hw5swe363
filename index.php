<?php
$temp ="";
$result_returned = false;
$correct_data = false;
error_reporting(0);
    if(isset($_POST['Search']) && $_POST['city'] != ""){
        $correct_data = true;
        if($_POST['degree'] == 'imperial'){
            // create & initialize a curl session
            $temp = "°F";
            $curl = curl_init();
 
            // set our url with curl_setopt()
            curl_setopt($curl, CURLOPT_URL, 'api.openweathermap.org/data/2.5/weather?q=' . $_POST['city'] . '&appid=08fd378cc8444e103b9580fb21902067&units=imperial');
 
            // return the transfer as a string, also with setopt()
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 
            // curl_exec() executes the started curl session
            // $output contains the output string
            if ($output = curl_exec($curl)) {
                $result_returned = true;
                curl_close($curl);
                $json = json_decode($output);
            }
            // close curl resource to free up system resources
            // (deletes the variable made by curl_init)
 
        }
        else if($_POST['degree'] == 'metric'){
            $temp = "°C";
            $curl = curl_init();
 
            // set our url with curl_setopt()
            curl_setopt($curl, CURLOPT_URL, 'api.openweathermap.org/data/2.5/weather?q=' . $_POST['city'] . '&appid=08fd378cc8444e103b9580fb21902067&units=metric');
 
            // return the transfer as a string, also with setopt()
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 
            // curl_exec() executes the started curl session
            // $output contains the output string
            if ($output = curl_exec($curl)) {
                $result_returned = true;
                curl_close($curl);
                $json = json_decode($output);
            }
            // close curl resource to free up system resources
            // (deletes the variable made by curl_init)
            
 
        }
 
    }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
  </head>
  <body>
    
    <div class="container-fluid text-center">
      <div class="row content">
        <div class="col-sm-2 sidenav"></div>
        <div class="col-sm-8 text-left">
         

          <form class="weather_forecast" method="POST">
            <fieldset>
                <legend>Weather Forecast</legend>
                <div class="container">
                    <label for="city">City: </label>
                    <input type="text" name="city">
                </div>
                <div class="container">
                    <label for="degree">Degree: </label>
                    <input type="radio" name="degree" value="imperial" checked>
                    <label> Fahrenhiet </label>
                    <input type="radio" name="degree" value="metric">
                    <label> Celsius </label>
                </div>
                <div class="buttons-container">
                    <input type="submit" name="Search" value="Search">
                    <button name="clear" onclick="cleartext();">clear</button>
                </div>
            </fieldset>
            <div>
                <fieldset>
                    <legend>Weather</legend>
                    <div class="weather container">
                        <?php
                            if($result_returned && $correct_data && $_POST['city'] && $json->name != null){
                                echo "<h2>" . $json->name . " Weather status</h2>";
                                echo '<div class="weather-forecast">';
                                echo '<img src="http://openweathermap.org/img/w/' . $json->weather[0]->icon . '.png" ';
                                echo 'class="weather-icon" />' . $json->main->temp_max . " " . $temp;
                                echo '<span class="min-temperature">' . $json->main->temp_min . " " . $temp; '</span></div>';
                            }
                            else{
                                echo "please enter valid city name";
                            }
                        ?>
                    </div>
                </fieldset>
            </div>
        </form>

        <div class="col-sm-2 sidenav"></div>
      </div>
    </div>

    
  </body>
</html>
