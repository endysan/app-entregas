$(document).ready(function(){

$('#calcular-btn').preventDefault(event);
$('#calcular-btn').onClick(calculateDistance());

function calculateDistance() {
    
    $.ajax({
        type: "GET",
        url: './distance',
        data: "",
        success: function() {
            console.log("Distancia calculada");
        }
    })
};
    
});