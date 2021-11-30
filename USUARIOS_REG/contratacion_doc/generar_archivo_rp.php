<?php
header("Pragma: no-cache");
setlocale(LC_TIME, 'Spanish');
$plant1 = isset($_GET["clase"]) ? $_GET["clase"] : '';
$id_auto_crpp = isset($_GET["id"]) ? $_GET["id"] : '';
$id_auto_ceva = isset($_GET["id_ceva"]) ? $_GET["id_ceva"] : '';
$plant = $plant1 . ".rtf";
if (file_exists($plant)) {
   $plantilla = file_get_contents($plant);
   // Agregamos los escapes necesarios   
   //$plantilla = addslashes($plantilla);
   $plantilla = str_replace("\\'f1", "'f1", $plantilla);
   $plantilla = str_replace("\\'e1", "'e1", $plantilla);
   $plantilla = str_replace("\\'e9", "'e9", $plantilla);
   $plantilla = str_replace("\\'ed", "'ed", $plantilla);
   $plantilla = str_replace("\\'f3", "'f3", $plantilla);
   $plantilla = str_replace("\\'fa", "'fa", $plantilla);
   $plantilla = str_replace("\\'c1", "'c1", $plantilla);
   $plantilla = str_replace("\\'c9", "'c9", $plantilla);
   $plantilla = str_replace("\\'93", "'93", $plantilla);
   $plantilla = str_replace("\\'94", "'94", $plantilla);
   $plantilla = str_replace("\\'d3", "'d3", $plantilla);
   $plantilla = str_replace("\\'cd", "'cd", $plantilla);
   $plantilla = str_replace("\\'da", "'da", $plantilla);
   $plantilla = str_replace("\\'5c", "'5c", $plantilla);
   // Datos de la plantilla   ---  Realizar consultas para cargar datos que se mostrarar en la plantilla 
   // Se puede manejar una estructura de control de acuerdo a la clase de contrato
   include('../config.php');
   $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

   // para pagos acumulados
   if ($id_auto_crpp == "") {
      $sq8 = "select * from cobp where ceva ='$id_auto_ceva'";
      $rs8 = $cx->query($sq8);
      $rw8 = $rs8->fetch_assoc();
      $id_auto_crpp = $rw8['id_auto_crpp'];

      $ban = "AUTO";

      //Consulto el a�o
      $res3 = $cx->query("select * from fecha");
      $row3 = $res3->fetch_assoc();
      $fecha = $row3["ano"];
      $anno = explode("/", $fecha);
      $vigencia = $anno[0];
      // Datos del registro presupuestal 
      $sqs = "select * from crpp where id_auto_crpp ='$id_auto_crpp'";
      $res = $cx->query($sqs);
      $fil = $res->num_rows;
      $row = $res->fetch_assoc();
      $ter_nat = $row["ter_nat"];
      $id_manu_cdpp = $row["id_manu_cdpp"];
      $id_manu_crpp = $row["id_manu_crpp"];
      $cuenta = $row["cuenta"];
      // Acumular imputaciones
      $i = 0;
      while ($rw4 = $res->fetch_assoc()) {
         $sq3 = "select nom_rubro from car_ppto_gas where cod_pptal ='$rw4[cuenta]'";
         $re3 = $cx->query($sq3);
         $rw3 = $re3->fetch_assoc();
         $nombre = $rw3['nom_rubro'];
         $cuentas .=  'al c�digo presupuestal No ' . $rw4['cuenta'] . ' - ' . $nombre . ' por valor de ' . number_format($rw4['vr_digitado'], 2, ',', '.') . ', ';
      }
      $sq7 = "select nom_rubro from car_ppto_gas where cod_pptal ='$cuenta'";
      $rs7 = $cx->query($sq7);
      $rw7 = $rs7->fetch_assoc();
      $nom_rubro = $rw7["nom_rubro"];
      $forma_pago = ucfirst(strtolower($row["pago"]));
      $ter_jur = $row["ter_jur"];
      if ($ter_nat != '') {
         $res4 = $cx->query("select * from terceros_naturales where id ='$ter_nat'");
         $row4 = $res4->fetch_assoc();
         $ter = $row4["pri_nom"] . " " . $row4["seg_nom"] . " " . $row4["pri_ape"] . " " . $row4["seg_ape"];
         $cc_nit = "C.C. " . $row4["num_id"];
      } else {
         $res5 = $cx->query("select * from terceros_juridicos where id ='$ter_jur'");
         $row5 = $res5->fetch_assoc();
         $ter = $row5["raz_soc2"];
         $cc_nit = "NIT " . $row5["num_id2"];
      }
      // Datos del contrato
      $res2 = $cx->query("select * from contrataciones2 where id_auto_crpp ='$id_auto_crpp'");
      $row2 = $res2->fetch_assoc();
      $clas_contrato = $row2["clas_contrato"];
      $cl_cont = array("", "PRESTACION DE SERVICIOS", "CONSULTORIA", "INTERVENTORIA", "MANTENIMIENTO Y/O REPARACION", "OBRA PUBLICA", "COMPRA Y/O SUMINISTRO", "CONCESION", "COMODATO", "ARRENDAMIENTO O ADQUISICION DE INMUEBLES", "FIDUCIA O ENCARGOS FIDUCITARIOS", "PRESTAMO O MUTUO", "TRANSPORTE", "PUBLICIDAD", "DEPOSITO", "SEGUROS", "PRESTACION DE LOS SERVICIOS DE SALUD", "CONTRATO INTERADMINISTRATIVO", "DESARROLLO DE ACT. CIENTIFICAS Y TECNOLOGICAS", "OTROS");
      $i = 0;
      for ($i = 0; $i <= 19; $i++) {
         if ($clas_contrato == 'C' . $i) {
            $clase_contrato = $cl_cont[$i];
         }
      }

      $num_contrato = $row2["num_contrato"];
      $fec_firma = $row2["fec_firma"];
      $concepto = $row2['objeto'];
      //$fec_larga = strftime("%d d�as del mes de %B de %Y",strtotime("$fec_firma"));
      //$fec_resol = strftime("De %B %d de %Y",strtotime("$fec_firma"));
      $valor_inicial = number_format($row2["valor_inicial"], 2, ',', '.');
      $num = $row2["valor_inicial"];
      // Datos del pago
      $filtro = "and id_auto_crpp ='$id_auto_crpp'";
      if ($ban == 'AUTO') {
         $filtro = "";
      }
      $res3 = $cx->query("select * from ceva where id_auto_ceva ='$id_auto_ceva' $filtro");
      $row3 = $res3->fetch_assoc();
      $fecha_pago = $row3['fecha_ceva'];
      $id_manu_ceva =  $row3['id_manu_ceva'];

      $fec_resol = strftime("De %B %d de %Y", strtotime("$fecha_pago"));
      $fec_larga = strftime("(%d) d�as del mes de %B de %Y", strtotime("$fecha_pago"));
      $num_rp = $row3['id'];
      // datos del cobp
      $sql6 = "select vr_digitado as total,des_cobp  from cobp where id_auto_crpp ='$id_auto_crpp' group by id_auto_crpp";
      $res4 = $cx->query($sql6);
      while ($row4 = $res4->fetch_assoc()) {
         $valor_cobp = $row4['total'];
         $concepto = $sql6; //$row4['des_cobp'];
      }
      $valor_inicial = number_format($valor_cobp, 2, ',', '.');
      if ($ban == 'AUTO') {
         $sq9 = "select sum(vr_digitado) as total_p from cobp where ceva ='$id_auto_ceva'";
         $rs9 = $cx->query($sq9);
         $rw9 = $rs9->fetch_assoc();
         $valor_cobp = $rw9['total_p'];
         $valor_inicial = number_format($valor_cobp, 2, ',', '.');
      }

      // ********************************************************************************************************************
      // Variables cunado el envio se hace desde COBP
      $id_cobp = $_GET['id_cobp'];
      if ($id_cobp) {
         $sql6 = "select des_cobp,tercero,ccnit,fecha_cobp,cuenta from cobp where id_auto_cobp ='$id_cobp'";
         $res4 = $cx->query($sql6);
         while ($row4 = $res4->fetch_assoc()) {
            $ter = $row4['tercero'];
            $concepto = $row4['des_cobp'];
            $ccnit = $row4['ccnit'];
            $fecha_pago = $row4['fecha_cobp'];
            $cuenta = $row4['cuenta'];
         }
         $sq7 = "select nom_rubro from car_ppto_gas where cod_pptal ='$cuenta'";
         $rs7 = $cx->query($sq7);
         $rw7 = $rs7->fetch_assoc();
         $nom_rubro = $rw7["nom_rubro"];

         // consulta del valor total obligado
         $sq5 = "select sum(vr_digitado) from cobp where id_auto_cobp ='$id_cobp' group by id_auto_cobp";
         $re5 = $cx->query($sq5);
         $rw5 = $re5->fetch_assoc();
         $valor_cobp = $rw5['sum(vr_digitado)'];
         $valor_inicial = number_format($valor_cobp, 2, ',', '.');
         // Formato de fechas
         $fec_resol = strftime("De %B %d de %Y", strtotime("$fecha_pago"));
         $fec_larga = strftime("%d d�as del mes de %B de %Y", strtotime("$fecha_pago"));
      }
      // fin COBP ************************************************************************************************************
      class EnLetras
      {
         var $Void = "";
         var $SP = " ";
         var $Dot = ".";
         var $Zero = "0";
         var $Neg = "MENOS";

         function ValorEnLetras($x, $Moneda)
         {
            $s = "";
            $Ent = "";
            $Frc = "";
            $Signo = "";

            if (floatVal($x) < 0)
               $Signo = $this->Neg . " ";
            else
               $Signo = "";

            if (intval(number_format($x, 2, '.', '')) != $x) //<- averiguar si tiene decimales
               $s = number_format($x, 2, '.', '');
            else
               $s = number_format($x, 0, '.', '');

            $Pto = strpos($s, $this->Dot);

            if ($Pto === false) {
               $Ent = $s;
               $Frc = $this->Void;
            } else {
               $Ent = substr($s, 0, $Pto);
               $Frc =  substr($s, $Pto + 1);
            }

            if ($Ent == $this->Zero || $Ent == $this->Void)
               $s = "CERO ";
            elseif (strlen($Ent) > 7) {
               $s = $this->SubValLetra(intval(substr($Ent, 0,  strlen($Ent) - 6))) .
                  "MILLONES " . $this->SubValLetra(intval(substr($Ent, -6, 6)));
            } else {
               $s = $this->SubValLetra(intval($Ent));
            }

            if (substr($s, -9, 9) == "MILLONES " || substr($s, -7, 7) == "MILLON ")
               $s = $s . "de ";

            $s = $s . $Moneda;

            if ($Frc != $this->Void) {
               $s = $s . " CON " . $this->SubValLetra(intval($Frc)) . "CENTAVOS";
               //$s = $s . " " . $Frc . "/100";
            }
            return ($Signo . $s . " M/CTE");
         }


         function SubValLetra($numero)
         {
            $Ptr = "";
            $n = 0;
            $i = 0;
            $x = "";
            $Rtn = "";
            $Tem = "";

            $x = trim("$numero");
            $n = strlen($x);

            $Tem = $this->Void;
            $i = $n;

            while ($i > 0) {
               $Tem = $this->Parte(intval(substr($x, $n - $i, 1) .
                  str_repeat($this->Zero, $i - 1)));
               if ($Tem != "CERO")
                  $Rtn .= $Tem . $this->SP;
               $i = $i - 1;
            }


            //--------------------- GoSub FiltroMil ------------------------------
            $Rtn = str_replace(" MIL MIL", " UN MIL", $Rtn);
            while (1) {
               $Ptr = strpos($Rtn, "MIL ");
               if (!($Ptr === false)) {
                  if (!(strpos($Rtn, "MIL ", $Ptr + 1) === false))
                     $this->ReplaceStringFrom($Rtn, "MIL ", "", $Ptr);
                  else
                     break;
               } else break;
            }

            //--------------------- GoSub FiltroCiento ------------------------------
            $Ptr = -1;
            do {
               $Ptr = strpos($Rtn, "CIEN ", $Ptr + 1);
               if (!($Ptr === false)) {
                  $Tem = substr($Rtn, $Ptr + 5, 1);
                  if ($Tem == "M" || $Tem == $this->Void);
                  else
                     $this->ReplaceStringFrom($Rtn, "CIEN", "CIENTO", $Ptr);
               }
            } while (!($Ptr === false));

            //--------------------- FiltroEspeciales ------------------------------
            $Rtn = str_replace("DIEZ UN", "ONCE", $Rtn);
            $Rtn = str_replace("DIEZ DOS", "DOCE", $Rtn);
            $Rtn = str_replace("DIEZ TRES", "TRECE", $Rtn);
            $Rtn = str_replace("DIEZ CUATRO", "CATORCE", $Rtn);
            $Rtn = str_replace("DIEZ CINCO", "QUINCE", $Rtn);
            $Rtn = str_replace("DIEZ SEIS", "DIECISEIS", $Rtn);
            $Rtn = str_replace("DIEZ SIETE", "DIECISIETE", $Rtn);
            $Rtn = str_replace("DIEZ OCHO", "DIECIOCHO", $Rtn);
            $Rtn = str_replace("DIEZ NUEVE", "DIECINUEVE", $Rtn);
            $Rtn = str_replace("VEINTE UN", "VEINTIUN", $Rtn);
            $Rtn = str_replace("VEINTE DOS", "VEINTIDOS", $Rtn);
            $Rtn = str_replace("VEINTE TRES", "VEINTITRES", $Rtn);
            $Rtn = str_replace("VEINTE CUATRO", "VEINTICUATRO", $Rtn);
            $Rtn = str_replace("VEINTE CINCO", "VEINTICINCO", $Rtn);
            $Rtn = str_replace("VEINTE SEIS", "VEINTISEIS", $Rtn);
            $Rtn = str_replace("VEINTE SIETE", "VEINTISIETE", $Rtn);
            $Rtn = str_replace("VEINTE OCHO", "VEINTIOCHO", $Rtn);
            $Rtn = str_replace("VEINTE NUEVE", "VEINTINUEVE", $Rtn);

            //--------------------- FiltroUn ------------------------------
            if (substr($Rtn, 0, 1) == "M") $Rtn = "UN " . $Rtn;
            //--------------------- Adicionar Y ------------------------------
            for ($i = 65; $i <= 88; $i++) {
               if ($i != 77)
                  $Rtn = str_replace("A " . Chr($i), "* Y " . Chr($i), $Rtn);
            }
            $Rtn = str_replace("*", "A", $Rtn);
            return ($Rtn);
         }


         function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
         {
            $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
         }


         function Parte($x)
         {
            $Rtn = '';
            $t = '';
            $i = 0;
            do {
               switch ($x) {
                  case 0:
                     $t = "CERO";
                     break;
                  case 1:
                     $t = "UN";
                     break;
                  case 2:
                     $t = "DOS";
                     break;
                  case 3:
                     $t = "TRES";
                     break;
                  case 4:
                     $t = "CUATRO";
                     break;
                  case 5:
                     $t = "CINCO";
                     break;
                  case 6:
                     $t = "SEIS";
                     break;
                  case 7:
                     $t = "SIETE";
                     break;
                  case 8:
                     $t = "OCHO";
                     break;
                  case 9:
                     $t = "NUEVE";
                     break;
                  case 10:
                     $t = "DIEZ";
                     break;
                  case 20:
                     $t = "VEINTE";
                     break;
                  case 30:
                     $t = "TREINTA";
                     break;
                  case 40:
                     $t = "CUARENTA";
                     break;
                  case 50:
                     $t = "CINCUENTA";
                     break;
                  case 60:
                     $t = "SESENTA";
                     break;
                  case 70:
                     $t = "SETENTA";
                     break;
                  case 80:
                     $t = "OCHENTA";
                     break;
                  case 90:
                     $t = "NOVENTA";
                     break;
                  case 100:
                     $t = "CIEN";
                     break;
                  case 200:
                     $t = "DOSCIENTOS";
                     break;
                  case 300:
                     $t = "TRESCIENTOS";
                     break;
                  case 400:
                     $t = "CUATROCIENTOS";
                     break;
                  case 500:
                     $t = "QUINIENTOS";
                     break;
                  case 600:
                     $t = "SEISCIENTOS";
                     break;
                  case 700:
                     $t = "SETECIENTOS";
                     break;
                  case 800:
                     $t = "OCHOCIENTOS";
                     break;
                  case 900:
                     $t = "NOVECIENTOS";
                     break;
                  case 1000:
                     $t = "MIL";
                     break;
                  case 1000000:
                     $t = "MILLON";
                     break;
               }

               if ($t == $this->Void) {
                  $i = $i + 1;
                  $x = $x / 1000;
                  if ($x == 0) $i = 0;
               } else
                  break;
            } while ($i != 0);

            $Rtn = $t;
            switch ($i) {
               case 0:
                  $t = $this->Void;
                  break;
               case 1:
                  $t = " MIL";
                  break;
               case 2:
                  $t = " MILLONES";
                  break;
               case 3:
                  $t = " BILLONES";
                  break;
            }
            return ($Rtn . $t);
         }
      }
      // divido la fecha de pago para obtener el dia
      $dia_pago = explode("/", $fecha_pago);
      $dia_p = $dia_pago[2] * 1;
      $V = new EnLetras();
      $dia_letras = $V->ValorEnLetras($dia_p, "");
      $dia_let = strtolower($dia_letras);
      $dia = substr($dia_let, 0, -7);
      $V = new EnLetras();
      $valor_letras = $V->ValorEnLetras($valor_cobp, "PESOS");
      $multa_valor_base = round($num * 0.2, 0);
      $multa_valor = number_format($multa_valor_base, 2, ',', '.');
      $W = new EnLetras();
      $multa_letras = $W->ValorEnLetras($multa_valor_base, "PESOS");
      $plazo_contrato = $row2["plazo_contrato"];
      $plazo_unidad = 'D�as';
      //$objeto =ucfirst(strtolower($row2["objeto"]));
      $espacio = ' ';
      $fec_ter1 = date("Y/m/d", strtotime("$fec_firma + $plazo_contrato day"));
      $fec_ter = strftime("el %d de %B de %Y", strtotime("$fec_ter1"));

      // Procesa la plantilla  
      $rtf ='<<<EOF_RTF $plantilla EOF_RTF';
      eval("\$rtf = \"$rtf\";"); 
      //eval($rtf = '<<<EOF_RTF' . $plantilla . 'EOF_RTF;');
      //OBTENIENDO EL NOMBRE  
      $aleat = rand(10, 50);
      $nombre_def = "Archivo_" . $num_contrato . $aleat . ".doc";
      file_put_contents($nombre_def, $rtf);

      if (!file_exists($nombre_def)) {
         echo "Ocurrio un error al generar el documento de word correspondiente";
      } else {
         $aleatorio = rand(1, 10000000);
         $hash_is = md5($aleatorio);
         $carpeta = $hash_is;
         mkdir("$carpeta", 0777);
         $nuevoarchivo = "$carpeta/$nombre_def";
         if (!copy($nombre_def, $nuevoarchivo)) {
            echo "Ocurrio un error al generar el documento de word Temporal correspondiente";
         }
         $path_a_tu_doc = "$carpeta";
         $enlace = $path_a_tu_doc . "/" . $nombre_def;
         header("Pragma: no-cache");
         header("Content-Type: application/msword");
         header("Content-Disposition: attachment; filename=" . $nombre_def . "\n\n");
         header("Content-Length: " . filesize($enlace));
         readfile($enlace);
      }
      //ELIMINA ARCHIVO   
      unlink($enlace);
      unlink($nombre_def);
      //ELIMINA DIRECTORIO   
      rmdir($path_a_tu_doc);
   } else {
      echo "No existe una plantilla definida para el contrato seleccionado : $plant1";
   }
}
