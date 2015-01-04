<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
?>

<?php get_header(); ?>
		<h1 class="page-title">	<?php _e('Error 404 - Not Found', 'startis') ?> </h1>
        <div class="content-wrapper">
            <div class="wrapper">         
			<div id="main">

				<div id="post-0">
				
					<div class="content">
                    
						<p><?php _e("Apologies, but the page you requested could not be found. Perhaps searching will help.", "startis") ?></p>
                        <?php get_search_form(); ?>
					</div>
				
				</div>

			</div>

<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>