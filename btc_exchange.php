<?php
/**
 * @package BTC_Exchange
 */
/*
Plugin Name: BTC Exchange Widget
Plugin URI: http://jacobbaron.net
Description: Bitcoin exchange rates and conversion tools.
Author: csmicfool
Version: 1.0.8
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
		$title = apply_filters( 'widget_title', $instance['title'] );
		
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
			$d = '{  "USD" : {"15m" : 503.79, "last" : 503.79, "buy" : 503.69, "sell" : 503.79,  "symbol" : "$"},  "CNY" : {"15m" : 3132.90627825, "last" : 3132.90627825, "buy" : 3132.28441075, "sell" : 3132.90627825,  "symbol" : "¥"},  "JPY" : {"15m" : 51603.96588879, "last" : 51603.96588879, "buy" : 51593.72273869, "sell" : 51603.96588879,  "symbol" : "¥"},  "SGD" : {"15m" : 631.0564222200001, "last" : 631.0564222200001, "buy" : 630.93116042, "sell" : 631.0564222200001,  "symbol" : "$"},  "HKD" : {"15m" : 3906.56499408, "last" : 3906.56499408, "buy" : 3905.7895588799997, "sell" : 3906.56499408,  "symbol" : "$"},  "CAD" : {"15m" : 555.22897416, "last" : 555.22897416, "buy" : 555.11876376, "sell" : 555.22897416,  "symbol" : "$"},  "NZD" : {"15m" : 587.18387007, "last" : 587.18387007, "buy" : 587.0673167699999, "sell" : 587.18387007,  "symbol" : "$"},  "AUD" : {"15m" : 540.03315639, "last" : 540.03315639, "buy" : 539.92596229, "sell" : 540.03315639,  "symbol" : "$"},  "CLP" : {"15m" : 280829.67485999997, "last" : 280829.67485999997, "buy" : 280773.93146, "sell" : 280829.67485999997,  "symbol" : "$"},  "GBP" : {"15m" : 300.02457765, "last" : 300.02457765, "buy" : 299.96502415000003, "sell" : 300.02457765,  "symbol" : "£"},  "DKK" : {"15m" : 2722.92902931, "last" : 2722.92902931, "buy" : 2722.3885404099997, "sell" : 2722.92902931,  "symbol" : "kr"},  "SEK" : {"15m" : 3325.6588512000003, "last" : 3325.6588512000003, "buy" : 3324.9987232, "sell" : 3325.6588512000003,  "symbol" : "kr"},  "ISK" : {"15m" : 56367.04794, "last" : 56367.04794, "buy" : 56355.859339999995, "sell" : 56367.04794,  "symbol" : "kr"},  "CHF" : {"15m" : 445.048086, "last" : 445.048086, "buy" : 444.959746, "sell" : 445.048086,  "symbol" : "CHF"},  "BRL" : {"15m" : 1126.88553264, "last" : 1126.88553264, "buy" : 1126.66185104, "sell" : 1126.88553264,  "symbol" : "R$"},  "EUR" : {"15m" : 364.69761132, "last" : 364.69761132, "buy" : 364.62522051999997, "sell" : 364.69761132,  "symbol" : "€"},  "RUB" : {"15m" : 17931.3571668, "last" : 17931.3571668, "buy" : 17927.7978748, "sell" : 17931.3571668,  "symbol" : "RUB"},  "PLN" : {"15m" : 1525.33556259, "last" : 1525.33556259, "buy" : 1525.03279049, "sell" : 1525.33556259,  "symbol" : "zl"},  "THB" : {"15m" : 16216.103353800001, "last" : 16216.103353800001, "buy" : 16212.8845318, "sell" : 16216.103353800001,  "symbol" : "?"},  "KRW" : {"15m" : 522957.53490204, "last" : 522957.53490204, "buy" : 522853.73023443995, "sell" : 522957.53490204,  "symbol" : "?"},  "TWD" : {"15m" : 15219.495900000002, "last" : 15219.495900000002, "buy" : 15216.474900000001, "sell" : 15219.495900000002,  "symbol" : "NT$"}  }';
		}
		
		if(get_transient('btc_data')===false && !WP_Widget::is_preview()){
			
			$response = wp_remote_get( 'https://blockchain.info/ticker?api_code=4b6e5da2-8817-4934-8397-a7068cd18bcf' ); 
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
			jQuery(document).ready(function () {
				jQuery('#crsel').change(function(){
					update_exc();
				});
				jQuery('#btc_amt').keyup(function(){
					update_exc();
				});
				jQuery('#cur_amt').keyup(function(){
					update_exc_rev();
				});
			});
			function update_exc(){
				var t = jQuery('#crsel').find('option:selected');
				console.log(t);
				var s = t.data('symbol');	
				var v = jQuery('#crsel').val();
				var b = jQuery('#btc_amt').val();
				v = v*b;
				jQuery('#cur_symbol').html('<strong style="font-size:1.2em;position:relative;margin-right:.1em">'+s+'</strong>');
				jQuery('#cur_amt').val(v.toFixed(2).toString());
			}
			function update_exc_rev(){
				var t = jQuery('#crsel').find('option:selected');
				console.log(t);
				var s = t.data('symbol');	
				var v = jQuery('#crsel').val();
				var b = jQuery('#cur_amt').val();
				v = (b/v);
				jQuery('#btc_amt').val(v.toFixed(2).toString());
			}
		</script>
        <div style="text-align:center;">
		<input type="text" name="btc_amt" id="btc_amt" value="<?= $instance['default_value'] ?>" size="4" style="width:auto;min-width:68px;max-width:100px;"/> BTC = 
        <span id="up"><span id="cur_symbol"><?php echo '<strong style="font-size:1.2em;position:relative;margin-right:.1em">'.$j->USD->symbol.'</strong>'; ?></span> <input type="text" name="cur_amt" id="cur_amt" value="<?= number_format((($j->USD->{'15m'}*$instance['default_value'])),2,'.','') ?>" size="8" style="width:auto;min-width:68px;max-width:100px;"/></span> <br><br>
        <select name="currency" id="crsel"><?php
		foreach(array_keys($o) as $c){
			?>
			<option data-symbol="<?= $o[$c]->{'symbol'} ?>" value="<?= number_format($o[$c]->{'15m'},2,'.','') ?>"><?= "(".$o[$c]->{'symbol'}.") ".$c ?></option>
			<?php
		}
		?>
		</select>
		</div><?php
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
		else {
			$title = __( 'Bitcoin Exchange Rate', 'text_domain' );
			$default_value = 1;
		}
		?>
		<p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"><br/>
            <label for="<?php echo $this->get_field_id( 'default_value' ); ?>"><?php _e( 'Default Value:' ); ?></label> <input class="" id="<?php echo $this->get_field_id( 'default_value' ); ?>" name="<?php echo $this->get_field_name( 'default_value' ); ?>" type="number" value="<?php echo esc_attr( $default_value ); ?>" style="width:50px;"> BTC
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

		return $instance;
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'btc_widget' );
});
?>