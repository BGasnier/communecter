<?php 
		if(isset(Yii::app()->session["userId"]) && $openEdition==true){
			Menu::entry("right", 'onclick',
	                            Yii::t( "common", "Become admin of this event"),
	                            Yii::t( "common", "Become admin"), 
	                            'fa fa-user-plus becomeAdminBtn',
	                            "connectTo('".Event::COLLECTION."','".(string)$event["_id"]."','".Yii::app()->session["userId"]."','".Person::COLLECTION."','admin')",null,null);
        }
		$this->renderPartial('../default/panels/toolbar'); 
?>

<?php
	$admin = false;
	if(isset(Yii::app()->session["userId"]) && isset($event["_id"])){
		$admin = Authorisation::canEditItem(Yii::app()->session["userId"], Event::COLLECTION, (string)$event["_id"]);
	}
?>
<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12">
		<?php $this->renderPartial('dashboard/description',array(
									"event" => $event,
									"organizer" =>$organizer,
									"itemId" => (string)$event["_id"],
									"eventTypes" => $eventTypes,
									"type" => Event::COLLECTION,
									"countries" => $countries,
									"imagesD" => $images,
									"edit"=>$admin,
									"openEdition"=>$openEdition
								));
								?>
		

		

		<div class="col-xs-12 no-padding calendar pull-left"></div>
		<div class="col-xs-12 no-padding timesheetphp pull-left"></div>
	</div>
	<div class="col-md-4 col-sm-12 col-xs-12">
		<?php  //print_r($attending); 
			$this->renderPartial('../pod/usersList', array(  "event"=> $event,
															"users" => $attending,
															"userCategory" => Yii::t("event","ATTENDEES",null,Yii::app()->controller->module->id), 
															"contentType" => Event::COLLECTION,
															"admin" => $admin,
															"countLowLinks" => $invitedNumber,
															"countStrongLinks"=> $attendeeNumber,
															"invitedMe" => @$invitedMe));
		if (!empty($subEvents) || $admin==1)
		{ 
				//ORGANISER LIST
				/*if( !empty($subEventsOrganiser) ){
					$this->renderPartial('../pod/usersList', array( "event" => $event,
																	"users" => $subEventsOrganiser,
																	"userCategory" => Yii::t("event","SUBEVENT ORGANISER",null,Yii::app()->controller->module->id), 
																	"contentType" => Event::COLLECTION,
																	"noAddLink" => true));
				}*/

				if(!isset($eventTypes)) $eventTypes = array();
				$this->renderPartial('../pod/eventsList',array( "events" => $subEvents, 
																"contextId" => (String) $event["_id"],
																"contextType" => Event::CONTROLLER,
																"list" => $eventTypes,
																"authorised" => $admin,
																"organiserImgs"=> true
																  )); 

		} ?>
	</div>
</div>
<script type="text/javascript">
	<?php $attending[] = $event; ?>
	<?php $attending[] = $organizer; ?>
	
	var contextMap = <?php echo json_encode($attending)?>;
	var thisEvent = <?php echo json_encode($event)?>;
	
	jQuery(document).ready(function() {
		$(".moduleLabel").html("<i class='fa fa-circle text-orange'></i> <i class='fa fa-calendar'></i> <?php echo addslashes($event["name"]) ?> ");
		console.dir(contextMap);
		
		Sig.restartMap();
		Sig.showMapElements(Sig.map, contextMap);
		
		<?php if (!empty($subEvents)){ ?>
		//getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Event::COLLECTION ?>/id/<?php echo $event["_id"]?>/isAdmin/0/isDetailView/1",null,"html");
		getAjax(".calendar",baseUrl+"/"+moduleId+"/event/calendarview/id/<?php echo $event["_id"]?>/pod/1?date=1",null,"html");
		<?php } ?>
	});
</script>
