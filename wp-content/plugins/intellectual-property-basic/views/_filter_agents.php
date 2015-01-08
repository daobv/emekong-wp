<div id="iproperty-agent-filter" class="iproperty-filter-form">
	<form id="iproperty-agent-filter-form" method="get" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ); ?>">
		<?php
			// Because this form submits via GET, we need to add any GET parameters that are not part
			// of this form as hidden inputs. This is a list of all attributes in this form.
			$form_attributes = array( 'agent_name', 'company' );
		?>
		<?php foreach ( $_GET as $name => $value ) : ?>
			<?php if ( ! in_array( $name, $form_attributes ) ) : ?>
				<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
			<?php endif; ?>
		<?php endforeach; ?>

		<?php $existing_agent_name = isset( $_REQUEST['agent_name'] ) ? stripslashes( $_REQUEST['agent_name'] ) : ''; ?>
		<label for="iproperty_agent_name"><?php _e( 'Name:', 'iproperty' ); ?></label>
		<input id="iproperty_agent_name" name="agent_name" type="text" value="<?php echo esc_attr( $existing_agent_name ); ?>">

		<?php
			if ( ! iproperty_is_single_company() ) {
				iproperty_select_html(
					'filter_company',
					'filter_company',
					__( 'Company', 'iproperty' ),
					iproperty_get_company_options( 'slug' ),
					iproperty_get_value_from_request( 'filter_company' )
				);
			}
		?>

		<input type="submit" value="<?php esc_attr_e( 'Go', 'iproperty' ); ?>">
	</form>
</div>