function selectHospital(){
    var x=document.getElementById("hospitalList");
    if(x.value.length!=0){
        var bt=document.getElementById("selectBtn");
        bt.classList.toggle('disabled');
    }
    else{
        var bt=document.getElementById("selectBtn");
        bt.classList.toggle('disabled');
        document.getElementById("result").classList.remove("show");
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
    alert(requestString);
    xhttp.send(requestString);
};