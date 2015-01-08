<?php $currencies = iproperty_get_currencies(); ?>
<?php $default_currency = iproperty_option( 'default_currency' ); ?>
<select id="iproperty-currency-select">
	<option value="">&ndash; <?php _e( 'Select Currency', 'iproperty' ); ?> &ndash;</option>
	<?php foreach ( $currencies as $symbol => $name ) : ?>
		<option value="<?php echo esc_attr( $symbol ); ?>"><?php echo esc_html( $name ); ?></option>
	<?php endforeach; ?>
</select>
<table id="iproperty-currency-prices" class="iproperty-results-table">
	<tbody>
		<tr>
			<th><?php _e( 'Current Price:', 'iproperty' ); ?></th>
			<th><?php _e( 'New Price:', 'iproperty' ); ?></th>
		</tr>
		<tr>
			<td>
				<span id="iproperty-current-price">
					<?php echo iproperty_get_formatted_price( $property->price ); ?> <?php echo isset( $currencies[$default_currency] ) ? esc_html( $currencies[$default_currency] ) : ''; ?>
				</span>
			</td>
			<td><span id="iproperty-new-price"></span></td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	iproperty.originalPrice = <?php echo esc_js( $property->price ); ?>;
	iproperty.originalCurrency = '<?php echo esc_js( $default_currency ); ?>';
	iproperty.currencyConvertURL = '<?php echo esc_js( plugins_url( 'endpoints/currency_convert.php', IPROPERTY_ROOT_FILE ) ); ?>';
</script>