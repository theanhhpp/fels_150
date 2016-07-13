$(document).ready(function() {
    $(".delete").click(function(){
        var r = confirm("Are you ok!");
        if (r) {
            return true;
        } else {
            return false;
        } 
    });
    $("#checkAll").change(function () {
        $(".ch").prop('checked', $(this).prop("checked"));
    });
});

function showCustomer(str, action) {
    var xhttp;
    if (str == "") {
        document.getElementById("index").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("index").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", action + "?q=" + str, true);
    xhttp.send();
}

function timeOut(){
   $("#bt").click(); 
}

function startTimer(duration, display, form) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        display.text(minutes + ':' + seconds);
        if (--timer < 0) {
            timeOut();
        }
    }, 1000);
}

jQuery(function ($) {
    var lesson_time = 60 * 20, display = $('#time');
    startTimer(lesson_time, display);
});
