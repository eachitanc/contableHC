<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CONTAFACIL</title>


		<style type="text/css">
			.Estilo2 {
				font-size: 9px
			}

			.Estilo4 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			a {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
				color: #666666;
			}

			a:link {
				text-decoration: none;
			}

			a:visited {
				text-decoration: none;
				color: #666666;
			}

			a:hover {
				text-decoration: underline;
				color: #666666;
			}

			a:active {
				text-decoration: none;
				color: #666666;
			}

			.Estilo7 {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 9px;
				color: #666666;
			}
		</style>

		<style>
			.fc_main {
				background: #FFFFFF;
				border: 1px solid #000000;
				font-family: Verdana;
				font-size: 10px;
			}

			.fc_date {
				border: 1px solid #D9D9D9;
				cursor: pointer;
				font-size: 10px;
				text-align: center;
			}

			.fc_dateHover,
			TD.fc_date:hover {
				cursor: pointer;
				border-top: 1px solid #FFFFFF;
				border-left: 1px solid #FFFFFF;
				border-right: 1px solid #999999;
				border-bottom: 1px solid #999999;
				background: #E7E7E7;
				font-size: 10px;
				text-align: center;
			}

			.fc_wk {
				font-family: Verdana;
				font-size: 10px;
				text-align: center;
			}

			.fc_wknd {
				color: #FF0000;
				font-weight: bold;
				font-size: 10px;
				text-align: center;
			}

			.fc_head {
				background: #000066;
				color: #FFFFFF;
				font-weight: bold;
				text-align: left;
				font-size: 11px;
			}
		</style>
		<style type="text/css">
			table.bordepunteado1 {
				border-style: solid;
				border-collapse: collapse;
				border-width: 2px;
				border-color: #004080;
			}
		</style>
		<style type="text/css">
			.Estilo10 {
				font-weight: bold
			}

			.Estilo11 {
				font-weight: bold
			}

			.Estilo12 {
				font-weight: bold
			}

			.Estilo13 {
				font-weight: bold
			}

			.Estilo14 {
				font-weight: bold
			}

			.Estilo16 {
				font-weight: bold
			}

			.Estilo17 {
				font-weight: bold
			}

			.Estilo18 {
				font-weight: bold
			}

			.Estilo19 {
				font-weight: bold
			}

			.Estilo20 {
				font-weight: bold
			}

			.Estilo21 {
				font-weight: bold
			}

			.Estilo22 {
				font-weight: bold
			}

			.Estilo23 {
				font-weight: bold
			}

			.Estilo24 {
				font-weight: bold
			}

			.Estilo25 {
				font-weight: bold
			}

			.Estilo26 {
				font-weight: bold
			}

			.Estilo27 {
				font-weight: bold
			}

			.Estilo28 {
				font-weight: bold
			}

			.Estilo29 {
				color: #FFFFFF
			}
		</style>
		<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
		</LINK>

		<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

		<script type="text/javascript">
			function slctr(texto, valor) {
				this.texto = texto
				this.valor = valor
			}

			var Colombia = new Array()
			Colombia[0] = new slctr('- - Departamento - -')
			Colombia[1] = new slctr("Amazonas", 'Amazonas')
			Colombia[2] = new slctr("Antioquia", 'Antioquia')
			Colombia[3] = new slctr("Arauca", 'Arauca')
			Colombia[4] = new slctr("Atlantico", 'Atlantico')
			Colombia[5] = new slctr("Bolivar", 'Bolivar')
			Colombia[6] = new slctr("Boyaca", 'Boyaca')
			Colombia[7] = new slctr("Caldas", 'Caldas')
			Colombia[8] = new slctr("Caqueta", 'Caqueta')
			Colombia[9] = new slctr("Casanare", 'Casanare')
			Colombia[10] = new slctr("Cauca", 'Cauca')
			Colombia[11] = new slctr("Cesar", 'Cesar')
			Colombia[12] = new slctr("Choco", 'Choco')
			Colombia[13] = new slctr("Cordoba", 'Cordoba')
			Colombia[14] = new slctr("Cundinamarca", 'Cundinamarca')
			Colombia[15] = new slctr("Guainia", 'Guainia')
			Colombia[16] = new slctr("Guajira", 'Guajira')
			Colombia[17] = new slctr("Guaviare", 'Guaviare')
			Colombia[18] = new slctr("Huila", 'Huila')
			Colombia[19] = new slctr("Magdalena", 'Magdalena')
			Colombia[20] = new slctr("Meta", 'Meta')
			Colombia[21] = new slctr("Narino", 'Narino')
			Colombia[22] = new slctr("N_de_Santander", 'N_de_Santander')
			Colombia[23] = new slctr("Putumayo", 'Putumayo')
			Colombia[24] = new slctr("Quindio", 'Quindio')
			Colombia[25] = new slctr("Risaralda", 'Risaralda')
			Colombia[26] = new slctr("San_Andres", 'San_Andres')
			Colombia[27] = new slctr("Santander", 'Santander')
			Colombia[28] = new slctr("Sucre", 'Sucre')
			Colombia[29] = new slctr("Tolima", 'Tolima')
			Colombia[30] = new slctr("Valle", 'Valle')
			Colombia[31] = new slctr("Vaupes", 'Vaupes')
			Colombia[32] = new slctr("Vichada", 'Vichada')


			//*******Nietos*******************
			var Amazonas = new Array()
			Amazonas[0] = new slctr('- - Amazonas - -')
			Amazonas[1] = new slctr("Leticia", null)
			Amazonas[2] = new slctr("Puerto Nari�o", null)

			var Antioquia = new Array()
			Antioquia[0] = new slctr('- - Antioquia - -')
			Antioquia[1] = new slctr("Medellin", null)
			Antioquia[2] = new slctr("Abejorral", null)
			Antioquia[3] = new slctr("Abriaqui", null)
			Antioquia[4] = new slctr("Alejandria", null)
			Antioquia[5] = new slctr("Amaga", null)
			Antioquia[6] = new slctr("Amalfi", null)
			Antioquia[7] = new slctr("Andes", null)
			Antioquia[8] = new slctr("Angelopolis", null)
			Antioquia[9] = new slctr("Angostura", null)
			Antioquia[10] = new slctr("Anori", null)
			Antioquia[11] = new slctr("Antioquia", null)
			Antioquia[12] = new slctr("Anza", null)
			Antioquia[13] = new slctr("Apartado", null)
			Antioquia[14] = new slctr("Arboletes", null)
			Antioquia[15] = new slctr("Argelia", null)
			Antioquia[16] = new slctr("Armenia", null)
			Antioquia[17] = new slctr("Barbosa", null)
			Antioquia[18] = new slctr("Belmira", null)
			Antioquia[19] = new slctr("Bello", null)
			Antioquia[20] = new slctr("Betania", null)
			Antioquia[21] = new slctr("Betulia", null)
			Antioquia[22] = new slctr("Ciudad Bolivar", null)
			Antioquia[23] = new slctr("Brice�o", null)
			Antioquia[24] = new slctr("Buritica", null)
			Antioquia[25] = new slctr("Caceres", null)
			Antioquia[26] = new slctr("Caicedo", null)
			Antioquia[27] = new slctr("Caldas", null)
			Antioquia[28] = new slctr("Campamento", null)
			Antioquia[29] = new slctr("Ca�asgordas", null)
			Antioquia[30] = new slctr("Caracoli", null)
			Antioquia[31] = new slctr("Caramanta", null)
			Antioquia[32] = new slctr("Carepa", null)
			Antioquia[33] = new slctr("Carmen de Viboral", null)
			Antioquia[34] = new slctr("Carolina", null)
			Antioquia[35] = new slctr("Caucacia", null)
			Antioquia[36] = new slctr("Chicorodo", null)
			Antioquia[37] = new slctr("Cisneros", null)
			Antioquia[38] = new slctr("Cocorna", null)
			Antioquia[39] = new slctr("Concepcion", null)
			Antioquia[40] = new slctr("Concordia", null)
			Antioquia[41] = new slctr("Copacavana", null)
			Antioquia[42] = new slctr("Dabeiba", null)
			Antioquia[43] = new slctr("Don Matias", null)
			Antioquia[44] = new slctr("Ebejico", null)
			Antioquia[45] = new slctr("El Bagre", null)
			Antioquia[46] = new slctr("Entrerrios", null)
			Antioquia[47] = new slctr("Envigado", null)
			Antioquia[48] = new slctr("Fredonia", null)
			Antioquia[49] = new slctr("Frontino", null)
			Antioquia[50] = new slctr("Giraldo", null)
			Antioquia[51] = new slctr("Girardota", null)
			Antioquia[52] = new slctr("Gomez Plata", null)
			Antioquia[53] = new slctr("Granada", null)
			Antioquia[54] = new slctr("Guadalupe", null)
			Antioquia[55] = new slctr("Guarne", null)
			Antioquia[56] = new slctr("Guatape", null)
			Antioquia[57] = new slctr("Heliconia", null)
			Antioquia[58] = new slctr("Hispania", null)
			Antioquia[59] = new slctr("Itagui", null)
			Antioquia[60] = new slctr("Ituango", null)
			Antioquia[61] = new slctr("Jardin", null)
			Antioquia[62] = new slctr("Jerico", null)
			Antioquia[63] = new slctr("La Ceja", null)
			Antioquia[64] = new slctr("La Estrella", null)
			Antioquia[65] = new slctr("La Pintada", null)
			Antioquia[66] = new slctr("La Uni�n", null)
			Antioquia[67] = new slctr("Liborina", null)
			Antioquia[68] = new slctr("Maceo", null)
			Antioquia[69] = new slctr("Marinilla", null)
			Antioquia[70] = new slctr("Montebello", null)
			Antioquia[71] = new slctr("Murindo", null)
			Antioquia[72] = new slctr("Mutata", null)
			Antioquia[73] = new slctr("Nari�o", null)
			Antioquia[74] = new slctr("Necocli", null)
			Antioquia[75] = new slctr("Nechi", null)
			Antioquia[76] = new slctr("Olaya", null)
			Antioquia[77] = new slctr("Pe�ol", null)
			Antioquia[78] = new slctr("Peque", null)
			Antioquia[79] = new slctr("Pueblorrico", null)
			Antioquia[80] = new slctr("Puerto Berrio", null)
			Antioquia[81] = new slctr("Puerto Nare", null)
			Antioquia[82] = new slctr("Puerto Triunfo", null)
			Antioquia[83] = new slctr("Remedios", null)
			Antioquia[84] = new slctr("Retiro", null)
			Antioquia[85] = new slctr("Rionegro", null)
			Antioquia[86] = new slctr("Sabanalarga", null)
			Antioquia[87] = new slctr("Sabaneta", null)
			Antioquia[88] = new slctr("Salgar", null)
			Antioquia[89] = new slctr("San Andres", null)
			Antioquia[90] = new slctr("San Carlos", null)
			Antioquia[91] = new slctr("San Francisco", null)
			Antioquia[92] = new slctr("San Jeronimo", null)
			Antioquia[93] = new slctr("San Jose de la Monta�a", null)
			Antioquia[94] = new slctr("San Juan de Uraba", null)
			Antioquia[95] = new slctr("Sab Luis", null)
			Antioquia[96] = new slctr("San Pedro", null)
			Antioquia[97] = new slctr("San Pedro de Uraba", null)
			Antioquia[98] = new slctr("San Rafael", null)
			Antioquia[99] = new slctr("San Roque", null)
			Antioquia[100] = new slctr("San Vicente", null)
			Antioquia[101] = new slctr("Santa Barbara", null)
			Antioquia[102] = new slctr("Santa Rosa de Osos", null)
			Antioquia[103] = new slctr("Santo Domingo", null)
			Antioquia[104] = new slctr("Santuario", null)
			Antioquia[105] = new slctr("Segovia", null)
			Antioquia[106] = new slctr("Sonson", null)
			Antioquia[107] = new slctr("Sopetran", null)
			Antioquia[108] = new slctr("Tamesis", null)
			Antioquia[109] = new slctr("Taraza", null)
			Antioquia[110] = new slctr("Tarso", null)
			Antioquia[111] = new slctr("Titiribi", null)
			Antioquia[112] = new slctr("Toledo", null)
			Antioquia[113] = new slctr("Turbo", null)
			Antioquia[114] = new slctr("Uramita", null)
			Antioquia[115] = new slctr("Urrao", null)
			Antioquia[116] = new slctr("Valdivia", null)
			Antioquia[117] = new slctr("Valparaiso", null)
			Antioquia[118] = new slctr("Vegachi", null)
			Antioquia[119] = new slctr("Venecia", null)
			Antioquia[120] = new slctr("Vigia del Fuerte", null)
			Antioquia[121] = new slctr("Yali", null)
			Antioquia[122] = new slctr("Yarumal", null)
			Antioquia[123] = new slctr("Yolombo", null)
			Antioquia[124] = new slctr("Yondo", null)
			Antioquia[125] = new slctr("Zaragoza", null)

			var Arauca = new Array()
			Arauca[0] = new slctr('- - Arauca - -')
			Arauca[1] = new slctr("Arauca", null)
			Arauca[2] = new slctr("Arauquita", null)
			Arauca[3] = new slctr("Cravo Norte", null)
			Arauca[4] = new slctr("Fortul", null)
			Arauca[5] = new slctr("Puerto Rondon", null)
			Arauca[6] = new slctr("Saravena", null)
			Arauca[7] = new slctr("Tame", null)

			var Atlantico = new Array()
			Atlantico[0] = new slctr('- - Atlantico - -')
			Atlantico[1] = new slctr("Barranquilla", null)
			Atlantico[2] = new slctr("Baranoa", null)
			Atlantico[3] = new slctr("Campo de la Cruz", null)
			Atlantico[4] = new slctr("Candelaria", null)
			Atlantico[5] = new slctr("Galapa", null)
			Atlantico[6] = new slctr("Juan de Acosta", null)
			Atlantico[7] = new slctr("Luruaco", null)
			Atlantico[8] = new slctr("Malambo", null)
			Atlantico[9] = new slctr("Manati", null)
			Atlantico[10] = new slctr("Palmar de Varela", null)
			Atlantico[11] = new slctr("Piojo", null)
			Atlantico[12] = new slctr("Polo Nuevo", null)
			Atlantico[13] = new slctr("Ponedera", null)
			Atlantico[14] = new slctr("Puerto Colombia", null)
			Atlantico[15] = new slctr("Repelon", null)
			Atlantico[16] = new slctr("Sabanagrande", null)
			Atlantico[17] = new slctr("Sabanalarga", null)
			Atlantico[18] = new slctr("Santa Lucia", null)
			Atlantico[19] = new slctr("Santo Tomas", null)
			Atlantico[20] = new slctr("Soledad", null)
			Atlantico[21] = new slctr("Suan", null)
			Atlantico[22] = new slctr("Tubara", null)
			Atlantico[23] = new slctr("Usiacuri", null)

			var Bolivar = new Array()
			Bolivar[0] = new slctr('- - Bolivar - -')
			Bolivar[1] = new slctr("Cartagena", null)
			Bolivar[2] = new slctr("Achi", null)
			Bolivar[3] = new slctr("Altos del Rosario", null)
			Bolivar[4] = new slctr("Arenal", null)
			Bolivar[5] = new slctr("Arjona", null)
			Bolivar[6] = new slctr("Arroyohondo", null)
			Bolivar[7] = new slctr("Barranco de Loba", null)
			Bolivar[8] = new slctr("Calamar", null)
			Bolivar[9] = new slctr("Cantagallo", null)
			Bolivar[10] = new slctr("Cicuco", null)
			Bolivar[11] = new slctr("Cordoba", null)
			Bolivar[12] = new slctr("Clemencia", null)
			Bolivar[13] = new slctr("El Carmen de Bolivar", null)
			Bolivar[14] = new slctr("El Guamo", null)
			Bolivar[15] = new slctr("El Pe�on", null)
			Bolivar[16] = new slctr("Hatillo de Loba", null)
			Bolivar[17] = new slctr("Magangue", null)
			Bolivar[18] = new slctr("Mahates", null)
			Bolivar[19] = new slctr("Margarita", null)
			Bolivar[20] = new slctr("Maria la Baja", null)
			Bolivar[21] = new slctr("Montecristo", null)
			Bolivar[22] = new slctr("Mompos", null)
			Bolivar[23] = new slctr("Morales", null)
			Bolivar[24] = new slctr("Pinillos", null)
			Bolivar[25] = new slctr("Regidor", null)
			Bolivar[26] = new slctr("Rio Viejo", null)
			Bolivar[27] = new slctr("San Cristobal", null)
			Bolivar[28] = new slctr("San Estanislao", null)
			Bolivar[29] = new slctr("San Fernando", null)
			Bolivar[30] = new slctr("San Jacinto", null)
			Bolivar[31] = new slctr("San Jacinto del Cauca", null)
			Bolivar[32] = new slctr("San Juan Nepomuceno", null)
			Bolivar[33] = new slctr("San Martin de Loba", null)
			Bolivar[34] = new slctr("San Pablo", null)
			Bolivar[35] = new slctr("Santa Catalina", null)
			Bolivar[36] = new slctr("Santa Rosa", null)
			Bolivar[37] = new slctr("Santa Rosa del Sur", null)
			Bolivar[38] = new slctr("Simiti", null)
			Bolivar[39] = new slctr("Soplaviento", null)
			Bolivar[40] = new slctr("Talaigua Nuevo", null)
			Bolivar[41] = new slctr("Tiquisio", null)
			Bolivar[42] = new slctr("Turbaco", null)
			Bolivar[43] = new slctr("Turbania", null)
			Bolivar[44] = new slctr("Villanueva", null)
			Bolivar[45] = new slctr("Zambrano", null)

			var Boyaca = new Array()
			Boyaca[0] = new slctr('- - Boyaca - -')
			Boyaca[1] = new slctr("Tunja", null)
			Boyaca[2] = new slctr("Almeida", null)
			Boyaca[3] = new slctr("Aquitania", null)
			Boyaca[4] = new slctr("Arcabuco", null)
			Boyaca[5] = new slctr("Belen", null)
			Boyaca[6] = new slctr("Berbeo", null)
			Boyaca[7] = new slctr("Beteitiva", null)
			Boyaca[8] = new slctr("Boavita", null)
			Boyaca[9] = new slctr("Boyaca", null)
			Boyaca[10] = new slctr("Brice�o", null)
			Boyaca[11] = new slctr("Buenavista", null)
			Boyaca[12] = new slctr("Busbanza", null)
			Boyaca[13] = new slctr("Caldas", null)
			Boyaca[14] = new slctr("Campohermoso", null)
			Boyaca[15] = new slctr("Cerinza", null)
			Boyaca[16] = new slctr("Chinavita", null)
			Boyaca[17] = new slctr("Chiquinquira", null)
			Boyaca[18] = new slctr("Chiscas", null)
			Boyaca[19] = new slctr("Chita", null)
			Boyaca[20] = new slctr("Chitaraque", null)
			Boyaca[21] = new slctr("Chivata", null)
			Boyaca[22] = new slctr("Cienega", null)
			Boyaca[23] = new slctr("Combita", null)
			Boyaca[24] = new slctr("Coper", null)
			Boyaca[25] = new slctr("Corrales", null)
			Boyaca[26] = new slctr("Covarachia", null)
			Boyaca[27] = new slctr("Cubara", null)
			Boyaca[28] = new slctr("Cucaita", null)
			Boyaca[29] = new slctr("Cuitiva", null)
			Boyaca[30] = new slctr("Chiquiza", null)
			Boyaca[31] = new slctr("Chivor", null)
			Boyaca[32] = new slctr("Duitama", null)
			Boyaca[33] = new slctr("El Cocuy", null)
			Boyaca[34] = new slctr("El Espino", null)
			Boyaca[35] = new slctr("Firavitoba", null)
			Boyaca[36] = new slctr("Floresta", null)
			Boyaca[37] = new slctr("Gachantiva", null)
			Boyaca[38] = new slctr("Gameza", null)
			Boyaca[39] = new slctr("Garagoa", null)
			Boyaca[40] = new slctr("Guacamayas", null)
			Boyaca[41] = new slctr("Guateque", null)
			Boyaca[42] = new slctr("Guayata", null)
			Boyaca[43] = new slctr("Guican", null)
			Boyaca[44] = new slctr("Iza", null)
			Boyaca[45] = new slctr("Jenesano", null)
			Boyaca[46] = new slctr("Jerico", null)
			Boyaca[47] = new slctr("Labranzagrande", null)
			Boyaca[48] = new slctr("La Capilla", null)
			Boyaca[49] = new slctr("La Victoria", null)
			Boyaca[50] = new slctr("La Uvita", null)
			Boyaca[51] = new slctr("Leiva", null)
			Boyaca[52] = new slctr("Macanal", null)
			Boyaca[53] = new slctr("Maripi", null)
			Boyaca[54] = new slctr("Miraflores", null)
			Boyaca[55] = new slctr("Mongua", null)
			Boyaca[56] = new slctr("Mongui", null)
			Boyaca[57] = new slctr("Moniquira", null)
			Boyaca[58] = new slctr("Motavita", null)
			Boyaca[59] = new slctr("Muzo", null)
			Boyaca[60] = new slctr("Nobsa", null)
			Boyaca[61] = new slctr("Nuevo Colon", null)
			Boyaca[62] = new slctr("Oicata", null)
			Boyaca[63] = new slctr("Otanche", null)
			Boyaca[64] = new slctr("Pachavita", null)
			Boyaca[65] = new slctr("Paez", null)
			Boyaca[66] = new slctr("Paipa", null)
			Boyaca[67] = new slctr("Pajarito", null)
			Boyaca[68] = new slctr("Panqueba", null)
			Boyaca[69] = new slctr("Pauna", null)
			Boyaca[70] = new slctr("Paya", null)
			Boyaca[71] = new slctr("Paz del Rio", null)
			Boyaca[72] = new slctr("Pesca", null)
			Boyaca[73] = new slctr("Pisba", null)
			Boyaca[74] = new slctr("Puerto Boyaca", null)
			Boyaca[75] = new slctr("Quipama", null)
			Boyaca[76] = new slctr("Ramiriqui", null)
			Boyaca[77] = new slctr("Raquira", null)
			Boyaca[78] = new slctr("Rondon", null)
			Boyaca[79] = new slctr("Saboya", null)
			Boyaca[80] = new slctr("Sachica", null)
			Boyaca[81] = new slctr("Samaca", null)
			Boyaca[82] = new slctr("San Eduardo", null)
			Boyaca[83] = new slctr("San Jose de Pare", null)
			Boyaca[84] = new slctr("San Luis de Gaceno", null)
			Boyaca[85] = new slctr("San Mateo", null)
			Boyaca[86] = new slctr("San Miguel de Sema", null)
			Boyaca[87] = new slctr("San Pablo de Borbur", null)
			Boyaca[88] = new slctr("Santana", null)
			Boyaca[89] = new slctr("Santa Maria", null)
			Boyaca[90] = new slctr("Santa Rosa de Viterbo", null)
			Boyaca[91] = new slctr("Santa Sofia", null)
			Boyaca[92] = new slctr("Sativanorte", null)
			Boyaca[93] = new slctr("Sativasur", null)
			Boyaca[94] = new slctr("Siachoque", null)
			Boyaca[95] = new slctr("Soata", null)
			Boyaca[96] = new slctr("Socota", null)
			Boyaca[97] = new slctr("Socha", null)
			Boyaca[98] = new slctr("Sogamoso", null)
			Boyaca[99] = new slctr("Somondoco", null)
			Boyaca[100] = new slctr("Sora", null)
			Boyaca[101] = new slctr("Sotaquira", null)
			Boyaca[102] = new slctr("Soraca", null)
			Boyaca[103] = new slctr("Susacon", null)
			Boyaca[104] = new slctr("Sutamarchan", null)
			Boyaca[105] = new slctr("Sutatenza", null)
			Boyaca[106] = new slctr("Tazco", null)
			Boyaca[107] = new slctr("Tenza", null)
			Boyaca[108] = new slctr("Tibana", null)
			Boyaca[109] = new slctr("Tibasosa", null)
			Boyaca[110] = new slctr("Tinjaca", null)
			Boyaca[111] = new slctr("Tipacoque", null)
			Boyaca[112] = new slctr("Toca", null)
			Boyaca[113] = new slctr("Togui", null)
			Boyaca[114] = new slctr("Topaga", null)
			Boyaca[115] = new slctr("Tota", null)
			Boyaca[116] = new slctr("Tunungua", null)
			Boyaca[117] = new slctr("Turmeque", null)
			Boyaca[118] = new slctr("Tuta", null)
			Boyaca[119] = new slctr("Tutasa", null)
			Boyaca[120] = new slctr("Umbita", null)
			Boyaca[121] = new slctr("Ventaquemada", null)
			Boyaca[122] = new slctr("Viracacha", null)
			Boyaca[123] = new slctr("Zetaquira", null)

			var Caldas = new Array()
			Caldas[0] = new slctr('- - Caldas - -')
			Caldas[1] = new slctr("Manizales", null)
			Caldas[2] = new slctr("Aguadas", null)
			Caldas[3] = new slctr("Anserma", null)
			Caldas[4] = new slctr("Aranzazu", null)
			Caldas[5] = new slctr("Belalcazar", null)
			Caldas[6] = new slctr("Chinchina", null)
			Caldas[7] = new slctr("Filadelfia", null)
			Caldas[8] = new slctr("La Dorada", null)
			Caldas[9] = new slctr("La Merced", null)
			Caldas[10] = new slctr("Manzanares", null)
			Caldas[11] = new slctr("Marmato", null)
			Caldas[12] = new slctr("Marquetalia", null)
			Caldas[13] = new slctr("Marulanda", null)
			Caldas[14] = new slctr("Neira", null)
			Caldas[15] = new slctr("Norcasia", null)
			Caldas[16] = new slctr("Pacora", null)
			Caldas[17] = new slctr("Palestina", null)
			Caldas[18] = new slctr("Pensilvania", null)
			Caldas[19] = new slctr("Riosucio", null)
			Caldas[20] = new slctr("Risaralda", null)
			Caldas[21] = new slctr("Salamina", null)
			Caldas[22] = new slctr("Samana", null)
			Caldas[23] = new slctr("San Jose", null)
			Caldas[24] = new slctr("Supia", null)
			Caldas[25] = new slctr("Victoria", null)
			Caldas[26] = new slctr("Villamaria", null)
			Caldas[27] = new slctr("Viterbo", null)

			var Caqueta = new Array()
			Caqueta[0] = new slctr('- - Caqueta - -')
			Caqueta[1] = new slctr("Florencia", null)
			Caqueta[2] = new slctr("Albania", null)
			Caqueta[3] = new slctr("Belen Andaquies", null)
			Caqueta[4] = new slctr("Cartagena del Chaira", null)
			Caqueta[5] = new slctr("Curillo", null)
			Caqueta[6] = new slctr("El Doncello", null)
			Caqueta[7] = new slctr("El Paujil", null)
			Caqueta[8] = new slctr("La Monta�ita", null)
			Caqueta[9] = new slctr("Milan", null)
			Caqueta[10] = new slctr("Morelia", null)
			Caqueta[11] = new slctr("Puerto Rico", null)
			Caqueta[12] = new slctr("San Jose de Fragua", null)
			Caqueta[13] = new slctr("San Vicente del Caguan", null)
			Caqueta[14] = new slctr("Solano", null)
			Caqueta[15] = new slctr("Solita", null)
			Caqueta[16] = new slctr("Valparaiso", null)

			var Casanare = new Array()
			Casanare[0] = new slctr('- - Casanare - -')
			Casanare[1] = new slctr("Yopal", null)
			Casanare[2] = new slctr("Aguazul", null)
			Casanare[3] = new slctr("Chameza", null)
			Casanare[4] = new slctr("Hato Corozal", null)
			Casanare[5] = new slctr("La Salina", null)
			Casanare[6] = new slctr("Mani", null)
			Casanare[7] = new slctr("Monterrey", null)
			Casanare[8] = new slctr("Nunchia", null)
			Casanare[9] = new slctr("Orocue", null)
			Casanare[10] = new slctr("Paz de Ariporo", null)
			Casanare[11] = new slctr("Pore", null)
			Casanare[12] = new slctr("Recetor", null)
			Casanare[13] = new slctr("Sabanalarga", null)
			Casanare[14] = new slctr("Sacama", null)
			Casanare[15] = new slctr("San Luis de Palenque", null)
			Casanare[16] = new slctr("Tamara", null)
			Casanare[17] = new slctr("Tauramena", null)
			Casanare[18] = new slctr("Trinidad", null)
			Casanare[19] = new slctr("Villanueva", null)

			var Cauca = new Array()
			Cauca[0] = new slctr('- - Cauca - -')
			Cauca[1] = new slctr("Popayan", null)
			Cauca[2] = new slctr("Almaguer", null)
			Cauca[3] = new slctr("Argelia", null)
			Cauca[4] = new slctr("Balboa", null)
			Cauca[5] = new slctr("Bolivar", null)
			Cauca[6] = new slctr("Buenos Aires", null)
			Cauca[7] = new slctr("Cajibio", null)
			Cauca[8] = new slctr("Caldono", null)
			Cauca[9] = new slctr("Caloto", null)
			Cauca[10] = new slctr("Corinto", null)
			Cauca[11] = new slctr("El Tambo", null)
			Cauca[12] = new slctr("Florencia", null)
			Cauca[13] = new slctr("Guapi", null)
			Cauca[14] = new slctr("Inza", null)
			Cauca[15] = new slctr("Jambalo", null)
			Cauca[16] = new slctr("La Sierra", null)
			Cauca[17] = new slctr("La Vega", null)
			Cauca[18] = new slctr("Lopez", null)
			Cauca[19] = new slctr("Mercaderes", null)
			Cauca[20] = new slctr("Miranda", null)
			Cauca[21] = new slctr("Morales", null)
			Cauca[22] = new slctr("Padilla", null)
			Cauca[23] = new slctr("Paez", null)
			Cauca[24] = new slctr("Patia(El Bordo)", null)
			Cauca[25] = new slctr("Piamonte", null)
			Cauca[26] = new slctr("Piendamo", null)
			Cauca[27] = new slctr("Puerto Tejada", null)
			Cauca[28] = new slctr("Purace", null)
			Cauca[29] = new slctr("Rosas", null)
			Cauca[30] = new slctr("San Sebastian", null)
			Cauca[31] = new slctr("Santander de Quilichao", null)
			Cauca[32] = new slctr("Santa Rosa", null)
			Cauca[33] = new slctr("Silvia", null)
			Cauca[34] = new slctr("Sotara", null)
			Cauca[35] = new slctr("Suarez", null)
			Cauca[36] = new slctr("Sucre", null)
			Cauca[37] = new slctr("Timbio", null)
			Cauca[38] = new slctr("Timbiqui", null)
			Cauca[39] = new slctr("Toribio", null)
			Cauca[40] = new slctr("Totoro", null)
			Cauca[41] = new slctr("Villa Rica", null)

			var Cesar = new Array()
			Cesar[0] = new slctr('- - Cesar - -')
			Cesar[1] = new slctr("Valledupar", null)
			Cesar[2] = new slctr("Aguachica", null)
			Cesar[3] = new slctr("Agustin Codazzi", null)
			Cesar[4] = new slctr("Astrea", null)
			Cesar[5] = new slctr("Becerril", null)
			Cesar[6] = new slctr("Bosconia", null)
			Cesar[7] = new slctr("Chimichagua", null)
			Cesar[8] = new slctr("Chiriguana", null)
			Cesar[9] = new slctr("Curumani", null)
			Cesar[10] = new slctr("El Copey", null)
			Cesar[11] = new slctr("El Paso", null)
			Cesar[12] = new slctr("Gamarra", null)
			Cesar[13] = new slctr("Gonzalez", null)
			Cesar[14] = new slctr("La Gloria", null)
			Cesar[15] = new slctr("La Jagua Ibirico", null)
			Cesar[16] = new slctr("Manaure Balcon del Cesar", null)
			Cesar[17] = new slctr("Pailitas", null)
			Cesar[18] = new slctr("Pelaya", null)
			Cesar[19] = new slctr("Pueblo Bello", null)
			Cesar[20] = new slctr("Rio de Oro", null)
			Cesar[21] = new slctr("Robles(La Paz)", null)
			Cesar[22] = new slctr("San Alberto", null)
			Cesar[23] = new slctr("San Diego", null)
			Cesar[24] = new slctr("San Martin", null)
			Cesar[25] = new slctr("Tamalameque", null)

			var Choco = new Array()
			Choco[0] = new slctr('- - Choco - -')
			Choco[1] = new slctr("Quibdo", null)
			Choco[2] = new slctr("Acandi", null)
			Choco[3] = new slctr("Alto Baudo(Pie de Pato)", null)
			Choco[4] = new slctr("Atrato", null)
			Choco[5] = new slctr("Bagado", null)
			Choco[6] = new slctr("Bahia Solano(Mutis)", null)
			Choco[7] = new slctr("Bajo Baudo(Pizarro)", null)
			Choco[8] = new slctr("Bojaya(Bellavista)", null)
			Choco[9] = new slctr("Canton de San Pablo", null)
			Choco[10] = new slctr("Carmen del Darien", null)
			Choco[11] = new slctr("Cartegui", null)
			Choco[12] = new slctr("Condoto", null)
			Choco[13] = new slctr("El Carmen", null)
			Choco[14] = new slctr("Litoral del San Juan", null)
			Choco[15] = new slctr("Istmina", null)
			Choco[16] = new slctr("Jurado", null)
			Choco[17] = new slctr("Lloro", null)
			Choco[18] = new slctr("Medio Atrato", null)
			Choco[19] = new slctr("Medio Baudo(Boca de Pepe)", null)
			Choco[20] = new slctr("Medio San Juan", null)
			Choco[21] = new slctr("Novita", null)
			Choco[22] = new slctr("Nuqui", null)
			Choco[23] = new slctr("Rio Iro", null)
			Choco[24] = new slctr("Rio Quito", null)
			Choco[25] = new slctr("Rio Sucio", null)
			Choco[26] = new slctr("San Jose del Palmar", null)
			Choco[27] = new slctr("Sipi", null)
			Choco[28] = new slctr("Tado", null)
			Choco[29] = new slctr("Unguia", null)
			Choco[30] = new slctr("Union Panamericana", null)

			var Cordoba = new Array()
			Cordoba[0] = new slctr('- - Cordoba - -')
			Cordoba[1] = new slctr("Monteria", null)
			Cordoba[2] = new slctr("Ayapel", null)
			Cordoba[3] = new slctr("Buenavista", null)
			Cordoba[4] = new slctr("Canalete", null)
			Cordoba[5] = new slctr("Cerete", null)
			Cordoba[6] = new slctr("Chima", null)
			Cordoba[7] = new slctr("Chinu", null)
			Cordoba[8] = new slctr("Cienaga de Oro", null)
			Cordoba[9] = new slctr("Cotorra", null)
			Cordoba[10] = new slctr("La Apartada", null)
			Cordoba[11] = new slctr("Lorica", null)
			Cordoba[12] = new slctr("Los Cordobas", null)
			Cordoba[13] = new slctr("Momil", null)
			Cordoba[14] = new slctr("Montelibano", null)
			Cordoba[15] = new slctr("Mo�itos", null)
			Cordoba[16] = new slctr("Planeta Rica", null)
			Cordoba[17] = new slctr("Pueblo Nuevo", null)
			Cordoba[18] = new slctr("Puerto Escondido", null)
			Cordoba[19] = new slctr("Puerto Libertador", null)
			Cordoba[20] = new slctr("Purisma", null)
			Cordoba[21] = new slctr("Sahagun", null)
			Cordoba[22] = new slctr("San Andres Sotavento", null)
			Cordoba[23] = new slctr("San Antero", null)
			Cordoba[24] = new slctr("San Bernardo Viento", null)
			Cordoba[25] = new slctr("San carlos", null)
			Cordoba[26] = new slctr("San Pelayo", null)
			Cordoba[27] = new slctr("Tierralta", null)
			Cordoba[28] = new slctr("Valencia", null)

			var Cundinamarca = new Array()
			Cundinamarca[0] = new slctr('- - Cundinamarca - -')
			Cundinamarca[1] = new slctr("Bogota", null)
			Cundinamarca[2] = new slctr("Alaban", null)
			Cundinamarca[3] = new slctr("Anapoima", null)
			Cundinamarca[4] = new slctr("Anolaima", null)
			Cundinamarca[5] = new slctr("Arbelaez", null)
			Cundinamarca[6] = new slctr("Beltran", null)
			Cundinamarca[7] = new slctr("Bituima", null)
			Cundinamarca[8] = new slctr("Bojaca", null)
			Cundinamarca[9] = new slctr("Cabrera", null)
			Cundinamarca[10] = new slctr("Cachipay", null)
			Cundinamarca[11] = new slctr("Cajica", null)
			Cundinamarca[12] = new slctr("Caparrapi", null)
			Cundinamarca[13] = new slctr("Caqueza", null)
			Cundinamarca[14] = new slctr("Carmen de Carupa", null)
			Cundinamarca[15] = new slctr("Chaguani", null)
			Cundinamarca[16] = new slctr("Chia", null)
			Cundinamarca[17] = new slctr("Chipaque", null)
			Cundinamarca[18] = new slctr("Choachi", null)
			Cundinamarca[19] = new slctr("Choconta", null)
			Cundinamarca[20] = new slctr("Cogua", null)
			Cundinamarca[21] = new slctr("Cota", null)
			Cundinamarca[22] = new slctr("Cucunuba", null)
			Cundinamarca[23] = new slctr("El Colegio", null)
			Cundinamarca[24] = new slctr("El Pe�on", null)
			Cundinamarca[25] = new slctr("El Rosal", null)
			Cundinamarca[26] = new slctr("Facatativa", null)
			Cundinamarca[27] = new slctr("Fomeque", null)
			Cundinamarca[28] = new slctr("Fosca", null)
			Cundinamarca[29] = new slctr("Funza", null)
			Cundinamarca[30] = new slctr("Fuquene", null)
			Cundinamarca[31] = new slctr("Fusagasuga", null)
			Cundinamarca[32] = new slctr("Gachala", null)
			Cundinamarca[33] = new slctr("Gachancipa", null)
			Cundinamarca[34] = new slctr("Gacheta", null)
			Cundinamarca[35] = new slctr("Gama", null)
			Cundinamarca[36] = new slctr("Girardot", null)
			Cundinamarca[37] = new slctr("Granada", null)
			Cundinamarca[38] = new slctr("Guacheta", null)
			Cundinamarca[39] = new slctr("Guadas", null)
			Cundinamarca[40] = new slctr("Guasca", null)
			Cundinamarca[41] = new slctr("Guataqui", null)
			Cundinamarca[42] = new slctr("Guatavita", null)
			Cundinamarca[43] = new slctr("Guayabal de Siquima", null)
			Cundinamarca[44] = new slctr("Guayabetal", null)
			Cundinamarca[45] = new slctr("Gutierrez", null)
			Cundinamarca[46] = new slctr("Jerusalen", null)
			Cundinamarca[47] = new slctr("Junin", null)
			Cundinamarca[48] = new slctr("La Calera", null)
			Cundinamarca[49] = new slctr("La Mesa", null)
			Cundinamarca[50] = new slctr("La Palma", null)
			Cundinamarca[51] = new slctr("La Pe�a", null)
			Cundinamarca[52] = new slctr("La Vega", null)
			Cundinamarca[53] = new slctr("Lenguazque", null)
			Cundinamarca[54] = new slctr("Macheta", null)
			Cundinamarca[55] = new slctr("Madrid", null)
			Cundinamarca[56] = new slctr("Manta", null)
			Cundinamarca[57] = new slctr("Medina", null)
			Cundinamarca[58] = new slctr("Mosquera", null)
			Cundinamarca[59] = new slctr("Nari�o", null)
			Cundinamarca[60] = new slctr("Nemocon", null)
			Cundinamarca[61] = new slctr("Nilo", null)
			Cundinamarca[62] = new slctr("Nimaima", null)
			Cundinamarca[63] = new slctr("Nocaima", null)
			Cundinamarca[64] = new slctr("Venecia(Ospina Perez)", null)
			Cundinamarca[65] = new slctr("Pacho", null)
			Cundinamarca[66] = new slctr("Paime", null)
			Cundinamarca[67] = new slctr("Pandi", null)
			Cundinamarca[68] = new slctr("Paratebueno", null)
			Cundinamarca[69] = new slctr("Pasca", null)
			Cundinamarca[70] = new slctr("Puerto Salgar", null)
			Cundinamarca[71] = new slctr("Puli", null)
			Cundinamarca[72] = new slctr("Quebradanegra", null)
			Cundinamarca[73] = new slctr("Quetame", null)
			Cundinamarca[74] = new slctr("Quipile", null)
			Cundinamarca[75] = new slctr("Rafael Reyes", null)
			Cundinamarca[76] = new slctr("Ricaurte", null)
			Cundinamarca[77] = new slctr("San Antonio del Tequendama", null)
			Cundinamarca[78] = new slctr("San Bernardo", null)
			Cundinamarca[79] = new slctr("San Cayetano", null)
			Cundinamarca[80] = new slctr("San Francisco", null)
			Cundinamarca[81] = new slctr("San Juan de Rioseco", null)
			Cundinamarca[82] = new slctr("Sasaima", null)
			Cundinamarca[83] = new slctr("Sesquile", null)
			Cundinamarca[84] = new slctr("Sibate", null)
			Cundinamarca[85] = new slctr("Silvania", null)
			Cundinamarca[86] = new slctr("Simijaca", null)
			Cundinamarca[87] = new slctr("Soacha", null)
			Cundinamarca[88] = new slctr("Sopo", null)
			Cundinamarca[89] = new slctr("Subachoque", null)
			Cundinamarca[90] = new slctr("Suesca", null)
			Cundinamarca[91] = new slctr("Supata", null)
			Cundinamarca[92] = new slctr("Susa", null)
			Cundinamarca[93] = new slctr("Sutatausa", null)
			Cundinamarca[94] = new slctr("Tabio", null)
			Cundinamarca[95] = new slctr("Tausa", null)
			Cundinamarca[96] = new slctr("Tena", null)
			Cundinamarca[97] = new slctr("Tenjo", null)
			Cundinamarca[98] = new slctr("Tibacuy", null)
			Cundinamarca[99] = new slctr("Tibirita", null)
			Cundinamarca[100] = new slctr("Tocaima", null)
			Cundinamarca[101] = new slctr("Tocancipa", null)
			Cundinamarca[102] = new slctr("Topaipi", null)
			Cundinamarca[103] = new slctr("Ubala", null)
			Cundinamarca[104] = new slctr("Ubaque", null)
			Cundinamarca[105] = new slctr("Ubate", null)
			Cundinamarca[106] = new slctr("Une", null)
			Cundinamarca[107] = new slctr("Utica", null)
			Cundinamarca[108] = new slctr("Vergara", null)
			Cundinamarca[109] = new slctr("Viani", null)
			Cundinamarca[110] = new slctr("Villagomez", null)
			Cundinamarca[111] = new slctr("Villapinzon", null)
			Cundinamarca[112] = new slctr("Villeta", null)
			Cundinamarca[113] = new slctr("Viota", null)
			Cundinamarca[114] = new slctr("Yacopi", null)
			Cundinamarca[115] = new slctr("Zipacon", null)
			Cundinamarca[116] = new slctr("Zipaquira", null)

			var Guainia = new Array()
			Guainia[0] = new slctr('- - Guainia - -')
			Guainia[1] = new slctr("Puerto Inirida", null)

			var Guajira = new Array()
			Guajira[0] = new slctr('- - Guajira - -')
			Guajira[1] = new slctr("Riohacha", null)
			Guajira[2] = new slctr("Albania", null)
			Guajira[3] = new slctr("Barrancas", null)
			Guajira[4] = new slctr("Dibulla", null)
			Guajira[5] = new slctr("Distraccion", null)
			Guajira[6] = new slctr("El Molino", null)
			Guajira[7] = new slctr("Fonseca", null)
			Guajira[8] = new slctr("Hatonuevo", null)
			Guajira[9] = new slctr("La jagua del Pilar", null)
			Guajira[10] = new slctr("Maicao", null)
			Guajira[11] = new slctr("Manaure", null)
			Guajira[12] = new slctr("San Juan del Cesar", null)
			Guajira[13] = new slctr("Uribia", null)
			Guajira[14] = new slctr("Urumita", null)
			Guajira[15] = new slctr("Villanueva", null)

			var Guaviare = new Array()
			Guaviare[0] = new slctr('- - Guaviare - -')
			Guaviare[1] = new slctr("San Jose del Guaviare", null)
			Guaviare[2] = new slctr("Calamar", null)
			Guaviare[3] = new slctr("El Retorno", null)
			Guaviare[4] = new slctr("Miraflores", null)

			var Huila = new Array()
			Huila[0] = new slctr('- - Huila - -')
			Huila[1] = new slctr("Neiva", null)
			Huila[2] = new slctr("Acevedo", null)
			Huila[3] = new slctr("Agrado", null)
			Huila[4] = new slctr("Aipe", null)
			Huila[5] = new slctr("Algeciras", null)
			Huila[6] = new slctr("Altamira", null)
			Huila[7] = new slctr("Baraya", null)
			Huila[8] = new slctr("Campoalegre", null)
			Huila[9] = new slctr("Colombia", null)
			Huila[10] = new slctr("Elias", null)
			Huila[11] = new slctr("Garzon", null)
			Huila[12] = new slctr("Gigante", null)
			Huila[13] = new slctr("Guadalupe", null)
			Huila[14] = new slctr("Hobo", null)
			Huila[15] = new slctr("Iquira", null)
			Huila[16] = new slctr("Isnos", null)
			Huila[17] = new slctr("La Argentina", null)
			Huila[18] = new slctr("La Plata", null)
			Huila[19] = new slctr("Nataga", null)
			Huila[20] = new slctr("Oporapa", null)
			Huila[21] = new slctr("Paicol", null)
			Huila[22] = new slctr("Palermo", null)
			Huila[23] = new slctr("Palestina", null)
			Huila[24] = new slctr("Pital", null)
			Huila[25] = new slctr("Pitalito", null)
			Huila[26] = new slctr("Rivera", null)
			Huila[27] = new slctr("Saladoblanco", null)
			Huila[28] = new slctr("San Agustin", null)
			Huila[29] = new slctr("Santa Maria", null)
			Huila[30] = new slctr("Suaza", null)
			Huila[31] = new slctr("Tarqui", null)
			Huila[32] = new slctr("Tesalia", null)
			Huila[33] = new slctr("Tello", null)
			Huila[34] = new slctr("Teruel", null)
			Huila[35] = new slctr("Timana", null)
			Huila[36] = new slctr("Villavieja", null)
			Huila[37] = new slctr("Yaguara", null)

			var Magdalena = new Array()
			Magdalena[0] = new slctr('- - Magdalena - -')
			Magdalena[1] = new slctr("Santa Marta", null)
			Magdalena[2] = new slctr("Algarrobo", null)
			Magdalena[3] = new slctr("Aracataca", null)
			Magdalena[4] = new slctr("Ariguani", null)
			Magdalena[5] = new slctr("Cerro San Antonio", null)
			Magdalena[6] = new slctr("Chivolo", null)
			Magdalena[7] = new slctr("Cienaga", null)
			Magdalena[8] = new slctr("Concordia", null)
			Magdalena[9] = new slctr("El Banco", null)
			Magdalena[10] = new slctr("El Pi�on", null)
			Magdalena[11] = new slctr("El Reten", null)
			Magdalena[12] = new slctr("Fundacion", null)
			Magdalena[13] = new slctr("Guamal", null)
			Magdalena[14] = new slctr("Nueva Granada", null)
			Magdalena[15] = new slctr("Pedraza", null)
			Magdalena[16] = new slctr("Piji�o del Carmen", null)
			Magdalena[17] = new slctr("Pivijay", null)
			Magdalena[18] = new slctr("Plato", null)
			Magdalena[19] = new slctr("Pueblo Viejo", null)
			Magdalena[20] = new slctr("Remolino", null)
			Magdalena[21] = new slctr("Sabanas de San Angel", null)
			Magdalena[22] = new slctr("Salamina", null)
			Magdalena[23] = new slctr("San Sebaastian de Buenavista", null)
			Magdalena[24] = new slctr("San Zenon", null)
			Magdalena[25] = new slctr("Santa Ana", null)
			Magdalena[26] = new slctr("Santa Barbara de Pinto", null)
			Magdalena[27] = new slctr("Sitionuevo", null)
			Magdalena[28] = new slctr("Tenerife", null)
			Magdalena[29] = new slctr("Zapayan", null)
			Magdalena[30] = new slctr("Zona Bananera", null)

			var Meta = new Array()
			Meta[0] = new slctr('- - Meta - -')
			Meta[1] = new slctr("Villavicencio", null)
			Meta[2] = new slctr("Acacias", null)
			Meta[3] = new slctr("Barranca de Upia", null)
			Meta[4] = new slctr("Cabuyaro", null)
			Meta[5] = new slctr("Castilla la Nueva", null)
			Meta[6] = new slctr("Cubarral", null)
			Meta[7] = new slctr("Cumaral", null)
			Meta[8] = new slctr("El Calvario", null)
			Meta[9] = new slctr("El Castillo", null)
			Meta[10] = new slctr("El Dorado", null)
			Meta[11] = new slctr("Fuente de Oro", null)
			Meta[12] = new slctr("Granada", null)
			Meta[13] = new slctr("Guamal", null)
			Meta[14] = new slctr("Mapiripan", null)
			Meta[15] = new slctr("Mesetas", null)
			Meta[16] = new slctr("La Macarena", null)
			Meta[17] = new slctr("La Uribe", null)
			Meta[18] = new slctr("Lejanias", null)
			Meta[19] = new slctr("Puerto Concordia", null)
			Meta[20] = new slctr("Puerto Gaitan", null)
			Meta[21] = new slctr("Puerto Lopez", null)
			Meta[22] = new slctr("Puerto Lleras", null)
			Meta[23] = new slctr("Puerto Rico", null)
			Meta[24] = new slctr("Restrepo", null)
			Meta[25] = new slctr("San Carlos Guarua", null)
			Meta[26] = new slctr("San Juan de Arama", null)
			Meta[27] = new slctr("San Juanito", null)
			Meta[28] = new slctr("San Martin", null)
			Meta[29] = new slctr("Vista Hermosa", null)

			var Narino = new Array()
			Narino[0] = new slctr('- - Narino - -')
			Narino[1] = new slctr("San Juan de Pasto", null)
			Narino[2] = new slctr("Alban", null)
			Narino[3] = new slctr("Aldana", null)
			Narino[4] = new slctr("Ancuya", null)
			Narino[5] = new slctr("Arboleda", null)
			Narino[6] = new slctr("Barbacoas", null)
			Narino[7] = new slctr("Belen", null)
			Narino[8] = new slctr("Buesaco", null)
			Narino[9] = new slctr("Colon(Genova)", null)
			Narino[10] = new slctr("Consaca", null)
			Narino[11] = new slctr("Contadero", null)
			Narino[12] = new slctr("Cordoba", null)
			Narino[13] = new slctr("Cuaspud", null)
			Narino[14] = new slctr("Cumbal", null)
			Narino[15] = new slctr("Cumbitara", null)
			Narino[16] = new slctr("Chachagui", null)
			Narino[17] = new slctr("El Charco", null)
			Narino[18] = new slctr("El Pe�ol", null)
			Narino[19] = new slctr("El Rosario", null)
			Narino[20] = new slctr("El Tablon", null)
			Narino[21] = new slctr("El Tambo", null)
			Narino[22] = new slctr("Funes", null)
			Narino[23] = new slctr("Guachucal", null)
			Narino[24] = new slctr("Guaitarilla", null)
			Narino[25] = new slctr("Gualmatan", null)
			Narino[26] = new slctr("Iles", null)
			Narino[27] = new slctr("Imues", null)
			Narino[28] = new slctr("Ipiales", null)
			Narino[29] = new slctr("La Cruz", null)
			Narino[30] = new slctr("La Florida", null)
			Narino[31] = new slctr("La Llanada", null)
			Narino[32] = new slctr("La Tola", null)
			Narino[33] = new slctr("La Union", null)
			Narino[34] = new slctr("Leiva", null)
			Narino[35] = new slctr("Linares", null)
			Narino[36] = new slctr("Los Andes", null)
			Narino[37] = new slctr("Magui", null)
			Narino[38] = new slctr("Mallama", null)
			Narino[39] = new slctr("Mosquera", null)
			Narino[40] = new slctr("Nari�o", null)
			Narino[41] = new slctr("Olaya Herrera", null)
			Narino[42] = new slctr("Ospina", null)
			Narino[43] = new slctr("Pizarro", null)
			Narino[44] = new slctr("Policarpa", null)
			Narino[45] = new slctr("Potosi", null)
			Narino[46] = new slctr("Providencia", null)
			Narino[47] = new slctr("Puerres", null)
			Narino[48] = new slctr("Pupiales", null)
			Narino[49] = new slctr("Ricaurte", null)
			Narino[50] = new slctr("Roberto Payan", null)
			Narino[51] = new slctr("Samaniego", null)
			Narino[52] = new slctr("Sandona", null)
			Narino[53] = new slctr("San Bernardo", null)
			Narino[54] = new slctr("San Lorenzo", null)
			Narino[55] = new slctr("San Pablo", null)
			Narino[56] = new slctr("San Pedro de Cartago", null)
			Narino[57] = new slctr("Santa Barbara", null)
			Narino[58] = new slctr("Santacruz", null)
			Narino[59] = new slctr("Sapuyes", null)
			Narino[60] = new slctr("Taminango", null)
			Narino[61] = new slctr("Tangua", null)
			Narino[62] = new slctr("Tumaco", null)
			Narino[63] = new slctr("Tuquerres", null)
			Narino[64] = new slctr("Yacuanquer", null)

			var N_de_Santander = new Array()
			N_de_Santander[0] = new slctr('- - N_de_Santander - -')
			N_de_Santander[1] = new slctr("Cucuta", null)
			N_de_Santander[2] = new slctr("Abrego", null)
			N_de_Santander[3] = new slctr("Arboledas", null)
			N_de_Santander[4] = new slctr("Bochalema", null)
			N_de_Santander[5] = new slctr("Bucarasica", null)
			N_de_Santander[6] = new slctr("Cacota", null)
			N_de_Santander[7] = new slctr("Cachira", null)
			N_de_Santander[8] = new slctr("Chinacota", null)
			N_de_Santander[9] = new slctr("Chitaga", null)
			N_de_Santander[10] = new slctr("Convencion", null)
			N_de_Santander[11] = new slctr("Cucutilla", null)
			N_de_Santander[12] = new slctr("Durania", null)
			N_de_Santander[13] = new slctr("El Carmen", null)
			N_de_Santander[14] = new slctr("El Tarra", null)
			N_de_Santander[15] = new slctr("El Zulia", null)
			N_de_Santander[16] = new slctr("Gramalote", null)
			N_de_Santander[17] = new slctr("Hacari", null)
			N_de_Santander[18] = new slctr("Herran", null)
			N_de_Santander[19] = new slctr("Labateca", null)
			N_de_Santander[20] = new slctr("La Esperanza", null)
			N_de_Santander[21] = new slctr("La Playa", null)
			N_de_Santander[22] = new slctr("Los Patios", null)
			N_de_Santander[23] = new slctr("Lourdes", null)
			N_de_Santander[24] = new slctr("Mutiscua", null)
			N_de_Santander[25] = new slctr("Oca�a", null)
			N_de_Santander[26] = new slctr("Pamplona", null)
			N_de_Santander[27] = new slctr("Pamplonita", null)
			N_de_Santander[28] = new slctr("Puerto Santander", null)
			N_de_Santander[29] = new slctr("Ragonvalia", null)
			N_de_Santander[30] = new slctr("Salazar", null)
			N_de_Santander[31] = new slctr("San Calixto", null)
			N_de_Santander[32] = new slctr("San Cayetano", null)
			N_de_Santander[33] = new slctr("Santiago", null)
			N_de_Santander[34] = new slctr("Sardinata", null)
			N_de_Santander[35] = new slctr("Silos", null)
			N_de_Santander[36] = new slctr("Teorama", null)
			N_de_Santander[37] = new slctr("Tibu", null)
			N_de_Santander[38] = new slctr("Toledo", null)
			N_de_Santander[39] = new slctr("Villacaro", null)
			N_de_Santander[40] = new slctr("Villa del Rosario", null)

			var Putumayo = new Array()
			Putumayo[0] = new slctr('- - Putumayo - -')
			Putumayo[1] = new slctr("Mocoa", null)
			Putumayo[2] = new slctr("Colon", null)
			Putumayo[3] = new slctr("Orito", null)
			Putumayo[4] = new slctr("Puerto Asis", null)
			Putumayo[5] = new slctr("Puerto Caicedo", null)
			Putumayo[6] = new slctr("Puerto Guzman", null)
			Putumayo[7] = new slctr("Puerto Leguizamo", null)
			Putumayo[8] = new slctr("Sibundoy", null)
			Putumayo[9] = new slctr("San Francisco", null)
			Putumayo[10] = new slctr("San Miguel", null)
			Putumayo[11] = new slctr("Santiago", null)
			Putumayo[12] = new slctr("Valle del Guamuez", null)
			Putumayo[13] = new slctr("Villagarzon", null)

			var Quindio = new Array()
			Quindio[0] = new slctr('- - Quindio - -')
			Quindio[1] = new slctr("Armenia", null)
			Quindio[2] = new slctr("Buenavista", null)
			Quindio[3] = new slctr("Calarca", null)
			Quindio[4] = new slctr("Circasia", null)
			Quindio[5] = new slctr("Cordoba", null)
			Quindio[6] = new slctr("Filandia", null)
			Quindio[7] = new slctr("Genova", null)
			Quindio[8] = new slctr("La Tebaida", null)
			Quindio[9] = new slctr("Montenegro", null)
			Quindio[10] = new slctr("Pijao", null)
			Quindio[11] = new slctr("Quimbaya", null)
			Quindio[12] = new slctr("Salento", null)

			var Risaralda = new Array()
			Risaralda[0] = new slctr('- - Risaralda - -')
			Risaralda[1] = new slctr("Pereira", null)
			Risaralda[2] = new slctr("Apia", null)
			Risaralda[3] = new slctr("Balboa", null)
			Risaralda[4] = new slctr("Belen de Umbria", null)
			Risaralda[5] = new slctr("Dos Quebradas", null)
			Risaralda[6] = new slctr("Guatica", null)
			Risaralda[7] = new slctr("La Celia", null)
			Risaralda[8] = new slctr("La Virginia", null)
			Risaralda[9] = new slctr("Marsella", null)
			Risaralda[10] = new slctr("Mistrato", null)
			Risaralda[11] = new slctr("Pueblo Rico", null)
			Risaralda[12] = new slctr("Quinchia", null)
			Risaralda[13] = new slctr("Santa Rosa de Cabal", null)
			Risaralda[14] = new slctr("Santuario", null)

			var San_Andres = new Array()
			San_Andres[0] = new slctr('- - San_Andres - -')
			San_Andres[1] = new slctr("San Andres", null)
			San_Andres[2] = new slctr("Providencia", null)

			var Santander = new Array()
			Santander[0] = new slctr('- - Santander - -')
			Santander[1] = new slctr("Bucaramanga", null)
			Santander[2] = new slctr("Aguada", null)
			Santander[3] = new slctr("Albania", null)
			Santander[4] = new slctr("Aratoca", null)
			Santander[5] = new slctr("Barbosa", null)
			Santander[6] = new slctr("Barichara", null)
			Santander[7] = new slctr("Barrancabermeja", null)
			Santander[8] = new slctr("Betulia", null)
			Santander[9] = new slctr("Bolivar", null)
			Santander[10] = new slctr("Cabrera", null)
			Santander[11] = new slctr("california", null)
			Santander[12] = new slctr("Capitanejo", null)
			Santander[13] = new slctr("Carcasi", null)
			Santander[14] = new slctr("Cepita", null)
			Santander[15] = new slctr("Cerrito", null)
			Santander[16] = new slctr("Charala", null)
			Santander[17] = new slctr("Charta", null)
			Santander[18] = new slctr("Chima", null)
			Santander[19] = new slctr("Chipata", null)
			Santander[20] = new slctr("Cimitarra", null)
			Santander[21] = new slctr("Concepcion", null)
			Santander[22] = new slctr("Confines", null)
			Santander[23] = new slctr("Contratacion", null)
			Santander[24] = new slctr("Coromoro", null)
			Santander[25] = new slctr("Curiti", null)
			Santander[26] = new slctr("El Carmen", null)
			Santander[27] = new slctr("El Guacamayo", null)
			Santander[28] = new slctr("El Pe�on", null)
			Santander[29] = new slctr("El Playon", null)
			Santander[30] = new slctr("Encino", null)
			Santander[31] = new slctr("Enciso", null)
			Santander[32] = new slctr("Florian", null)
			Santander[33] = new slctr("Floridablanca", null)
			Santander[34] = new slctr("Galan", null)
			Santander[35] = new slctr("Gambita", null)
			Santander[36] = new slctr("Giron", null)
			Santander[37] = new slctr("Guaca", null)
			Santander[38] = new slctr("Guadalupe", null)
			Santander[39] = new slctr("Guapota", null)
			Santander[40] = new slctr("Guavata", null)
			Santander[41] = new slctr("Guepsa", null)
			Santander[42] = new slctr("Hato", null)
			Santander[43] = new slctr("Jesus Maria", null)
			Santander[44] = new slctr("Jordan", null)
			Santander[45] = new slctr("La Belleza", null)
			Santander[46] = new slctr("Landazuri", null)
			Santander[47] = new slctr("La Paz", null)
			Santander[48] = new slctr("Lebrija", null)
			Santander[49] = new slctr("Los Santos", null)
			Santander[50] = new slctr("Macaravita", null)
			Santander[51] = new slctr("Malaga", null)
			Santander[52] = new slctr("Matanza", null)
			Santander[53] = new slctr("Mogotes", null)
			Santander[55] = new slctr("Molagavita", null)
			Santander[55] = new slctr("Ocamonte", null)
			Santander[56] = new slctr("Oiba", null)
			Santander[57] = new slctr("Onzaga", null)
			Santander[58] = new slctr("Palmar", null)
			Santander[59] = new slctr("Palmas del Socorro", null)
			Santander[60] = new slctr("Paramo", null)
			Santander[61] = new slctr("Piedecuesta", null)
			Santander[62] = new slctr("Pinchote", null)
			Santander[63] = new slctr("Puente Nacional", null)
			Santander[64] = new slctr("Puerto Parra", null)
			Santander[65] = new slctr("Puerto Wilches", null)
			Santander[66] = new slctr("Rionegro", null)
			Santander[67] = new slctr("Sabana de Torres", null)
			Santander[68] = new slctr("San Andres", null)
			Santander[69] = new slctr("San Benito", null)
			Santander[70] = new slctr("San Gil", null)
			Santander[71] = new slctr("San Joaquin", null)
			Santander[72] = new slctr("San Jose de Miranda", null)
			Santander[73] = new slctr("San Miguel", null)
			Santander[74] = new slctr("San Vicente de Chucuri", null)
			Santander[75] = new slctr("Santa Barbara", null)
			Santander[76] = new slctr("Santa Helena", null)
			Santander[77] = new slctr("Simacota", null)
			Santander[78] = new slctr("Socorro", null)
			Santander[79] = new slctr("Suaita", null)
			Santander[80] = new slctr("Sucre", null)
			Santander[81] = new slctr("Surata", null)
			Santander[82] = new slctr("Tona", null)
			Santander[83] = new slctr("Valle San Jose", null)
			Santander[84] = new slctr("Velez", null)
			Santander[85] = new slctr("Vetas", null)
			Santander[86] = new slctr("Villanueva", null)
			Santander[87] = new slctr("Zapatoca", null)

			var Sucre = new Array()
			Sucre[0] = new slctr('- - Sucre - -')
			Sucre[1] = new slctr("Sincelejo", null)
			Sucre[2] = new slctr("Buenavista", null)
			Sucre[3] = new slctr("Caimito", null)
			Sucre[4] = new slctr("Coloso", null)
			Sucre[5] = new slctr("Corozal", null)
			Sucre[6] = new slctr("Cove�as", null)
			Sucre[7] = new slctr("Chalan", null)
			Sucre[8] = new slctr("El Roble", null)
			Sucre[9] = new slctr("Galeras", null)
			Sucre[10] = new slctr("Guaranda", null)
			Sucre[11] = new slctr("La Union", null)
			Sucre[12] = new slctr("Los Palmitos", null)
			Sucre[13] = new slctr("Majagual", null)
			Sucre[14] = new slctr("Morroa", null)
			Sucre[15] = new slctr("Ovejas", null)
			Sucre[16] = new slctr("Palmito", null)
			Sucre[17] = new slctr("Sampues", null)
			Sucre[18] = new slctr("San Benito Abad", null)
			Sucre[19] = new slctr("San Juan de betulia", null)
			Sucre[20] = new slctr("San Marcos", null)
			Sucre[21] = new slctr("San Onofre", null)
			Sucre[22] = new slctr("San Pedro", null)
			Sucre[23] = new slctr("Since", null)
			Sucre[24] = new slctr("Sucre", null)
			Sucre[25] = new slctr("Tolu", null)
			Sucre[26] = new slctr("Toluviejo", null)

			var Tolima = new Array()
			Tolima[0] = new slctr('- - Tolima - -')
			Tolima[1] = new slctr("Ibague", null)
			Tolima[2] = new slctr("Alpujarra", null)
			Tolima[3] = new slctr("Alvarado", null)
			Tolima[4] = new slctr("Ambalema", null)
			Tolima[5] = new slctr("Anzoategui", null)
			Tolima[6] = new slctr("Armero(Guayabal)", null)
			Tolima[7] = new slctr("Ataco", null)
			Tolima[8] = new slctr("Cajamarca", null)
			Tolima[9] = new slctr("Carmen Apicala", null)
			Tolima[10] = new slctr("Casabianca", null)
			Tolima[11] = new slctr("Chaparral", null)
			Tolima[12] = new slctr("Coello", null)
			Tolima[13] = new slctr("Coyaima", null)
			Tolima[14] = new slctr("Cunday", null)
			Tolima[15] = new slctr("Dolores", null)
			Tolima[16] = new slctr("Espinal", null)
			Tolima[17] = new slctr("Falan", null)
			Tolima[18] = new slctr("Flandes", null)
			Tolima[19] = new slctr("Fresno", null)
			Tolima[20] = new slctr("Guamo", null)
			Tolima[21] = new slctr("Herveo", null)
			Tolima[22] = new slctr("Honda", null)
			Tolima[23] = new slctr("Iconozno", null)
			Tolima[24] = new slctr("Lerida", null)
			Tolima[25] = new slctr("Libano", null)
			Tolima[26] = new slctr("Mariquita", null)
			Tolima[27] = new slctr("Melgar", null)
			Tolima[28] = new slctr("Murillo", null)
			Tolima[29] = new slctr("Natagaima", null)
			Tolima[30] = new slctr("Ortega", null)
			Tolima[31] = new slctr("Palocabildo", null)
			Tolima[32] = new slctr("Piedras", null)
			Tolima[33] = new slctr("Planadas", null)
			Tolima[34] = new slctr("Prado", null)
			Tolima[35] = new slctr("Purificacion", null)
			Tolima[36] = new slctr("Rioblanco", null)
			Tolima[37] = new slctr("Roncesvalles", null)
			Tolima[38] = new slctr("Rovira", null)
			Tolima[39] = new slctr("Salda�a", null)
			Tolima[40] = new slctr("San Antonio", null)
			Tolima[41] = new slctr("San Luis", null)
			Tolima[42] = new slctr("Santa Isabel", null)
			Tolima[43] = new slctr("Suarez", null)
			Tolima[44] = new slctr("Valle de San Juan", null)
			Tolima[45] = new slctr("Venadillo", null)
			Tolima[46] = new slctr("Villahermosa", null)
			Tolima[47] = new slctr("Villarrica", null)

			var Valle = new Array()
			Valle[0] = new slctr('- - Valle - -')
			Valle[1] = new slctr("Cali", null)
			Valle[2] = new slctr("Alcala", null)
			Valle[3] = new slctr("Andalucia", null)
			Valle[4] = new slctr("Ansermanuevo", null)
			Valle[5] = new slctr("Argelia", null)
			Valle[6] = new slctr("Bolivar", null)
			Valle[7] = new slctr("Buenaventura", null)
			Valle[8] = new slctr("Buga", null)
			Valle[9] = new slctr("Bugalagrande", null)
			Valle[10] = new slctr("Caicedonia", null)
			Valle[11] = new slctr("Calima", null)
			Valle[12] = new slctr("Candelaria", null)
			Valle[13] = new slctr("Cartago", null)
			Valle[14] = new slctr("Dagua", null)
			Valle[15] = new slctr("El Aguila", null)
			Valle[16] = new slctr("El Cairo", null)
			Valle[17] = new slctr("El Cerrito", null)
			Valle[18] = new slctr("El Dovio", null)
			Valle[19] = new slctr("Florida", null)
			Valle[20] = new slctr("Ginebra", null)
			Valle[21] = new slctr("Guacari", null)
			Valle[22] = new slctr("Jamundi", null)
			Valle[23] = new slctr("La Cumbre", null)
			Valle[24] = new slctr("La Union", null)
			Valle[25] = new slctr("La Victoria", null)
			Valle[26] = new slctr("Obando", null)
			Valle[27] = new slctr("Palmira", null)
			Valle[28] = new slctr("Pradera", null)
			Valle[29] = new slctr("Restrepo", null)
			Valle[30] = new slctr("Riofrio", null)
			Valle[31] = new slctr("Roldanillo", null)
			Valle[32] = new slctr("San Pedro", null)
			Valle[33] = new slctr("Sevilla", null)
			Valle[34] = new slctr("Toro", null)
			Valle[35] = new slctr("Trujillo", null)
			Valle[36] = new slctr("Tulua", null)
			Valle[37] = new slctr("Ulloa", null)
			Valle[38] = new slctr("Versalles", null)
			Valle[39] = new slctr("Vijes", null)
			Valle[40] = new slctr("Yotoco", null)
			Valle[41] = new slctr("Yumbo", null)
			Valle[42] = new slctr("Zarzal", null)

			var Vaupes = new Array()
			Vaupes[0] = new slctr('- - Vaupes - -')
			Vaupes[1] = new slctr("Mitu", null)
			Vaupes[2] = new slctr("Caruru", null)
			Vaupes[3] = new slctr("Taraira", null)

			var Vichada = new Array()
			Vichada[0] = new slctr('- - Vichada - -')
			Vichada[1] = new slctr("Puerto Carreno", null)
			Vichada[2] = new slctr("La Primavera", null)
			Vichada[3] = new slctr("Santa Rosalia", null)
			Vichada[4] = new slctr("Cumaribo", null)



			function slctryole(cual, donde) {
				if (cual.selectedIndex != 0) {
					donde.length = 0
					cual = eval(cual.value)
					for (m = 0; m < cual.length; m++) {
						var nuevaOpcion = new Option(cual[m].texto);
						donde.options[m] = nuevaOpcion;
						if (cual[m].valor != null) {
							donde.options[m].value = cual[m].valor
						} else {
							donde.options[m].value = cual[m].texto
						}
					}
				}
			}
		</script>

		<script>
			function validar(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
				patron = /\d/; //ver nota 
				te = String.fromCharCode(tecla);
				return patron.test(te);
			}

			// JavaScript Document
			function objetoAjax() {
				var xmlhttp = false;
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (E) {
						xmlhttp = false;
					}
				}

				if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
					xmlhttp = new XMLHttpRequest();
				}
				return xmlhttp;
			}

			function ValidaActividad(id) {
				//donde se mostrar� el formulario con los datos
				var doc = document.getElementById(id).value;
				//instanciamos el objetoAjax
				ajax = objetoAjax();
				//uso del medotod GET
				ajax.open("POST", "actividad.php", false);
				ajax.onreadystatechange = function() {
					if (ajax.readyState == 4) {
						//mostrar resultados en esta capa
						var res = ajax.responseText
						if (res == 0) {
							alert("El codigo de actividad no existe...");
							document.getElementById(id).value = '';
							document.getElementById(id).focus();
						}
						//mostrar el formulario
						// divFormulario.style.display="block";
					}
				}
				//como hacemos uso del metodo GET
				//colocamos null
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				//enviando los valores
				ajax.send("doc=" + doc);
			}
		</script>


	</head>

	<body>
		<table width="800" border="0" align="center">
			<tr>

				<td colspan="3">
					<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
						<div align="center">
							<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
						</div>
					</div>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
						<div align="center">
							<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
								<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center"><a href='terceros.php' target='_parent'>VOLVER </a> </div>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php
					$tercero = $_POST['a'];
					?>
					<?php
					if ($tercero == 'NATURAL') {
					?>
						<form name="a" method="post" action="proc_naturales.php" onsubmit="return confirm('Verifique su Informacion antes de Grabar')">
							<table width="750" border="1" align="center" class="bordepunteado1">
								<tr>
									<td colspan="4" bgcolor="#DCE9E5">
										<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
											<div align="center" class="Estilo4"><strong>REGISTRO DE TERCEROS NATURALES </strong></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="176" bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo10" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">TIPO DE IDENTIFICACION </div>
										</div>
									</td>
									<td width="182" bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="tipo_id" class="Estilo4" id="tipo_id" style="width:155px;">
												<option value="1">CEDULA CIUDADANIA</option>
												<option value="2">NIT</option>
												<option value="3">CEDULA EXTRANJERIA</option>
												<option value="4">PASAPORTE</option>
												<option value="5">SOC EXTRANJERA SIN NIT</option>
												<option value="6">REGISTRO CIVIL</option>
												<option value="7">TARJETA DE IDENTIDAD</option>
												<option value="8">TARJETA DE EXTRANJERIA</option>
												<option value="9">OTROS</option>
											</select>
										</div>
									</td>
									<td width="176" bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo20" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">NO. DE IDENTIFICACION </div>
										</div>
									</td>
									<td width="186" bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="num_id" type="text" class="Estilo4" id="num_id" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo11" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DV </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<label>
												<select name="dv" class="Estilo4" id="dv">
													<option value="-">-</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="0">0</option>
												</select>
											</label>
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo21" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">CLASE </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="clase" class="Estilo4" id="clase">
												<option value="" selected="selected"></option>
												<option value="CLIENTE">CLIENTE</option>
												<option value="PROVEEDOR">PROVEEDOR</option>
												<option value="CONTRATISTA">CONTRATISTA</option>
												<option value="NOMINA CA">NOMINA CA</option>
												<option value="NOMINA LNR">NOMINA LNR</option>
												<option value="OTROS">OTROS</option>
											</select>
										</div>
									</td>
								</tr>

								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo12" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">REGIMEN TRIBUTARIO </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="regimen" class="Estilo4" id="regimen">
												<option value="COMUN">COMUN</option>
												<option value="SIMPLIFICADO">SIMPLIFICADO</option>
												<option value="GRAN CONTRIBUYENTE">GRAN CONTRIBUYENTE</option>
												<option value="SECTOR PUBLICO">SECTOR PUBLICO</option>
												<option value="SECTOR FINANCIERO">SECTOR FINANCIERO</option>
												<option value="ESPECIAL">ESPECIAL</option>
												<option value="OTRO">OTRO</option>
												<option value="NINGUNO">NINGUNO</option>
											</select>
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo22" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">ENTIDAD OFICIAL </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div class="Estilo4" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="ent_ofi" class="Estilo4" id="ent_ofi">
												<option value="NO">NO</option>
												<option value="SI">SI</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo13" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">PRIMER APELLIDO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="pri_ape" type="text" class="Estilo4" id="pri_ape" style="width:150px;" onkeyup="a.pri_ape.value=a.pri_ape.value.toUpperCase();" />
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo23" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">SEGUNDO APELLIDO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="seg_ape" type="text" class="Estilo4" id="seg_ape" style="width:150px;" onkeyup="a.seg_ape.value=a.seg_ape.value.toUpperCase();" />
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo14" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">PRIMER NOMBRE </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="pri_nom" type="text" class="Estilo4" id="pri_nom" style="width:150px;" onkeyup="a.pri_nom.value=a.pri_nom.value.toUpperCase();" />
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo24" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">OTROS NOMBRES </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="seg_nom" type="text" class="Estilo4" id="seg_nom" style="width:150px;" onkeyup="a.seg_nom.value=a.seg_nom.value.toUpperCase();" />
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">
												<span class="Estilo4"><strong>ACTIVIDAD COMERCIAL</strong></span> <br />
												<span class="Estilo4">(CIIU)</span>
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="nom_com" type="text" class="Estilo4" id="nom_com" style="width:80px;" onkeyup="a.nom_com.value=a.nom_com.value.toUpperCase();" />
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo25" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">PAIS </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="select" class="Estilo4" onchange="slctryole(this,this.form.select2)" style="width:150px;">
												<option>- - Seleccionar - -</option>
												<option value="Colombia">Colombia</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo16" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DEPARTAMENTO </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="select2" class="Estilo4" onchange="slctryole(this,this.form.select3)" style="width:150px;">
												<option>- - - - - -</option>
											</select>
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo26" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">MUNICIPIO </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="select3" class="Estilo4" style="width:150px;">
												<option>- - - - - -</option>

											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo17" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DIRECCION </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="dir" type="text" class="Estilo4" id="dir" style="width:150px;" onkeyup="a.dir.value=a.dir.value.toUpperCase();" />
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo27" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">TELEFONO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="tel" type="text" class="Estilo4" id="tel" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo18" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">FAX </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="fax" type="text" class="Estilo4" id="fax" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">EMAIL </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="email" type="text" class="Estilo4" id="email" style="width:150px;" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo19" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">MOVIMIENTOS </div>
										</div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Contabilidad <span class="Estilo29">:::</span>
												<input name="contabilidad" type="checkbox" class="Estilo4" id="contabilidad" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right" class="Estilo4">Tesoreria <span class="Estilo29">:::</span>
												<input name="tesoreria" type="checkbox" class="Estilo4" id="tesoreria" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
								</tr>
								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Presupuesto <span class="Estilo29">:::</span>
												<input name="ppto" type="checkbox" class="Estilo4" id="ppto" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right" class="Estilo4">Almacen <span class="Estilo29">:::</span>
												<input name="almacen" type="checkbox" class="Estilo4" id="almacen" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
								</tr>
								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Interventor <span class="Estilo29">:::</span>
												<input name="interventor" type="checkbox" class="Estilo4" id="ppto" value="SI" />
											</div>
										</div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Embargo <span class="Estilo29">:::</span>
												<input name="embargo" type="checkbox" class="Estilo4" id="embargo" value="SI" />
												<!--input name="almacen" type="checkbox" class="Estilo4" id="almacen" value="SI" /-->
											</div>
										</div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>Valor <input name="monto" type="text" class="Estilo4" id="monto" style="width:100px;text-align:right" /></div>
									</td>
								</tr>



								<tr>
									<td colspan="4">
										<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
											<div align="center">
												<input name="Submit" type="submit" class="Estilo4" value="Guardar" />
											</div>
										</div>
									</td>
								</tr>
							</table>
						</form>

					<?php } else { ?>
						<form name="b" method="post" action="proc_juridicos.php" onsubmit="return confirm('Verifique su Informacion antes de Grabar')">
							<table width="750" border="1" align="center" class="bordepunteado1">
								<tr>
									<td colspan="4" bgcolor="#DCE9E5">
										<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
											<div align="center" class="Estilo4"><strong>REGISTRO DE TERCEROS JURIDICOS </strong></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="176" bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">TIPO DE IDENTIFICACION </div>
										</div>
									</td>
									<td width="182" bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="tip_id2" class="Estilo4" id="select" style="width:155px;">
												<option value="2">NIT</option>
												<option value="5">SOC EXTRANJERA SIN NIT</option>
												<option value="9">OTROS</option>
											</select>
										</div>
									</td>
									<td width="176" bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">NO. DE IDENTIFICACION </div>
										</div>
									</td>
									<td width="186" bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="num_id2" type="text" class="Estilo4" id="num_id2" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DV </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<label>
												<select name="dv2" class="Estilo4" id="select2">
													<option value="-">-</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="0">0</option>
												</select>
											</label>
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">CLASE </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="clase2" class="Estilo4" id="select3">
												<option value="CLIENTE">CLIENTE</option>
												<option value="PROVEEDOR">PROVEEDOR</option>
												<option value="CONTRATISTA">CONTRATISTA</option>
												<option value="NOMINA CA">NOMINA CA</option>
												<option value="NOMINA LNR">NOMINA LNR</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">REGIMEN TRIBUTARIO </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="regimen2" class="Estilo4" id="regimen2">
												<option value="COMUN">COMUN</option>
												<option value="SIMPLIFICADO">SIMPLIFICADO</option>
												<option value="GRAN CONTRIBUYENTE">GRAN CONTRIBUYENTE</option>
												<option value="SECTOR PUBLICO">SECTOR PUBLICO</option>
												<option value="SECTOR FINANCIERO">SECTOR FINANCIERO</option>
												<option value="ESPECIAL">ESPECIAL</option>
												<option value="OTRO">OTRO</option>
												<option value="NINGUNO">NINGUNO</option>
											</select>
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">ENTIDAD OFICIAL </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div class="Estilo4" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="ent_ofi2" class="Estilo4" id="select5">
												<option value="NO">NO</option>
												<option value="SI">SI</option>
											</select>
										</div>
									</td>
								</tr>

								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">CONTRIBUYENTE CREE </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="cree" class="Estilo4" id="select5">
												<option value="NO">NO</option>
												<option value="SI">SI</option>
											</select>
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">ACTIVIDAD ECONOMICA </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div class="Estilo4" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="act_eco" id="act_eco" type="text" size="5" onchange="ValidaActividad('act_eco');" />
										</div>
									</td>
								</tr>


								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right"> <span class="Estilo4"><strong>RAZON SOCIAL </strong></span></div>
										</div>
									</td>
									<td colspan="3">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="center">
												<input name="raz_soc2" type="text" class="Estilo4" id="raz_soc2" style="width:400px;" onkeyup="b.raz_soc2.value=b.raz_soc2.value.toUpperCase();" />
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right"> <span class="Estilo4"><strong>NOMBRE COMERCIAL</strong></span> <br />
												<span class="Estilo4">(siglas) </span>
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="nom_com2" type="text" class="Estilo4" id="nom_com2" style="width:150px;" onkeyup="b.nom_com2.value=b.nom_com2.value.toUpperCase();">
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">PAIS </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="selecta" class="Estilo4" id="selecta" style="width:150px;" onchange="slctryole(this,this.form.selectb)">
												<option>- - Seleccionar - -</option>
												<option value="Colombia" selected="selected">Colombia</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DEPARTAMENTO </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="selectb" class="Estilo4" id="selectb" style="width:150px;" onchange="slctryole(this,this.form.selectc)">
												<option>- - - - - -</option>
												<option value="Narino" selected="selected">Narino</option>
											</select>
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">MUNICIPIO </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<select name="selectc" class="Estilo4" id="selectc" style="width:150px;">
												<option>- - - - - -</option>
												<option value="Aldana" selected="selected">Aldana</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DIRECCION </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="dir2" type="text" class="Estilo4" id="dir2" style="width:150px;" onkeyup="b.dir2.value=b.dir2.value.toUpperCase();" />
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">TELEFONO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="tel2" type="text" class="Estilo4" id="tel2" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">FAX </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="fax2" type="text" class="Estilo4" id="fax2" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">EMAIL </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="email2" type="text" class="Estilo4" id="email2" style="width:150px;" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">MOVIMIENTOS </div>
										</div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Contabilidad <span class="Estilo29">:::</span>
												<input name="contabilidad2" type="checkbox" class="Estilo4" id="contabilidad2" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right" class="Estilo4">Tesoreria <span class="Estilo29">:::</span>
												<input name="tesoreria2" type="checkbox" class="Estilo4" id="tesoreria2" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
								</tr>
								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Presupuesto <span class="Estilo29">:::</span>
												<input name="ppto2" type="checkbox" class="Estilo4" id="ppto2" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right" class="Estilo4">Almacen <span class="Estilo29">:::</span>
												<input name="almacen2" type="checkbox" class="Estilo4" id="almacen2" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
								</tr>
								<tr>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
									<td class="Estilo4">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">Interventor <span class="Estilo29">:::</span>
												<input name="interventor" type="checkbox" class="Estilo4" id="ppto" value="SI" />
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right" class="Estilo4"> <span class="Estilo29">:::</span>
												<!--input name="almacen" type="checkbox" class="Estilo4" id="almacen" value="SI" /-->
											</div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> </div>
									</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#DCE9E5">
										<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
											<div align="center"><strong>REPRESENTANTE LEGAL </strong></div>
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo13" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">PRIMER APELLIDO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="pri_ape2" type="text" class="Estilo4" id="pri_ape2" style="width:150px;" onkeyup="b.pri_ape2.value=b.pri_ape2.value.toUpperCase();">
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo23" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">SEGUNDO APELLIDO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="seg_ape2" type="text" class="Estilo4" id="seg_ape2" style="width:150px;" onkeyup="b.seg_ape2.value=b.seg_ape2.value.toUpperCase();" />
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo14" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">PRIMER NOMBRE </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="pri_nom2" type="text" class="Estilo4" id="pri_nom2" style="width:150px;" onkeyup="b.pri_nom2.value=b.pri_nom2.value.toUpperCase();">
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo24" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">OTROS NOMBRES </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="seg_nom2" type="text" class="Estilo4" id="seg_nom2" style="width:150px;" onkeyup="b.seg_nom2.value=b.seg_nom2.value.toUpperCase();" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">DIRECCION </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="dir22" type="text" class="Estilo4" id="dir22" style="width:150px;" onkeyup="b.dir22.value=b.dir22.value.toUpperCase();" />
										</div>
									</td>
									<td class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">TELEFONO </div>
										</div>
									</td>
									<td>
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="tel22" type="text" class="Estilo4" id="tel22" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">FAX </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="fax22" type="text" class="Estilo4" id="fax22" style="width:150px;" onkeypress="return validar(event)" />
										</div>
									</td>
									<td bgcolor="#F5F5F5" class="Estilo4">
										<div class="Estilo28" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<div align="right">EMAIL </div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
											<input name="email22" type="text" class="Estilo4" id="email22" style="width:150px;" />
										</div>
									</td>
								</tr>


								<tr>
									<td colspan="4">
										<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
											<div align="center">
												<input name="Submit2" type="submit" class="Estilo4" value="Guardar" />
											</div>
										</div>
									</td>
								</tr>
							</table>
						</form>

					<?php } ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
						<div align="center">
							<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
								<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center"><a href='terceros.php' target='_parent'>VOLVER </a> </div>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
							<span class="Estilo4"> <strong>
									<?php include('../config.php');
									$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
									$sqlxx = "select * from fecha";
									$resultadoxx = $connectionxx->query($sqlxx);

									while ($rowxx = $resultadoxx->fetch_assoc()) {
										$ano = $rowxx["ano"];
									}
									echo $ano;
									?>
								</strong> </span> <br />
							<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><?php include('../config.php');
											echo $nom_emp ?><br />
							<?php echo $dir_tel ?><BR />
							<?php echo $muni ?> <br />
							<?php echo $email ?> </div>
					</div>
				</td>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
							</a><BR />
							<a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
						</div>
					</div>
				</td>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
						<div align="center">Desarrollado por <br />
							<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
							Derechos Reservados - 2009
						</div>
					</div>
				</td>
			</tr>
		</table>
		<p>&nbsp;</p>
	</body>

	</html>
<?php
}
?>