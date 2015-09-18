
<script type="text/javascript">

var formDefinition = {
    "jsonSchema" : {
        "title" : "News Form",
        "type" : "object",
        "properties" : {
        	"id" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['id'])) ? $_GET['id'] : '' ?>"
            },
            "type" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>"
            },
            "name" :{
            	"inputType" : "text",
            	"placeholder" : "Title",
            	"rules" : {
						"required" : true
					}
            },
            
            "text" :{
            	"inputType" : "textarea",
            	"placeholder" : "Details",
            	"rules" : {
						"required" : true
					}
            },
            "tags" :{
	            	"inputType" : "tags",
	            	"placeholder" : "Tags",
	            	"values" : [
	            		"Sport",
                    	"Agricutlture",
                    	"Culture",
                    	"Urbanisme",
	            	]
	            },
	        "date" :{
            	"inputType" : "date",
            	"placeholder" : "When was this or will it be",
            },
	        "public" :{
	            	"inputType" : "checkbox",
	            	"placeholder" : "Public",
	            	"values" : true,
	            	"onclick" : "function(){alert()}"
	            },
	        /*"scope" :{
	            	"inputType" : "tags",
	            	"placeholder" : "Scope, Who can see this",
	            	"values" : [
	            		"Sport",
                    	"Agricutlture",
                    	"Culture",
                    	"Urbanisme",
	            	]
	            },*/
	        /*"latitude" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['lat'])) ? $_GET['lat'] : '' ?>"
            },
            "longitude" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['lon'])) ? $_GET['lon'] : '' ?>"
            },*/
        }
    },
    "collection" : "organization",
    "key" : "ajaxForm",
};

var dataBind = {
   "#ajaxForm #text" : "text",
   "#ajaxForm #name" : "name",
   "#ajaxForm #tags" : "tags",
   "#ajaxForm #id" : "typeId",
   "#ajaxForm #type" : "type",
   "#ajaxForm #date" : "date",
  /* "#latitude" : "from.latitude",
   "#longitude" : "from.longitude"*/
};
var contextId = "";
var contextType = "";
var contextName = "";
jQuery(document).ready(function() {
	
	$(".new-news").off().on("click",function() { 
		console.log("add news on ",$(this).data('id'),$(this).data('type'));
		if( $(this).data('id') )
			contextId = $(this).data('id') ;
		if( $(this).data('type') )
			contextType = $(this).data('type');
		if( $(this).data('name') )
			contextName = " : inform "+contextType+" "+$(this).data('name');
		$("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
							"<div class='space20'></div>"+
							"<h1>Share a thought, an idea "+contextName+" </h1>"+
							"<form id='ajaxForm'></form>"+
							"<div id='newsFeed'></div>"+
						  "</div>");
		$.subview({
			content : "#ajaxSV",
			onShow : function() 
			{
				var form = $.dynForm({
					formId : "#ajaxForm",
					formObj : formDefinition,
					onLoad : function  () {
						if( contextId )
							$("#ajaxForm #id").val( contextId );
						if( contextType )
							$("#ajaxForm #type").val( contextType );
						//hide form partially
						//Fetch and show latest msgs
						if(contextType && contextId)
							getAjax(".newsFeed", baseUrl+"/"+moduleId+"/news/latest/type/"+contextType+"/id/<?php if(isset($_GET["id"]))echo $_GET["id"];?>/count/15", function(){}, "html");
					},
					onSave : function(){
						console.log("saving Organization!!");
						var params = {};
						$.each(dataBind,function(field,dest){
							console.log("dataBind 1 ",field,$(field).val());
							if(field != "" )
							{
								console.log("dataBind 2",field);
								value = "";
								if(dest == "tags"){
									value = $(field).val().split(",");
								} else if( $(field) && $(field).val() && $(field).val() != "" )
									value = $(field).val();

								if( value != "" )
								{
									console.log("dataBind 3 ",field,dest,value);
									jsonHelper.setValueByPath( params, dest, value );
								} 
							}
							else
								console.log("save Error",field);
						});
						params.id = '<?php echo Yii::app()->session['userId']; ?>';
						console.dir(params);
						$.ajax({
				    	  type: "POST",
				    	  url: baseUrl+"/<?php echo $this->module->id?>/news/save",
				    	  data: params,
				    	  dataType: "json"
				    	}).done( function(data){
				    		if(data.result)
				    		{
				    			if( 'undefined' != typeof updateNews && typeof updateNews == "function" )
		                    		updateNews(data.object);
								console.dir(data);
								$.unblockUI();
								$("#ajaxSV").html('');
								$.hideSubview();
								toastr.success('Saved successfully!');
				    		}
				    		else 
				    		{
				    			$.unblockUI();
								toastr.error('Something went wrong!');
				    		}
				    	} );

						return false;
					}
				});
				console.dir(form);
			},
			onHide : function() {
				$("#ajaxSV").html('');
				$.hideSubview();
			},
			onSave: function() {
				$("#ajaxForm").submit();
			}
		});
	});
});

</script>
