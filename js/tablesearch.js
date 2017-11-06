function csearch() {
document.getElementById("headingc").style.display = "none";
document.getElementById("headdivc").style.display = "none";
document.getElementById("sname-c").style.display = "block";
var e = document.getElementById("fromto");
  var strUser = e.options[e.selectedIndex].value;
  var dt = document.getElementById("datesearch").value;
  var xx,da;
	da=dt.toString();
	var a,b,c;
	 a = da.substring(0, 4);
		 b = da.substring(5, 7);
		 c = da.substring(8, 10);
	if(strUser=="fr"){xx=1;
				   }
	else if(strUser=="ca"){ xx=2;}
	else {xx=0;}
    var dm = b.concat(c);
	var date=a.concat(dm);
    if (xx == "") {
        document.getElementById("myTable").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("myTable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","trial2.php?req="+xx+"&dt="+date,true);
        xmlhttp.send();
    }
}

function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("sname-c");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    tm= tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || tm.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function logdropdown() {
document.getElementById("logindropdown").style.display = "block";
}