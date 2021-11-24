<?
header('Content-Type: text/html; charset=latin1'); 
include '../config.php';
$cx=mysql_connect($server,$dbuser,$dbpass);
mysql_select_db("$database"); 
?>
<script>
//************************************************  AREA DE TRABAJO JAVASCRIPT ************************************************ */
function prosForm()
{
		//document.getElementById('caja5').style.display="block";
		//document.getElementById("estado").value='';
       
    var camposenv = ["id_crpp","centros","valor"]; 
		var datos ='';
		var element =camposenv.length;
		var ruta ='agregar_cc.php';
    var campo='mostrar';
		datos ="?id="+document.getElementById("id2").value;
		for (i=0;i<element;i++)
		{
			datos +="&"+camposenv[i]+"="+escape(document.getElementById(camposenv[i]).value);
		}
		archivo =(ruta+datos);
    $("#"+campo).load(archivo);	
    return false;
        
}

</script>

<div class="container">
  <form method="post" onsubmit="return prosForm();">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 col-form-label">Centro de costo</label>
    <div class="col-sm-8">
    <input type="hidden" name="id2" id="id2" >
     <input list="ccostos" name="ccostos" id="centros" required >
        <datalist id="ccostos">
            <? 
                $sq3="select id,nombre from cc";
                $rs3 =mysql_query($sq3,$cx);
                while ($rw3 =mysql_fetch_array($rs3))
                {
                    echo "<option value='$rw3[id]- $rw3[nombre]'>";    
                }
            ?>
        </datalist>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-3 col-form-label">Valor porcentual</label>
    <div class="col-sm-8">
    <input type="number" name="valor" id="valor" min="1" max="100" step="1"  required="required">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <button type="submit" class="btn btn-primary btn-sm" >Enviar</button>
    </div>
  </div>
</form>
</div>