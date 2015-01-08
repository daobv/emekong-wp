<div id="iproperty-company-filter" class="iproperty-filter-form">
	<form id="iproperty-company-filter-form" method="get" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ); ?>">
		<?php
			// Because this form submits via GET, we need to add any GET parameters that are not part
			// of this form as hidden inputs. This is a list of all attributes in this form.
			$form_attributes = array( 'company_name' );
		?>
		<?php foreach ( $_GET as $name => $value ) : ?>
			<?php if ( ! in_array( $name, $form_attributes ) ) : ?>
				<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
			<?php endif; ?>
		<?php endforeach; ?>

		<?php $existing_company_name = isset( $_REQUEST['company_name'] ) ? stripslashes( $_REQUEST['company_name'] ) : ''; ?>
		<label for="iproperty_company_name"><?php _e( 'Name:', 'iproperty' ); ?></label>
		<input id="iproperty_company_name" name="company_name" type="text" value="<?php echo esc_attr( $existing_company_name ); ?>">

		<input type="submit" value="<?php esc_attr_e( 'Go', 'iproperty' ); ?>">
	</form>
</div>