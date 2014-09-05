$(function(){
    clickcount = 0;
    seq = "";

    $(".pinremove").hide();
    $(".pinremove").click(function(){
        $(".pinremove").hide();
        seq = "";
        clickcount = 0;
        $(".notif .pinspan").remove();
    })

    $(".keypad").click(function(){
        var num = $(this).text();
        seq += num+"";
        clickcount ++;

        if (!$(".pinremove").is(':visible')) {
            $(".pinremove").show();
        };

        $(".notif .pinspan").remove();
        $(".notif").append("<span class='pinspan'>"+seq+"</span>");
        $(".notif .resspan").remove();

        if (clickcount == 4) {
            $(".pinremove").hide();

            //alert(seq)
            callLogin(seq);

            clickcount = 0;
            seq = "";
        }
        
    })
  
})

function callLogin(seq){
    $(".notif .pinspan").remove();
    
    $.ajax({
        type: 'POST',
        url: "cgi-bin/utentelogin.php",
        data: {
            pin: seq
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function(res) {
            if (res == "ok") {
               window.document.location.href='tables.php';
           }else{
             $(".notif").append("<span class='resspan'>"+res+"</span>");
           }
       },
       error: function(r) {
        alert("Error "+r.status+" on resource '"+this.url+"':\n"+r.statusText);
    }
})
}