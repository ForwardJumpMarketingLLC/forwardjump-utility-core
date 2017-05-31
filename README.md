# README #

This plugin allows you to easily do the following:

1. Add settings pages.
2. Add CMB2 meta boxes to:
    - Post/CPT edit screen.
    - Term edit screen.
    - Genesis CPT Archive Settings.
    - Genesis Theme Settings.
3. Register custom post types.
4. Register custom taxonomies.
5. Add shortcodes.

## Requirements
PHP 5.4+

## Installation

Download the latest tagged release and install it using the WordPress plugin installer.

## Usage
The general concept of this plugin is to separate all of the project specific elements into configuration arrays.  This means that you will mostly be editing configuration arrays in order to fit the project's needs.  For example, in order to add a second (or more) settings page, you will simply add an additional array to the `$settings_config` array (see below for more information).

### Add Settings Pages
Add settings pages to the WordPress Admin menu.  Refer to the sample configuration file in `/src/post-metaboxes/config/` to see the required format of the array as well as the options for where the settings page appears (e.g., top-level menu or several submenu options, including Genesis).

```php
$settings_config = [
	[
		'capability'         => 'manage_options',
		'menu_page_type'     => 'submenu',
		'menu_page_parent'   => 'genesis',
		'menu_page_priority' => 10,
		'menu_page_icon'     => '',
		'menu_slug'          => 'fj-options',
		'menu_title'         => 'FJ Utility Settings',
		'page_title'         => 'ForwardJump Utility Settings',
		'option_name'        => 'fj_options',
		'option_group'       => 'fj_options_group',
		'metabox_id'         => 'fj_settings',
		'metabox_fields'     => [
			[
				'name'    => 'Gravity Forms honeypots',
				'desc'    => 'Force honeypots on all GF forms?',
				'id'      => 'gf_honeypot',
				'type'    => 'checkbox',
				'default' => false,
			],
			// Add additional meta box fields here.
		],
		'view'               => FJ_UTILITY_SETTINGS_DIR . '/views/admin-form.php',
	],
	// Add additional settings page arrays here.
];

foreach ( (array) $settings_config as $setting ) {
    ( new \ForwardJump\Utility\Settings\Settings_Page( $setting ) )->init();
}
```

### Add Custom Meta Boxes
Add custom meta boxes using [CMB2](https://github.com/CMB2/CMB2) to a variety of screens within the WordPress Admin.

**Limitations**: Group (i.e., repeater) fields are not currently supported.

#### Post Edit Screen
Custom meta boxes can be added to any post edit screen (including CPTs) by passing an array to `ForwardJump\Utility\PostMetaboxes\Post_Metabox()`. Refer to the sample configuration file in `/src/post-metaboxes/config/` to see the required format of the array.

```php
$metabox_config = [
    [
        'metabox' => [
            'object_types' => [ 'post', 'custom-post-type' ],
            'title'        => 'Example Metabox',
        ],
        'fields'  => [
            [
                'name'    => 'Example Custom Field',
                'id'      => 'example_field',
                'type'    => 'text',
                'default' => false,
            ],
        ],
	],
	// Add additional custom meta box arrays here.
];

foreach ( (array) $metabox_config as $metabox ) {
    ( new \ForwardJump\Utility\PostMetaboxes\Post_Metabox( $metabox ) )->init();
}
```

#### Term Edit Screen
Custom meta boxes can be added to any taxonomy term edit screen by passing an array to `ForwardJump\Utility\TermMetaboxes\Term_Metabox()`. Refer to the sample configuration file in `/src/term-metaboxes/config/` to see the required format of the array.

```php
$metabox_config = [
	[
		'metabox' => [
			'taxonomies' => [ 'category' ],
			'title'      => 'Featured Image',
			'show_names' => false,
		],
		'fields'  => [
			[
				'name'  => 'Featured Image',
				'id'    => 'featured_image',
				'type'  => 'file',
				'allow' => [ 'attachment' ],
			],
		],
	],
	// Add additional custom meta box arrays here.
];

foreach ( (array) $metabox_config as $metabox ) {
    ( new \ForwardJump\Utility\TermMetaboxes\Term_Metabox( $metabox ) )->init();
}
```

#### Genesis
Meta boxes can be added to the Genesis Theme Settings page or to Genesis CPT Archive Settings pages.  This functionality is also available in the standalone plugin [Genesis CMB2 Meta Boxes](https://github.com/ForwardJumpMarketingLLC/genesis-cmb2-meta-boxes).

- See example configuration arrays in the `/src/genesis-admin-metaboxes/config/` directory. In general, use the same arguments for creating meta boxes and fields as you [normally would with CMB2](https://github.com/CMB2/CMB2/wiki/Basic-Usage#create-a-metabox). It is not necessary to include `'id'` or `'context'` in the `'metabox'` array.
- Retrieve the custom field values using `genesis_get_option( $field_id )` and `genesis_get_cpt_option( $field_id )`.

##### Genesis Theme Settings

```php
$genesis_theme_settings_config = [
	[
		'metabox' => [
			'title'        => 'Example Genesis Theme Settings CMB2 meta box',
		],
		'fields'  => [
			[
				'name'    => 'Example field',
				'id'      => 'example_genesis_theme_settings_field',
				'type'    => 'text',
			],
			// Add additional field arrays here.
		],
	],
	// Add additional custom meta box arrays here.
];

foreach ( (array) $genesis_theme_settings_config as $metabox ) {
    ( new \ForwardJump\Utility\GenesisAdminMetaboxes\Genesis_Theme_Settings_Meta_Box( $metabox ) )->init();
}
```

##### Genesis CPT Archive Settings
Make sure your custom post types have support for `'genesis-cpt-archives-settings'`.

```php
$genesis_cpt_archive_settings_config = [
	[
		'metabox' => [
			'title'        => 'Example Genesis CPT Settings CMB2 meta box',
			'object_types' => [ 'custom-post-type' ],
		],
		'fields'  => [
			[
				'name'    => 'Example field',
				'id'      => 'example_genesis_cpt_archive_settings_field',
				'type'    => 'text',
			],
			// Add additional field arrays here.
		],
	],
	// Add additional custom meta box arrays here.
];

foreach ( (array) $genesis_cpt_archive_settings_config as $metabox ) {
    ( new \ForwardJump\Utility\GenesisAdminMetaboxes\Genesis_CPT_Archives_Meta_Box( $metabox ) )->init();
}
```

### Register Custom Post Types
Register your post types by passing an array to the class `ForwardJump\Utility\CustomPostTypes\Custom_Post_Type()`. Refer to the sample configuration file in `/src/custom-post-types/config/` to see the required format of the array.

```php
$cpts_config = [
	[
		'post_type' => 'custom-post-type',
		'args'      => [
			'label'       => 'Custom Post Type',
			'labels'      => [
				'singular' => 'Custom Post Type',
				'plural'   => 'Custom Post Types',
			],
			'public'      => true,
			'supports'    => [
				'title',
				'editor',
				'genesis-cpt-archives-settings',
			],
			'has_archive' => true,
		],
	],
	// Add additional custom post type arrays here.
];

foreach ( (array) $cpts_config as $cpt ) {
    ( new \ForwardJump\Utility\CustomPostTypes\Custom_Post_Type( $cpt ) )->init();
}
```

### Register Custom Taxonomies
Register your custom taxonomies by passing an array to the class `ForwardJump\Utility\CustomTaxonomies\Custom_Taxonomy()`. Refer to the sample configuration file in `/src/custom-taxonomies/config/` to see the required format of the array.

```php
$tax_config = [
    [
        'taxonomy'    => 'custom-tax',
        'object_type' => [
            'new-post-type',
        ],
        'args'        => [
            'label'  => 'Custom Taxonomy',
            'labels' => [
                'singular' => 'Custom Taxonomy',
                'plural'   => 'Custom Taxonomies',
            ],
            'public' => true,
        ],
    ],
    // Add additional taxonomy arrays here.
];

foreach ( (array) $tax_config as $tax ) {
    ( new \ForwardJump\Utility\CustomTaxonomies\Custom_Taxonomy( $tax ) )->init();
}
```

### Add Shortcodes
Add shortcodes by passing an array to the class `ForwardJump\Utility\Shortcodes\Add_Shortcode()`. Refer to the sample configuration file in `/src/shortcodes/config/` to see the required format of the array.

```php
$shortcodes_config = [
	[
		'tag' => 'recent-posts',
		'args' => [
			'count'     => 1,
			'post_type' => 'post',
		],
		'view' => FJ_UTILITY_SHORTCODES_DIR . 'views/recent-posts.php',
		'scripts' => [
			[
				'handle' => 'fj-scripts',
				'src'    => 'https://code.jquery.com/jquery-3.2.1.min.js',
				'ver'    => '0.1.0',
			],
		],
	],
	// Add additional shortcodes arrays here.
];

foreach ( (array) $shortcodes_config as $shortcode ) {
    ( new \ForwardJump\Utility\Shortcodes\Add_Shortcode( $shortcode ) )->init();
}
```

## Credits
Built by [Tim Jensen](https://github.com/timothyjensen).
