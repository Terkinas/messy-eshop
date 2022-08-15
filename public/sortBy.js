(function($) {

	$(document).ready(function() {

        "use strict"

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var sortbyId = $('#sortbyId');
        
        sortbyId.on('change', function(e) {
            e.preventDefault();
            // var terminal_code = document.getElementById('map-test').value;

 
            
            $.ajax({
        
                url: '/products/',
                type: 'GET',
                
                data: {
                    pickShort: 'lowhigh'
                },
                
                success: function (data) { 
                    console.log('nicee');
                    
                },
                error : function (data){
                    donateButton.prop('disabled',false);
                    window.location.reload();
                    // alert('One of items you picked has been sold out :(');
                    // alert('Looks like one of your items has been sold out');
                    
                }
            });


            
            
            
        });

    })

})(jQuery);	