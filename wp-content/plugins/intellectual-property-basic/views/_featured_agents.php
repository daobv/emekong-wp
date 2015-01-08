<?php if ( ! empty( $featured_agent_query->results ) ) : ?>
	<div class="iproperty-featured-agents-container iproperty-agent-list-container">
		<h2 class="iproperty-featured-agents-header"><?php _e( 'Featured Agents', 'iproperty' ); ?></h2>
		<?php foreach ( $featured_agent_query->results as $agent ) : ?>
			<?php iproperty_load_template( '_agent_details.php', array( 'agent' => $agent, 'is_featured_query' => true ) ); ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>