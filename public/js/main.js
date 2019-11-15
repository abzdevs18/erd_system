/* FIeld form design*/

// $(document).ready(function(){
// 	$('.form-group input').focus(function(){
// 		$('.form-group label').addClass('focus-label');
// 	});
// });

//For scrollBar
$(".content").mCustomScrollbar({
    autoHideScrollbar: true
});
/*ENd ScrollBar*/
var URL_ROOT = '/easy_ride_hub';
$(document).on('click', '.save-btn', function(e){
	e.preventDefault();
	var data = $('#chemicalAdd').serializeArray();

	$.ajax({
		url: URL_ROOT + '/admin/add',
		type: 'POST',
		data: $.param(data),
		success: function(e){
			console.log(e);
		},
		error: function(_e){
			console.log('l');
		}

	});
	console.log(data);
});

$(document).on('click','.setup-btn', function(){

  var form = $(this).attr('data-form');
  var link = $(this).attr('data-link');
  /* Admin configuration Script*/
  var current, next, prev;

  current = $(this).parent();
  next = $(this).parent().next();





  if ( form == 1) {
    /* progress */
    $('.progress li').eq($('div.awesome').index(next)).addClass('active');
    current.hide();
    next.show(); 
    animate(current, next);
 
  }

  if ( form == 2) {
    var dbCon = $('#c-n').serializeArray();
    /* Check for the inputs if they are valid */
     $.ajax({
       url: URL_ROOT + '/init/adminSetup',
       type: 'POST',
       dataType: 'json',
       data: $.param(dbCon),
       success: function(data){
         /* If inputs are valid show connecting to the DB */
         if (data['status'] == 1) { 
           $('.modal').show(100).animate({opacity: '1'},300);
           $('.loadingTxt').text('Connecting to database');
           $('.loading').show(100).animate({opacity: '1','margin-right': '25%'}, 800);
           $.ajax({
             url: URL_ROOT + '/init/configGen',
             type: 'POST',
             dataType: 'json',
             data: $.param(dbCon),
             success: function(data){
               if (data['status'] == 1) {
                 $.ajax({
                   url: URL_ROOT + '/init/err',
                   type: 'POST',
                   dataType: 'json',
                   success: function(data){
                     /* If this goes wrong error will throw up*/
                     if (data['error'] == 0) {
                       $.ajax({
                         url: URL_ROOT + '/init/uploadTable',
                         dataType: 'json',
                         beforeSend: function(){
                           setTimeout(function(){
                             $('.loadingTxt').text('Uploading Tables');
                           }, 5000);
                         },
                         success: function(data){
                           /* Checking SQL upload status*/
                           setTimeout(function(){
                             if (data['error'] == 0) {
                                 $('.modal').hide(100);
                                 $('.loading').hide();
                                 $('.error').hide();
                                     /* progress */
                                 $('.progress li').eq($('div.awesome').index(next)).addClass('active');
                                 current.hide();
                                 next.show(); 
                                 animate(current, next); 
                             }else{
                               $('.loading').animate({opacity: '0','margin-right': '50%'}, 300).hide(50);
                               $('.error').delay(130).animate({opacity: '1','margin-right': '25%'}, 800);
                             }
                           }, 5000);
                         }
                       });                    
                     }else{
                       $('.loading').animate({opacity: '0','margin-right': '50%'}, 300).hide(50);
                       $('.error').delay(130).animate({opacity: '1','margin-right': '25%'}, 800);
                     }
                   },
                   error: function(e){
                     console.log(e);
                   }
                 });
               }else{
                 $('.loading').animate({opacity: '0','margin-right': '50%'}, 300).hide(50);
                 $('.error').delay(130).animate({opacity: '1','margin-right': '25%'}, 800);
               }
             }
           });
         }else{
              if (data['DB_HOST_err']) {
                /* Get the parent/container of the input field for firstname and */
                feedbackShow("dbVal", data['DB_HOST_err']);
              } else{
                feedbackHide("dbVal");
              }

              if (data['DB_NAME_err']) {
                /* Get the parent/container of the input field for firstname and */
                feedbackShow("hostVal", data['DB_NAME_err']);
              } else{
                feedbackHide("hostVal");
              }

              if (data['DB_USER_err']) {
                /* Get the parent/container of the input field for firstname and */
                feedbackShow("userVal", data['DB_USER_err']);
              } else{
                feedbackHide("userVal");
              }
          }
       },
       error:function(e){
         console.log(e);
       }
     });
                  // $('.progress li').eq($('div.awesome').index(next)).addClass('active');

                  // current.hide();
                  // next.show();
                  // animate(current, next);   
  }

  if ( form == 3) {
    var ch_site = $('#sf_site_info').serializeArray();
    var fd = new FormData();
    var photo_data = $('#imgInp').prop('files')[0];
    var siteName = $("input[name=siteName").val();
    var adminEmail = $("input[name=adminEmail").val();
    var adminUserName = $("input[name=adminUserName").val();
    var adminUserPass = $("input[name=adminUserPass").val();
    var adminUserCPass = $("input[name=adminUserCPass").val();
    fd.append('siteLogo',photo_data);
    fd.append('siteName',siteName);
    fd.append('adminEmail',adminEmail);
    fd.append('adminUserName',adminUserName);
    fd.append('adminUserPass',adminUserPass);
    fd.append('adminUserCPass',adminUserCPass);

    $.ajax({
      url: URL_ROOT + '/init/chSetup',
      type: 'POST',
      dataType: 'json',
      processData: false, // important
      contentType: false, // important
      // data: $.param(ch_site),
      data: fd,
      success: function(data){
        if (data['status'] == 1) {
          $('body').css('overflow','hidden');
           $('.modal').show(100).animate({opacity: '1'},300);
          $('.finish').animate({opacity: '1','margin-right': '25%'}, 800);
        }else {
          if (data['siteName_err']) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("siteVal", data['siteName_err']);
          } else{
            feedbackHide("siteVal");
          }

          if (data['adminEmail_err']) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("adminEmailVal", data['adminEmail_err']);
          } else{
            feedbackHide("adminEmailVal");
          }

          if (data['adminUserName_err']) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("adminUserVal", data['adminUserName_err']);
          } else{
            feedbackHide("adminUserVal");
          }

          if (data['adminUserPass_err']) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("adminPassVal", data['adminUserPass_err']);
          } else{
            feedbackHide("adminPassVal");
          }

          if (data['adminUserCPass_err']) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("adminCPassVal", data['adminUserCPass_err']);
          } else{
            feedbackHide("adminCPassVal");
          }
        }
      },
      error: function(e){
        console.log(e);
      }
    });
  }

  /* if setup this is the link*/
  if (link == 'login') {
    window.location.href = URL_ROOT + "/admin/login";
  }
});
/* Admin initialization*/
$(document).on('click', '.error > span', function(){
  $('.error').animate({opacity: '0','margin-right': '50%'}, 800);
  $('.modal').delay(500).animate({opacity: '0'},300).hide(100);
});

$(document).on('click', '.login-admin', function(){
  login();
});

$('#loginCredentials').keypress(function(e){
  if (e.keyCode == 13) {
    login();
  }
});
function login(){
  var adminData = $('#loginCredentials').serializeArray();

  $.ajax({
    url: URL_ROOT + '/init/adminLogin',
    type: 'POST',
    dataType: 'json',
    data: $.param(adminData),
    success:function(data){
      if (data["data"].status == 1 && data["row"].fId != "") {
        feedbackDefault('f-form');
        window.location.href =  URL_ROOT + "/admin";
        console.log(data["row"].fId);
      }else if(data["data"].status == 2){
        $('#flash-msgs').show().effect( "shake", {times:4}, 1000 );
      }else {
          if (data['data'].adminUserName_err) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("adminUVal", data['data'].adminUserName_err);
          } else{
            feedbackHide("adminUVal");
          }

          if (data['data'].adminUserPass_err) {
            /* Get the parent/container of the input field for firstname and */
            feedbackShow("adminPVal", data['data'].adminUserPass_err);
          } else{
            feedbackHide("adminPVal");
          }
      }
      // console.log(data);
    },
    error: function(err){
      console.log(err);
    }
  });
}

function animate(current, next){
  var left, opacity, scale;
  current.animate({opacity:0},{
    step: function(now,_mx){
      scale = 1 - (1 - now)*0.2;
      left = (now * 50) + "%";
      opacity = 1 - now;
      current.css({'transform':'scale('+scale+')'});
      next.css({'left':left,'opacity':opacity});
    },
    duration: 800,
    complete:function(){
      current.hide();
    }
  }); 
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  $('#blah').show(100);
  readURL(this);
});

/*This two function below will show and hide the feedback during the validation process*/
function feedbackDefault(container){
  $('.' + container + ' .form-group > input').removeClass('invalid-box-shadow');
  $('.' + container + ' .invalid-feedback').hide();
}

function feedbackShow(container, data){
  $('.' + container + ' .form-group > input').addClass('invalid-box-shadow');
  $('.' + container + ' .invalid-feedback').show().text(data);
}

function feedbackHide(container){
  $('.' + container + ' .form-group > input').removeClass();
  $('.' + container + ' .invalid-feedback').hide();
}

$(document).on('click','.req_logs_', function(){
  var stat = $(".request_side").attr("data-status");
  if(stat == "open"){
    $(".request_side").attr("data-status","");
    $(".request_side").css("right","-33%");
  }else{
    $(".request_side").attr("data-status","open");
    $(".request_side").css("right","0");
  }
});

$(window).scroll(function(){
  var w = $(window).scrollTop();
  var e = $(".dashboard-nav").offset().top;
  var t = e - w;
  if(t < -100){
    console.log("Now");
    // $(".dashboard-nav").css("position","fixed");
  }
});
$(document).on('click','#notif-icon',function(){
  $('.m_notification').toggleClass('m_notif_show');
});
$(document).on('click','#add_record',function(){
  $('.m_add_hidden').toggleClass('add_m');
  // Push.Permission.request(onGranted, onDenied);
  Push.Permission.DENIED; // 'denied'


  console.log(Push.Permission.has());
  demo();
  $('.m_notification').print();
  return false;
});
// setInterval(function(){demo()},5000);

var notif = new Audio(URL_ROOT + '/media/audio/notif.mp3');
function demo() {
  Push.create('New request received!', {
      body: 'Some data show in here.',
      icon: URL_ROOT +'/img/icons/clock.png',
      link: '/#',
      // timeout: 4000,
      requireInteraction: true,
      onClick: function () {
          console.log("Fired!");
          window.focus();
          this.close();
      },
      vibrate: [200, 100, 200, 100, 200, 100, 200]
  });
  // notif.play();
  // playSound(URL_ROOT + '/media/audio/notif');
}
// callback For Push Notification if Granted
function onGranted(){

}
// callback For Push Notification if Denied
function onDenied(){

}

// function playSound(filename){
//   var mp3Source = '<source src="' + filename + '.mp3" type="audio/mpeg">';
//   var oggSource = '<source src="' + filename + '.ogg" type="audio/ogg">';
//   var embedSource = '<embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3">';
//   document.getElementById("sound").innerHTML='<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
// }
$('#tinymce').submit(function(e){
  e.preventDefault();
  // var name = $('#mytextarea').val();
  
  console.log($('#chemicalFormula').val());
});

// Precaution Selection
$(document).on('change','#pre_warning_label',function(){
  var option = $(this).val();
  var content = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas commodi incidunt similique";
  $('.caution_note_label').show(100);
  if(option == 1){
    precaution('/img/icons/safety/sprout.png',"Nature Friendly","var(--nature-friendly-label)",content,"var(--nature-friendly-label)");
  } else if (option == 2){
    precaution('/img/icons/safety/precaution.png',"Proceed with caution","var(--proceed-with-caution-label)",content,"var(--proceed-with-caution-label)");
  } else if (option == 3){
    precaution('/img/icons/safety/biohazard.png',"Dispose properly","var(--dispose-properly-label)",content,"var(--dispose-properly)");
  } else if (option == 4){
    precaution('/img/icons/safety/danger.png',"Biohazard","var(--biohazard-label)",content,"var(--biohazard)");
  } else {
    $('.caution_note_label').hide(100);
  }
});

function precaution(icon,label_text,label_background,content,content_background){
  $("#precaution_icon").attr('src',URL_ROOT + icon);
  $("#precaution_label").text(label_text);
  $("#precaution_label").css("background-color",label_background);
  $("#precaution_content").text(content);
  $(".warning_content").css("background-color",content_background);
}
// End of Precaution Selection

$(document).on('click','.open_file_ex',function(){
  $('.new_user_photo_set').show(50);
});