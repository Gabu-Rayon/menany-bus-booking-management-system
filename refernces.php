     <?php
session_start();
require_once 'config/connect.php';
if(empty($_SESSION['id'])){
   header('location: sign-in.php');    
} else {
    	$id = $_SESSION['id'];
				$sql = $conn->prepare("SELECT * FROM `tbl_users` WHERE `id`='$id'");
				$sql->execute();
				$fetch = $sql->fetch();
                // echo $fetch['name']." ". $fetch['username'];


// Check if the schedule ID is provided in the URL
    if (!isset($_GET['id'])) {
        // Handle the case when the schedule ID is missing
        die('Schedule ID is missing.');
    }

    $scheduleId = $_GET['id'];

        // Prepare and execute the query to fetch the schedule details
        $query = "
SELECT
schedule_list.id,
bus.name AS bus_name,
bus.bus_number,
location_from.terminal_name AS from_terminal,
location_from.city AS from_city,
location_from.state AS from_state,
location_to.terminal_name AS to_terminal,
location_to.city AS to_city,
location_to.state AS to_state,
schedule_list.departure_time,
schedule_list.eta,schedule_list.price

FROM
schedule_list
INNER JOIN
bus ON schedule_list.bus_id = bus.id
INNER JOIN
location AS location_from ON schedule_list.from_location = location_from.id
INNER JOIN
location AS location_to ON schedule_list.to_location = location_to.id
WHERE
schedule_list.id = :scheduleId
";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':scheduleId', $scheduleId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the schedule details as an associative array
        $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the schedule exists
        if (!$schedule) {
            // Handle the case when the schedule doesn't exist
            die('Schedule not found.');
        }
     ?>
     <div class="container mt-4">

         <h1>Book Schedule</h1>
         <div class="row">
             <div class="col-md-6">
                 <div class="card mb-4">
                     <div class="card-body">
                         <h5 class="card-title"><?php echo $schedule['bus_name']; ?></h5>
                         <h6 class="card-subtitle mb-2 text-muted">Bus Number: <?php echo $schedule['bus_number']; ?>
                         </h6>
                         <p class="card-text">
                             <strong>From:</strong>
                             <?php echo $schedule['from_terminal'] . ', ' . $schedule['from_city'] . ', ' . $schedule['from_state']; ?><br>
                             <strong>To:</strong>
                             <?php echo $schedule['to_terminal'] . ', ' . $schedule['to_city'] . ', ' . $schedule['to_state']; ?><br>
                             <strong>Departure:</strong> <?php echo $schedule['departure_time']; ?><br>
                             <strong>ETA:</strong> <?php echo $schedule['eta']; ?><br>
                             <strong>Price:</strong> Ksh <?php echo $schedule['price']; ?><br>
                         </p>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-6">
                 <form action="process_booking.php" method="POST">
                     <input type="hidden" name="schedule_id" value="<?php echo $scheduleId; ?>">
                     <div class="mb-3">
                         <label for="luggage_count" class="form-label">coming along with someone</label>
                         <br>
                         <i class="fs-6">How many are you ?.</i>
                         <input type="number" name="how_many" id="how_many" class="form-control" placeholder="optional"
                             required>
                     </div>
                     <div class="mb-3">
                         <label for="luggage_count" class="form-label">Number of Luggage</label>
                         <input type="number" name="luggage_count" id="luggage_count" class="form-control"
                             placeholder="optional" required>
                     </div>
                     <button type="submit" class="btn btn-primary">Book Now</button>

                     <a href="offers.php" class="btn btn-primary">Cancel</a>
             </div>
             </form>
         </div>
     </div>
     </div>
     <br> <br>
     <?php
      include "templates/inc/footer.php";
}