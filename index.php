<!-- php portion -->
<?php
  
// Username is root
$user = 'sql6410200';
$password = '8VAtkLmzsA'; 
  
// Database name is gfg
$database = 'sql6410200'; 
  
// Server is localhost with
// port number 3308
$servername='sql6.freesqldatabase.com:3306';
$mysqli = new mysqli($servername, $user, 
                $password, $database);
  
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' . 
    $mysqli->connect_errno . ') '. 
    $mysqli->connect_error);
}
$counter=1;
// SQL query to select data from database
$sql = "SELECT * FROM data";
$result = $mysqli->query($sql);
$mysqli->close(); 
?>
<!-- html portion -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>Covid Help Kolkata</title>
</head>
<body>
    <div class="container">
        <!-- Navbar and begining text -->
        <nav class="navbar sticky-top navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <span class="material-icons d-inline-block align-text-bottom covid-icon">
                    coronavirus
                    </span>
                <span>
                    COVID Help Kolkata
                </span>
              </a>
              <input class="btn btn-primary" type="button" value="I want to contribute">
            </div>
          </nav>
          <br>
          Find beds around Kolkata Hospitals as reported by fellow users
          <br>
          <br>

          <!-- Main table begins here -->

          <table class="table table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Hospital Name</th>
                <th scope="col">Earlier</th>
                <th scope="col">Last</th>
                <th scope="col">Latest</th>
              </tr>
            </thead>
            <tbody>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $counter?></td>
                <td ><?php echo $rows['hospital'];?></td>
                <!-- Button trigger modal -->
                <td>
                <div data-bs-toggle="tooltip" data-bs-placement="left" title="Updated by <?php echo $rows['addedBy3'];?>" >
                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#Modal_<?php echo $counter?>3">
                    <?php echo $rows['earlier'];?>
                  </button>
                </div>
                </td>
                <td>
                <div data-bs-toggle="tooltip" data-bs-placement="left" title="Updated by <?php echo $rows['addedBy2'];?>" >
                  <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#Modal_<?php echo $counter?>2">
                    <?php echo $rows['last'];?>
                  </button>
                </div>
                </td>
                <td>
                <div data-bs-toggle="tooltip" data-bs-placement="left" title="Updated by <?php echo $rows['addedBy1'];?>" >
                  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Modal_<?php echo $counter?>1">
                    <?php echo $rows['latest'];?>
                  </button>
                </div>
                </td>



                <!-- Modal 3 -->
                <div class="modal fade" id="Modal_<?php echo $counter?>3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        This information was provided by: 
                          <?php echo $rows['addedBy3'];?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Link to Facebook Profile</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal 2 -->
                <div class="modal fade" id="Modal_<?php echo $counter?>2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        This information was provided by: 
                          <?php echo $rows['addedBy2'];?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Link to Facebook Profile</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal 1 -->
                <div class="modal fade" id="Modal_<?php echo $counter?>1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        This information was provided by: 
                          <?php echo $rows['addedBy1'];?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Link to Facebook Profile</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- incrementing value of counter -->
                <?php $counter+=1 ?>

            </tr>
            <?php
                }
             ?>
            </tbody>
          </table>

    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="/script/script.js"></script>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    </script>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
          myInput.focus()
        })
    </script>
</body>
</html>