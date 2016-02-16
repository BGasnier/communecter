<style>
	.main-login{
		position:absolute;
		top:80px;
	}
	.box-login, .box-register, .box-email{
		left: unset !important;
		right: 14% !important;
		border-radius:15px;
	}
	.form-login, .form-register, .form-email{
		left: unset !important;
		right: 14% !important;
		border-radius:15px;
	}
	.btn-round{
		border-radius:0px 0px 15px 15px !important;
	}

	.btn-close-box{
		position:absolute;
		right:0px;
		top:0px;
		border-radius: 0px 10px 0px 0px;
		border: 0px;
		height:35px;
		background-color: transparent;
	}
</style>
	
	<div class="main-login col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1">
		<!-- <a class="byPHRight" href="#"><img style="" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a> -->
		
			<div class="box-login box box-white-round no-padding pull-right">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<?php 
					$this->renderPartial('../default/menuTitle');
				?>
				<form class="form-login box-white-round" action="" method="POST">
					<img style="width:100%; border: 10px solid white; border-bottom-width:0px;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
					<br/>
					<?php //echo Yii::app()->session["requestedUrl"]." - ".Yii::app()->request->url; ?>
					<fieldset>
						<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je me connecte</h2>
						<div class="form-group">
							<span class="input-icon">		
								<input type="text" class="form-control radius-10" name="email" id="email" placeholder="<?php echo Yii::t("login","Email") ?>" >
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							
							<span class="input-icon">
								<input type="password" class="form-control password"  name="password" id="password" placeholder="<?php echo Yii::t("login","Password") ?>">
								
								<label for="remember" class="checkbox-inline">
									<input type="checkbox" class="grey remember" id="remember" name="remember">
									<?php echo Yii::t("login","Keep me signed in") ?>
								</label>

								<i class="fa fa-lock"></i>
								<a class="forgot pull-right padding-5" href="javascript:" onclick="showPanel('box-email');"><?php echo Yii::t("login","I forgot my password") ?></a> 
							
							</span>
						</div>
						<div class="form-actions" style="margin-top:-20px;">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							<div class="errorHandler alert alert-danger no-display loginResult">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
							</div>
							<div class="errorHandler alert alert-danger no-display notValidatedEmailResult">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Your account is not validated : please check your mailbox to validate your email address.") ?>
								      <?php echo Yii::t("login","If you didn't receive it or lost it, click") ?>
								      <a class="validate" href="#">here</a> to receive it again.
							</div>
							<div class="errorHandler alert alert-success no-display emailValidated">
								<i class="fa fa-check"></i> <?php echo Yii::t("login","Your account is now validated ! Please try to login.") ?>
							</div>
							<div class="errorHandler alert alert-danger no-display custom-msg">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							
							<br/>
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="loginBtn ladda-button center-block">
								<span class="ladda-label"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
						
					</fieldset>
					<div class="new-account">
						<!-- <h2 class="text-red  no-margin padding-bottom-5 text-center bg-white"><i class="fa fa-angle-down"></i> Je m'inscris</h2> -->
						<?php //echo Yii::t("login","Don't have an account yet?") ?>
						<a href="javascript:" onclick="showPanel('box-register');" class="btn btn-default btn-sm register btn-round text-dark">
							<i class="fa fa-plus"></i> <i class="fa fa-user"></i> <?php echo Yii::t("login", "Create an account") ?>
						</a>
						
					</div>
				</form>
			</div>
			<!-- end: LOGIN BOX -->
			<!-- start: FORGOT BOX -->
			<div class="box-email box box-white-round">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<form class="form-email box-white-round">
					<img style="width:100%; border: 10px solid white;" class="pull-right box-white-round" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
					<br/>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" id="email2" placeholder="Email">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
								<span class="ladda-label"><i class="fa fa-key"></i> <?php echo Yii::t("login","Get my password") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
					</fieldset>
					<div class="new-account">
						<a href="javascript:" onclick="showPanel('box-login');" class="text-dark btn go-back btn-round">
							<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
						</a>	
					</div>
				</form>
			</div>
			<!-- end: FORGOT BOX -->
			<!-- start: REGISTER BOX -->
			<div class="box-register box box-white-round no-padding" style=" margin-top:-25px !important;">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<form class="form-register center box-white-round" style="background-color:white !important;">
					<img style="width:70%; border: 10px solid white;" class="" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
					
					<fieldset>
						<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je crée mon compte</h2>
						<div class="col-md-12 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="name" name="name" placeholder="Nom et Prénom">
									<i class="fa fa-user"></i> </span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="username" name="username" placeholder="<?php echo Yii::t("login","Username") ?>">
									<i class="fa fa-user-secret"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" id="email3" name="email3" placeholder="<?php echo Yii::t("login","Email") ?>">
									<i class="fa fa-envelope"></i> </span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password3" name="password3" placeholder="<?php echo Yii::t("login","Password") ?>">
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="<?php echo Yii::t("login","Password again") ?>">
									<i class="fa fa-lock"></i> </span>
							</div>
						</div>
						<div class="col-md-12 no-padding no-margin">
							<hr style="margin-top: 0px; margin-bottom: 15px;">
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="streetAddress" id="fullStreet" placeholder="<?php echo Yii::t("login","Full Street") ?>" value="<?php if(isset($organization["address"])) echo $organization["address"]["streetAddress"]?>" >
									<i class="fa fa-road"></i>
								</span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="cp" name="cp" placeholder="<?php echo Yii::t("login","Postal Code") ?>">
									<i class="fa fa-home"></i>
								</span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group" id="cityDiv" style="display: none;">
								<span class="input-icon col-md-12" style="margin-bottom:7px;">
									<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("login","Select your City...") ?>'>
									</select>
								</span>
							</div>	
						</div>
						<div class="col-md-6 padding-5 text-center hidden" id="alert-city-found" style="text-align:center;font-family:inherit; border-radius:0px; margin-top:0px;">
							<!-- <span class="pull-left" style="padding:6px;"><i class="fa fa-check"></i> Position géographique</span> -->
							<div class="btn btn-success" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
							
							<input type="hidden" name="geoPosLatitude" id="geoPosLatitude" style="width: 100%; height:35px;">
							<input type="hidden" name="geoPosLongitude" id="geoPosLongitude" style="width: 100%; height:35px;">
						</div>	
						<div class="form-group pull-left no-margin" style="width:100%;">
							<div>
								<label for="agree" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree" name="agree">
									<?php echo Yii::t("login","I agree to the Terms of") ?> <a href="#" class="bootbox-spp"><?php echo Yii::t("login","Service and Privacy Policy") ?></a>
								</label>
							</div>
						</div>			

						<div class="pull-left" style="width:100%;">
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="createBtn ladda-button center-block">
								<span class="ladda-label"><i class="fa fa-plus"></i><i class="fa fa-user"></i>  <?php echo Yii::t("login","Submit") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
						<div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
							<div class="errorHandler alert alert-danger no-display registerResult pull-left">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
							</div>
							<div class="errorHandler alert alert-success no-display pendingProcess">
								<i class="fa fa-check"></i> <?php echo Yii::t("login","Please fill your personal information in order to log in.") ?>
							</div>
						</div>
					</fieldset>
					<div class="new-account">
						<a href="javascript:" onclick="showPanel('box-login');" class="text-dark btn go-back btn-round">
							<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
						</a>	
					</div>	
				</form>
				<!-- end: COPYRIGHT -->
			</div>
	</div>
<script>

var register = <?php echo isset($_GET["register"]) ? "true" : "false"; ?>;


jQuery(document).ready(function() {

	$(".box").hide();

	userId = null;
	Main.init();
	Login.init();
	console.log("register", register);

	if(register == true){
		//masque la box login
		$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).hide().removeClass("animated bounceOutRight");

		});
		$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).show().removeClass("animated bounceInLeft");

		});
		
		activePanel = "box-register";
	}

	$('#btn-show-city').click(function(){
			showMap(true);
			$(".sigModuleBg #right_tool_map, .sigModuleBg .btn-group").hide();
		});


	$('.form-register #username').keyup(function(e) {
		validateUserName();
	})

	
	//Validation of the email
	if (userValidated) {
		//We are in a process of invitation. The user already exists in the db
		if (invitor != null) {
			$(".errorHandler").hide();
			$('.register').click();
			$('.pendingProcess').show();
			$('#email3').val(email);
			$('#email3').prop('disabled', true);
		} else {
			$(".errorHandler").hide();
			$(".emailValidated").show();
			$(".form-login #password").focus();
		}
	}

	if (msgError != "") {
		$(".custom-msg").show();
		$(".custom-msg").text(msgError);
	}

	$(".btn-close-box").click(function(){
		$(".box").hide(400);
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
	});

});

var email = '<?php echo @$_GET["email"]; ?>';
var userValidated = '<?php echo @$_GET["userValidated"]; ?>';
var pendingUserId = '<?php echo @$_GET["pendingUserId"]; ?>';
var msgError = '<?php echo @$_GET["msg"]; ?>';
var invitor = <?php echo Yii::app()->session["invitor"] ? json_encode(Yii::app()->session["invitor"]) : '""'?>;

var timeout;
var emailType;
var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-login');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-register');
					break;
				case "email" :
					el = $('.box-email');
					break;
				case "validate" :
					el = $('.box-email');
					break;
				default :
					el = $('.box-login');
					break;
			}
		}
		el.show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
		});
	};
	var runLoginButtons = function() {
		/*
		$('.forgot').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-email').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");
			});
			emailType = "password";
			$("#email2").val($("#email").val());
			activePanel = "box-email";
		});
		$('.validate').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-email').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");
			});
			emailType = "validation";
			$("#email2").val($("#email").val());
			activePanel = "box-email";
		});
		$('.register').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});
			activePanel = "box-register";
		});
		$('.go-back').click(function() {
			var boxToShow;
			if ($('.box-register').is(":visible")) {
				boxToShow = $('.box-register');
				activePanel = "box-register";
			} else {
				boxToShow = $('.box-email');
				activePanel = "box-email";
			}
			boxToShow.addClass("animated bounceOutLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				boxToShow.hide().removeClass("animated bounceOutLeft");

			});
			$('.box-login').show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInRight");

			});
			if(!locationHTML5Found)
			$("#mapCanvasBg").hide(400);
			$(".box-menu").hide(400);
			$(".box-discover").hide(400);
		});
		$('.big-button').click(function() {
			$(".box-ajax").hide(400);
		});
	*/
		
	};
	//function to return the querystring parameter with a given name.
	var getParameterByName = function(name) {
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	};
	var runSetDefaultValidation = function() {
		$.validator.setDefaults({
			errorElement : "span", // contain the error msg in a small tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
					error.appendTo($(element).closest('.form-group').children('div'));
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : ':hidden',
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error');
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').addClass('has-error');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			}
		});
	};
	var runLoginValidator = function() {
		var form = $('.form-login');
		var loginBtn = null;
		Ladda.bind('.loginBtn', {
	        callback: function (instance) {
	            loginBtn = instance;
	        }
	    });
		form.submit(function(e){e.preventDefault() });
		var errorHandler = $('.errorHandler', form);
		
		form.validate({
			rules : {
				email : {
					minlength : 2,
					required : true
				},
				password : {
					minlength : 4,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				loginBtn.start();
				var params = { 
				   "email" : $("#email").val(), 
                   "pwd" : $("#password").val()
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/authenticate",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	var url = "<?php echo (isset(Yii::app()->session["requestedUrl"])) ? Yii::app()->session["requestedUrl"] : null; ?>";
		    		  	if(url) {
		    		  		console.log(url);
		    		  		window.location.href = url;
		        		} else {
		        			window.location.reload();
		        		}
		    		  } else {
		    		  	var msg;
		    		  	if (data.msg == "notValidatedEmail") {
							$('.notValidatedEmailResult').show();
		    		  	} else if (data.msg == "accountPending") {
		    		  		pendingUserId = data.pendingUserId;
		    		  		$(".errorHandler").hide();
							$('.register').click();
							$('.pendingProcess').show();
							$('#email3').val($("#email").val());
							$('#email3').prop('disabled', true);
		    		  	} else{
		    		  		msg = data.msg;
		    		  		$('.loginResult').html(msg);
							$('.loginResult').show();
		    		  	}
						loginBtn.stop();
		    		  }
		    	  },
		    	  error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  	loginBtn.stop();
		    	  },
		    	  dataType: "json"
		    	});
			    return false; // required to block normal submit since you used ajax
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
				loginBtn.stop();
			}
		});
	};
	var runForgotValidator = function() {
		var form2 = $('.form-email');
		var errorHandler2 = $('.errorHandler', form2);
		var forgotBtn = null;
		Ladda.bind('.forgotBtn', {
	        callback: function (instance) {
	            forgotBtn = instance;
	        }
	    });
		form2.validate({
			rules : {
				email2 : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				forgotBtn.start();
				var params = { 
					"email" : $("#email2").val(),
					"type"	: emailType
				};
		        $.ajax({
		          type: "POST",
		          url: baseUrl+"/<?php echo $this->module->id?>/person/sendemail",
		          data: params,
		          success: function(data){
					if (data.result) {
						alert(data.msg);
			            window.location.reload();
					} else if (data.errId == "UNKNOWN_ACCOUNT_ID") {
						if (confirm(data.msg)) {
							$('.box-email').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
								$(this).hide().removeClass("animated bounceOutRight");
							});
							$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
								$(this).show().removeClass("animated bounceInLeft");

							});
						} else {
							window.location.reload();
						}
					}
		          },
		          error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  },
		          dataType: "json"
		        });
		        return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
				forgotBtn.stop();
			}
		});
	};
	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		var errorHandler3 = $('.errorHandler', form3);
		var createBtn = null;
		
		Ladda.bind('.createBtn', {
	        callback: function (instance) {
	            createBtn = instance;
	        }
	    });
		form3.validate({
			rules : {
				cp : {
					required : true,
					rangelength : [5, 5],
					validPostalCode : true
				},
				city : {
					required : true,
					minlength : 1
				},
				name : {
					required : true
				},
				username : {
					required : true,
					validUserName : true,
					rangelength : [8, 20]
				},
				email3 : {
					required : { 
						depends:function(){
							$(this).val($.trim($(this).val()));
							return true;
        				}
        			},
					email : true
				},
				password3 : {
					minlength : 8,
					required : true
				},
				passwordAgain : {
					equalTo : "#password3"
				},
				agree : {
					minlength : 1,
					required : true
				}
			},
			messages: {
				agree: "You must validate the CGU to sign up.",
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				createBtn.start();
				var params = { 
				   "name" : $("#name").val(),
				   "username" : $("#username").val(),
				   "email" : $("#email3").val(),
                   "pwd" : $("#password3").val(),
                   "cp" : $("#cp").val(),
                   "geoPosLatitude" : $("#geoPosLatitude").val(),
                   "geoPosLongitude" : $("#geoPosLongitude").val(),
                   "app" : "<?php echo $this->module->id?>",
                   "city" : $("#city").val(),
                   "pendingUserId" : pendingUserId
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/register",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	// $.blockUI({
    		  			// 	message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '
    		  			// });
		        		toastr.success(data.msg+" , we'll contact you as soon as we open up! Thanks for joining.");
		        		loadByHash("#default.directory");
		        		//window.location.reload();
		        		//setTimeout(function() { $.unblockUI(); showPanel(); },5000);
		    		  }
		    		  else {
						$('.registerResult').html(data.msg);
						$('.registerResult').show();
						createBtn.stop();
		    		  }
		    	  },
		    	  error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  	createBtn.stop();
		    	  },
		    	  dataType: "json"
		    	});
			    return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler3.show();
				createBtn.stop();
			}
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			addCustomValidators();
			runBoxToShow();
			runLoginButtons();
			runSetDefaultValidation();
			runLoginValidator();
			runForgotValidator();
			runRegisterValidator();
			bindPostalCodeAction();
		}
	};
}();



function runShowCity(searchValue) {
	citiesByPostalCode = getCitiesByPostalCode(searchValue);
	Sig.citiesByPostalCode = citiesByPostalCode;

	var oneValue = "";
	console.table(citiesByPostalCode);
	$.each(citiesByPostalCode,function(i, value) {
    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
	});
	
	if (citiesByPostalCode.length == 1) {
		$("#city").val(oneValue);
	}

	if (citiesByPostalCode.length >0) {
        $("#cityDiv").slideDown("medium");
      } else {
        $("#cityDiv").slideUp("medium");
      }

    //si l'utilisateur a déjà donné sa fullStreet
    if($('.form-register #fullStreet').val() != ""){
    	//on fait une recherche nominatim
    	clearTimeout(timeout);
		timeout = setTimeout(function() {
			searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		}, 200);
    }else{ //sinon : on a que le CP et on recherche par le codeInsee de la première ville de la liste
    	findGeoposByInsee(citiesByPostalCode[0].value, callbackFindByInseeSuccessRegister);
    }
}

function bindPostalCodeAction() {
	$('.form-register #cp').change(function(e){
		//searchCity();
	});
	$('.form-register #cp').keyup(function(e){
		searchCity();
	});

	$('.form-register #fullStreet').keyup(function(e){
		if($('.form-register #cp').val() != "") {
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
			}, 500);
		}
	});

	$('.form-register #fullStreet').change(function(e){
		if($('.form-register #cp').val() != "") {
			searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		}
	});

	$('#city').change(function(e){
		//Sig.execFullSearchNominatim(0);
		console.log('findGeoposByInsee', $('#city').val());
		findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessRegister);
	});
}

var oldCp = "";
function searchCity() { 
	console.log("searchCity");
	var searchValue = $('.form-register #cp').val();
	if(searchValue.length == 5) {
		if(oldCp != searchValue){
			$("#city").empty();
			clearTimeout(timeout);
			timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 500);
			clearTimeout(timeout);
			timeout = setTimeout('runShowCity("'+searchValue+'")', 500); 
		}
	} else {
		$("#cityDiv").slideUp("medium");
		$("#city").val("");
		$("#city").empty();
	}
	oldCp = searchValue;
}

function validateUserName() {
	var username = $('.form-register #username').val();
	if(username.length >= 8) {
		clearTimeout(timeout);
		timeout = setTimeout(function() {
				console.log("bing !");
				if (! isUniqueUsername(username)) {
					var validator = $( '.form-register' ).validate();
					validator.showErrors({
  						"username": "The user name is not unique : please change it."
					});
				}
			}, 200);
	}
}

function callBackFullSearch(resultNominatim){
	console.log("callback ok");
	var ok = Sig.showCityOnMap(resultNominatim, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "person");
	if(!ok){
		if($('#city').val() != "") {
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessRegister);
		}
	}
	//$(".topLogoAnim").hide();

	//setTimeout("setMapPositionregister();", 1000);
}
// function setMapPositionregister(){ console.log("setMapPositionregister");
// 	Sig.map.panTo(Sig.markerNewData.getLatLng(), {animate:false}); 
// 	Sig.map.panBy([300, 0]);
// }

//quand la recherche par code insee a fonctionné
function callbackFindByInseeSuccessRegister(obj){
	console.log("callbackFindByInseeSuccess");
	//si on a bien un résultat
	if (typeof obj != "undefined" && obj != "") {
		//récupère les coordonnées
		var coords = Sig.getCoordinates(obj, "markerSingle");
		//si on a une geoShape on l'affiche
		if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
		//on affiche le marker sur la carte
		$("#alert-city-found").show();
		//console.log("verification contenue obj");
		//console.dir(obj);
		Sig.showCityOnMap(obj, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "person");

		if(typeof obj.name != "undefined"){
			$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
			$("#main-title-public2").show();
		}

		hideLoadingMsg();
				
		//showGeoposFound(coords, projectId, "projects", projectData);
	}
	else {
		console.log("Erreur getlatlngbyinsee vide");
	}
}
	function searchAddressInGeoShape(){
		if($('#cp').val() != "" && $('#cp').val() != null){
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessAdd);
		}
	}

	function callbackFindByInseeSuccessAdd(obj){
		console.log("callbackFindByInseeSuccessAdd");
		console.dir(obj);
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			currentCityByInsee = obj;
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une street dans le form
			if($('#fullStreet').val() != "" && $('#fullStreet').val() != null){
				//si on a une geoShape dans la reponse obj
				if(typeof obj.geoShape != "undefined") {
					//on recherche avec une limit bounds
					var polygon = L.polygon(obj.geoShape.coordinates);
					var bounds = polygon.getBounds();
					Sig.execFullSearchNominatim(0, bounds);
				}
				else{
					//on recherche partout
					Sig.execFullSearchNominatim(0);
				}
			}
			else{
				Sig.showCityOnMap(obj, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "person");
			}

			if(typeof obj.name != "undefined"){
				$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
				$("#main-title-public2").show();
			}
			hideLoadingMsg();
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}
//quand la recherche par code insee n'a pas fonctionné
function callbackFindByInseeError(){
	console.log("erreur getlatlngbyinsee");
}


</script>