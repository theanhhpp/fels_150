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
