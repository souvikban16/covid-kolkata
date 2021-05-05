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