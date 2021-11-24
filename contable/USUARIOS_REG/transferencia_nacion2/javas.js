function masitem(val){
  document.getElementById('contador').value = eval(parseInt(document.getElementById('contador').value)+1);
  if(document.getElementById('contador').value > val){document.getElementById('contador').value = val;}
  rasca(document.getElementById('contador').value,val);
  document.getElementById('contis').innerHTML = document.getElementById('contador').value;
}

function menitem(){
  document.getElementById('contador').value = eval(parseInt(document.getElementById('contador').value)-1);
  if(document.getElementById('contador').value < 3){document.getElementById('contador').value='2';}
  rasca(document.getElementById('contador').value);
  document.getElementById('contis').innerHTML = document.getElementById('contador').value;
}

function rasca(val,con){
 veapues();
 var ide='',co1='',co2='',resulta='',pgcp='';
 var i = 0;
 for(i=3;i<=val;i++){
   ide = 'fil' + eval(i);
   xDisplay(ide,'block');
 }
 for(i=(parseInt(val)+1);i<=con;i++){
   co1 = 'vr_deb_'+eval(i);
   co2 = 'vr_cre_'+eval(i);
   resulta = 'des'+eval(i);
   pgcp = 'pgcp'+eval(i);
   document.getElementById(pgcp).value='';
   document.getElementById(co1).value = '';
   document.getElementById(co2).value = '';
   document.getElementById(resulta).innerHTML = '';
 }
 Calcular();
}

function siespgcp(ide){
  var pgcp = 'pgcp' + eval(ide);
  var valor = document.getElementById(pgcp).value;
  if(valor != ''){
    var ajax=objetoAjax();
    var resulta = 'des' + eval(ide);
    ajax.open("POST", "buspgcp.php");
    ajax.onreadystatechange=function()
    { if (ajax.readyState==4) {
       var res = parseInt(ajax.responseText);
       ocultboxer(ide);
       if(res == 0){
           alert("La Cuenta "+valor+" no existe o es tipo Mayor:\n1. Seleccione una de la lista\n2. Agregar una nueva - Item 4.2 del menu");
           document.getElementById(pgcp).value = '';
           document.getElementById(resulta).value = '';
           document.getElementById(pgcp).focus();
          }
        else{document.getElementById(resulta).value = ajax.responseText;}
    }
   }
   ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   ajax.send("val="+valor);
 }
}

function veapues(){
 for(var i=3;i<=51;i++){
   ide = 'fil' + eval(i);
   xDisplay(ide,'none');
 }
}

function lookup(inputString,ide) {
        var sugges = '#sugges' + eval(ide);
        var autoSug = '#autoSug' + eval(ide);
        if(inputString.length == 0) {
            $(sugges).hide();
        } else {
            $.post("rpc.php", {queryString: ""+inputString+"",qid: ""+ide+""}, function(data){
                if(data.length >0) {
                    $(sugges).show();
                    $(autoSug).html(data);
                }
                else{
                   $(sugges).hide();
                }
            });
        }
    }
function fill(obj,ide) {
      var sugges = '#sugges' + eval(ide);
      var valor = obj.id;
      var pgcp = 'pgcp' + eval(ide);
      var resulta = 'des' + eval(ide);
       var tes = 0;
       var ch = '';
       var maso = new Array('','');
       $(sugges).hide();
       for (i = 0; i < valor.length; i++) {
         ch = valor.charAt(i);
         if (ch == '/'){tes=1;}
         else{maso[tes] = maso[tes] + ch;}
       }
        document.getElementById(pgcp).value = maso[0];
        document.getElementById(resulta).value = maso[1];
        siespgcp(ide);
    }
function ocultboxer(ide) {
        var sugges = '#sugges' + eval(ide);
        $(sugges).hide();
}

function Calcular(){
  var can = parseInt(document.getElementById('contador').value);
  var co1="",co2="";
  var to1=0,to2=0,dif=0;
  for(var i = 1;i <= can; i++){
    co1 = 'vr_deb_'+eval(i);
    co2 = 'vr_cre_'+eval(i);
    if(document.getElementById(co1).value != ""){
        to1 = to1 + parseFloat(document.getElementById(co1).value);}
    if(document.getElementById(co2).value != ""){
        to2 = to2 + parseFloat(document.getElementById(co2).value);}
  }

  document.getElementById("tot_deb_a").value = PesoFormat(to1);
  document.getElementById("tot_cre_a").value = PesoFormat(to2);
  dif = to1-to2;
  document.getElementById("total").value = PesoFormat(dif);
}

function PesoFormat(num) {
  var val = parseFloat(num);
  if (isNaN(val)) { return "0.00"; }
  val += "";
  if (val.indexOf('.') == -1) { return val+".00"; }
  else { val = val.substring(0,val.indexOf('.')+3); }
  val = (val == Math.floor(val)) ? val + '.00' : ((val*10 ==Math.floor(val*10)) ? val + '0' : val);
  return val;
} 

function noVacio2(Form,val){
	
	
	
   var has = (parseInt(val)*3) + 9;
   var mensa = "Falta completar campos obligatorios...";
   var res = noVacio(0,has,Form,10);
   if(res && document.getElementById("ter_jur").disabled && document.getElementById("ter_nat").disabled){
     mensa = "Falta seleccionar un tercero...";
     res=false;
   }
   if(res && document.getElementById("total").value != "0.00"){
     mensa = "No son sumas iguales...";
     res=false;
   }
   if(!res){alert(mensa);return false;}
   else{return true;}
}


function noVacio5(Form,val){
   var has = (parseInt(val)*3) + 9;
   var mensa = "Falta completar campos obligatorios...";
   var res = noVacio00(0,has,Form,10);
   if(res && document.getElementById("ter_jur").disabled && document.getElementById("ter_nat").disabled){
     mensa = "Falta seleccionar un tercero...";
     res=false;
   }
   if(res && (document.getElementById("total").value != "0.00")){
     mensa = "No son sumas iguales...";
     res=false;
   }
   
   if(!res){alert(mensa);return false;}
   else{return true;}
}

function noVacio4(Form,val,des,has){
  var res = noVacio00(des,has,Form);
  has++;
  var max=has+(val*4);
  has++;
  var cam=has+1;
  if(res){res = verform(has,max,Form,cam);}
  var mensa = "Falta completar campos obligatorios...";
  if(res && document.getElementById("total").value != "0" &&  document.getElementById("total").value != "0.00"){
     mensa = "No son sumas iguales...";
     res=false;
   }
   if(!res){alert(mensa);return false;}
   else{return true;}
}


function vertodas(obj,ide){
  var comp = 'si'+ide;
  var roco = obj.rock;
  if(roco == comp){
   xDisplay('caja5','none');
   xDisplay('espere','block');
   obj.rock = 'no'+ide;
   var ajax=objetoAjax();
   ajax.open("POST", "listodo.php");
    ajax.onreadystatechange=function()
    { if (ajax.readyState==4) {
        document.getElementById('toncon').innerHTML = ajax.responseText;
        xDisplay('espere','none');
        xDisplay('toncon','block');
    }
   }
   ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   ajax.send("val="+obj.name);
  }
  else{
   xDisplay('caja5','block');
   xDisplay('espere','none');
   xDisplay('toncon','none');
   obj.rock = 'si'+ide;
  }
}

function vertodas2(obj,ide){
  var comp = 'si'+ide;
  var roco = obj.rock;
  if(roco == comp){
   xDisplay('caja14','none');
   xDisplay('espere','block');
   obj.rock = 'no'+ide;
   var ajax=objetoAjax();
   ajax.open("POST", "listodo2.php");
    ajax.onreadystatechange=function()
    { if (ajax.readyState==4) {
        document.getElementById('toncon').innerHTML = ajax.responseText;
        xDisplay('espere','none');
        xDisplay('toncon','block');
    }
   }
   ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   ajax.send("val="+obj.name);
  }
  else{
   xDisplay('caja14','block');
   xDisplay('espere','none');
   xDisplay('toncon','none');
   obj.rock = 'si'+ide;
  }
}

function noVacio3(Form,val){
   var has = (parseInt(val)*3) + 8;
   var mensa = "Falta completar campos obligatorios...";
   var res = noVacio(0,has,Form,8);
   if(res && document.getElementById("total").value != "0.00"){
     mensa = "No son sumas iguales...";
     res=false;
   }
   if(!res){alert(mensa);return false;}
   else{return true;}
}



function noVacio(ini,fin,Form,coj){
 var res = true;
 var j=0;
  for(var i = ini; i<fin; i++){
   var hola = Form.elements[i];
   if(i == coj){
      j=i+1;
      var hole = Form.elements[j];
      i=i+1;
      coj=coj+3;
      if(hola.value == '' && hole.value == ''){
      res = false; break;}
   }
   else{
     if (hola.value == ''){
     res = false; break;}
   }
 }
 if(!res){
  hola.focus();
  return false;
 }
 else{return true;}
}

function noVacio00(ini,fin,Form){
 var res = true;
  for(var i = ini; i<fin; i++){
   var hola = Form.elements[i];
   if (hola.value == ''){
   res = false; break;}
 }
 if(!res){
  hola.focus();
  return false;
 }
 else{return true;}
}

function verform(ini,fin,Form,coj){
 var res = true;
 var j=0;
 for(var i = ini; i<fin; i++){
   var hola = Form.elements[i];
   if(i == coj){
      j=i+1;
      var hole = Form.elements[j];
      i=i+2;
      coj=coj+4;
      if(hola.value == '' && hole.value == ''){
      res = false; break;}
   }
   else{
     if (hola.value == ''){
     res = false; break;}
   }
 }
 if(!res){
  hola.focus();
  return false;
 }
 else{return true;}
}















var xOp7Up,xOp6Dn,xIE4Up,xIE4,xIE5,xNN4,xUA=navigator.userAgent.toLowerCase();if(window.opera){var i=xUA.indexOf('opera');if(i!=-1){var v=parseInt(xUA.charAt(i+6));xOp7Up=v>=7;xOp6Dn=v<7;}}else if(navigator.vendor!='KDE' && document.all && xUA.indexOf('msie')!=-1){xIE4Up=parseFloat(navigator.appVersion)>=4;xIE4=xUA.indexOf('msie 4')!=-1;xIE5=xUA.indexOf('msie 5')!=-1;}else if(document.layers){xNN4=true;}xMac=xUA.indexOf('mac')!=-1;function xDef(){for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])=='undefined') return false;}return true;}function xDisplay(e,s){if(!(e=xGetElementById(e))) return null;if(e.style && xDef(e.style.display)) {if (xStr(s)) e.style.display = s;return e.style.display;}return null;}function xGetElementById(e){if(typeof(e)!='string') return e;if(document.getElementById) e=document.getElementById(e);else if(document.all) e=document.all[e];else e=null;return e;}function xStr(s){for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])!='string') return false;}return true;}
function objetoAjax(){
  var xmlhttp=false;
  try {
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
  try {
  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
  xmlhttp = false;
  }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
  xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}