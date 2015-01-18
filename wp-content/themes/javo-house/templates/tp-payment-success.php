<?php
/*Template name: Payment Success Page*/
get_header();
global $javo_tso;
$javo_query = new javo_array($_POST);
$javo_pay_status = strtolower($javo_query->get('payment_status'));
$javo_pay_params = $javo_query->get('custom', null);
$javo_pay_meta = Array();
if(!empty($javo_pay_params)){
	$javo_pay_params = explode('&', $javo_pay_params);
	foreach($javo_pay_params as $params){
		$param = explode('=', $params);
		$javo_pay_meta[$param[0]] = $param[1];
	};
};
$javo_pm = new javo_array($javo_pay_meta);
$javo_payer = (int)$javo_pm->get('user', 0) > 0? get_userdata($javo_pm->get('user')) : get_userdata(1);

$javo_payment_args = Array(
	'post_type'=> 'payment'
	, 'post_author'=> $javo_payer->ID
	, 'post_status'=> 'publish'
);

$javo_pay_output = Array( 'title'=> __('Untitle', 'javo_fr'));


switch($javo_pay_status){
	case 'pending':
		if( isset( $_GET['notify'] )){
			$javo_payment_args['post_title'] = sprintf('[%s] %s %s'
				, __('Paypal', 'javo_fr')
				, $javo_payer->first_name
				, $javo_payer->last_name
			);
			$post_id = wp_insert_post($javo_payment_args);
			$javo_paypal_term = get_term_by('slug', 'paypal', 'payment_type');
			if(!empty($javo_paypal_term)){
				$javo_paypal_term_id = $javo_paypal_term->term_id;
			}else{
				$javo_paypal_term_id = wp_insert_term('paypal', 'payment_type');
				$javo_paypal_term_id = $javo_paypal_term_id['term_id'];
			};
			wp_set_post_terms($post_id, $javo_paypal_term_id, 'payment_type');
			if($post_id){
				update_post_meta($post_id, 'pay_item_id', $javo_pm->get('item_id'));
				update_post_meta($post_id, 'pay_cnt_post', $javo_pm->get('post'));
				update_post_meta($post_id, 'pay_expire_day', $javo_pm->get('days'));
				update_post_meta($post_id, 'pay_price', $javo_query->get('payment_gross'));
				update_post_meta($post_id, 'pay_currency', $javo_query->get('mc_currency'));
				update_post_meta($post_id, 'pay_day', date('Y-m-d h:i:s', strtotime( $javo_query->get('payment_date'))));
				update_post_meta($post_id, 'pay_type', 'paypal');

				$javo_user_pay_history = @unserialize(get_user_meta($javo_payer->ID, 'pay_items_ids', true));
				if(!in_array($post_id, $javo_user_pay_history) ){
					$javo_user_pay_history[] = $post_id;
				};
				update_user_meta($javo_payer->ID, 'pay_items_ids', @serialize($javo_user_pay_history));
			};
			exit(0);

		}
		$javo_pay_output['title'] = __('Test Mode', 'javo_fr');
		$javo_pay_output['content'] = Array(
			Array(
				'item'=> __('Payer', 'javo_fr')
				, 'value'=> sprintf('%s %s', $javo_payer->first_name, $javo_payer->last_name)
			), Array(
				'item'=> __('Produce Name', 'javo_fr')
				, 'value'=> $javo_query->get('item_name')
			), Array(
				'item'=> __('Posts', 'javo_fr')
				, 'value'=> $javo_pm->get('post').' posts'
			), Array(
				'item'=> __('Post Expired Days', 'javo_fr')
				, 'value'=> $javo_pm->get('days').' days'
			), Array(
				'item'=> __('Produce Price', 'javo_fr')
				, 'value'=> $javo_query->get('payment_gross')
			), Array(
				'item'=> __('Produce Payment Date', 'javo_fr')
				, 'value'=> date('Y-m-d h:i:s', strtotime( $javo_query->get('payment_date') ) )
			), Array(
				'item'=> __('Payment ID', 'javo_fr')
				, 'value'=>  $javo_query->get('txn_id')

			)
		);
	break;
	case 'completed':
		$javo_pay_output['title'] = __('Test Mode', 'javo_fr');
		$javo_pay_output['content'] = Array(
			Array(
				'item'=>__('Payer', 'javo_fr')
				, 'value'=> sprintf('%s %s', $javo_payer->first_name, $javo_payer->last_name)
			), Array(
				'item'=>__('Produce Name', 'javo_fr')
				, 'value'=> $javo_query->get('item_name')
			), Array(
				'item'=>__('Jobs', 'javo_fr')
				, 'value'=> $javo_pay_meta['jobs'].' jobs'
			), Array(
				'item'=>__('Jobs expired', 'javo_fr')
				, 'value'=> $javo_pay_meta['expired'].' days'
			), Array(
				'item'=>__('Produce Price', 'javo_fr')
				, 'value'=> $javo_query->get('payment_gross')
			), Array(
				'item'=>__('Produce Payment Date', 'javo_fr')
				, 'value'=> date('Y-m-d h:i:s', strtotime($javo_query->get('payment_date')))
			)
		);
	break;
	case 'bank':
		$javo_payment_args['post_title'] = sprintf('[%s] %s %s'
			, __('Direct bank', 'javo_fr')
			, $javo_payer->first_name
			, $javo_payer->last_name
		);
		$javo_payment_args['post_status'] = 'pending';
		$post_id = wp_insert_post($javo_payment_args);
		$javo_bank_term = get_term_by('slug', 'bank', 'payment_type');
		if(!empty($javo_bank_term)){
			$javo_bank_term_id = $javo_bank_term->term_id;
		}else{
			$javo_bank_term_id = wp_insert_term('bank', 'payment_type');
			$javo_bank_term_id = $javo_bank_term_id['term_id'];
		};
		wp_set_post_terms($post_id, $javo_bank_term_id, 'payment_type');

		if($post_id){
			update_post_meta($post_id, 'pay_item_id', $javo_pm->get('item_id'));
			update_post_meta($post_id, 'pay_cnt_post', $javo_pm->get('post'));
			update_post_meta($post_id, 'pay_expire_day', $javo_pm->get('days'));
			update_post_meta($post_id, 'pay_price', $javo_query->get('amount'));
			update_post_meta($post_id, 'pay_currency', $javo_query->get('currency'));
			update_post_meta($post_id, 'pay_day', date('Y-m-d h:i:s'));
			update_post_meta($post_id, 'pay_type', 'bank');

			$javo_user_pay_history = @unserialize(get_user_meta($javo_payer->ID, 'pay_items_ids', true));
			if(!in_array($post_id, $javo_user_pay_history) ){
				$javo_user_pay_history[] = $post_id;
			};
			update_user_meta($javo_payer->ID, 'pay_items_ids', @serialize($javo_user_pay_history));
		};
		$javo_pay_output['title'] = __('Direct bank Pending', 'javo_fr');
		$javo_pay_output['content'] = Array(
			Array(
				'item'=>__('Account Name', 'javo_fr')
				, 'value'=> $javo_tso->get('account_name')
			), Array(
				'item'=>__('Account Number', 'javo_fr')
				, 'value'=> $javo_tso->get('account_number')
			), Array(
				'item'=>__('Bank Name', 'javo_fr')
				, 'value'=> $javo_tso->get('bank_name')
			), Array(
				'item'=> __('Payer', 'javo_fr')
				, 'value'=> sprintf('%s %s', $javo_payer->first_name, $javo_payer->last_name)
			), Array(
				'item'=> __('Produce Name', 'javo_fr')
				, 'value'=> $javo_query->get('item_name')
			), Array(
				'item'=> __('Posts', 'javo_fr')
				, 'value'=> $javo_pm->get('post').' posts'
			), Array(
				'item'=> __('Post Expired Days', 'javo_fr')
				, 'value'=> $javo_pm->get('days').' days'
			), Array(
				'item'=> __('Produce Price', 'javo_fr')
				, 'value'=> $javo_query->get('amount')
			), Array(
				'item'=> __('Produce Price Currency', 'javo_fr')
				, 'value'=> $javo_query->get('currency')
			), Array(
				'item'=> __('Produce Payment Date', 'javo_fr')
				, 'value'=> date('Y-m-d h:i:s', strtotime( get_the_date($post_id) ) )
			), Array(
				'item'=> __('Message', 'javo_fr')
				, 'value'=> __('Your payment has been successfully made! Admin will review your payment shortly and approve your post.', 'javo_fr')
			)
		);

	break;
	default:
		$javo_pay_output['title'] = __('Access Error', 'javo_fr');
		$javo_pay_output['content'] = Array(
			Array(
				'item'=>__('Sorry', 'javo_fr')
				, 'value'=> __('Error', 'javo_fr')
			)
		);
}
?>

<div class="container">
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo $javo_pay_output['title'] ?></h1>
			</div><!-- Close 12 -->
		</div><!-- Close Row -->
		<h1>&nbsp;</h1>
		<?php
		if(!empty($javo_pay_output['content'])){
			foreach($javo_pay_output['content'] as $items){
		?>
			<div class="row">
				<div class="col-md-2">
					<?php echo $items['item'];?>
				</div>
				<div class="col-md-10">
					<?php echo $items['value'];?>
				</div>
			</div>
		<?php
			};
		};?>
		<h1>&nbsp;</h1>
		<div class="row">
			<div class="col-md-12">
				<a href="<?php echo get_site_url();?>" class="btn btn-primary"><?php _e('Done', 'javo_fr');?></a>
			</div><!-- Close 12 -->
		</div><!-- Close Row -->
	</div><!-- Jombotron -->
</div><!-- Container-->


<?php get_footer();