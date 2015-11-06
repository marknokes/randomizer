jQuery(document).ready(function($){

    var $container = $('#random-container'),
        num = $container.data('num'),
        fileUrl = $container.data('text-file');

    $container.parents().find('head').append('<link rel="stylesheet" type="text/css" href="style.css">');

    if ( "" === num || isNaN(num) )
        num = 1;

    $.ajax({
        url: "ajax.php",
        data: {
            num: num,
            fileUrl: fileUrl
        },
        success: function(array){
            var values = JSON.parse(array),
                createP = function(value) {
                    var p = document.createElement("p");
                    $(p).html(value);
                    $(p).appendTo($container).hide();
                };
            if ( "string" === typeof( values ) ) {
                createP( values );
                return;
            }
            $.each(values, function(index,value){
                createP(value);
            });
            $container.find('p').fadeIn(500);
        }
    });
});