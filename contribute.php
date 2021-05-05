<!-- php portion -->
<?php
require "connect.php";
$counter = 1;
// SQL query to select data from database
$sql = "SELECT * FROM data";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- Html portion -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>Covid Help Kolkata</title>
</head>
<body>
    <div class="container">
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
              <a href="index.php">
                <input class="btn btn-primary" type="button" value="Back to Lists">
              </a>
              <input class="btn btn-primary" type="button" value="Back to Lists">
            </div>
        </nav>
        <br>
        <br>
        <h4>Please find the Hospital name from the dropdown below and provide the number of beds</h4>
        <br>

        <form class="row">
        <label for="exampleDataList" class="form-label">Hospital Name</label>
        <div class="col-6">
            
            <input class="form-control" list="datalistOptions" id="hospitalList" placeholder="Type to search..." onchange="selectHospital()">
            <datalist id="datalistOptions" >
            <option disabled selected value> -- select an option -- </option>
            <?php // LOOP TILL END OF DATA
            while ($rows = $result->fetch_assoc()) {
            ?>
             <option value="<?php echo $rows['hospital']; ?>">
             <?php
                }
            ?>
            </datalist>
        </div>
        <div class="col-6">
                <button type="button" id="selectBtn" class="btn btn-primary disabled" onclick="requestData()" >Select Hospital</button>
            </div>
        </form>
        <br>
        <div class="spinner-border collapse" id="spinner" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="result col-6 collapse" id="result">
            <div class="card">
                <div class="card-header">
                    Data info
                </div>
            <div class="card-body">
                <h5 class="card-title" id="hospitalName">Special title treatment</h5>
                <p class="card-text" id="currentBeds">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text" id="addedBy">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Update</a>
            </div>
            </div>
        </div>


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

            myModal.addEventListener('shown.bs.modal', function () {myInput.focus()})
    </script>
</body>
</html>