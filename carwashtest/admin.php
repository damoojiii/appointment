<?php 
 include "include/connection.php";
 include "include/header.php"; 
?>

<div class="container px-3 pt-4">
<?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>
<div class="mb-4">
  <h3>Staff Information</h3>
</div>
<button class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Staff</button>
<table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Username</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM staff_tbl";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["staffID"] ?></td>
            <td><?php echo $row["firstname"] ?></td>
            <td><?php echo $row["lastname"] ?></td>
            <td><?php echo $row["username"] ?></td>
            <td><?php echo $row["phonenum"] ?></td>
            <td>
              <a href="update.php?id=<?php echo $row["staffID"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a onclick="return confirm('Are you sure you want to delete this record?')" href="delete.php?id=<?php echo $row["staffID"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

</div>

<!-- Modal -->
<form action="add.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Staff</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group row mb-2">
              <div class="col">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" class="form-control" required/>
              </div>
              <div class="col">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" class="form-control" required/>
              </div>
              <div class="mb-2">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required/>
              </div>
              <div class="mb-2">
                <label for="phonenum">Phone Number</label>
                <input type="number" name="phonenum" class="form-control" maxlength="11" required/>
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

<?php include "include/footer.php"; ?>