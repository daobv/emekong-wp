<?php
global $javo_tso, $edit;
if(empty($edit) && $javo_tso->get('property_publish', '') != ''){
	$javo_add_property_step = Array("btn-default", "btn-default", "btn-default");
	if(isset($_POST['act2'])){
		$javo_add_property_step[1] = "btn-primary";
	}elseif(isset($_POST['act3'])){
		$javo_add_property_step[2] = "btn-primary";
	}else{
		$javo_add_property_step[0] = "btn-primary";
	}
	?>
	<div class="javo-add-property-step-number">
		<div class="col-md-6 btn-group">
			<a class="btn <?php echo $javo_add_property_step[0] ;?> btn-lg"><?php _e('Step 1', 'javo_fr');?></a>
			<a class="btn <?php echo $javo_add_property_step[1] ;?> btn-lg"><?php _e('Step 2', 'javo_fr');?></a>
			<a class="btn <?php echo $javo_add_property_step[2] ;?> btn-lg"><?php _e('Step 3', 'javo_fr');?></a>
		</div>
	</div>
<?php }; ?>