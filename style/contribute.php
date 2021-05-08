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
<!-- Load facebook scripts -->
<script src="/script/facebookLogin.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <div class="container">
        <nav class="navbar sticky-top navbar-dark bg-dark navbar-expand">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <span class="material-icons d-inline-block align-text-bottom covid-icon">
                    coronavirus
                    </span>
                <span>
                    COVID Help Kolkata
                </span>
              </a>
              <div class="navbar-nav">
                <div class=" btn nav-link">
                    <span class="material-icons d-inline-block align-text-bottom">
                        account_circle
                    </span>
                    <span id="profileName">
                        Not logged in
                    </span>
                    <button type="button" class="btn btn-danger collapse" id="logOutBtn" onclick="logOut()">Log out</button>
                </div>
                <a href="/index.php" class="nav-link">
                    <button type="button" class="btn btn-primary">Back to List</button>
                </a>
            </div>
            </div>
        </nav>
        <br>
        <br>
        <span><h1> <strong>1.</strong> <span style="color: grey">Update existing hospitals</span></h1></span>
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
        <div class="resultpane row">
            <!-- results of hospital select -->
            <div class="result col-6 collapse" id="result">
                <div class="card">
                    <div class="card-header">
                        Hospital info
                    </div>
                <div class="card-body">
                    <h5 class="card-title" id="hospitalName">Special title treatment</h5>
                    <p class="card-text" id="currentBeds">With supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text" id="addedBy">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary" onclick="displayUpdatePane()">Update</a>
                </div>
                </div>
            </div>
            <!-- update window -->
            <div class="col-6 collapse" id="update" >
                <div class="card">
                    <div class="card-header">
                        Update Info
                        <button type="button"  style="float: right" class="btn btn-close" aria-label="Close" onclick="closeUpdate()"></button>
                    </div>
                    <div class="card-body">
                    <form action="">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Enter your name</span>
                            <input type="text" id="name" class="form-control" aria-label="Name">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Enter beds</span>
                            <input type="number" id="beds" class="form-control" aria-label="Beds">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">More details if any</span>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                        </div>
                        <br>
                        <button type="button" id="updateBtn" class="btn btn-primary" onclick="updateData()">
                            <span id="statusSpinner" class="spinner-border spinner-border-sm collapse" role="status" aria-hidden="true"></span>
                            <span id="status">Update</span>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center"><h1 style="color:grey">Or</h1></div>
        <br>
        <span><h1> <strong>2.</strong> <span style="color: grey">Create new entry</span></h1></span>
        <br>
        <h4>Enter details of the hospital below and provide the number of beds</h4>
        <br>
        <!-- new hospital -->
        <div class="col-6 " id="create" >
                <div class="card">
                    <div class="card-header">
                        Create Info
                    </div>
                    <div class="card-body">
                    <form action="">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Enter your name</span>
                            <input type="text" id="createName" class="form-control" aria-label="Name">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Enter Hospital Name</span>
                            <input type="text" id="createHospitalName" class="form-control" aria-label="Name">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Enter beds</span>
                            <input type="number" id="createBeds" class="form-control" aria-label="Beds">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">More details if any</span>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                        </div>
                        <br>
                        <button type="button" id="createBtn" class="btn btn-primary" onclick="createData()">
                            <span id="statusCreateSpinner" class="spinner-border spinner-border-sm collapse" role="status" aria-hidden="true"></span>
                            <span id="statusCreate">Create</span>
                        </button>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Create Modal -->
        <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabels" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                New entry has been created;
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/index.php">
                <button type="button" class="btn btn-primary">Return to List</button>
                </a>
                </div>
            </div>
            </div>
        </div>

        <!-- Duplicate Entry Modal -->
        <div class="modal fade" id="duplicateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabels" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Failure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Failed to create new entry
                <br>
                Please check if duplicate hospital exists and try again.
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Not Logged In Modal -->
        <div class="modal fade" id="notLoggedInModal" tabindex="-1" aria-labelledby="staticBackdropLabels" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Failure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Not logged in. Please log into Facebook to contribute
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="logIn()" >Login to Facebook</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Log In success -->
        <div class="modal fade" id="successLogInModal" tabindex="-1" aria-labelledby="staticBackdropLabels" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Logged in Facebook. Proceed Entering data
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Log out module -->
        <div class="modal fade" id="logOutModal" tabindex="-1" aria-labelledby="staticBackdropLabels" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Successfully logged out of Facebook
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                </div>
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