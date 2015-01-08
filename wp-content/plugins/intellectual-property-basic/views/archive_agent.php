<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<?php do_action( 'iproperty_agent_archive_before_loop' ); ?>
	<section class="iproperty-agent-archive iproperty-agent-list-container">
		<?php $agent_query = iproperty_get_agents_query(); ?>
		<?php if ( ! empty( $agent_query->results ) ) : ?>
			<?php iproperty_pagination_links( $agent_query ); ?>
			<?php foreach ( $agent_query->results as $agent ) : ?>
				<?php $agent_meta = get_user_meta( $agent->ID ); ?>
				<?php iproperty_load_template( '_agent_details.php', array( 'agent' => $agent, 'agent_meta' => $agent_meta ) ); ?>
			<?php endforeach; ?>
			<?php iproperty_pagination_links( $agent_query ); ?>
		<?php else : ?>
			<p class="iproperty-no-records-found"><?php _e( 'Sorry, no records were found. Please try again.', 'iproperty' ); ?></p>
		<?php endif; ?>
	</section>
	<?php do_action( 'iproperty_agent_archive_after_loop' ); ?>
	<?php do_action( 'iproperty_footer' ); ?>
</div>