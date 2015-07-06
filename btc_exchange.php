<?php
/**
 * @package BTC_Exchange
 */
/*
Plugin Name: BTC Exchange Widget
Plugin URI: http://jacobbaron.net
Description: Bitcoin exchange rates and conversion tools.
Author: csmicfool
Version: 1.2.8
Author URI: http://jacobbaron.net
*/

class btc_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		// widget actual processes
		parent::__construct(
			'btc_widget', // Base ID
			__('Bitcoin Exchange Rate', 'text_domain'), // Name
			array( 'description' => __( 'Current Bitcoin Exchange Rates and coversion tools for multiple currencies.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		wp_enqueue_script( 'btc_exchange_js', plugins_url('jquery.autosize.input.js', __FILE__), array(), false, true);
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = false;
		if(apply_filters( 'disable_style', $instance['disable_style'] )) $style = true;
		
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		// outputs the content of the widget<select name="currency" id="crsel">
		if ( ! wp_http_supports( array( 'ssl' ) ) ) {
			// this server can't do https, display an error or handle it gracefully 
			echo 'Error Loading Widget: SSL Not Supported';
			return;
		}
		
		if(WP_Widget::is_preview()){
			$d = '{
			  "AUD": {
				"24h_avg": 661.19,
				"ask": 680.57,
				"bid": 680.57,
				"last": 680.57,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 29.2
			  },
			  "BRL": {
				"24h_avg": 1488.66,
				"ask": 1535.0,
				"bid": 1520.0,
				"last": 1520.0,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 13.93
			  },
			  "CAD": {
				"24h_avg": 650.63,
				"ask": 656.87,
				"bid": 652.68,
				"last": 656.14,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 133.7
			  },
			  "CHF": {
				"24h_avg": 342.54,
				"ask": 0.0,
				"bid": 0.0,
				"last": 0.0,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 0.34
			  },
			  "CNY": {
				"24h_avg": 3673.59,
				"ask": 3687.54,
				"bid": 3683.95,
				"last": 3683.95,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 7523.09
			  },
			  "EUR": {
				"24h_avg": 446.21,
				"ask": 447.94,
				"bid": 446.87,
				"last": 447.13,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 885.65
			  },
			  "GBP": {
				"24h_avg": 362.06,
				"ask": 364.64,
				"bid": 364.64,
				"last": 364.64,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 235.82
			  },
			  "HKD": {
				"24h_avg": 2049.42,
				"ask": 4788.27,
				"bid": 4788.27,
				"last": 4788.27,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 0.67
			  },
			  "IDR": {
				"24h_avg": 6732590.73,
				"ask": 6778000.0,
				"bid": 6695000.0,
				"last": 6778000.0,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 12.27
			  },
			  "ILS": {
				"24h_avg": 2002.2,
				"ask": 2045.0,
				"bid": 1980.0,
				"last": 1980.0,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 3.25
			  },
			  "MXN": {
				"24h_avg": 7697.81,
				"ask": 7963.86,
				"bid": 7857.14,
				"last": 7964.73,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 9.15
			  },
			  "NOK": {
				"24h_avg": 28.2,
				"ask": 0.0,
				"bid": 0.0,
				"last": 0.0,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 0.0
			  },
			  "NZD": {
				"24h_avg": 660.39,
				"ask": 709.22,
				"bid": 709.22,
				"last": 709.22,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 4.94
			  },
			  "PLN": {
				"24h_avg": 1762.95,
				"ask": 1795.0,
				"bid": 1765.0,
				"last": 1795.0,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 53.58
			  },
			  "RON": {
				"24h_avg": 1556.79,
				"ask": 1637.16,
				"bid": 1637.16,
				"last": 1637.16,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 1.84
			  },
			  "RUB": {
				"24h_avg": 22695.07,
				"ask": 22719.97,
				"bid": 22574.1,
				"last": 22574.11,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 112.95
			  },
			  "SEK": {
				"24h_avg": 4390.63,
				"ask": 4370.92,
				"bid": 4370.92,
				"last": 4370.92,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 9.44
			  },
			  "SGD": {
				"24h_avg": 745.3,
				"ask": 745.44,
				"bid": 743.96,
				"last": 743.72,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 14.1
			  },
			  "TRY": {
				"24h_avg": 1289.62,
				"ask": 1300.86,
				"bid": 1291.01,
				"last": 1291.01,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 7.05
			  },
			  "USD": {
				"24h_avg": 596.85,
				"ask": 597.95,
				"bid": 597.45,
				"last": 598.16,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 9728.7
			  },
			  "ZAR": {
				"24h_avg": 6730.28,
				"ask": 6604.71,
				"bid": 6560.99,
				"last": 6616.35,
				"timestamp": "Sun, 27 Jul 2014 01:37:24 -0000",
				"total_vol": 9.09
			  },
			  "timestamp": "Sun, 27 Jul 2014 01:37:24 -0000"
			}';
		}
		

		if(get_transient('btc_data')===false && !WP_Widget::is_preview()){
			
			$response = wp_remote_get( 'https://api.bitcoinaverage.com/ticker/all' ); 
			if ( is_wp_error( $response ) || (200 != wp_remote_retrieve_response_code( $response ) && 429 != wp_remote_retrieve_response_code($response))) {
				// failed to get a valid response, handle this error 
				echo 'Error Loading Widget Data';
				echo $args['after_widget'];
				return;
			} 
			if(429 == wp_remote_retrieve_response_code($response) || wp_remote_retrieve_body( $response ) == 'IP Banned'){
				// rate limit exceeded somehow
				echo 'Rate Limit Exceeded or IP Blocked';
				echo $args['after_widget'];
				return;
			}
			$d = wp_remote_retrieve_body( $response );
			set_transient('btc_data',$d,300);
		}
		
		if(!get_transient('btc_data')===false){
			$d = get_transient('btc_data');
		}
		
		$j = json_decode($d);
		$o = get_object_vars($j);
		
?>
		<script type="text/javascript">
			var currenciesJSON = {
				"AUD":{"symbol":"A$","country":"Australia","name":"Dollar","longname":"Australian Dollar"},
				"BRL":{"symbol":"R$","country":"Brazil","name":"Real","longname":"Brazilian Real"},
				"CAD":{"symbol":"C$","country":"Canada","name":"Dollar","longname":"Canadian Dollar"},
				"CHF":{"symbol":"CHF","country":"Switzerland","name":"Franc","longname":"Swiss Franc"},
				"CNY":{"symbol":"&yen;","country":"China","name":"Yuan","longname":"Yuan Renminbi"},
				"EUR":{"symbol":"&euro;","country":"European Union","name":"Euro","longname":"Euro"},
				"GBP":{"symbol":"&pound;","country":"United Kingdom","name":"Pound","longname":"United Kingdom Pound"},
				"HKD":{"symbol":"HK$","country":"Hong Kong","name":"Dollar","longname":"Hong Kong Dollar"},
				"IDR":{"symbol":"Rp","country":"Indonesia","name":"Rupiah","longname":"Indonesian Rupiah"},
				"ILS":{"symbol":"&#8362;","country":"Israel","name":"Sheqel","longname":"Israeli New Sheqel"},
				"MXN":{"symbol":"Mex$","country":"Mexico","name":"Peso","longname":"Mexican Peso"},
				"NOK":{"symbol":"kr","country":"Norway","name":"Kroner","longname":"Norwegian Kroner"},
				"NZD":{"symbol":"$","country":"New Zealand","name":"Dollar","longname":"New Zealand Dollar"},
				"PLN":{"symbol":"zl","country":"Poland","name":"Zloty","longname":"Polish Zloty"},
				"RON":{"symbol":"leu","country":"Romania","name":"Leu","longname":"Romanian New Leu"},
				"RUB":{"symbol":"руб","country":"Russia","name":"Rouble","longname":"Russian Rouble"},
				"SEK":{"symbol":"kr","country":"Sweeden","name":"Krona","longname":"Sweedish Krona"},
				"SGD":{"symbol":"S$","country":"Singapore","name":"Dollar","longname":"Singapore Dollar"},
				"TRY":{"symbol":"TL","country":"Turkey","name":"Lira","longname":"Turkish Lira"},
				"USD":{"symbol":"$","country":"United States","name":"Dollar","longname":"United States Dollar"},
				"ZAR":{"symbol":"R","country":"South Africa","name":"Rand","longname":"South Africa Rand"}
			}; //"":{"symbol":"","country":"","name":"","longname":""}
			jQuery(document).ready(function () {
				jQuery('#crsel').change(function(){
					update_exc();
					set_curr_detail();
				});
				jQuery('#btc_amt').keyup(function(){
					update_exc();
					set_curr_detail();
				});
				jQuery('#cur_amt').keyup(function(){
					update_exc_rev();
					set_curr_detail();
				});
				jQuery('.btc_widget_content input').autosizeInput();
				set_curr_detail();
				jQuery('#crsel option').each(function(){
					//console.log(jQuery(this).data('symbol'));
					var curr = jQuery(this).data('symbol');
					jQuery(this).html(curr+' ('+currenciesJSON[curr].country+')');
				});
			});
			function set_curr_detail(){
				var t = jQuery('#crsel').find('option:selected');
				var s = t.data('symbol');
				jQuery('#cur_long_name').html(currenciesJSON[s].longname);
				jQuery('#cur_symbol').html('<strong style="font-size:1.2em;position:relative;margin-right:.1em">'+currenciesJSON[s].symbol+'</strong>');
			}
			function update_exc(){
				var t = jQuery('#crsel').find('option:selected');
				//console.log(t);
				var s = t.data('symbol');	
				var v = jQuery('#crsel').val();
				var b = jQuery('#btc_amt').val();
				v = v*b;
				jQuery('#cur_symbol').html('<strong style="font-size:1.2em;position:relative;margin-right:.1em">'+s+'</strong>');
				jQuery('#cur_amt').val(v.toFixed(2).toString());
				jQuery('#cur_amt').change();
			}
			function update_exc_rev(){
				var t = jQuery('#crsel').find('option:selected');
				//console.log(t);
				var s = t.data('symbol');	
				var v = jQuery('#crsel').val();
				var b = jQuery('#cur_amt').val();
				v = (b/v);
				jQuery('#btc_amt').val(v.toFixed(2).toString());
				jQuery('#btc_amt').change();
			}
		</script>
		<?php 
		if(!$style){
		?>
			<style type="text/css">
				.btc_widget_content input {
					width: 40px;
					min-width: 40px;
					max-width: 240px;
					transition: width 0s;    
				}
			</style>
			<div class="btc_widget_content" style="text-align:center;">
			<span id="btc_symbol"><strong style="font-size:1.2em;position:relative;margin-right:.1em">฿</strong></span><input type="text" name="btc_amt" id="btc_amt" data-autosize-input='{ "space": 0 }' value="<?= $instance['default_value'] ?>" /> = 
			<span id="up" style="white-space:nowrap;"><span id="cur_symbol"><strong style="font-size:1.2em;position:relative;margin-right:.1em">USD</strong></span> <input type="text" name="cur_amt" id="cur_amt" data-autosize-input='{ "space": 0 }' value="<?= number_format((($j->USD->{'last'}*$instance['default_value'])),2,'.','') ?>" /></span><br>
			<small><span id="cur_long_name"></span></small><br>
			<select name="currency" id="crsel"><?php
			foreach(array_keys($o) as $c){
				if(($c!='timestamp') && ($o[$c]->{'last'}>0)){
					?>
					<option data-symbol="<?= $c ?>" value="<?= number_format($o[$c]->{'last'},2,'.','') ?>" <?php if($c=="USD"){echo 'selected="selected"';} ?>><?= $c ?></option>
					<?php
				}
			}
			
			?>
			</select>
			</div><?php
		}
		if($style){
		?>
			<div class="btc_widget_content" style="text-align:center;">
			<span id="btc_symbol">฿</span><input type="text" name="btc_amt" id="btc_amt" data-autosize-input='{ "space": 0 }' value="<?= $instance['default_value'] ?>" /> = 
			<span id="up"><span id="cur_symbol"><strong>USD</strong></span> <input type="text" name="cur_amt" id="cur_amt" data-autosize-input='{ "space": 0 }' value="<?= number_format((($j->USD->{'last'}*$instance['default_value'])),2,'.','') ?>" /></span><br>
			<small><span id="cur_long_name"></span></small><br>
			<select name="currency" id="crsel"><?php
			foreach(array_keys($o) as $c){
				if(($c!='timestamp') && ($o[$c]->{'last'}>0)){
					?>
					<option data-symbol="<?= $c ?>" value="<?= number_format($o[$c]->{'last'},2,'.','') ?>" <?php if($c=="USD"){echo 'selected="selected"';} ?>><?= $c ?></option>
					<?php
				}
			}
			
			?>
			</select>
			</div><?php
		
		}
		echo $args['after_widget'];
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'default_value' ] ) ) {
			$default_value = $instance[ 'default_value' ];
		}
		if ( isset( $instance[ 'disable_style' ] ) ) {
			$disable_style = $instance[ 'disable_style' ];
		}
		else {
			$title = __( 'Bitcoin Exchange Rate', 'text_domain' );
			$default_value = 1;
			$disable_style = false;
		}
		?>
		<p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"><br/>
            <label for="<?php echo $this->get_field_id( 'default_value' ); ?>"><?php _e( 'Default Value:' ); ?></label> <input class="" id="<?php echo $this->get_field_id( 'default_value' ); ?>" name="<?php echo $this->get_field_name( 'default_value' ); ?>" type="number" value="<?php echo esc_attr( $default_value ); ?>" style="width:50px;"> BTC<br/><br/>
			<label for="<?php echo $this->get_field_id('disable_style'); ?>"><?php _e('Disable Inline Styles:'); ?></label> <input class="" id="<?php echo $this->get_field_id('disable_style'); ?>" name="<?php echo $this->get_field_name('disable_style'); ?>" type="checkbox" value="true<?php echo esc_attr($disable_style); ?>" <?php if(esc_attr($disable_style)){echo 'checked';} ?>>
		</p>
        <p>
        	Enjoying the widget?&nbsp; Why not make a donation?
            <!-- Place this html code where you want the widget -->
            <div style="float:left;padding-right:12px;">
                <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=C2A8GHH997USA" target="_blank">
                	<img border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="PayPal - The safer, easier way to pay online!">
                </a>
			</div>
            <div style="float:left;padding-top:2px;">
                <div class="bitcoin-button" data-address="1GTxp3G6rPn6VM79zBF4ik93Mzc44BXkSy" data-info="none" data-message="Leave a tip to support my work!"></div>
                
                <!-- Place this snippet somewhere after the last button -->
                <script type="text/javascript">
                var bitcoinwidget_init = { autoload: true, host: "//bitcoinwidget.appspot.com" };
                (function() {
                var x = document.createElement("script"); x.type="text/javascript"; x.async=true;
                x.src = "//bitcoinwidget.appspot.com/js/bitcoinwidget.js";
                var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(x,s);
                })();
                </script>
            </div>
            <div class="clear"></div>
            <a href="https://BitcoinAverage.com" target="_blank">BitcoinAverage Price Index</a>
            <div class="clear"></div>
        </p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['default_value'] = ( ! empty( $new_instance['default_value'] ) ) ? strip_tags( $new_instance['default_value'] ) : '';
		$instance['disable_style'] = ( ! empty( $new_instance['disable_style'] ) ) ? strip_tags( $new_instance['disable_style'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'btc_widget' );
});


//[foobar]
function btc_widget_shortcode( $atts ){
	wp_enqueue_script( 'btc_exchange_js', plugins_url('jquery.autosize.input.js', __FILE__), array(), false, true);
	
	if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
	// outputs the content of the widget<select name="currency" id="crsel">
	if ( ! wp_http_supports( array( 'ssl' ) ) ) {
		// this server can't do https, display an error or handle it gracefully 
		echo 'Error Loading Widget: SSL Not Supported';
		return;
	}	

	if(get_transient('btc_data')===false && !WP_Widget::is_preview()){
		
		$response = wp_remote_get( 'https://api.bitcoinaverage.com/ticker/all' ); 
		if ( is_wp_error( $response ) || (200 != wp_remote_retrieve_response_code( $response ) && 429 != wp_remote_retrieve_response_code($response))) {
			// failed to get a valid response, handle this error 
			echo 'Error Loading Widget Data';
			echo $args['after_widget'];
			return;
		} 
		if(429 == wp_remote_retrieve_response_code($response) || wp_remote_retrieve_body( $response ) == 'IP Banned'){
			// rate limit exceeded somehow
			echo 'Rate Limit Exceeded or IP Blocked';
			echo $args['after_widget'];
			return;
		}
		$d = wp_remote_retrieve_body( $response );
		set_transient('btc_data',$d,300);
	}
	
	if(!get_transient('btc_data')===false){
		$d = get_transient('btc_data');
	}
	
	$j = json_decode($d);
	$o = get_object_vars($j);
	
?>
	<script type="text/javascript">
		var currenciesJSON = {
			"AUD":{"symbol":"A$","country":"Australia","name":"Dollar","longname":"Australian Dollar"},
			"BRL":{"symbol":"R$","country":"Brazil","name":"Real","longname":"Brazilian Real"},
			"CAD":{"symbol":"C$","country":"Canada","name":"Dollar","longname":"Canadian Dollar"},
			"CHF":{"symbol":"CHF","country":"Switzerland","name":"Franc","longname":"Swiss Franc"},
			"CNY":{"symbol":"&yen;","country":"China","name":"Yuan","longname":"Yuan Renminbi"},
			"EUR":{"symbol":"&euro;","country":"European Union","name":"Euro","longname":"Euro"},
			"GBP":{"symbol":"&pound;","country":"United Kingdom","name":"Pound","longname":"United Kingdom Pound"},
			"HKD":{"symbol":"HK$","country":"Hong Kong","name":"Dollar","longname":"Hong Kong Dollar"},
			"IDR":{"symbol":"Rp","country":"Indonesia","name":"Rupiah","longname":"Indonesian Rupiah"},
			"ILS":{"symbol":"&#8362;","country":"Israel","name":"Sheqel","longname":"Israeli New Sheqel"},
			"MXN":{"symbol":"Mex$","country":"Mexico","name":"Peso","longname":"Mexican Peso"},
			"NOK":{"symbol":"kr","country":"Norway","name":"Kroner","longname":"Norwegian Kroner"},
			"NZD":{"symbol":"$","country":"New Zealand","name":"Dollar","longname":"New Zealand Dollar"},
			"PLN":{"symbol":"zl","country":"Poland","name":"Zloty","longname":"Polish Zloty"},
			"RON":{"symbol":"leu","country":"Romania","name":"Leu","longname":"Romanian New Leu"},
			"RUB":{"symbol":"руб","country":"Russia","name":"Rouble","longname":"Russian Rouble"},
			"SEK":{"symbol":"kr","country":"Sweeden","name":"Krona","longname":"Sweedish Krona"},
			"SGD":{"symbol":"S$","country":"Singapore","name":"Dollar","longname":"Singapore Dollar"},
			"TRY":{"symbol":"TL","country":"Turkey","name":"Lira","longname":"Turkish Lira"},
			"USD":{"symbol":"$","country":"United States","name":"Dollar","longname":"United States Dollar"},
			"ZAR":{"symbol":"R","country":"South Africa","name":"Rand","longname":"South Africa Rand"}
		}; //"":{"symbol":"","country":"","name":"","longname":""}
		jQuery(document).ready(function () {
			jQuery('#crsel').change(function(){
				update_exc();
				set_curr_detail();
			});
			jQuery('#btc_amt').keyup(function(){
				update_exc();
				set_curr_detail();
			});
			jQuery('#cur_amt').keyup(function(){
				update_exc_rev();
				set_curr_detail();
			});
			jQuery('.btc_widget_content input').autosizeInput();
			set_curr_detail();
			jQuery('#crsel option').each(function(){
				//console.log(jQuery(this).data('symbol'));
				var curr = jQuery(this).data('symbol');
				jQuery(this).html(curr+' ('+currenciesJSON[curr].country+')');
			});
		});
		function set_curr_detail(){
			var t = jQuery('#crsel').find('option:selected');
			var s = t.data('symbol');
			jQuery('#cur_long_name').html(currenciesJSON[s].longname);
			jQuery('#cur_symbol').html('<strong style="font-size:1.2em;position:relative;margin-right:.1em">'+currenciesJSON[s].symbol+'</strong>');
		}
		function update_exc(){
			var t = jQuery('#crsel').find('option:selected');
			//console.log(t);
			var s = t.data('symbol');	
			var v = jQuery('#crsel').val();
			var b = jQuery('#btc_amt').val();
			v = v*b;
			jQuery('#cur_symbol').html('<strong style="font-size:1.2em;position:relative;margin-right:.1em">'+s+'</strong>');
			jQuery('#cur_amt').val(v.toFixed(2).toString());
			jQuery('#cur_amt').change();
		}
		function update_exc_rev(){
			var t = jQuery('#crsel').find('option:selected');
			//console.log(t);
			var s = t.data('symbol');	
			var v = jQuery('#crsel').val();
			var b = jQuery('#cur_amt').val();
			v = (b/v);
			jQuery('#btc_amt').val(v.toFixed(2).toString());
			jQuery('#btc_amt').change();
		}
	</script>
	<div class="btc_widget_content">
	<span id="btc_symbol">฿</span><input type="text" name="btc_amt" id="btc_amt" data-autosize-input='{ "space": 0 }' value="<?= $instance['default_value'] ?>" /> = 
	<span id="up"><span id="cur_symbol">USD</span> <input type="text" name="cur_amt" id="cur_amt" data-autosize-input='{ "space": 0 }' value="<?= number_format((($j->USD->{'last'}*$instance['default_value'])),2,'.','') ?>" /></span><br>
	<small><span id="cur_long_name"></span></small><br>
	<select name="currency" id="crsel"><?php
	foreach(array_keys($o) as $c){
		if(($c!='timestamp') && ($o[$c]->{'last'}>0)){
			?>
			<option data-symbol="<?= $c ?>" value="<?= number_format($o[$c]->{'last'},2,'.','') ?>" <?php if($c=="USD"){echo 'selected="selected"';} ?>><?= $c ?></option>
			<?php
		}
	}
	?>
	</select>
	<!--<div class="clear"></div>
	<span style="font-size:10px"><a href="https://BitcoinAverage.com" target="_blank">BitcoinAverage Price Index</a></span>-->
	</div><?php
}

add_shortcode( 'btc_widget', 'btc_widget_shortcode' );
?>