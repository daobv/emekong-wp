<?php if ( ! empty( $links ) ) : ?>
	<div id="iproperty-header-links" class="primary-background-color">
		<?php foreach ( $links as $id => $attributes ) : ?>
			<?php
				if ( isset( $attributes['class'] ) ) {
					$class = $attributes['class'];
				} else {
					$class = '';
				}

				if ( isset( $attributes['url'] ) ) {
					$url = $attributes['url'];
				} else {
					$url = '#';
				}
			?>
			<a id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>">
				<?php echo esc_html( $attributes['text'] ); ?>
			</a>
			<?php end( $links ); ?>
			<?php if ( $id !== key( $links ) ) : ?>
				<?php echo '<span class="iproperty-links-separator">|</span>'; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>