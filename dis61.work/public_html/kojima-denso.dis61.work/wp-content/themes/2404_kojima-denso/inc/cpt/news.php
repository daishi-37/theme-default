<?php
add_action('init', function(){
	/*-----------------------------------------------------------------------------------*/
	/* カスタム投稿 設定
	/*-----------------------------------------------------------------------------------*/
	$cpt_slug       = "news";
	$cpt_code       = "news";
	$cpt_name       = "お知らせ";

	$cpt_category_enable = true;
	$cpt_category_slug   = $cpt_slug."_category";
	$cpt_category_code   = $cpt_code."_category";
	$cpt_category_name   = $cpt_name."カテゴリー";

	$cpt_tag_enable = false;
	$cpt_tag_slug   = $cpt_slug."_tag";
	$cpt_tag_code   = $cpt_code."_tag";
	$cpt_tag_name   = $cpt_name."タグ";

	/*-----------------------------------------------------------------------------------*/
	/* カスタム投稿
	/*-----------------------------------------------------------------------------------*/
	register_post_type($cpt_code,
		array(
			'label'                => $cpt_name, // Default: Value of $labels['name']
			'labels' => array(
				'name'               => $cpt_name,
				'singular_name'      => $cpt_name,
				'menu_name'          => $cpt_name,
				'add_new'            => '新規追加',
				'add_new_item'       => $cpt_name.'を追加',
				'edit'               => '編集',
				'edit_item'          => $cpt_name.'を編集',
				'new_item'           => '新規'.$cpt_name.'をご紹介',
				'view'               => '表示',
				'view_item'          => $cpt_name.'を表示',
				'search_items'       => $cpt_name.'を検索',
				'not_found'          => $cpt_name.'が見つかりませんでした。',
				'not_found_in_trash' => 'ゴミ箱内に'.$cpt_name.'が見つかりませんでした。',
				'parent_item_colon'  => '親'.$cpt_name.'：',
				'all_items'          => '全ての'.$cpt_name,
			),
			'description'          => '',
			'public'               => true,                                              // Default: false
			'exclude_from_search'  => false,                                             // Default: value of public argument
			'show_in_nav_menus'    => false,                                             // Default: value of public argument,
			'menu_position'        => '1',                                               // 5,10,15,20,25,60,65,70,75,80,100
			'menu_icon'            => 'dashicons-edit',                                  // Default: null - defaults to the posts icon
			'map_meta_cap'         => true,                                              // Default: null
			'has_archive'          => true,                                              // 
			'show_in_rest'         => true,                                              // 
			'supports'             => array('title','editor','thumbnail','excerpt','comments','author'),                // Default: title and editor
			'rewrite'              => array('with_front' => false), // Default: true and use $post_type as slug
			'yarpp_support'        => true,
		)
	);

	/*-----------------------------------------------------------------------------------*/
	/* カテゴリ
	/*-----------------------------------------------------------------------------------*/
	if($cpt_category_enable){
		register_taxonomy($cpt_category_code, $cpt_code,
			array(
				'label'                        => $cpt_category_name,
				'labels' => array(
					'name'                       => $cpt_category_name,
					'singular_name'              => $cpt_category_name,
					'menu_name'                  => $cpt_category_name,
					'all_items'                  => '全ての'.$cpt_category_name,
					'edit_item'                  => $cpt_category_name.'を編集',
					'view_item'                  => $cpt_category_name.'を表示',
					'update_item'                => $cpt_category_name.'を更新',
					'add_new_item'               => '新規'.$cpt_category_name.'を追加',
					'new_item_name'              => '新規'.$cpt_category_name.'の名前',
					'parent_item'                => '親'.$cpt_category_name,
					'parent_item_colon'          => '親'.$cpt_category_name.'：',
					'search_items'               => $cpt_category_name.'を検索',
					'popular_items'              => '人気の'.$cpt_category_name,
					'separate_items_with_commas' => $cpt_category_name.'をコンマで区切ってください',
					'add_or_remove_items'        => $cpt_category_name.'の追加または削除',
					'choose_from_most_used'      => 'よく使われている'.$cpt_category_name.'から選択',
					'not_found'                  => $cpt_category_name.'が見つかりませんでした。',
				),
				'public'                       => true,                                      // Default: true
				'hierarchical'                 => true,                                      // Default: false
				'update_count_callback'        => '_update_post_term_count',                 // Default: None
				'rewrite'                      => array('slug' => $cpt_category_slug, 'with_front' => false),
				'has_archive'                  => true,
				'show_in_rest'                 => true,
			)
		);
	}
	/*-----------------------------------------------------------------------------------*/
	/* タグ
	/*-----------------------------------------------------------------------------------*/
	if($cpt_tag_enable){
		register_taxonomy($cpt_tag_code, $cpt_code,
			array(
				'label'                        => $cpt_tag_name,
				'labels' => array(
					'name'                       => $cpt_tag_name,
					'singular_name'              => $cpt_tag_name,
					'menu_name'                  => $cpt_tag_name,
					'all_items'                  => '全ての'.$cpt_tag_name,
					'edit_item'                  => $cpt_tag_name.'を編集',
					'view_item'                  => $cpt_tag_name.'を表示',
					'update_item'                => $cpt_tag_name.'を更新',
					'add_new_item'               => '新規'.$cpt_tag_name.'を追加',
					'new_item_name'              => '新規'.$cpt_tag_name.'の名前',
					'parent_item'                => '親'.$cpt_tag_name,
					'parent_item_colon'          => '親'.$cpt_tag_name.'：',
					'search_items'               => $cpt_tag_name.'を検索',
					'popular_items'              => '人気の'.$cpt_tag_name,
					'separate_items_with_commas' => $cpt_tag_name.'をコンマで区切ってください',
					'add_or_remove_items'        => $cpt_tag_name.'の追加または削除',
					'choose_from_most_used'      => 'よく使われている'.$cpt_tag_name.'から選択',
					'not_found'                  => $cpt_tag_name.'が見つかりませんでした。',
				),
				'public'                       => true,                                      // Default: true
				'hierarchical'                 => true,                                     // Default: false
				'update_count_callback'        => '_update_post_term_count',                 // Default: None
				'rewrite'                      => array('slug' => $cpt_tag_slug, 'with_front' => false),
				'has_archive'                  => true,
				'show_in_rest'                 => true,
			)
		);
	}
});

?>