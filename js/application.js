$(document).ready(function() 
{
    $.ajax(
    {
        post: "GET",
        url: "./php/table.php",
        success: function(data){
            $("#contentColumn").html(data);
        }
    });

});