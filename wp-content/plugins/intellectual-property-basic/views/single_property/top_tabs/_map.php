<div id="iproperty-single-map"></div>
<script type="text/javascript">
	iproperty.singlePropertyAttributes = {
		post_id: <?php echo esc_js( get_the_ID() ); ?>,
		latitude: <?php echo floatval( $property->latitude ); ?>,
		longitude: <?php echo floatval( $property->longitude ); ?>,
		title: <?php echo json_encode( get_the_title() ); ?>,
		content: <?php echo json_encode( iproperty_get_info_window_content() ); ?>
	};
</script>