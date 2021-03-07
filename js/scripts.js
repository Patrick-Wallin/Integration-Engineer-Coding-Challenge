
const btnRefreshMembers = document.getElementById('btn-refresh-members');
const cbxShowXML = document.getElementById('cbx-show-xml');
const urlSenators = "api/senators.php?";

window.addEventListener('load', (event) => {
    refreshMembers();
});

btnRefreshMembers.addEventListener('click', function (event) {
    refreshMembers();
});

cbxShowXML.addEventListener('change', function() {
    if(this.checked) {
        document.getElementById('display-xml').style.display='block';
    }else {
        document.getElementById('display-xml').style.display='none';
    }
});

function refreshMembers() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          displayXML();
          displayJSON();
      }
    };
    xhttp.open("GET", urlSenators + 'process');
    xhttp.send();  
}

function displayXML() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('display-xml-data').value = this.responseText;
      }
    };
    xhttp.open("GET", urlSenators + 'xml');
    xhttp.send();      
}

function displayJSON() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('display-json-data').value = this.responseText;
      }
    };
    xhttp.open("GET", urlSenators + 'json');
    xhttp.send();      
}

