<?php
add_shortcode("main-jumbotron","main_jumbotron");

function main_jumbotron($atts,$content){
	extract(shortcode_atts(Array(
		"background"=>JAVO_IMG_DIR."/bg/family.jpg",
		"title"=>"",
		"content"=>""
	),$atts));

$sc_jum_bg = $background;
$sc_jum_title = $title;
$sc_jum_content = $content;

ob_start();
?>

<div class="row main-jum" style="background: url('<?php echo $sc_jum_bg ?>');background-position: -110px -20px;
	min-height:400px;">
	<div class="col-md-6">
	</div> <!-- col-md-6 -->
	<div class="col-md-6 text-area">
		<h2><?php echo $sc_jum_title; ?></h2>
		<h3><?php echo $sc_jum_content; ?></h3>
	</div><!-- text-area -->
</div> <!-- main-jum -->
<?php
	$return_value = ob_get_clean();

	return $return_value;
}
?>