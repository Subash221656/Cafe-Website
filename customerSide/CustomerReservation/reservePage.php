<?php
require_once 'config.php';

// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    


    <title>Customer Reservation </title>
    <style>
       
      



body {
  position: relative;
  margin: 0;
  height: 100vh;
  overflow: hidden;
  background: transparent;
}

#myVideo {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1; /* This will ensure the video is behind your content */
}

.video-wrapper::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
 
 
  z-index: 0; /* This will ensure the blur effect is applied above the video but below your content */
}

.reserve-container {
  position: relative;
  z-index: 1; /* This will ensure the reserve-container is above the video and the blur effect */
  width: 100%; /* Adjust this as needed */
 height: 100%;
  margin: 0 auto; /* This will center the container */
  padding: 20px;
  background: rgba(255, 255, 255, 0.8); /* This will make the background of the form slightly transparent */
  border-radius: 10px; /* This will round the corners of the form */
}









.row {
    display: flex;
    justify-content: space-between; /* This will add gaps between the columns */
}

.column {
    flex: 1; /* This will make the columns take up equal width */
    margin: auto 220px; /* This will add some space around the columns */
}

button{
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}



.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="date"],
.form-group input[type="time"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.form-control {
  width: 100%; /* This will make the form control take up the full width of its parent */
  max-width: 225px; /* This will limit the maximum width to 250px */
  /* The rest of your .form-control styles go here */
}


.form-group textarea {
    min-height: 50px;
    resize: vertical;
}

.form-group button {
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.form-group button:hover {
    background-color: #0056b3;
}

@media screen and (max-width: 600px) {
    .container {
        padding: 10px;
    }
}
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }
}

            
    </style>
</head>


<body>

    <?php
        $reservationStatus = $_GET['reservation'] ?? null;
        $message = '';
        if ($reservationStatus === 'success') {
            $message = "Reservation successful";
            $reservation_id = $_GET['reservation_id'] ?? null;
            echo '<a class="nav-link" href="../home/home.php#hero">' .
            '<h1 class="text-center" style="font-family: Copperplate; color: whitesmoke;">COFFEE RUSH</h1>' .
            '<span class="sr-only"></span></a>';
            echo '<script>alert("Table Successfully Reserved. Click OK to view your reservation receipt."); window.location.href = "reservationReceipt.php?reservation_id=' . $reservation_id . '";</script>';

        }
        $head_count = $_GET['head_count'] ?? 1;
    ?>
    <div class="video-wrapper">
  <video playsinline autoplay muted loop id="myVideo">
    <source src="../image/cupofcoffee.mp4" type="video/mp4">
  </video>
</div>
    
    <div class="reserve-container">
        <a class="nav-link" href="../home/home.php#hero" style="text-decoration: none;">
            <h1 class="text-center" style="font-family: Copperplate; background: #959595;
background: linear-gradient(to right, #959595 0%, #0D0D0D 46%, #010101 50%, #0A0A0A 53%, #4E4E4E 76%, #383838 87%, #1B1B1B 100%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
 text-align: center;  font-size: 45px;">RESERVATION</h1>
            
        </a>

        <div class="row">
            <div class="column">
                <div id="Search Table">
                    <h2 style="background: #A7CFDF;
background: linear-gradient(to right, #A7CFDF 0%, #23538A 100%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
">Search for Time</h2><hr>
                 
                    <form id="reservation-form" method="GET" action="availability.php"><br>
                        <div class="form-group">
                        <label for="reservation_date" style="">Select Date</label><br>
                        <input class="form-control" type="date" id="reservation_date" name="reservation_date" required>
                        </div>
                        <div class="form-group">
                        <label for="reservation_time" style="">Available Reservation Times</label>
                        <div id="availability-table">
                            <?php
                            $availableTimes = array();
                            for ($hour = 10; $hour <= 20; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $time = sprintf('%02d:%02d:00', $hour, $minute);
                                    $availableTimes[] = $time;
                                }
                            }
                            echo '<select name="reservation_time" id="reservation_time" style="width:10em;" class="form-control" >';
                            echo '<option value="" selected disabled>Select a Time</option>';
                            foreach ($availableTimes as $time) {
                                echo "<option  value='$time'>$time</option>";
                            }
                            echo '</select>';
                            if (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </div>
                        </div>
              
                        <input type="number" id="head_count" name="head_count" value=1 hidden required>
                        <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn" name="submit" style="height: 120px;">Search</button>
                    </form>
                </div>
            </div>

            <div class="column">
                <div id="insert-reservation-into-table">
                    <h2 style="background: #A7CFDF;
background: linear-gradient(to right, #A7CFDF 0%, #23538A 100%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
">Make Reservation</h2><hr>
                    <form id="reservation-form" method="POST" action="insertReservation.php">
                        <br>
                        <div class="form-group">
                            <label for="customer_name" style="">Customer Name</label>
                            <input class="form-control" type="text" id="customer_name" name="customer_name" required>
                        </div>
                        <?php
                        $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
                        $defaultReservationTime = $_GET['reservation_time'] ?? "13:00:00";
                        ?>
                   
                        <div class="form-group " >
                            <label for="reservation_date" style="">Reservation Date</label>
                            <input type="date" id="reservation_date" name="reservation_date"
                                   value="<?= $defaultReservationDate ?>" readonly required>
                            <input type="time" id="reservation_time" name="reservation_time"
                                   value="<?= $defaultReservationTime ?>" readonly required>
                        </div>
                 
                        <div class="form-group">
                            <label for="table_id_reserve" style="">Available Tables</label>
                            <select class="form-control" name="table_id" id="table_id_reserve" style="width:10em;" required>
                                <option value="" selected disabled>Select a Table</option>
                                <?php
                                $table_id_list = $_GET['reserved_table_id'];
                                $head_count = $_GET['head_count'] ?? 1;
                                $reserved_table_ids = explode(',', $table_id_list);
                                $select_query_tables = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count'";
                                if (!empty($reserved_table_ids)) {
                                    $reserved_table_ids_string = implode(',', $reserved_table_ids);
                                    $select_query_tables .= " AND table_id NOT IN ($reserved_table_ids_string)";
                                }
                                $result_tables = mysqli_query($link, $select_query_tables);
                                $resultCheckTables = mysqli_num_rows($result_tables);
                                if ($resultCheckTables > 0) {
                                    while ($row = mysqli_fetch_assoc($result_tables)) {
                                        echo '<option value="' . $row['table_id'] . '">For ' . $row['capacity'] . ' people. (Table Id: ' . $row['table_id'] . ')</option>';
                                    }
                                }  else {
                                    echo '<option disabled>No tables available, please choose another time.</option>';
                                    echo '<script>alert("No reservation tables found for the selected time. Please choose another time.");</script>';
                                }
                                ?>
                            </select>
                            <input type="number" id="head_count" name="head_count" value="<?= $head_count ?>" required hidden>
                        </div>
                 
                        <div class="form-group mb-3">
                            <label for="special_request">Special request</label>
                            <textarea class="form-control"  id="special_request" name="special_request"> </textarea><br><br>
                            <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn" type="submit" name="submit">Make Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const viewDateInput = document.getElementById("reservation_date");
        const makeDateInput = document.getElementById("reservation_date");

        viewDateInput.addEventListener("change", function () {
            makeDateInput.value = this.value;
        });
    </script>
</body>

</html>
