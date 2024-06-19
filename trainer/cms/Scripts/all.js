const cmsURL="http://localhost/GYMKHANA/trainer/cms/";
const ajaxURL="http://localhost/GYMKHANA/trainer/cms/Requires/";

//default toast
var toast = {
    success: function(message,title='Success') {
        $.toast({
            heading: title,
            text: message,
            icon: 'success',
            loader: true,        // Change it to false to disable loader
            loaderBg: '#9EC600', // To change the background
            position: 'top-right'
        });
    },
    fail: function(message,title='Warning') {
        $.toast({
            heading: title,
            text: message,
            showHideTransition: 'fade',
            icon: 'error',
            position: 'top-right'
        })
    },
};




//swal alert
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger mr-4"
    },
    buttonsStyling: false,
  });

var pop = {
    success: function(message) {
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
      });
    },
    fail: function(message) {
      Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
      });
    },
    delete:function(row,position,table){
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "Did you confirm to remove this "+position+"?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
            backdrop: `
            rgba(0,0,123,0.4)
            url("Upload/nyan-cat.gif")
            left top
            no-repeat
          `
          }).then((result) => {
            if (result.isConfirmed) {
                //execute function
                removeUser(row,position,table);
            }
          });
    },
    connectError:function(){
        swalWithBootstrapButtons.fire({
            title: "Error",
            text: "The Connection was Error Please try again",
            icon: "error"
          });
    },
    error:function(errorMessage){
        swalWithBootstrapButtons.fire({
            title: "Error",
            text: errorMessage,
            icon: "error"
          });
    },
    codeerror:function(errorMessage){
        swalWithBootstrapButtons.fire({
            title: "Error",
            text: errorMessage,
            icon: "error",
            didClose: () => {
                location.reload();
              }
          });
    },
    codesuccess:function(Message){
        swalWithBootstrapButtons.fire({
            title: "Success",
            text: Message,
            icon: "success",
            didClose: () => {
                window.location.href="index.php";
              }
          });
    }

}



function removeUser(row,position,table){
    var form= new FormData();
    form.append('userid',row.data('id'));
    form.append('position',position);

    $.ajax({
        url: ajaxURL+"removeUser.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(responce) {
            if(responce['responce']=="200"){
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "This "+position+" has been deleted.",
                    icon: "success"
                });
                let current= row.closest('tr');
                let currentPage=table.page();
                table.row(current).remove().draw();
                    if (table.page.info().pages - 1 < currentPage && currentPage > 0) {
                        table.page(currentPage - 1).draw('page');
                    }else{
                        table.page(currentPage).draw('page');
                    }
            }else{
                pop.error(responce['error']);
            }
        },
        error: function(){

        }
    })
}

function Login(us,ps){
    var form= new FormData();
    form.append('username',us);
    form.append('password',ps);

    $.ajax({
        url: ajaxURL+"login.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(response) {
            if(response['responce']=='200'){
                storeLocal(us,ps);
                window.location.href=cmsURL+"dashboard.php?login=true";
            
            }else{
                toast.fail("Please Check your username or password","Login Unsuccessful");
            }
            $("#loginbtn").prop("disabled",false);
        },
        error: function(xhr, status, error) {
            toast.fail("Error status : "+status+"\nError problem : "+error);
            $("#loginbtn").prop("disabled",false);
        }
    });
}

function storeLocal(us,ps){
    if($("#remember").prop("checked")){
        user={username:us,password:ps}
        localStorage.setItem('user', JSON.stringify(user));
    }else{
        localStorage.removeItem('user');
    }
}

function sendEmail(email){
    var form= new FormData();
    form.append('email',email);

    $.ajax({
        url: ajaxURL+"sendEmail.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(response) {
            console.log("test");
            if(response['responce']=='200'){
                pop.success("The 6 digit code was sent to your gmail please check it");
                startCountdown();
                $('#card1').slideUp('slow', function () {
                    $('#card2').slideDown('slow');
                });
            }else{
                pop.error(response['error']);
            }
            $("#forgotbtn").prop("disabled",false);
        },
        error: function(xhr, status, error) {
            toast.fail("Error status : "+status+"\nError problem : "+error);
            $("#forgotbtn").prop("disabled",false);
        }
    });
   
}

function verifyCode(code){
    var form= new FormData();
    form.append('code',code);

    $.ajax({
        url: ajaxURL+"checkCode.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(response) {
            if(response['responce']=='200'){
                //success and go to next
                stopCountdown();
                pop.success("The code was Match with the system, now the system will redirect you to next step.");
                $('#card2').slideUp('slow', function () {
                    $('#card3').slideDown('slow');
                });
            }else if(response['responce']=="304"){
                pop.error(response['error']);
            }else{
                pop.codeerror(response['error']);
                
            }
            $("#forgotbtn2").prop("disabled",false);
        },
        error: function(xhr, status, error) {
            toast.fail("Error status : "+status+"\nError problem : "+error);
            $("#forgotbtn2").prop("disabled",false);
        }
    });
}



//countdown function
function updateCountdown() {
    const countdownElement = $('#countdown');
    countdownElement.text(` ${countdownTime}`);
    if (countdownTime <= 0) {
        clearInterval(countdownInterval);
        pop.codeerror("The Session was Expired, System will redirect you back to forgot password page");
    } else {
        countdownTime--;
    }
}

function startCountdown() {
    countdownTime = 60;
    countdownInterval = setInterval(updateCountdown, 1000);
    console.log("executed");
}
function stopCountdown() {
    clearInterval(countdownInterval);
}

function updatePassword(newpassword,conpassword){
    var form= new FormData();
    form.append('newpassword',newpassword);
    form.append('conpassword',conpassword);

    $.ajax({
        url: ajaxURL+"updatePassword.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(response) {
            
            if(response['responce']=='200'){
                //success and go to next
                pop.codesuccess("Password Updated Successful you can login to our system now");
            }else if(response['responce']=="404"){
                pop.codeerror(response['error']);
            }else{
                pop.error(response['error']);
            }
            $("#forgotbtn3").prop("disabled",false);
        },
        error: function(xhr, status, error) {
            toast.fail("Error status : "+status+"\nError problem : "+error);
            $("#forgotbtn3").prop("disabled",false);
        }
    });
}

function checkGmail(type,value,id,callback){
    var form= new FormData();
    form.append('type',type);
    form.append('value',value);
    if(id!=null){
        form.append('id',id);
    }
    $.ajax({
        url: ajaxURL+"checkGmail.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(response) {
            if(response['responce']=="200"){
                callback(true);
            }else{
                callback(false);
            }
        },
        error: function(xhr, status, error) {
            callback(false);
        }
    }); 
}

function checkUser(type,value,id,callback){
    var form= new FormData();
    form.append('type',type);
    form.append('value',value);
    if(id!=null){
        form.append('id',id);
    }
    $.ajax({
        url: ajaxURL+"checkUser.php",
        method: 'POST',
        dataType: 'json',
        processData: false, //dont remove dont process the data
        contentType: false, // Let jQuery set the content type
        data: form,
        success: function(response) {
            if(response['responce']=="200"){
                callback(true);
            }else{
                callback(false);
            }
        },
        error: function(xhr, status, error) {
            callback(false);
        }
    }); 
}

//preset function
$(document).ready(function(){
    var gmail=true;
    var username=true;

    //modal popup
    $('.open-model').magnificPopup({
        fixedContentPos: true,
		fixedBgPos: true,
		overflowY: 'auto',
		type: 'inline',
		preloader: false,
		focus: '#username',
		modal: false,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in',
    });
    
    $('.close-model').on('click', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

    $("#loginform").on("submit",function(e){
        e.preventDefault();
        //add loading page
        $("#loginbtn").prop("disabled",true);
        var username=$(".username").val();
        var password=$(".password").val();

        if(username!="" && password !=""){
            Login(username,password);
        }else{
            $("#loginbtn").prop("disabled",false);
        }

    });

    $("#forgotPassword").on("submit",function(e){
        e.preventDefault();
        $("#forgotbtn").prop("disabled",true);
        var email=$(".email").val();
        if(email!=""){
            sendEmail(email);
        }else{
            $("#forgotbtn").prop("disabled",false);
        }
    });
    
    $("#forgotPassword2").on("submit",function(e){
        e.preventDefault();
        $("#forgotbtn2").prop("disabled",true);
        var code=$(".code").val();
        if(code!=""){
            verifyCode(code);
        }else{
            $("#forgotbtn2").prop("disabled",false);
        }
    });

    $("#forgotPassword3").on("submit",function(e){
        e.preventDefault();
        $("#forgotbtn3").prop("disabled",true);
        var newpassword=$(".newpassword").val();
        var conpassword=$(".conpassword").val();
        if(newpassword!="" &&  conpassword !=""){
            updatePassword(newpassword,conpassword);
        }else{
            $("#forgotbtn3").prop("disabled",false);
        }
    });
    $(".addEditform").on("submit",function(e){
        e.preventDefault();
        if(gmail && username){
            this.submit();
        }else{
            pop.error("Please Correct the Error before you submit");
        };
    });

    $(".gmail").on("change",function(e){
        typeName=$(this).attr('name');
        type=typeName.split("_")[0];
        value=$(this).val();
        id=null;
        //mean have item there
        if($('input[name="id"]').length>0){
            id=$('input[name="id"]').val();
        }


        if(value!=""){
            checkGmail(type,value,id,function(result){
                if(result){
                    gmail=true;
                    $(".gmail").removeClass("is-invalid");
                    $("#errormessageEmail.errormessageEmail").remove();
                }else{
                    if($("#errormessageEmail.errormessageEmail").length===0){
                        newElement=$("<span>").attr("id","errormessageEmail").addClass("errormessageEmail error invalid-feedback").text("The Email was Duplicated with our system");
                        $(".gmail").addClass("is-invalid").after(newElement);
                    }
                    gmail=false;
                }
            });
        }else{
            gmail=false;
            if($("#errormessageEmail.errormessageEmail").length===0){
                newElement=$("<span>").attr("id","errormessageEmail").addClass("errormessageEmail error invalid-feedback").text("The Email Cannot be Empty");
                $(".gmail").addClass("is-invalid").after(newElement);
            }else{
                $("#errormessageEmail.errormessageEmail").text("The Email Cannot be Empty");
                $(".gmail").addClass("is-invalid").after(newElement);
            }
        }
    }); 

    $(".addEditform input.username").on("change",function(e){
        typeName=$(this).attr('name');
        type=typeName.split("_")[0];
        value=$(this).val();
        id=null;
        //mean have item there
        if($('input[name="id"]').length>0){
            id=$('input[name="id"]').val();
        }
        if(value!=""){
            checkUser(type,value,id,function(result){
                if(result){
                    username=true;
                    $(".username").removeClass("is-invalid");
                    $("#errormessageEmail.errormessageEmail").remove();
                }else{
                    if($("#errormessageEmail.errormessageEmail").length===0){
                        newElement=$("<span>").attr("id","errormessageEmail").addClass("errormessageEmail error invalid-feedback").text("The Email was Duplicated with our system");
                        $(".username").addClass("is-invalid").after(newElement);
                    }
                    username=false;
                }
            });
        }else{
            username=false;
            if($("#errormessageEmail.errormessageEmail").length===0){
                newElement=$("<span>").attr("id","errormessageEmail").addClass("errormessageEmail error invalid-feedback").text("The Email Cannot be Empty");
                $(".username").addClass("is-invalid").after(newElement);
            }else{
                $("#errormessageEmail.errormessageEmail").text("The Email Cannot be Empty");
                $(".username").addClass("is-invalid").after(newElement);
            }
        }
    });
});
//preset function