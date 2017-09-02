<!DOCTYPE html>
<html>
<head>
<script src="../jquery/jquery.min.3.js"></script>
<script>
$(document).ready(function(){

    $.ajax({
        
        url: "bonolotoloader.php",
        crossDomain:true,        
        cache: false
        })
        .done(function (html ) {
            var mainDiv = $(".cuerpoRegionIzq ul", html);
            $( "#div1" ).append( mainDiv );
            $( "#div1 ul" ).attr('class','loto-ballgs');
            $( "#div1 ul li" ).attr('class','loto-ball-g');
        })
        .fail(function( html ) {
            $( "#div1" ).html( "error");
        });

    
});
</script>
</head>
<body>

<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>

<button>Get External Content</button>

</body>
</html>