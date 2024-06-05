<?php 
 include "include/connection.php";
 include "include/header.php";

 if(isset($_GET['date'])){
    $date = $_GET['date'];

 }

 /*$select= "SELECT * FROM user_tbl WHERE userID='$id'";
 $result=mysqli_query($con, $select);
 $row=mysqli_fetch_assoc($result);
 
 if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO appointment_tbl (date, userID) VALUES ('$date','$id')";
    $msg = "<div class='alert alert-success'>Booking Successful</div>";

 }
*/
 $duration = 60;
 $cleanup = 0;
 $start = "07:00";
 $end = "19:00";

 function timeslots($duration,$cleanup,$start,$end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod > $end){
            break;
        }
        $slots[] = $intStart->format("h:iA")."-".$endPeriod->format("h:iA");
    }
    return $slots;
 }
?>
    <div class="container">
        <h2 class="text-center">Book for Date: <?php echo date('m/d/Y',strtotime($date));?></h2><hr>
        <div class="row mt-5">
            <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
                foreach($timeslots as $ts){
            ?>
            <div class="col-md-2">
                <div class="form-group mb-3">
                    <button class="btn btn-dark btn-xs px-3 book" data-bs-toggle="modal" data-bs-target="#exampleModal" data-timeslot="<?php echo $ts;?>"><?php echo $ts;?></button>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Modal -->
<form action="add.php" method="post" autocomplete="off">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="slot">Booking</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group row mb-2">
              <div class="mb-2">
                <label for="timeslot">Timeslot</label>
                <input type="text" name="timeslot" id="timeslot" class="form-control" required readonly/>
              </div>
              <div class="mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
              </div>
              <div class="col">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" readonly/>
              </div>
              <div class="col">
                <label for="">Phone Number</label>
                <input type="text" class="form-control" name="phonenum" value="<?php echo $row['phonenumber'] ?>" readonly/>
              </div>
              <div class="mb-2">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required/>
              </div>
              <div class="mb-2">
                <label for="password">Confirm Password</label>
                <input type="password" name="conpass" class="form-control" required/>
              </div>
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php include "include/footer.php";?>