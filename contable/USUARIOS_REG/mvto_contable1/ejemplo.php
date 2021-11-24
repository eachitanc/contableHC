<html>
<head>
</head>
<script>
function chk_ncon(){
var pos_url = '../comprobadores/comprueba_ncon.php';
var cod = document.getElementById('id_manu_ncon').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_ncon').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>
<body>  


<table>
  <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;"> <span class="Estilo12">
     <input name="id_manu_ncon" type="text" class="required Estilo4" id="id_manu_ncon" style="text-align:center"  onkeyup="chk_ncon();"/>
    </span> </div>
	
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div class="Estilo4" align="center" id='res_ncon'></div>
        </div>
              
            </div>
          </div>
        </div>
	
	</td>
</table>
</body>





