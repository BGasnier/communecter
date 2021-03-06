<?php
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	//'/js/sig/geolocInternational.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<?php 
	$me = Person::getById(Yii::app()->session['userId']);
	
	/*$lat = isset($me["geo"]) ? $me["geo"]["latitude"] : 
			@$me["geoPosition"] ? $me["geoPosition"]["coordinates"][1] : -21.13318 ;

	$lng = isset($me["geo"]) ? $me["geo"]["longitude"] : 
			isset($me["geoPosition"]) ? $me["geoPosition"]["coordinates"][0] : 55.5314 ;
	*/
	$lat = -21.13318;
	if(@$me["geo"]){ $lat = $me["geo"]["latitude"]; } else {
		if(@$me["geoPosition"]){ $lat = $me["geoPosition"]["coordinates"][1]; }
	}
	$lng = 55.5314;
	if(@$me["geo"]){ $lng = $me["geo"]["longitude"]; } else {
		if(@$me["geoPosition"]){ $lng = $me["geoPosition"]["coordinates"][0]; }
	}
	
	$sigParams = array(

		/* CLÉ UNIQUE QUI SERT D'IDENTIFIANT POUR CETTE CARTE */
		"sigKey" => "Entity",

		/* MAP */
		"mapHeight" => 350,
		"mapTop" => 0,
		"mapColor" => 'rgb(69, 96, 116)',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
		"mapOpacity" => 0.4, //ex : 0.4

		/* MAP LAYERS (FOND DE CARTE) */
		"mapTileLayer" 	  => 'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png',
		"mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	
		//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

		/* MAP BUTTONS */
		"mapBtnBgColor" => '#5896AB',
		"mapBtnColor" => '#213042',
		"mapBtnBgColor_hover" => '#456074',

		/* USE */
		"titlePanel" 		 => '',
        "usePanel" 			 => false,
        "useFilterType" 	 => false,
        "useRightList" 		 => true,
        "useZoomButton" 	 => false,
        "useHomeButton" 	 => false,
        "useSatelliteTiles"	 => false,
        "useFullScreen" 	 => false,
        "useFullPage" 	 	 => false,
        "useResearchTools" 	 => false,
        "useChartsMarkers" 	 => false,
        "useHelpCoordinates" => false,

		/* COORDONNÉES DE DÉPART (position géographique de la carte au chargement) && zoom de départ */
		"firstView"		  => array(  "coordinates" => array($lat, $lng),
									 "zoom"		  => 11),
		);
?>
<style>


/* css modale */
#country-geolocInternational{
	margin-bottom:10px;
}
#inputText-geolocInternational{
	width: 80%;
	height: 45px;
	padding-left: 10px;
	border-width: 0px;
	border-bottom-width: 1px;
}
#btn-geolocInternational{
	height: 45px;
	border-radius: 0px;
	width: 20%;
	text-align: center;
}

.btn-select-address{
	margin-top:3px;
}

#mapCanvasEntity{
	height:350px;
	width:100%;
	/*border-radius: 400px;*/
	/*max-width: 350px;*/
}
.sigModule<?php echo $sigParams['sigKey']; ?> #liste_map_element{
	padding-top:0px;
}
.sigModule<?php echo $sigParams['sigKey']; ?> #right_tool_map {
    width: unset;
    height: 305px;
    position: relative !important;
    right: 0%;
    top: 0%;
    border-bottom:1px solid #d4d4d4;
    border-left:1px solid #d4d4d4;
    -moz-box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
	-webkit-box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
	-o-box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
	box-shadow: -5px -5px 1px 0px rgba(189, 189, 189, 0);
}

.sigModule<?php echo $sigParams['sigKey']; ?> .info_item.pseudo_item_map_list{
	width-width: 100% !important;
	max-width: 100% !important;
	text-align: left;
	font-weight: 400;
    padding-bottom: 5px;
    padding-top: 5px;
}

.sigModule<?php echo $sigParams['sigKey']; ?> .element-right-list{
	border-bottom: 1px solid #c5c5c5;
	margin-bottom:-4px;
}

.sigModule<?php echo $sigParams['sigKey']; ?> .btn-group-map {
    float: left;
    top: 10px;
    right: -18px;
    left:unset;
    position: absolute;
}

.msg_list_res{
	padding: 50px;
	text-align: center;
	padding-top: 80px;
}

.sigModule<?php echo $sigParams['sigKey']; ?> .btn-map {
    padding: 7px 12px 9px !important;
    font-size: 14px !important;
}
.radio-typeInternationalSearch .radio{
	margin:5px !important;
}
.bg-success{
	background-color: #5cb85c!important;
}

.bg-success .info_item, .bg-red .info_item{
	color:white !important;
}
#modalHelpCP .modal-dialog{
	width:90% !important;
}
</style>

<div class="modal fade" id="modalHelpCP">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title text-dark">
        	<i class="fa fa-angle-down"></i> Trouver un code postal <span class="badge bg-green title-helpCP"></span>
        </h3>
      </div>
      <div class="modal-body pull-left col-md-12">
		<div class="sigModule<?php echo $sigParams['sigKey']; ?>">
			<div class="col-md-3 no-padding hidden">
				<form class="form-postalcode">
					<div class="col-md-12 no-padding">
						<select class="pull-left" id="country-geolocInternational"></select>
					</div>
					<!-- <div class="col-md-5 no-padding"></div>
					<div class="col-md-7 no-padding"></div> -->

				</form>
			</div>
			<div class="col-md-5 no-padding">
				<input type="text" id="inputText-geolocInternational" placeholder="quelle commune recherchez-vous ?">
				<button class="btn btn-success pull-right" id="btn-geolocInternational"><i class="fa fa-search"></i></button>
				<div id="right_tool_map">
					<div id="liste_map_element"></div>
				</div>
			</div>
			<div class="col-md-7 no-padding">
				<div id="mapCanvasEntity"></div>
				<div class="btn-group-map tools-btn">
					<?php if($sigParams['useSatelliteTiles']){ ?>
						<div class="btn-group btn-group-lg">
							<button type="button" class="btn btn-map bg-dark" id="btn-satellite"><i class="fa fa-magic"></i></button>
						</div>
					<?php } ?>
					<?php if($sigParams['useZoomButton']){ ?>
						<div class="btn-group btn-group-lg">		
							<button type="button" class="btn btn-map bg-dark" id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
							<button type="button" class="btn btn-map bg-dark" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
						</div>
					<?php } ?>
					<?php if($sigParams['useHomeButton']){ ?>
						<div class="btn-group btn-group-lg">
							<button type="button" class="btn btn-map" id="btn-home"><i class="fa fa-bullseye"></i></button>
						</div>
					<?php } ?>	
				</div>
			</div>
		</div>
	  </div>
      <div class="modal-footer">
		<div class="badge bg-white text-dark pull-left"><i class="fa fa-info-circle"></i> Recherchez une commune par son nom pour trouver son code postal</div>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-time"></i> Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">

	var allCountries = getCountries("select2");
	var formType = "city"; //a modifier sur les autres formulaires pour avoir le bon icon sur la carte

	var idCountryInput = "#<?php echo $idCountryInput; ?>";
	
	//console.dir(allCountries);
	$.each(allCountries, function(key, country){
	 	$("#country-geolocInternational").append("<option value='"+country.id+"'>"+country.text+"</option>");
	 });

	//var SigEntity;
	var mapEntity;
	var typeSearchInternational;

	jQuery(document).ready(function() {
	 	$(".moduleLabel").html("<i class='fa fa-plus'></i> <i class='fa fa-calendar'></i> Créer un événement");
		

	 	$("#btn-geolocInternational").click(function(){
	 		var country = $(idCountryInput).val(); 
	 		
	 		if(country == ""){
	 			showMsgListRes("Merci de sélectionner un pays avant de continuer");
	 			return;
	 		}

	 		typeSearchInternational = "address"; // $(".radio-typeInternationalSearch input[type='radio']:checked").val();
	 		
	 		var requestPart = $("#inputText-geolocInternational").val();
	 			
	 		var geoPos = getGeoPosInternational(requestPart, country);
	 	});

 		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;
		//chargement la carte
		mapEntity = loadMap("mapCanvas", initParams);
	});

function openModalHelpCP(){
	var country = $(idCountryInput).val(); 
	if(country == ""){
		$(".badge.title-helpCP").html("Attention : aucun pays selectionné");
		$(".badge.title-helpCP").removeClass("bg-green").addClass("bg-red");
	}else{
		$(".badge.title-helpCP").html(country);
		$(".badge.title-helpCP").removeClass("bg-red").addClass("bg-green");
	}

	$('#modalHelpCP').modal('show');
	setTimeout(function() {
					mapEntity.invalidateSize(false);
				}, 1000);
	
}

function showMsgListRes(msg){
	msg = msg != "" ? "<h1 class='msg_list_res'>" + msg + "</h1>" : "";
	$(".sigModuleEntity #liste_map_element").html(msg);
}

/*  return { id, cityName, postalCode, street, coordinates } 
	PROCESS GENERAL
*/
function getGeoPosInternational(requestPart, countryCode){

	var countryCodes = new Array("FR", "GP", "GF", "MQ", "YT", "NC", "RE", "PM");
	showMsgListRes("Recherche en cours ...");
	
	if($.inArray(countryCode, countryCodes) >= 0) callCommunecter(requestPart, countryCode);
	else
		callNominatim(requestPart, countryCode);
}

function callCommunecter(requestPart, countryCode){ /*countryCode=="FR"*/
	console.log('callCommunecter');
	showMsgListRes("Recherche en cours<br><small>Communecter</small>");
	callGeoWebService("communecter", requestPart, countryCode,
		function(objs){ /*success nominatim*/
			console.log("SUCCESS Communecter"); 

			if(objs.length != 0){
				console.log('Résultat trouvé chez Communecter !'); console.dir(objs);
				var commonGeoObj = getCommonGeoObject(objs, "communecter");
				var res = addResultsInForm(commonGeoObj, countryCode);
				if(res == 0) 
					callDataGouv(requestPart, countryCode); 
			}else{
				console.log('Aucun résultat chez Communecter');
				callDataGouv(requestPart, countryCode);
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR communecter");
			console.dir(thisError);
		}
	);
}

function callDataGouv(requestPart, countryCode){ /*countryCode=="FR"*/
	console.log('callDataGouv');
	showMsgListRes("Recherche en cours<br><small>Data Gouv</small>");
	callGeoWebService("data.gouv", requestPart, countryCode,
		function(objDataGouv){ /*success nominatim*/
			console.log("SUCCESS DataGouv"); 

			if(objDataGouv.length != 0){
				console.log('Résultat trouvé chez DataGouv !'); console.dir(objDataGouv);
				var commonGeoObj = getCommonGeoObject(objDataGouv.features, "data.gouv");
				var res = addResultsInForm(commonGeoObj, countryCode);
				if(res == 0) 
					callNominatim(requestPart, countryCode);
			}else{
				console.log('Aucun résultat chez DataGouv');
				callNominatim(requestPart, countryCode);
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR DataGouv");
			console.dir(thisError);
		}
	);
}

function callNominatim(requestPart, countryCode){
	console.log('callNominatim');
	showMsgListRes("Recherche en cours<br><small>Nominatim</small>");
	callGeoWebService("nominatim", requestPart, countryCode,
		function(objNomi){ /*success nominatim*/
			console.log("SUCCESS nominatim"); 

			if(objNomi.length != 0){
				console.log('Résultat trouvé chez Nominatim !'); console.dir(objNomi);

				var commonGeoObj = getCommonGeoObject(objNomi, "nominatim");
				var res = addResultsInForm(commonGeoObj, countryCode);

				if(res == 0) 
					callGoogle(requestPart, countryCode);
			}else{
				console.log('Aucun résultat chez Nominatim');
				callGoogle(requestPart, countryCode);
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR nominatim");
			console.dir(thisError);
		}
	);
}

function callGoogle(requestPart, countryCode){
	console.log('callGoogle');
	showMsgListRes("Recherche en cours<br><small>GoogleMap</small>");
	callGeoWebService("google", requestPart, countryCode,
		function(objGoo){ /*success google*/
			console.log("SUCCESS GOOGLE");
			if(objGoo.results.length != 0){
				console.log('Résultat trouvé chez Google !'); console.dir(objGoo);
				var commonGeoObj = getCommonGeoObject(objGoo.results, "google");
				var res = addResultsInForm(commonGeoObj, countryCode);
				if(res == 0) 
					showMsgListRes("Aucun résultat.<br>Précisez votre recherche.");
	
			}else{
				console.log('Aucun résultat chez Google');
				showMsgListRes("Aucun résultat.<br>Précisez votre recherche.");
			}

		}, 
		function(thisError){ /*error google*/
			showMsgListRes("Aucun résultat.<br>Précisez votre recherche.");
			console.log("ERROR GOOGLE"); console.dir(thisError);
		}
	);
}

/* fonction pour appeler le web service de géoloc de sont choix */
function callGeoWebService(providerName, requestPart, countryCode, success, error){
	var url = "";
	var data = {};

	if(providerName == "nominatim") {
		if(typeSearchInternational == "address")
		url = "//nominatim.openstreetmap.org/search?q=" + requestPart + "," + countryCode + "&format=json&polygon=0&addressdetails=1";
		else if(typeSearchInternational == "city")
		url = "//nominatim.openstreetmap.org/search?city=" + requestPart + "&country=" + countryCode + "&format=json&polygon=0&addressdetails=1";
	}
	
	if(providerName == "google") {
		if(typeSearchInternational == "address")
		url = "//maps.googleapis.com/maps/api/geocode/json?address=" + requestPart + "," + countryCode;
		else if(typeSearchInternational == "city")
		url = "//maps.googleapis.com/maps/api/geocode/json?locality=" + requestPart + "&country=" + countryCode;
	}	
	if(providerName == "data.gouv") {
		if(typeSearchInternational == "address")
		url = "//api-adresse.data.gouv.fr/search/?q=" + requestPart;
		else if(typeSearchInternational == "city")
		url = "//api-adresse.data.gouv.fr/search/?q=" + requestPart + "&type=city";
	}
	if(providerName == "communecter") {
		url = baseUrl+"/"+moduleId+"/search/globalautocomplete";
		data = {"name" : requestPart, "country" : countryCode, "searchType" : [ "cities" ], "searchBy" : "ALL"  };
	}

	console.log("calling : " + url);
	if(url != ""){
		if(providerName != "communecter"){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				async:false,
				crossDomain:true,
				complete: function () {},
				success: function (obj){
					success(obj);
				},
				error: function (thisError) {
					error(thisError);
				}
			});
		}else{
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data:data,
				complete: function () {},
				success: function (obj){
					success(obj);
				},
				error: function (thisError) {
					error(thisError);
				}
			});
		}
	}else{
		toastr.error('provider inconnu');
		return false;
	}
}


/* retourne un obj address commun à partir des données des différents webservices */
function getCommonGeoObject(objs, providerName){

	var commonObjs = new Array();
	var multiCpName = new Array();
	$.each(objs, function(key, obj){

		var commonObj = {};
		if(providerName == "nominatim"){
			var address = obj["address"];
			commonObj = addAttObjNominatim(commonObj, address, "streetNumber", "house_number");
			
			commonObj = addAttObjNominatim(commonObj, address, "street", "road");
			if(typeof commonObj["street"] == "undefined")
			commonObj = addAttObjNominatim(commonObj, address, "street", "locality");
			
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "county");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "city");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "town");
			commonObj = addAttObjNominatim(commonObj, address, "country", "country");
			commonObj = addAttObjNominatim(commonObj, address, "countryCode", "country_code");
			commonObj = addAttObjNominatim(commonObj, address, "postalCode", "postcode");
			commonObj = addAttObjNominatim(commonObj, obj, "placeId", "place_id");

		}else 
		if(providerName == "google"){
			$.each(obj.address_components, function(addressKey, component){
				commonObj = addAttObjGoogle(commonObj, component, "streetNumber", "street_number", "long_name");
				commonObj = addAttObjGoogle(commonObj, component, "street", "route", "long_name");
				commonObj = addAttObjGoogle(commonObj, component, "cityName", "locality", "short_name");
				commonObj = addAttObjGoogle(commonObj, component, "country", "country", "long_name");
				commonObj = addAttObjGoogle(commonObj, component, "countryCode", "country", "short_name");
				commonObj = addAttObjGoogle(commonObj, component, "postalCode", "postal_code", "long_name");
			});
			commonObj = addAttObjNominatim(commonObj, obj, "placeId", "place_id");
		}else 
		if(providerName == "data.gouv"){
			console.log("details result data.gouv");
			console.dir(obj);
			var address = obj["properties"];
			commonObj = addAttObjNominatim(commonObj, address, "street", "name");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "city");
			commonObj = addAttObjNominatim(commonObj, address, "country", "country");
			commonObj = addAttObjNominatim(commonObj, address, "postalCode", "postcode");
			commonObj = addAttObjNominatim(commonObj, address, "insee", "citycode");
			commonObj["countryCode"] = "FR";
			commonObj = addAttObjNominatim(commonObj, address, "placeId", "id");
		
		}else 
		if(providerName == "communecter"){
			console.log("details result communecter");
			console.dir(obj);
			commonObj = addAttObjNominatim(commonObj, obj, "cityName", "name");
			commonObj = addAttObjNominatim(commonObj, obj, "countryCode", "country");
			commonObj = addAttObjNominatim(commonObj, obj, "postalCode", "cp");
			commonObj = addAttObjNominatim(commonObj, obj, "insee", "insee");
			commonObj["placeId"] = obj["country"]+"_"+obj["insee"]+"-" + obj["cp"];
		
		}

		commonObj = addCoordinates(commonObj, obj, providerName);
		commonObj["type"] = "addressEntity";
		commonObj["typeSig"] = formType;
		commonObj["name"] = getFullAddress(commonObj);

		if(typeof commonObj["postalCode"] != "undefined" && commonObj["postalCode"].indexOf(";") >= 0){
			var CPS = commonObj["postalCode"].split(";");
			$.each(CPS, function(index, value){
				var oneCity = commonObj;
				oneCity["postalCode"] = value;
				oneCity["name"] = oneCity["cityName"] + ", " + value + ", " + oneCity["country"];

				if($.inArray(oneCity["name"], multiCpName) < 0){
					multiCpName.push(oneCity["name"]);
					commonObjs.push(oneCity);
				}
			});
		}else{
			commonObjs.push(commonObj);
		}
	});

	

	return commonObjs;
}


//ajoute les attribut s'ils existent
function addAttObjNominatim(obj1, obj2, att1, att2){
	if(typeof obj2[att2] != "undefined") obj1[att1] = obj2[att2];
	return obj1;
}

function addAttObjGoogle(obj1, obj2, att1, att2, nameLength){
	
	if($.inArray(att2, obj2.types) >= 0){
		obj1[att1] = obj2[nameLength];
	}
	return obj1;
}

//récupère les coordonnées et transforme la data dans notre format geo
function addCoordinates(commonObj, obj, providerName){

	var lat = null; var lng = null; var geoShape = null;

	if(providerName == "nominatim"){
		lat = (typeof obj["lat"] != "undefined") ? obj["lat"] : null;
		lng = (typeof obj["lon"] != "undefined") ? obj["lon"] : null;
		geoShape = (typeof obj["boundingbox"] != "undefined") ? obj["boundingbox"] : null;
	}else 
	if(providerName == "google"){ console.log("coordinates google"); console.dir(obj);
		if(typeof obj["geometry"] != "undefined" && typeof obj["geometry"]["location"] != "undefined"){
			lat = (typeof obj["geometry"]["location"]["lat"] != "undefined") ? obj["geometry"]["location"]["lat"] : null;
			lng = (typeof obj["geometry"]["location"]["lng"] != "undefined") ? obj["geometry"]["location"]["lng"] : null;
			//geoShape = (typeof obj["boundingbox"] != "undefined") ? obj["boundingbox"] : null; 
			//TODO : rajouter le boundingbox (transfoormer format google to leaflet polygon)
		}
	}else 
	if(providerName == "data.gouv"){
		if(typeof obj["geometry"] != "undefined" && typeof obj["geometry"]["coordinates"] != "undefined"){
			lat = (typeof obj["geometry"]["coordinates"][1] != "undefined") ? obj["geometry"]["coordinates"][1] : null;
			lng = (typeof obj["geometry"]["coordinates"][0] != "undefined") ? obj["geometry"]["coordinates"][0] : null;
			//TODO : geoshape
		}
	}
	else 
	if(providerName == "communecter"){
		if(typeof obj["geo"] != "undefined") commonObj["geo"] = obj["geo"];
		if(typeof obj["geoPosition"] != "undefined") commonObj["geoPosition"] = obj["geoPosition"];
		return commonObj;
	}

	if(lat != null && lng != null){
		commonObj["geo"] = { "@type" : "GeoCoordinates", 
							 "latitude" : lat,  "longitude" : lng };

		commonObj["geoPosition"] = { "type" : "Point", "float" : true, 
									 "coordinates" : new Array(lat, lng) };
	}

	if(geoShape != null){
		commonObj["geoShape"] = { "type" : "Polygon", 
							 "coordinates" : geoShape };
	}

	return commonObj;
}



/* affiche les résultat de la recherche dans la div #result (à placer dans l'interface au préalable) */
var markerListEntity = null;
function addResultsInForm(commonGeoObj, countryCode){
	
	//clear map
	var thisSig = Sig;
	if(markerListEntity != null)
	$.each(markerListEntity, function(){
		mapEntity.removeLayer(this);
	});
	markerListEntity = new Array();

	Sig.clearPolygon();
	Sig.listId = new Array();
	
	//clear list
	showMsgListRes("");

	//show objs in map && list
	var totalShown = 0;
	$.each(commonGeoObj, function(key, obj){
		console.log("obj.countryCode > " + obj.countryCode.toLowerCase() 
					+ " == " + countryCode.toLowerCase() + " < countryCode");

		//verifie que le countryCode correspond au choix dans le formulaire, 
		//et que la donnée a au moins un nom ou un code postal
		if(obj.countryCode.toLowerCase() == countryCode.toLowerCase() && 
		   (typeof obj.cityName != "undefined" || 
		   typeof obj.postalCode != "undefined")){ totalShown++;
				showOneElementOnMap(obj, mapEntity);
		}
	});
	//var markersLayerAddress = L.featureGroup(markerListEntity);
	if(totalShown>0){
		mapEntity.fitBounds(L.featureGroup(markerListEntity).getBounds(), { 'maxZoom' : 14 });
		mapEntity.zoomOut();
	}
	console.log("total : " + totalShown);
	return totalShown;
}

function getFullAddress(obj){
	var strResult = "";
	if(typeof obj.street != "undefined") strResult += obj.street;
	if(typeof obj.cityName != "undefined") strResult += (strResult != "") ? ", " + obj.cityName : obj.cityName;
	if(typeof obj.postalCode != "undefined") strResult += (strResult != "") ? ", " + obj.postalCode : obj.postalCode;
	if(typeof obj.country != "undefined") strResult += (strResult != "") ? ", " + obj.country : obj.country;
	return strResult;
}


function checkCityExists(addressData, btn){
	var data = "";
	if(typeof addressData.placeId != "undefined")
		data = "insee=" + addressData.placeId;
	if(typeof addressData.postalCode != "undefined"){ if(data != "") data += "&";
		data += "postalCode=" + addressData.postalCode;
	}
	if(typeof addressData.cityName != "undefined"){ if(data != "") data += "&";
		data += "cityName=" + addressData.cityName;
	}
	if(typeof addressData.country != "undefined"){ if(data != "") data += "&";
		data += "country=" + addressData.countryCode;
	}

	console.log("start verify city exists  : " + data);

	$.ajax({
			url: baseUrl+"/"+moduleId+"/city/cityExists",
			type: 'POST',
			data: data,
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (thisSuccess){
				if(thisSuccess.res == true){
					console.log("cityExists : TRUE");
					console.dir(thisSuccess.obj);
					$(".item_map_list").removeClass("bg-success text-white");
					$(".item_map_list").removeClass("bg-red text-white");
					$(btn).addClass("bg-success text-white");
				}else{
					console.log("cityExists : FLASE");
					$(".item_map_list").removeClass("btn-success text-white");
					$(".item_map_list").removeClass("bg-red text-white");
					$(btn).addClass("bg-red text-white");
				}
			},
			error: function (thisError) {
				console.log("cityExists : ERROR");
				console.dir(thisError);
				$(btn).addClass("bg-red text-white");
			}
		});
}

/**********************************************************************************************/
/*************************************     MAP        *****************************************/
/**********************************************************************************************/

function loadMap(canvasId, initParams)
{
	console.warn("--------------- loadMap ENTITY ---------------------");
	canvasId += initParams.sigKey;
	
	$("#"+canvasId).html("");
	$("#"+canvasId).css({"background-color": initParams.mapColor});

	//initialisation des variables de départ de la carte
	if(canvasId != "")
	var mapEntity = L.map(canvasId, { "zoomControl" : false,
								"scrollWheelZoom":true,
								"center" : initParams.firstView.coordinates,
								"zoom" : initParams.firstView.zoom,
								"worldCopyJump" : false });

	var tileLayer = L.tileLayer(initParams.mapTileLayer, { 
		attribution: 'Map tiles by ' + initParams.mapAttributions,
		minZoom: 3,
		maxZoom: 20
	});

	tileLayer.setOpacity(initParams.mapOpacity).addTo(mapEntity);

	var roadTileLayer = L.tileLayer('//otile{s}-s.mqcdn.com/tiles/1.0.0/{type}/{z}/{x}/{y}.{ext}', {
					type: 'hyb',
					ext: 'png',
					attribution: 'Tiles Courtesy of <a href="http://www.mapquest.com/">MapQuest</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
					subdomains: '1234',
					opacity: 0.7,
					minZoom:12,
					maxZoom: 20
				});
	roadTileLayer.addTo(mapEntity);

	//rafraichi les tiles après le redimentionnement du mapCanvas
	mapEntity.invalidateSize(false);
	return mapEntity;
};


function showOneElementOnMap(thisData, thisMap){
				
	var objectId = Sig.getObjectId(thisData);
	console.log("showOneElementOnMap");
	console.dir(thisData);
	console.dir(objectId);

	if(objectId != null){
					
		if(("undefined" != typeof thisData['geo'] && thisData['geo'] != null) || ("undefined" != typeof thisData['geoPosition'] && thisData['geoPosition'] != null)) {
			
				var type = (typeof thisData["typeSig"] !== "undefined") ? thisData["typeSig"] : thisData["type"];
				//préparation du contenu de la bulle
				var content = Sig.getPopupAddress(thisData, "Utiliser ce code postal");
				//création de l'icon sur la carte
				var theIcon = Sig.getIcoMarkerMap(thisData);
				console.log("theIcon");
				console.dir(theIcon);
				var properties = { 	id : objectId,
									icon : theIcon,
									type : thisData["type"],
									typeSig : type,
									name : thisData["name"],
									faIcon : Sig.getIcoByType(thisData),
									content: content };

				var coordinates = Sig.getCoordinates(thisData, "markerSingle");
				var marker = Sig.getMarkerSingle(thisMap, properties, coordinates);
				marker.dragging.enable();

				markerListEntity.push(marker);
						
				if(typeof thisData["geoShape"] != "undefined" && typeof thisData["geoShape"]["coordinates"] != "undefined"){
					var geoShape = thisData["geoShape"]; //Sig.inversePolygon(thisData["geoShape"]["coordinates"]);
					Sig.addPolygon(geoShape);
				}
				
				
				createItemRigthListMap(thisData, marker, thisMap);
				//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
				//si le marker n'est pas dans un cluster (sinon le click est géré dans le .geoJson.onEachFeature)
				$(".sigModuleEntity .item_map_list_" + objectId).click(function()
				{	thisMap.setZoom(10);
					Sig.checkListElementMap(thisMap);
					marker.openPopup();
					thisMap.panTo(coordinates, {"animate" : false });
					thisMap.panBy([0, -80], {"animate" : false });

					
					console.log("onclick " + thisData.cityName);
					//checkCityExists(thisData, this);

					$(".btn-communecter-city").click(function(){
						var cp = $(this).attr("cp-com");
						$("input#postalCode").val(cp);
						searchCity();
						$('#modalHelpCP').modal('hide');
					});

					//if(typeof thisData.postalCode == "undefined")
					//askNominatimCp(thisData.cityName);
					//setTimeout(function(){ mapEntity.invalidateSize(false); }, 1000);
					thisMap.invalidateSize(false);
				});
				
		}
	}
}

function createItemRigthListMap(element, thisMarker, thisMap){

	var imgProfilPath =  Sig.getThumbProfil(element);
	//prépare le nom (ou "anonyme")
	var name = (element['name'] != null) ? element['name'] : "Anonyme";

	//récupère l'url de l'icon a afficher
	// var ico = Sig.getIcoByType(element);
	// var color = Sig.getIcoColorByType(element);

	// var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

	var button = '<div class="element-right-list" id="element-right-list-'+Sig.getObjectId(element)+'">' +
    				'<button class="item_map_list item_map_list_'+ Sig.getObjectId(element) +'">' +
	    				"<div class='info_item pseudo_item_map_list text-dark'>" +  
	    					'<i class="fa fa-map-marker"></i>' +
	    					name + 
	    				"</div>" +
	    			'</button>' + 
	    		  "</div>";

	$(".sigModuleEntity #liste_map_element").append(button);				
}

function askNominatimCp(cityName){
	http://nominatim.openstreetmap.org/search?format=json&city=Noum%C3%A9a&countrycodes=FR
	//var url = "//nominatim.openstreetmap.org/search?city=" + cityName + "&format=json&polygon=0&addressdetails=1";
	var url ="//maps.googleapis.com/maps/api/geocode/json?address=" + cityName;
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		async:false,
		crossDomain:true,
		complete: function () {},
		success: function (obj){
			console.log("askNominatimCp success");
			console.dir(obj);
		},
		error: function (thisError) {
			console.log("askNominatimCp error");
			toastr.error(thisError);
		}
	});
}

// var tileMode = "terrain";
// function createItemRigthListMap(element, thisMarker, thisMap){
// 	$(".sigModuleEntity #btn-satellite").click(function(){
// 		if(tileMode == "terrain"){
// 			tileMode = "satellite";
// 			if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);
// 			thisSig.tileLayer = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', 
// 											{maxZoom:17,
// 											 minZoom:3}).addTo(Sig.map);
// 			thisSig.map.minZoom = 0;
// 			thisSig.map.maxZoom = 17;
// 		}else if(thisSig.tileMode == "satellite"){
// 			thisSig.tileMode = "terrain";
// 			if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);
// 			thisSig.tileLayer = L.tileLayer(thisSig.initParameters.mapTileLayer, 
// 									{maxZoom:20,
// 									 minZoom:3}).addTo(Sig.map);
// 			thisSig.map.minZoom = 0;
// 			thisSig.map.maxZoom = 20;
// 		}
// 		if(thisSig.map.getZoom() > thisSig.map.getMaxZoom()) 
// 			thisSig.map.setZoom(thisSig.map.getMaxZoom());
// 	});
// }
</script>


