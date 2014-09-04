$(function(){

})

function verify(arg){
    var trimed = $.trim(arg);
  if (trimed =="") 
    return false;
else if (!validEmail(trimed) && !ValidPhone(trimed)) {
    return false;
}
else return true;
}

function validEmail(v) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
}

function ValidPhone(v) {
    var pattern = /^[0-9-+]+$/;
    if (pattern.test(v)) {
        return true;
    }
    return false;
}

function validSocial(v) {
    var r = new RegExp("^[a-zA-Z'_ ]*$");
    return (v.match(r) == null) ? false : true;
}


function ajaxVerify(arg){
    var trimed = $.trim(arg);
    $.ajax({
        type: 'GET',
        url:  'php/verifyid.php',
        data: {
            senderid:trimed
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(x) {
           // alert(x);
            if (x == 0) {
                $(".warning2").append("<span>"+msgSENDER+"</span>");
                $(".wst").addClass("has-error");
            }else if (x == 1) {
                ajaxTrace($("#whoareyou").val(),$("#whosthat").val(),$("#whichnetwork").val());
            }
            
        },
        error: function(r) { 
            alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText); 
        }
    })
}


