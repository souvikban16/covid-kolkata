function selectHospital(){
    var x=document.getElementById("hospitalList");
    if(x.value.length!=0){
        var bt=document.getElementById("selectBtn");
        bt.classList.remove("disabled");
    }
    else{
        var bt=document.getElementById("selectBtn");
        bt.classList.add('disabled');
        document.getElementById("result").classList.remove("show");
        closeUpdate();
    }
    
};

function requestData(){
    document.getElementById("spinner").classList.add("show");
    var hospital=document.getElementById("hospitalList");
    var requestString="hospital='"+hospital.value+"'";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("spinner").classList.remove("show");
        var myObj = JSON.parse(this.responseText);
        document.getElementById("result").classList.add("show");
        document.getElementById("hospitalName").innerHTML=hospital.value;
        document.getElementById("currentBeds").innerHTML="Last available beds: "+ myObj.beds;
        document.getElementById("addedBy").innerHTML="Data provided by: " + myObj.addedBy;
      }
    };
    xhttp.open("POST", "requestData.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(requestString);
};

function displayUpdatePane(){
  document.getElementById("update").classList.add("show");
};

function updateData(){
    //first check if person is logged into facebook
    if(checkLogin()==="not connected"){//if the user is not logged in
      askLogin()//let the modal handle the next call. Modals don't return anything. BS
      return; // don't proceed with creating new data
      console.log("not connected it seems")
    }
  
  
  //make the button loading animation
  document.getElementById('updateBtn').classList.add("disabled");
  document.getElementById('status').innerHTML="Updating";
  document.getElementById('statusSpinner').classList.remove("collapse");
  var uploaderName=document.getElementById("name").value;
  var newBeds=document.getElementById("beds").value;
  var hospital=document.getElementById("hospitalList");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //make that button to sucess
      document.getElementById('updateBtn').classList.replace("btn-primary", "btn-success");
      document.getElementById('status').innerHTML="Success";
      document.getElementById('statusSpinner').classList.add("collapse");
    }
  };
  xhttp.open("POST", "updateData.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var requestString="name='"+uploaderName+"'&beds="+newBeds+"&hospital='"+hospital.value+"'";
  xhttp.send(requestString);
};

function closeUpdate(){
  document.getElementById("update").classList.remove("show");
  document.getElementById('updateBtn').classList.replace("btn-success", "btn-primary");
  document.getElementById('updateBtn').classList.remove("disabled");
  document.getElementById('status').innerHTML="Update";
  document.getElementById('statusSpinner').classList.add("collapse");
};

function createData(){
  //first check if person is logged into facebook
  if(checkLogin()==="not connected"){//if the user is not logged in
    askLogin()//let the modal handle the next call. Modals don't return anything. BS
    return; // don't proceed with creating new data
  }



  //make the button loading animation
  document.getElementById('createBtn').classList.add("disabled");
  document.getElementById('statusCreate').innerHTML="Creating";
  document.getElementById('statusCreateSpinner').classList.remove("collapse");
  var uploaderName=document.getElementById("createName").value;
  var newHospital=document.getElementById("createHospitalName").value;
  var newBeds=document.getElementById("createBeds").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //make that button to sucess
      // alert(this.responseText);
      if(this.responseText=="1"){
        document.getElementById('createBtn').classList.replace("btn-primary", "btn-success");
        document.getElementById('statusCreate').innerHTML="Success";
        document.getElementById('statusCreateSpinner').classList.add("collapse");
        var myModal = new bootstrap.Modal(document.getElementById('createModal'));
        myModal.show();
        resetCreate();
      }
      else{
        // alert("Please check if hospital already exists or the provided info is correct");
        var alertModal = new bootstrap.Modal(document.getElementById('duplicateModal'));
        alertModal.show();
        resetCreate();
      }
    }
  };
  xhttp.open("POST", "createData.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var requestString="name='"+uploaderName+"'&beds="+newBeds+"&hospital='"+newHospital+"'";
  // alert(requestString)
  xhttp.send(requestString);
};

function resetCreate(){
  document.getElementById('createBtn').classList.replace("btn-success", "btn-primary");
  document.getElementById('createBtn').classList.remove("disabled");
  document.getElementById('statusCreate').innerHTML="Create";
  document.getElementById('statusCreateSpinner').classList.add("collapse");
};

function askLogin(){
  var myModal = new bootstrap.Modal(document.getElementById('notLoggedInModal'));
  // invoke modal
  myModal.show();
};