<?php 
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
  '/js/dataHelpers.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);


$logguedAndValid = Person::logguedAndValid();
$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$action);

if( Yii::app()->request->isAjaxRequest ){
	Menu::action( $action );
	$this->renderPartial('../default/panels/toolbar');
}
?>
<style type="text/css">

	/*a.btn{margin:3px;}*/
	a:hover.btn {background-color: pink;border solid #666;}

	/*.infolink{border-top:1px solid #fff}*/
	.leftlinks a.btn{color:black;background-color: yellow;border: 0px solid yellow;}
	.leftlinks a.btn:hover{color:white;background-color: #3C5665;}
	/*.rightlinks a.btn{background-color: beige;border: 1px solid beige;}*/
	a.btn.alertlink		{background-color:red;color:white;border: 1px solid red;}
	a.btn.golink		{background-color:green;color:white;border: 1px solid green;}
	a.btn.voteUp		{background-color: #93C22C;border: 1px solid green;}
	a.btn.voteUnclear	{background-color: yellow;border: 1px solid yellow;}
	a.btn.voteMoreInfo	{background-color: #C1ABD4;border: 1px solid #789289;}
	a.btn.voteAbstain	{color: black;background-color: white;border: 1px solid grey !important;}
	a.btn.voteDown		{background-color: #db254e;border: 1px solid #db254e;}

	.commentPod .panel {box-shadow: none;}
	.commentPod .panel-heading {border-bottom-width: 0px;}

	.assemblyHeadSection {  
      background-image:url(<?php echo $this->module->assetsUrl; ?>/images/Discussion.jpg); 
      /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
      background-color: #fff;
      background-repeat: no-repeat;
      background-position: 0px -50px;
      background-size: 100% auto;
    }

      .citizenAssembly-header{
        background-color: rgba(255, 255, 255, 0.63);
		padding-top: 0px;
		margin-bottom: -3px;
		font-size: 32px;
		top: 115px;
		z-index: 1;
		position: absolute;
		width: 96%;
		left: 2%;
		padding-bottom: 15px;
      }

    .citizenAssembly-header h1{
    	font-size: 32px;
		
    }
    .row.vote-row {
	   	position: absolute;
		padding-top: 5px;
		top: 300px;
		background-color: white;
		width: 100%;
		z-index: 0;
    }

    .leftlinks a.btn{
    	border: transparent;
		border-radius: 25px;
		font-size: 25px;
    }

  .progress-bar-green{background-color: #93C22C;}
  .progress-bar-yellow{background-color: yellow;}
  .progress-bar-white{background-color: #C9C9C9;}
  .progress-bar-purple{background-color: #C1ABD4;}
  .progress-bar-red{background-color: #db254e;}

  .color-btnvote-green{background-color: #93C22C;color: black;	padding: 8px;border-radius: 30px;}
  .color-btnvote-yellow{background-color: yellow;color: black;	padding: 8px;border-radius: 30px;}
  .color-btnvote-white{background-color: #FFF;color: black;	padding: 8px;border-radius: 30px;border: 1px solid #939393;}
  .color-btnvote-purple{background-color: #C1ABD4;color: black;	padding: 8px;border-radius: 30px;}
  .color-btnvote-red{background-color: #db254e;color: black;		padding: 8px;border-radius: 30px;}

  .msg-head-tool-vote{
  	width:100%;
  	font-size: 18px;
  	font-weight: 300;
  }

  #thumb-profil-parent{
      margin-top:-60px;
      margin-bottom:20px;
      -moz-box-shadow: 0px 3px 10px 1px #656565;
      -webkit-box-shadow: 0px 3px 10px 1px #656565;
      -o-box-shadow: 0px 3px 10px 1px #656565;
      box-shadow: 0px 3px 10px 1px #656565;
    }


#commentHistory .panel-scroll{
	max-height:unset !important;
}


@media screen and (min-width: 1060px) {
  
}
@media screen and (max-width: 1060px) {
  
  .assemblyHeadSection {  
    background-position: 0px 50px;
  }

  .container-tool-vote {
    font-size: 17px;
    margin-top: 60px;
  }
}

@media screen and (max-width: 767px) {
  .assemblyHeadSection {  
    background-position: 0px 0px;
  }
  .citizenAssembly-header{
  	top: 70px;
  	height:160px;
  }
  .citizenAssembly-header h1 {
	font-size: 24px;
  }
  .row.vote-row {
    top: 230px;
  }
}

@media screen and (max-width: 600px) {
  
}

</style>


<!-- start: LOGIN BOX -->
<div class="padding-20 center" style="margin-top: 20px">
	
	<br/>
	
<?php 
	//ca sert a quoi ce doublon ?
	$parentType = $room["parentType"];
	$parentId = $room["parentId"];
	$nameParentTitle = "";
	if($parentType == Organization::COLLECTION && isset($parentId)){
		$orga = Organization::getById($parentId);
		$nameParentTitle = $orga["name"];
	}

?>
 	<div>
     
 		<h1 class="homestead text-dark center citizenAssembly-header">

		  <?php 
		    $urlPhotoProfil = "";
		    if(isset($parent['profilImageUrl']) && $organizer['profilImageUrl'] != "")
		        $urlPhotoProfil = Yii::app()->createUrl($organizer['profilImageUrl']);
		      else
		        $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
		  
		    $icon = "comments"; 
		      if($parentType == Project::COLLECTION) $icon = "lightbulb-o";
		      if($parentType == Organization::COLLECTION) $icon = "group";
		      if($parentType == Person::CONTROLLER) $icon = "user";
		  ?>
		  <img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
		    <br>
		  <span style="padding:0px; border-radius:50px;">
		    <i class="fa fa-<?php echo $icon; ?>"></i> 
		    <?php echo $organizer["name"]; ?>
		  </span>
		  	<br>
		  <small class="homestead text-dark center"><?php echo Yii::t("rooms","Actions",null,Yii::app()->controller->module->id) ?></small>
		  
		</h1>

		
    </div>
 </div>

<div class="row vote-row" >

	<div class="col-md-12">
		<!-- start: REGISTER BOX -->
		<div class="box-vote box-pod box">
				
			<h4 class="col-md-12 text-center text-azure" style="font-weight:500; font-size:13px;"> 
				
				
				<span class="pull-right"><?php echo Yii::t("rooms","Since",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",$action["created"]) ?></span>
			 	<span class="pull-left"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","VISITORS",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($action["viewCount"])) ? $action["viewCount"] : "0"  ?></span>
			 	<br/><span class="pull-left"><i class="fa fa-caret-right"></i> <?php /*echo Yii::t("rooms","Date Change Count",null,Yii::app()->controller->module->id) ?> : <?php echo (isset($action["viewCount"])) ? $action["viewCount"] : "0"  */?></span>
			 	
				<?php if( @$action["dateEnd"] ){ ?>
				<span class="pull-right"><?php echo Yii::t("rooms","Ends",null,Yii::app()->controller->module->id) ?> <i class="fa fa-caret-right"></i> <?php echo date("d/m/y",@$action["dateEnd"]) ?></span>
				<?php } ?>
				
			</h4>

			

			<div class="col-md-6 col-md-offset-3 center" style="margin-top: -45px; margin-bottom: 10px;">

				<?php if( @$action["dateEnd"] && $action["dateEnd"] < time() ){ ?>
						
						<div class="box-vote box-pod box radius-20" style="">
							<span class="text-extra-large text-bold text-red"> 
								<?php echo Yii::t("rooms","Closed",null,Yii::app()->controller->module->id) ?>
							</span> 
							<?php if( isset($organizer) ){ ?>
								<p><?php echo Yii::t("rooms","Proposed by",null,Yii::app()->controller->module->id) ?> <a href="<?php echo @$organizer['link'] ?>" target="_blank"><?php echo @$organizer['name'] ?></a> </p>
							<?php }	?>
						</div>
						
				<?php } else { ?> 
						<div class="box-vote box-pod box radius-20" style="margin-top:8px;">
							<?php
					        $statusLbl = Yii::t("rooms", "Todo", null, Yii::app()->controller->module->id);
					        $statusColor = "default";
					        if( @$action["startDate"] < time() )
					        {
					          $statusLbl = Yii::t("rooms", "Progressing", null, Yii::app()->controller->module->id);
					          if( @$action["dateEnd"] > time()  )
					            $statusLbl = Yii::t("rooms", "Late", null, Yii::app()->controller->module->id);
					          
					        } 
					        if ( @$action["status"] == ActionRoom::ACTION_CLOSED  ) {
					          $statusLbl = Yii::t("rooms", "Closed", null, Yii::app()->controller->module->id);
					          $statusColor = "danger";
					        }
					        
							?>
							<span style="font-size: 35px; font-weight:bold; padding:5px; border:1px solid #ccc;" class='text-bold <?php echo $statusColor?>'>
							<?php
					        echo $statusLbl;
							?>
							</span>
						</div>

				<?php } ?>
			</div>	
			<div class="col-xs-12 voteinfoSection">
				<div class="col-md-7" style="margin-top:10px;">
					<?php if( isset($organizer) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-caret-right"></i> <?php echo Yii::t("rooms","Made by ",null,Yii::app()->controller->module->id) ?> <a style="font-size:14px;" href="javascript:<?php echo @$organizer['link'] ?>" class="text-dark"><?php echo @$organizer['name'] ?></a></span><br/>
					<?php }	?>
					
					<span class="text-extra-large text-bold text-dark col-md-12" style="font-size:25px !important;"><i class="fa fa-file-text"></i> <?php echo  $action["name"] ?></span>
					<br/><br/>
					
					<?php echo $action["message"]; ?>
					
					<br/>
					<?php if( isset( $action["tags"] ) ){ ?>
						<span class="text-red" style="font-size:13px; font-weight:500;"><i class="fa fa-tags"></i>
						<?php foreach ( $action["tags"] as $value) {
								echo '<span class="badge badge-danger text-xss">#'.$value.'</span> ';
							}?>
						</span><br>
					<?php }	?>

					<?php if( isset( $action["urls"] ) ){ ?>
						
						<h2 class="text-dark" style="border-top:1px solid #eee;"><br><?php Yii::t("rooms", "Links and info bullet points", null, Yii::app()->controller->module->id)?></h2>
						<?php foreach ( $action["urls"] as $value) {
							if( strpos($value, "http://")!==false || strpos($value, "https://")!==false )
								echo '<a href="'.$value.'" class="text-large"  target="_blank"><i class="fa fa-link"></i> '.$value.'</a><br/> ';
							else
								echo '<span class="text-large"><i class="fa fa-caret-right"></i> '.$value.'</span><br/> ';
						}?>
						<span class="" ><?php echo Yii::t("room","Comments",null,Yii::app()->controller->module->id) ?></span>
					<?php }	?>
				</div>
				<div  class="col-md-5">
					<div class="col-md-12 leftInfoSection " >
						
						<?php 
							if( @$action["links"]["contributors"] )
							{	
								$this->renderPartial('../pod/usersList', array(  
															"project"=> $action,
															"users" => $contributors,
															"userCategory" => Yii::t("common","COMMUNITY"), 
															"contentType" => ActionRoom::COLLECTION_ACTIONS,
															"admin" => true	)); 
							}
						?>
						<?php if( ActionRoom::canParticipate(Yii::app()->session['userId'],$room["parentId"],$room["parentType"]) && !@$action["links"]["contributors"][Yii::app()->session['userId']]  ){	?>
						<div class="space20"></div>
						<a href="javascript:;" class="center text-large btn btn-dark-blue " onclick="assignMe('<?php echo (string)$action["_id"]?>');" ><i class="fa fa-link"></i> <?php echo Yii::t("room","Assign Me This Task",null,Yii::app()->controller->module->id) ?></a>
						<?php }	?>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<div class="col-md-12 commentSection leftInfoSection" >
		<div class="box-vote box-pod box margin-10 commentPod"></div>
	</div>
	
</div>



<style type="text/css">
	.footerBtn{font-size: 2em; color:white; font-weight: bolder;}
</style>

<script type="text/javascript">
clickedVoteObject = null;

jQuery(document).ready(function() {
	
	$(".main-col-search").addClass("assemblyHeadSection");
  	$(".moduleLabel").html("<i class='fa fa-cogs'></i> Actions");
  
  	$('.box-vote').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});

	getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/actions/id/<?php echo $action['_id'] ?>",function(){ $(".commentCount").html( $(".nbComments").html() ); },"html");
});

function closeAction(id)
{
    console.warn("--------------- closeEntry ---------------------");
    
      bootbox.confirm("Are you sure ? ",
          function(result) {
            if (result) {
              params = { "id" : id };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/closeaction")?>',params,function(data){
                if(data.result)
                  loadByHash(location.hash);
                else 
                  toastr.error(data.msg);
              });
          } 
      });
 }

function assignMe(id)
{
    bootbox.confirm("Are you sure ? ",
        function(result) {
            if (result) {
              params = { "id" : id };
              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/assignme")?>',params,function(data){
                if(data.result)
                  loadByHash(location.hash);
                else 
                  toastr.error(data.msg);
              });
        } 
    });
 }
</script>