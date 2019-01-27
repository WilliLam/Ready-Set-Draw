 //Snackbar !!!

// To know //
/********

the codes typeof define === 'function' and define.amd
are used to check the presence of require.js which in a
javascript dependency management library.
amd stands for asynchronous module definition.

Factories are simply function that are used instead of classes.
*******/


(function(root, factory) {
    'use strict';

    if (typeof define === 'function' && define.amd) {
        define([], function() {
            return (root.Snackbar = factory());
        });
    } else if (typeof module === 'object' && module.exports) {
        module.exports = root.Snackbar = factory();
    } else {
        root.Snackbar = factory();
    }
})
(this, function() {

  var Snackbar = {};

  Snackbar.current = null;

  var $defaults = {
    def_text : "Snackbar Default Text",
    textColor: "#fff",
    background_color: "#323232",
    duration : 4000,
    showAction : true,
    actionText_color : "#eeff41",
    actionText : "Dismiss",
    onClick: function(element) {
        element.css("opacity","0");
    },
    onClose: function(element) {}
  };


  Snackbar.showToast = function($options){
    var options = $.extend({}, $defaults, $options);

    if (Snackbar.current) {

        Snackbar.current.css("opacity","0");
        setTimeout(
            function() {
                if ($("body").has($(this)))
                  $(this).remove();

            }.bind(Snackbar.current),
            500
        );
    }

    Snackbar.toast = $("<div></div>");
    Snackbar.toast.attr('id','snackbar_cont');

    var innerSnack = $("<div></div>").addClass("snackbar").text(options.def_text);
    Snackbar.toast.append(innerSnack);


    if(options.showAction){
      var actionBtn = $("<button></button>");
      actionBtn.addClass("actionBtn");
      actionBtn.text(options.actionText);
      actionBtn.css("color",options.actionText_color);
      actionBtn.on("click",function(){
        options.onClick(Snackbar.toast);
      });
      innerSnack.append(actionBtn);
    }

    if(options.duration){
      setTimeout(function(){
         if(Snackbar.current == this){
           Snackbar.current.css("opacity","0");
           Snackbar.current.css("top","-80px");
           Snackbar.current.css("bottom","-80px");
         }
      }.bind(Snackbar.toast),options.duration
    );
  }

    Snackbar.toast.on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(event){

      if (event.originalEvent.propertyName === 'opacity' && $(this).css("opacity") == '0') {
        if (typeof(options.onClose) === 'function')
            options.onClose($(this));

          $(this).remove();
          if (Snackbar.current === this) {
              Snackbar.current = null;
          }
      }
    }.bind(Snackbar.toast)
  );

    Snackbar.current = Snackbar.toast;

    $("body").append(Snackbar.toast);
    //Just to make sure transition will work for the first time as well !!!
    var $bottom = window.getComputedStyle(document.getElementById('snackbar_cont')).bottom;
    var $top = window.getComputedStyle(document.getElementById('snackbar_cont')).top;
    Snackbar.toast.css("opacity","1");
    Snackbar.toast.attr('id','snackbar_cont');
    Snackbar.toast.addClass("show");
  }

  Snackbar.close = function() {
      if (Snackbar.current) {
          Snackbar.current.css("opacity","0");
      }
  };

    return Snackbar;
});

// Check if the Email is Valid
function isValidEmailAddress( emailAddress ) {
	var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	return pattern.test( emailAddress );
}



$("document").ready(function(){

  //////////////////////////////////////////////////////////
         ////  LOGIN AND REGISTER INPUT BUTTONS   ////
    /////////////////////////////////////////////////////////

    $('input[type=email].input_with_borderErrors').on('keyup',function(){
      $(this).removeClass("invalid");
      if(isValidEmailAddress($(this).val()) ){
        $(this).removeClass("invalid").addClass("is_valid");
      }else{
        $(this).removeClass("is_valid");
      }
    });

    $('input[type=text].input_with_borderErrors').on('keyup',function(){
      $(this).removeClass("invalid");
      if($(this).val().replace(/^\s+|\s+$/g, "").length>=6){
          $(this).removeClass("invalid").addClass("is_valid");
      }else{
        $(this).removeClass("is_valid");
      }
    });

    $('input[type=password].input_with_borderErrors').on('keyup',function(){
      $(this).removeClass("invalid");
      if($(this).val().replace(/^\s+|\s+$/g, "").length>=6){
          $(this).removeClass("invalid").addClass("is_valid");
      }else{
        $(this).removeClass("is_valid");
      }
    });



    ///////////////////////////////////////
         ////  AJAX REGISTER   ////
    //////////////////////////////////////

    $("#submit-register").on("click",function(event){
        event.preventDefault();

        var username = $("#register-username").val();
        var email = $("#register-email").val();
        var password = $("#register-password").val();
        var repassword = $("#register-password2").val();
        var checkbox = $("#terms_9vodraw_checkbox");

        if(username.replace(/^\s+|\s+$/g, "").length == 0){
          $("#register-username").addClass("invalid");
          Snackbar.showToast({def_text:"Please enter your Username !"});
        }else if(username.replace(/^\s+|\s+$/g, "").length<6){
          $("#register-username").addClass("invalid");
          Snackbar.showToast({def_text:"Your username must be at least 6 characters long"});
        }else if(email.replace(/^\s+|\s+$/g, "").length == 0){
          $("#register-email").addClass("invalid");
          Snackbar.showToast({def_text:"Please enter your Email Address"});
        }else if(!isValidEmailAddress(email)){
          $("#register-email").addClass("invalid");
          Snackbar.showToast({def_text:"Invalid Email Address"});
        }else if(password.replace(/^\s+|\s+$/g, "").length == 0){
          $("#register-password").addClass("invalid");
          $("#register-password2").addClass("invalid");
          Snackbar.showToast({def_text:"Please enter your Password!"});
        }else if(password.replace(/^\s+|\s+$/g, "").length < 6){
          $("#register-password").addClass("invalid");
          $("#register-password2").addClass("invalid");
          Snackbar.showToast({def_text:"Your password must be at least 6 characters long!"});
        }else if(repassword.replace(/^\s+|\s+$/g, "").length == 0){
          $("#register-password").addClass("invalid");
          $("#register-password2").addClass("invalid");
          Snackbar.showToast({def_text:"Please enter your Password (Confirm) !"});
        }else if(password != repassword){
          $("#register-password").addClass("invalid");
          $("#register-password2").addClass("invalid");
          Snackbar.showToast({def_text:"Your passwords do not match"});
        }else if(!checkbox.is(":checked")){
          Snackbar.showToast({def_text:"You must agree to the terms & conditions !"});
        }else{
            $.ajax({
              type: "POST",
              url: "include/entry.php?action=register",
              data: {username: username, email: email, password: password, repassword: repassword},
              dataType: "json",
              success: function(response){
                if(response.status == 0){
                  Snackbar.showToast({def_text:response.error});
                }else if(response.status == 1){
                      window.location.href = "getting-ready.php";
                }else{
                  Snackbar.showToast({def_text:'An unknown error has occured.'});
                }
              },
              error: function(xhr){
                Snackbar.showToast({def_text:xhr.responseText});
              }

            });
        }
    });


    ///////////////////////////////////////
         ////  AJAX LOGIN   ////
    //////////////////////////////////////

    $("#submit-login").on("click",function(event){
        event.preventDefault();

        var username = $("#login-username").val();
        var password = $("#login-password").val();


        if(username.replace(/^\s+|\s+$/g, "").length == 0){
          Snackbar.showToast({def_text:"Please enter your Username or Email address"});
        } else if(password.replace(/^\s+|\s+$/g, "").length == 0){
          Snackbar.showToast({def_text:"Please enter your password"});
        }else{

          $.ajax({
            type: "POST",
            url: "include/entry.php?action=login",
            data: {username: username, password: password},
            dataType: "json",
            success: function(response){
              if(response.status == 0){
                Snackbar.showToast({def_text:response.error});
              }else if(response.status == 1){
                Snackbar.showToast({def_text:"Login successfully! Redicting"});
                window.location.href="getting-ready.php";
              }else{
                Snackbar.showToast({def_text:"An unknown error has occured"});
              }
            },
            error: function(xhr, ajaxOptions, thrownError){
              Snackbar.showToast({def_text:"An unknown error has occured"});
            }
          });

        }

    });



    //////////////////////////////////////////////////////////////////
	        //////////// GETTING USER INPUT (WIZARD FORM)////////////
	    /////////////////////////////////////////////////////////////////


      function isEmptyInput(init_input){
        var input = init_input.val();
        if(input.replace(/^\s+|\s+$/g, "").length == 0){
          return false;
        }else{
          return true;
        }
      }

      function isValidPhone(phoneInput){
        var filter = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
        if(!filter.test(phoneInput)){
          $("input#phone-number").closest(".form-group").addClass("has-error");
        }
      }


      $(".form_wizard_step_btn").on("click",function(e){

        // We don't want to just go to Finish setup without finishing all of inputs
        var currentInputs = $(".wizard_input");
        var hasErrors = false;
        for(var i=0;i<currentInputs.length;i++){
          if(!isEmptyInput($(currentInputs[i]))){
            hasErrors = true;
          }
        }
        // Check whether to enable/disable back btn
        var current = $(this).attr('href');

        if(current != "#step-3" || (current == "#step-3" && hasErrors == false)){
        if($(".back_btn").hasClass("disabled") && current != "#step-1"){
          $(".back_btn").removeClass("disabled");
        }else if(!$(".back_btn").hasClass("disabled") && current == "#step-1"){
          $(".back_btn").addClass("disabled");
        }
        e.preventDefault();
        var target = $($(this).attr('href'));
        $(".form_wizard_step_btn").removeClass("active_step");
        $(this).addClass("active_step");

        //Show the div associated with the btn and hide the others
        $(".form_wizard_form_cont").removeClass("show");
        target.addClass("show");
        target.find("input:eq(0)").focus();

      }
      });


      $(".form_wizard_btns_wrapper .next_btn").on("click",function(){

        var currentStep = $(this).closest(".form_wizard_form_cont");
        var currentStepButton = currentStep.attr("id");
        var currentInputs = currentStep.find("input.wizard_input, textarea.wizard_input");
        var nextStepWizard = $(".form_wizard_steps_cont .form_wizard_step a[href='#" + currentStepButton +"']").parent().next().children("a");

        var isValid = true;
        $(".form-group").removeClass("has-error");
        for(var i=0;i<currentInputs.length;i++){
          if($(currentInputs[i]).is("#phone-number")){
            isValidPhone($(currentInputs[i]).val());
          }
          if(!isEmptyInput($(currentInputs[i]))){
            isValid = false;
            $(currentInputs[i]).closest(".form-group").addClass("has-error");
          }
        }
        if(isValid){
          nextStepWizard.trigger('click');
        }
      });

      $(".form_wizard_btns_wrapper .back_btn").on("click",function(){

        if(!$(this).hasClass("disabled")){
            var currentStep = $(this).closest(".form_wizard_form_cont");
            var currentStepButton = currentStep.attr("id");
            var currentInputs = currentStep.find("input");
            var prevStepWizard = $(".form_wizard_steps_cont .form_wizard_step a[href='#"+ currentStepButton +"']").parent().prev().children("a");

            prevStepWizard.trigger('click');
        }
      });


    //////////////////////////////////////////////////////////////////
          //////////// OPENING THE CHANGE PROFILE IMAGE MODAL /////////////
      /////////////////////////////////////////////////////////////////

      $(function(){

		window.onclick = function(event){
			if(event.target.matches(".change_pickModal")){

				$(".change_pickModal").removeClass("open");
				$(".change_pickModal").one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",
			function(e){
				$(".change_pickModal").css("display","none");
				$("body").removeClass("locked_body");
				$("body").css("padding-right","");
				$("change_selectImg_btn input").val("");
				$(this).off('webkitTransitionEnd moztransitionend transitionend oTransitionEnd');
 			});
			}
		}

	});

  //Get all user info
  $("#get-started-finish-btn").on("click",function(event){
    event.preventDefault();

    //Create a FormData to append everything

    var form_data = new FormData();

    var firstname = $("#get-started-firstname").val();
    var lastname = $("#get-started-lastname").val();
    var gender = $("#get-started-gender").val();
    var age = $("#get-started-age").val();


    //Append everything in FormData (also user_id and token from the normal js )
    form_data.append("user_id", user_id);
    form_data.append("token", token);
    form_data.append("file", profile_pic_image);
    form_data.append("firstname", firstname);
    form_data.append("lastname", lastname);
    form_data.append("gender", gender);
    form_data.append("age", age);

    if(firstname.replace(/^\s+|\s+$/g, "").length == 0){
      Snackbar.showToast({def_text:"Please fill in all the required information !"});
    }else if(lastname.replace(/^\s+|\s+$/g, "").length == 0){
      Snackbar.showToast({def_text:"Please fill in all the required information !"});
    }else if(gender.replace(/^\s+|\s+$/g, "").length == 0){
      Snackbar.showToast({def_text:"Please fill in all the required information !"});
    }else if(age.replace(/^\s+|\s+$/g, "").length == 0){
      Snackbar.showToast({def_text:"Please fill in all the required information !"});
    }else{
      $.ajax({
        url: "include/user-information.php?action=insert-info",
        data: form_data,
			  processData: false,
			  contentType: false,
        type: "POST",
        dataType: "json",
        success: function(response){
          if(response.status == 0){
            Snackbar.showToast({def_text:response.error});
          }else if(response.status == 1){
              window.location.href = "./";
          }else{
            Snackbar.showToast({def_text:'An unknown error has occured.'});
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          Snackbar.showToast({def_text:xhr.responseText});
        }

      });

    }
  });

  //////////////////////////////////////////////////////////////////
      //////////// Log the User Out/////////////
  /////////////////////////////////////////////////////////////////

  $("body").on("click","#logout",function(event){
    event.preventDefault();
    $.post("include/entry.php?action=logout", {token: token, user_id: user_id}).done(function(data){
      if(data == "error"){
        Snackbar.showToast({def_text: "An unknown error has occured!"});
      }else{
        window.location.href="login.php";
      }
    })
  });


})
