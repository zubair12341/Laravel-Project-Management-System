// Tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    //--------------------------- Alert message
    $(document).ready(function() {
        $("#alert").fadeTo(2000, 500).fadeOut(2000, function(){
            $("#alert").alert('close');
        });
    });

  });


