
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<div id="paypal-button-container"></div>

<script>
    // Render the PayPal button

    paypal.Button.render({

        // Set your environment

        env: 'sandbox', // sandbox | production

        // Specify the style of the button

        style: {
            layout: 'vertical', // horizontal | vertical
            size: 'medium', // medium | large | responsive
            shape: 'rect', // pill | rect
            color: 'blue' // gold | blue | silver | black
        },

        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV

        funding: {
            allowed: [paypal.FUNDING.CARD, paypal.FUNDING.CREDIT],
            disallowed: []
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox: 'ATLVMGtUchEJL0vZZuEb3PfEyIgjkqo2iLjywJ4OOd_-qmq-DlHn5ho2lpmFihKyMgy9PTKRvlCfm1av'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [{
                        amount: {
                            total: document.getElementById('total').innerHTML,
                            currency: 'EUR'
                        }
                    }]
                }
            });
        },

        onAuthorize: function(data, actions) {
            actions.order.capture().then(function(detalles) {
                console.log(detalles.payer.name)
            });
            if (window.location == "http://localhost/tienda/carrito.php") {
                $.ajax({
                    url: 'servicios/pedido/confirm.php',
                    type: 'POST',
                    data: {
                        dirusu: "",
                        telusu: ""
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.state) {
                            window.location.href = 'pedidos.php';
                        } else {
                            alert(data.details)
                        }
                    },
                    error: function(err) {
                        console.error("Error fetching data:", err.responseText);
                    }
                });
            } else if (window.location.href.indexOf("http://localhost/tienda/producto.php") !== -1) {
                $.ajax({
                    url: 'servicios/productos/compra_individual.php',
                    type: 'POST',
                    data: {
                        codpro: p,
                        dirusu: "",
                        telusu: ""
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.state) {
                            window.location.href = 'historial.php';
                        } else {
                            alert(data.details)
                        }
                    },
                    error: function(err) {
                        console.error("Error fetching data:", err.responseText);
                    }
                });
            }
                
            

            return actions.payment.execute().then(function() {
                window.alert('Payment Complete!');
            });
        }

    }, '#paypal-button-container');
</script>