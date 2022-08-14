(function($) {

	$(document).ready(function() {

        "use strict"

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var stripe = Stripe($('#stripe_publishable').val());

        var donateButton = $('#donate');
        donateButton.prop('disabled',true);

        var customer_checkbox = $('#link-checkbox');

        customer_checkbox.change(
            function(){
                if ($(this).is(':checked')) {
                    donateButton.prop('disabled',false);
                }
                else {
                    donateButton.prop('disabled',true);
                }
            });
        
        donateButton.on('click', function(e) {
            e.preventDefault();
            donateButton.prop('disabled',true);
            var amount = document.getElementById('amount').value;
            var customer_email = document.getElementById('customer_email').value;
            var terminal_code = document.getElementById('map-test').value;


            document.getElementById('payicon').style.display = 'none';
            document.getElementById('payloadingicon').classList.add('opacity-100');
            
            
            if(amount=='' || customer_email==''){
                alert('Type in your email');
                document.getElementById('payicon').style.display = 'inline';
            document.getElementById('payloadingicon').classList.remove('opacity-100');
            donateButton.prop('disabled',false);
                return;
            }
            if(terminal_code == '') {
                alert('Choose terminal');
                document.getElementById('payicon').style.display = 'inline';
            document.getElementById('payloadingicon').classList.remove('opacity-100');
            donateButton.prop('disabled',false);
                return;
            }
            $.ajax({
        
                url: '/stripe/initiateCheckout',
                type: 'POST',
                
                data: {
                    amount: 10,
                    email: customer_email,
                    terminal_code: terminal_code
                },
                
                success: function (data) { 
                    if(data.status == 'success') {
                        stripe.redirectToCheckout({
                            sessionId: data.stripeSession
                        })
                    }
                    else if(data.status == 'soldout') {
                        window.location.search += '&itemName=' + data.item + '&itemId=' + data.itemId + '&itemQty=' + data.itemQty;
                    }
                    else {
                        alert('Something went wrong!');
                    }
                    
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