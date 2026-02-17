<?php
    get_header();

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    global $wpdb;
    session_start();

    $table_name = $wpdb->prefix . 'custom_payment'; // Replace 'custom_table' with your actual table name

    $data = array(
        'payment_response' => json_encode($_POST),
    );
    if( isset($_POST['transactionId']) && $_POST['code'] == 'PAYMENT_SUCCESS'){

        $data['payment_status'] = 1; ?>

            <div class="phonepe" id="phonepe">
                <div class="phonepe__header">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#18A558">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2>Payment Confirmed</h2>
                    <p>Thank you, your payment has been successfull</p>
                </div>
                <div class="phonepe__body">
                    <h3>ORDER DETAILS</h3>
                    <table class="phonepe__body__table">
                    <tr>
                        <td>Amount</td>
                        <td>INR <?php echo $_POST['amount']; ?></td>
                    </tr>
                    <tr>
                        <td>Transaction Details</td>
                        <td><?php echo $_POST['transactionId']; ?></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td><?php echo current_time('jS M, Y, H:i');?></td>
                    </tr>
                    </table>
                </div>
                <div class="phonepe__footer">
                    <a href="<?php echo site_url('/custom-payment'); ?>">Make new payment</a>
                    <button id="printdata">Print invoice</button>
                </div>
            </div>

        <?php
    }else if( isset($_POST['transactionId']) && $_POST['code'] == 'PAYMENT_ERROR'){

        $data['payment_status'] = 0;?>
            <div class="phonepe" id="phonepe">
                <div class="phonepe__header">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d24141" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2>Payment Failed</h2>
                    <p>Opps, your payment has been failed. Please Retry after few minutes.</p>
                </div>
                <div class="phonepe__footer">
                    <a href="<?php echo site_url('/custom-payment'); ?>">Retry</a>
                </div>
            </div>
    <?php }else{
        $data['payment_status'] = 0; ?>
            <div class="phonepe" id="phonepe">
                <div class="phonepe__header">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d24141" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2>Unauthorized Payment</h2>
                </div>
                <div class="phonepe__footer">
                    <a href="<?php echo site_url('/custom-payment'); ?>">Retry</a>
                </div>
            </div>
        <?php

    }

    $where = array(
        'transaction_id' => $_POST['transactionId'],
    );

    $wpdb->update($table_name, $data, $where);

    if( isset($_POST['transactionId']) && $_POST['code'] == 'PAYMENT_SUCCESS'){

        // Define the name of your custom table (replace 'your_custom_table' with the actual table name)
        $table_name = $wpdb->prefix . 'custom_payment';

        // Define the query
        $sql = $wpdb->prepare("SELECT phone_no FROM $table_name WHERE transaction_id = %s", $_POST['transactionId']);

        // Execute the query
        $phoneno = $wpdb->get_var($sql);

        $textmessage = rawurlencode("Dear test, Your 123456 is dispatched. You will be notify if order status updates. -SEVAK PREMIUM PRODUCTS");
        send_sms($textmessage, $phoneno);
    }
?>
<script>
    jQuery(document).ready(function(){
        function printDiv(divId) {
            var content = document.getElementById(divId);
            jQuery(content).find('svg').remove();
            var printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title></head><body>');
            printWindow.document.write(content.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
    })
    jQuery(document).on('click','#printdata', function() {
        printDiv('phonepe'); // Specify the div's ID
    });
</script>
<?php
    get_footer();
?>