<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// admin table
function cf7ccav_admin_table() {



	if ( !current_user_can( "manage_options" ) )  {
		wp_die( __( "You do not have sufficient permissions to access this page." ) );
	}



	// save and update options
	if (isset($_POST['update'])) {

		$options['currency'] = sanitize_text_field($_POST['currency']);
		if ( empty( $options['currency'] ) ) { 
			$options['currency'] = ''; 
		}

		$options['enable_ccavenue'] = sanitize_text_field( $_POST['enable_ccavenue'] );
		if ( empty( $options['enable_ccavenue'] ) ) { 
			$options['enable_ccavenue'] = ''; 
		}

		$options['mode'] = sanitize_text_field( $_POST['mode'] );
		if ( empty( $options['mode'] ) ) { 
			$options['mode'] = ''; 
		}

		$options['title'] = sanitize_text_field( $_POST['title'] );
		if ( empty( $options['title'] ) ) { 
			$options['title'] = ''; 
		}

		$options['description'] = sanitize_text_field( $_POST['description'] );
		if ( empty( $options['description'] ) ) { 
			$options['description'] = 'Pay securely by Credit or Debit card or internet banking through CCAvenue Secure Servers.'; 
		}

		$options['merchant_id'] = sanitize_text_field( $_POST['merchant_id'] );
		if ( empty( $options['merchant_id'] ) ) { 
			$options['merchant_id'] = '2'; 
		}

		$options['working_key'] = sanitize_text_field( $_POST['working_key'] );
		if ( empty( $options['working_key'] ) ) { 
			$options['working_key'] = ''; 
		}

		$options['access_code'] = sanitize_text_field( $_POST['access_code'] );
		if ( empty( $options['access_code'] ) ) { 
			$options['access_code'] = ''; 
		}


		$options['cancel'] = sanitize_text_field( $_POST['cancel'] );
		if ( empty( $options['cancel'] ) ) { 
			$options['cancel'] = ''; 
		}

		$options['return'] = sanitize_text_field($_POST['return']);
		if ( empty( $options['return'] ) ) { 
			$options['return'] = ''; 
		}

		$options['return'] = 	sanitize_text_field($_POST['return']);
		if ( empty( $options['return'] ) ) { 
			$options['return'] = '2'; 
		}

		update_option("cf7ccav_options", $options);

		echo "<br /><div class='updated'><p><strong>"; _e("Settings Updated."); echo "</strong></p></div>";

	}

	// get options
	$options = get_option('cf7ccav_options');

	if ( empty( $options['currency'] ) ) { 
		$options['currency'] = ''; 
	}

	if (empty($options['enable_ccavenue'])) {
		$options['enable_ccavenue'] = 0; 
	}

	if (empty($options['mode'])) {
	 	$options['mode'] = '1'; 
	}
	
	if (empty($options['enable_currency_conversion'])) {
	 	$options['enable_currency_conversion'] = ''; 
	}

	if (empty($options['iframemode'])) {
		$options['iframemode'] = ''; 
	}

	if (empty($options['title'])) {
		$options['title'] = ''; 
	}

	if (empty($options['description'])) {
		$options['description'] = ''; 
	}

	if (empty($options['merchant_id'])) {
		$options['merchant_id'] = ''; 
	}

	if (empty($options['working_key'])) {
		$options['working_key'] = ''; 
	}

	if (empty($options['access_code'])) {
		$options['access_code'] = ''; 
	}

	if (empty($options['cancel'])) {
		$options['cancel'] = ''; 
	}

	if (empty($options['return'])) {
		$options['return'] = ''; 
	}

	if (empty($options['return'])) {
		$options['return'] = '2'; 
	}
	

	$siteurl = get_site_url();

	if (isset($_POST['hidden_tab_value'])) {
		$active_tab =  $_POST['hidden_tab_value'];
	} else {
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : '1';
	}

?>


<form method='post'>
	<div class='wrap'><h2>Contact Form 7 - CC Avenue Settings</h2></div>

	<table width='100%'><tr><td width='70%' valign='top'>
		<h2 class="nav-tab-wrapper">
			<a onclick='closetabs("3,6");newtab("1");' href="#" id="id1" class="nav-tab <?php echo $active_tab == '1' ? 'nav-tab-active' : ''; ?>">CCAvenue</a>
			<a onclick='closetabs("1,6");newtab("3");' href="#" id="id3" class="nav-tab <?php echo $active_tab == '3' ? 'nav-tab-active' : ''; ?>">Other</a>
			<a onclick='closetabs("1,3");newtab("6");' href="#" id="id6" class="nav-tab <?php echo $active_tab == '6' ? 'nav-tab-active' : ''; ?>">Instructions</a>
		</h2>
		<br />
	</td><td colspan='3'></td></tr><tr><td valign='top'>

	<div id="1" style="display:none;border: 1px solid #CCCCCC;<?php echo $active_tab == '1' ? 'display:block;' : ''; ?>">
		<div style="background-color:#E4E4E4;padding:8px;color:#000;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
		&nbsp; CC Avenue Details
		</div>
		<div style="background-color:#fff;padding:8px;">

			<table width='100%' cellpadding="5px">
				<tr>
					<td class='cf7ccav_width'>
						<b>Enable: </b>
					</td>
					<td>
						<input type='checkbox' name='enable_ccavenue' value='1' <?php if ($options['enable_ccavenue'] == "1") { echo "checked='checked'"; } ?> > Enable <a href="https://www.ccavenue.com/" target="_blank" >CCAvenue</a> Payment Gateway
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Sandbox Mode:</b>
					</td>
					<td>
						<input <?php if ($options['mode'] == "1") { echo "checked='checked'"; } ?> type='radio' name='mode' value='1'>On (Sandbox mode)
						<input <?php if ($options['mode'] == "2") { echo "checked='checked'"; } ?> type='radio' name='mode' value='2'>Off (Live mode)
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Currency Conversion to INR? </b>
					</td>
					<td>
						<input type='checkbox' name='enable_currency_conversion' value='<?php echo $options['enable_currency_conversion']; ?>' <?php if ($options['enable_currency_conversion'] == "1") { echo "checked='checked'"; } ?> > 
					</td>
				</tr>
				<tr><td class='cf7ccav_width'>
				<b>Currency:</b></td><td>
				<select name="currency" readonly>
				<option <?php if ($options['currency'] == "INR") { echo "SELECTED"; } ?> value="INR">Indian Rupees - INR</option>
				<option <?php if ($options['currency'] == "AUD") { echo "SELECTED"; } ?> value="AUD">Australian Dollar - AUD</option>
				<option <?php if ($options['currency'] == "BRL") { echo "SELECTED"; } ?> value="BRL">Brazilian Real - BRL</option>
				<option <?php if ($options['currency'] == "CAD") { echo "SELECTED"; } ?> value="CAD">Canadian Dollar - CAD</option>
				<option <?php if ($options['currency'] == "CZK") { echo "SELECTED"; } ?> value="CZK">Czech Koruna - CZK</option>
				<option <?php if ($options['currency'] == "DKK") { echo "SELECTED"; } ?> value="DKK">Danish Krone - DKK</option>
				<option <?php if ($options['currency'] == "EUR") { echo "SELECTED"; } ?> value="EUR">Euro - EUR</option>
				<option <?php if ($options['currency'] == "HKD") { echo "SELECTED"; } ?> value="HKD">Hong Kong Dollar - HKD</option>
				<option <?php if ($options['currency'] == "HUF") { echo "SELECTED"; } ?> value="HUF">Hungarian Forint - HUF</option>
				<option <?php if ($options['currency'] == "ILS") { echo "SELECTED"; } ?> value="ILS">Israeli New Sheqel - ILS</option>
				<option <?php if ($options['currency'] == "JPY") { echo "SELECTED"; } ?> value="JPY">Japanese Yen - JPY</option>
				<option <?php if ($options['currency'] == "MYR") { echo "SELECTED"; } ?> value="MYR">Malaysian Ringgit - MYR</option>
				<option <?php if ($options['currency'] == "MXN") { echo "SELECTED"; } ?> value="MXN">Mexican Peso - MXN</option>
				<option <?php if ($options['currency'] == "NOK") { echo "SELECTED"; } ?> value="NOK">Norwegian Krone - NOK</option>
				<option <?php if ($options['currency'] == "NZD") { echo "SELECTED"; } ?> value="NZD">New Zealand Dollar - NZD</option>
				<option <?php if ($options['currency'] == "PHP") { echo "SELECTED"; } ?> value="PHP">Philippine Peso - PHP</option>
				<option <?php if ($options['currency'] == "PLN") { echo "SELECTED"; } ?> value="PLN">Polish Zloty - PLN</option>
				<option <?php if ($options['currency'] == "GBP") { echo "SELECTED"; } ?> value="GBP">Pound Sterling - GBP</option>
				<option <?php if ($options['currency'] == "RUB") { echo "SELECTED"; } ?> value="RUB">Russian Ruble - RUB</option>
				<option <?php if ($options['currency'] == "SGD") { echo "SELECTED"; } ?> value="SGD">Singapore Dollar - SGD</option>
				<option <?php if ($options['currency'] == "SEK") { echo "SELECTED"; } ?> value="SEK">Swedish Krona - SEK</option>
				<option <?php if ($options['currency'] == "CHF") { echo "SELECTED"; } ?> value="CHF">Swiss Franc - CHF</option>
				<option <?php if ($options['currency'] == "TWD") { echo "SELECTED"; } ?> value="TWD">Taiwan New Dollar - TWD</option>
				<option <?php if ($options['currency'] == "THB") { echo "SELECTED"; } ?> value="THB">Thai Baht - THB</option>
				<option <?php if ($options['currency'] == "TRY") { echo "SELECTED"; } ?> value="TRY">Turkish Lira - TRY</option>
				<option <?php if ($options['currency'] == "USD") { echo "SELECTED"; } ?> value="USD">U.S. Dollar - USD</option>
				</select></td></tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Title: </b>
					</td>
					<td>
						<input type='text' size=40 name='title' value='<?php echo $options['title']; ?>'>
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Description: </b>
					</td>
					<td>
						<textarea name="description" rows="3" cols="30"><?php echo $options['description']; ?></textarea> 
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Merchant ID: </b>
					</td>
					<td>
						<input type='text' size=40 name='merchant_id' value='<?php echo $options['merchant_id']; ?>'>
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Working Key: </b>
					</td>
					<td>
						<input type='text' size=40 name='working_key' value='<?php echo $options['working_key']; ?>'>
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'>
						<b>Access Code: </b>
					</td>
					<td>
						<input type='text' size=40 name='access_code' value='<?php echo $options['access_code']; ?>'>
					</td>
				</tr>

				<tr>
					<td class='cf7ccav_width'></td>
					<td>
						<br />Enter a valid Merchant account ID (strongly recommend). All payments will go to this account.
						<br /><br />You can find your Merchant account ID in your <a href="https://dashboard.ccavenue.com/jsp/merchant/merchantLogin.jsp" traget="_blank">CC Avenue Dashboard</a>

						<br /><br />If you don't have a CC Avenue Sellers account, you can sign up for free at <a target='_blank' href='https://dashboard.ccavenue.com/web/registration.do?command=navigateSchemeForm'>CC Avenue</a>. <br /><br />
					</td>
				</tr>
			</table>

		</div>
	</div>
		

	<div id="3" style="display:none;border: 1px solid #CCCCCC;<?php echo $active_tab == '3' ? 'display:block;' : ''; ?>">
		<div style="background-color:#E4E4E4;padding:8px;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
			&nbsp; Other Settings
		</div>
		<div style="background-color:#fff;padding:8px;">

			<table style="width: 100%;">

				<tr><td class='cf7ccav_width'><b>Cancel URL: </b></td><td><input type='text' name='cancel' value='<?php echo $options['cancel']; ?>'> Optional <br /></td></tr>
				<tr><td class='cf7ccav_width'></td><td>If the customer goes to CCAvenue and clicks the cancel button, where do they go. Example: <?php echo $siteurl; ?>/cancel. Max length: 1,024. </td></tr>

				<tr><td>
				<br />
				</td></tr>

				<tr><td class='cf7ccav_width'><b>Return URL: </b></td><td><input type='text' name='return' value='<?php echo $options['return']; ?>'> Optional <br /></td></tr>
				<tr><td class='cf7ccav_width'></td><td>If the customer goes to CCAvenue and successfully pays, where are they redirected to after. Example: <?php echo $siteurl; ?>/thankyou. Max length: 1,024. </td></tr>

				<tr><td>
				<br />
				</td></tr>

			</table>

		</div>
	</div>

	<div id="6" style="display:none;border: 1px solid #CCCCCC;<?php echo $active_tab == '6' ? 'display:block;' : ''; ?>">
		<div style="background-color:#E4E4E4;padding:8px;color:#000;font-size:15px;color:#464646;font-weight: 700;border-bottom: 1px solid #CCCCCC;">
			&nbsp; Instructions
		</div>
		<div style="background-color:#fff;padding:8px;">

			When go to your list of contact forms, make a new form or edit an existing form, you will see a new tab called 'CCAvenue'. Here you can
			setup individual settings for that specific contact form.

			<br /><br />

			On this page, you can setup your general CCAvenue settings which will be used for all of your contact forms.

			<br /><br />

			Once you have CCAvenue enabled on a form, you will receive an email as soon as the customer submits the form. Then after they have paid, you should receive a payment
			notification from 'CCAvenue' with the details of the transaction.

		</div>
	</div>

	<input type='hidden' name='update' value='1'>
	<input type='hidden' name='hidden_tab_value' id="hidden_tab_value" value="<?php echo $active_tab; ?>">

	<table width='70%'>
		<tr>
			<td><br />
		<input type='submit' name='btn2' class='button-primary' style='font-size: 17px;line-height: 28px;height: 32px;float: left;' value='Save Settings'>
	</td></tr></table>

</form>

	</td><td width="3%" valign="top">

	</td><td width="24%" valign="top">


	
	</td><td width="2%" valign="top">



	</td></tr></table>

	<?php

}
