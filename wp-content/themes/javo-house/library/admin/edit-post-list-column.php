<?php
class javo_manage_column
{
	public function __construct()
	{
		add_filter('manage_edit-agent_columns', Array($this, "agent_columns_initialize"));
		add_filter('manage_edit-property_columns', Array($this, "property_columns_initialize"));
		add_action('manage_agent_posts_custom_column', Array($this, "agent_columns_function"), 10, 2);
		add_action('manage_property_posts_custom_column', Array($this, "property_columns_function"), 10, 2);	
	}
	public function agent_columns_initialize($columns)
	{
		$columns = Array();
		$columns['cb'] = "<input type='checkbox'>";
		$columns['avatar'] = __("Avatar", "javo_fr");
		$columns['title'] = __("Agent Subject", "javo_fr");
		$columns['author'] = __("Author", "javo_fr");
		$columns['comments'] = __("Reply", "javo_fr");
		$columns['tag'] = "tag";
		$columns['categories'] = "categories";
		$columns['date'] = __("Date", "javo_fr");
		return $columns;
	}
	public function agent_columns_function($columns_name, $post_id)
	{
		$author = get_userdata(get_post($post_id)->post_author);
		switch($columns_name)
		{
			case "avatar":
				$avatar = get_user_meta($author->ID, "avatar", true);
				$avatar = wp_get_attachment_image_src($avatar, "thumbnail");
				printf("<img src='%s' width='80' height='80'>", $avatar[0]);
			break;		
		};
	}
	public function property_columns_initialize($columns)
	{
		$columns = Array();
		$columns['cb'] = "<input type='checkbox'>";
		$columns['featured'] = __("Featured", "javo_fr");
		$columns['title'] = __("Agent Subject", "javo_fr");
		$columns['author'] = __("Author", "javo_fr");
		$columns['comments'] = __("Reply", "javo_fr");
		$columns['tag'] = "tag";
		$columns['categories'] = "categories";
		$columns['date'] = __("Date", "javo_fr");
		return $columns;
	}
	public function property_columns_function($columns_name, $post_id)
	{
		$src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id));
		switch($columns_name)
		{
			case "featured":
				printf("<img src='%s' width='80' height='80'>", $src[0]);
			break;	
		};
	}
};
new javo_manage_column();