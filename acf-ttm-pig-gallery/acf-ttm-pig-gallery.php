<?php 
	/*
	Plugin Name: Acf Post Independent Gallery 
	Plugin URI: None :)
	Description: Add a new menu item allowing you to create acf galleries independent of pages and use them on multiple pages
	Author: Tai Havard
	Version: 1.0
	Author URI: http://www.tonguetiedmedia.com
	*/
	
/*////////////////////////////////////////////////////////////
Creates acf ttm pig custom post type
////////////////////////////////////////////////////////////*/
add_action( 'init', 'tmm_register_acf_tmm_pig_posttype' );

function tmm_register_acf_tmm_pig_posttype()
{
	register_post_type('acf_gallery', array(	'label' => 'Galleries','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => true,'supports' => array('title'),'labels' => array (
	  'name' => 'Galleries',
	  'singular_name' => 'Gallery',
	  'menu_name' => 'Galleries',
	  'add_new' => 'Add New',
	  'add_new_item' => 'Add New Gallery',
	  'edit' => 'Edit',
	  'edit_item' => 'Edit Gallery',
	  'new_item' => 'New Gallery',
	  'view' => 'View Galleies',
	  'view_item' => 'View Gallery',
	  'search_items' => 'Search Galleries',
	  'not_found' => 'No Galleries Found',
	  'not_found_in_trash' => 'No Galleries Found in Trash',
	  'parent' => 'Parent Gallery',
	),) ); 
}

/*////////////////////////////////////////////////////////////
Creates acf ttm pig advanced custom field
////////////////////////////////////////////////////////////*/
add_action( 'init', 'tmm_register_acf_tmm_pig_acffields' );

function tmm_register_acf_tmm_pig_acffields()
{
	if(function_exists("register_field_group"))//Register Gallery Field Group
	{
	register_field_group(array (
	  'id' => '5009a2c99a3aa',
	  'title' => 'Gallery',
	  'fields' => 
	  array (
		0 => 
		array (
		  'label' => 'Gallery Images',
		  'name' => 'acf_ttm_pig_gallery',
		  'type' => 'gallery',
		  'instructions' => '',
		  'required' => '0',
		  'preview_size' => 'thumbnail',
		  'key' => 'field_5009a2bf90481',
		  'order_no' => '0',
		),
	  ),
	  'location' => 
	  array (
		'rules' => 
		array (
		  0 => 
		  array (
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'acf_gallery',
			'order_no' => '0',
		  ),
		),
		'allorany' => 'all',
	  ),
	  'options' => 
	  array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => 
		array (
		),
	  ),
	  'menu_order' => 0,
	));
	}
	
	if(function_exists("register_field_group"))//Register Gallery Options Field Group
	{
	register_field_group(array (
	  'id' => '5009a20d53e39',
	  'title' => 'Gallery Settings',
	  'fields' => 
	  array (
		0 => 
		array (
		  'key' => 'field_5009443a70f94',
		  'label' => 'Show Captions',
		  'name' => 'acf_ttm_pig_caption',
		  'type' => 'true_false',
		  'instructions' => '',
		  'required' => '0',
		  'message' => '',
		  'order_no' => '0',
		),
		1 => 
		array (
		  'key' => 'field_5009a04b7b956',
		  'label' => 'Disable Shadowbox',
		  'name' => 'acf_ttm_pig_caption_disable_shadowbox',
		  'type' => 'true_false',
		  'instructions' => '',
		  'required' => '0',
		  'message' => '',
		  'order_no' => '1',
		),
		2 => 
		array (
		  'key' => 'field_5009815db79d4',
		  'label' => 'Images per row',
		  'name' => 'acf_ttm_pig_images_per_row',
		  'type' => 'text',
		  'instructions' => '',
		  'required' => '0',
		  'default_value' => '',
		  'formatting' => 'html',
		  'order_no' => '2',
		),
		3 => 
		array (
		  'key' => 'field_500994bfdba0b',
		  'label' => 'Thumbnail Size X (width)',
		  'name' => 'acf_ttm_pig_thumbnail_size_x',
		  'type' => 'text',
		  'instructions' => '',
		  'required' => '0',
		  'default_value' => '',
		  'formatting' => 'html',
		  'order_no' => '3',
		),
		4 => 
		array (
		  'key' => 'field_500994bfdbc87',
		  'label' => 'Thumbnail Size Y (height)',
		  'name' => 'acf_ttm_pig_thumbnail_size_y',
		  'type' => 'text',
		  'instructions' => '',
		  'required' => '0',
		  'default_value' => '',
		  'formatting' => 'html',
		  'order_no' => '4',
		),
	  ),
	  'location' => 
	  array (
		'rules' => 
		array (
		  0 => 
		  array (
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'acf_gallery',
			'order_no' => '0',
		  ),
		),
		'allorany' => 'all',
	  ),
	  'options' => 
	  array (
		'position' => 'side',
		'layout' => 'default',
		'hide_on_screen' => 
		array (
		),
	  ),
	  'menu_order' => 0,
	));
	}
}

/*////////////////////////////////////////////////////////////
Load shadow box js and css for acf ttm pig galleries
////////////////////////////////////////////////////////////*/
add_action('wp_head', 'ttm_load_shadowbox');

function ttm_load_shadowbox()
{
?>

<script type="text/javascript" src="<?php echo plugins_url( 'js/shadowbox-3.0.3/shadowbox.js' ,__FILE__  ); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'js/shadowbox-3.0.3/shadowbox.css' ,__FILE__  ); ?>">

<!-- Initiate shadowbox -->   
<script type="text/javascript">
	Shadowbox.init();
</script> 
<?php
}

/*////////////////////////////////////////////////////////////
Load css
////////////////////////////////////////////////////////////*/
add_action('wp_head', 'ttm_load_css');

function ttm_load_css()
{
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.plugins_url( 'style.css' ,__FILE__  ).'"/>';
}

/*////////////////////////////////////////////////////////////
Add new image sizes for acf tmm pig galleries
////////////////////////////////////////////////////////////*/
if (function_exists('add_image_size'))
{
	add_image_size( 'acf-gallery-thumbnail', 150, 150, true );
} 

/*////////////////////////////////////////////////////////////
Create custom metaboxes
////////////////////////////////////////////////////////////*/

//Add Metaboxes
function ttm_add_custom_meta_boxes()
{ 
 	add_meta_box(//Shortcode metabox
			'galleryshortcode', //id
			'Gallery Shortcode', //title
			'ttm_metabox_content_shortcode', //callback
			'acf_gallery', //postype
			'side', //content
			'low' //priority
	);
}		

// The Meta box content (ttm_acf_tmm_pig_metabox)
function ttm_metabox_content_shortcode() {
    global $post;
	echo 'Copy and paste the following shortcode into a post / page to display your gallery<br/><br/>';
    echo '[acfGallery id="'.$post->ID.'"]';
}

add_action('admin_menu', 'ttm_add_custom_meta_boxes');

/*////////////////////////////////////////////////////////////
Add custom image sizes
////////////////////////////////////////////////////////////*/

function add_image_sizes()
{
	//Check for custom image dimensions if specified by user, if none default to standard 150 x 150 image size 
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	$wp_query->query('post_type=acf_gallery');
	while ($wp_query->have_posts()) : $wp_query->the_post();
	
	if( get_field('acf_ttm_pig_thumbnail_size_x') && get_field('acf_ttm_pig_thumbnail_size_y') ) 
	{
		$thumbnailSizeX = get_field('acf_ttm_pig_thumbnail_size_x');
		$thumbnailSizeY = get_field('acf_ttm_pig_thumbnail_size_y');
		$imageSize = 'acf-gallery-thumbnail-'.$thumbnailSizeX.'-'.$thumbnailSizeY;//Create string for calling image custom image size
		//echo $imageSize.'<br/>';
		$existingImageSizes = get_intermediate_image_sizes();//Get array of existing image sizes
		if( !in_array($imageSize,$existingImageSizes) )//If image size already exists set the image string for the call below to the name of the existing image size
		{
			$existingImageSizes = null;
			add_image_size( $imageSize, $thumbnailSizeX, $thumbnailSizeY, true );// Create new image size based on user input

		}
	}
										
	endwhile;
	$wp_query = null; $wp_query = $temp;
	
	//$existingImageSizes = get_intermediate_image_sizes();
	//print_r($existingImageSizes);	
}

add_action('wp_head', 'add_image_sizes');

/*////////////////////////////////////////////////////////////
Shortcodes
////////////////////////////////////////////////////////////*/

function ttm_acf_ttm_pig_register_shortcodes()
{
   add_shortcode('acfGallery', 'ttm_acf_tmm_pig_shortcode');
}

function ttm_acf_tmm_pig_shortcode( $atts )
{
	extract(shortcode_atts(array(  
        "id" =>  '', 
    ), $atts));  


$images = get_field('acf_ttm_pig_gallery',$id);

if( $images ): 

//Count number of images to allows easy html wrapping
$number_of_images = count( $images );

//Check for number of images per row specified by user, if none default to 5 
if( get_field('acf_ttm_pig_images_per_row',$id) ) {$images_per_row = get_field('acf_ttm_pig_images_per_row',$id);}
else {$images_per_row = 5;}

//Create the image string again, definatly a better way to do this
if( get_field('acf_ttm_pig_thumbnail_size_x',$id) && get_field('acf_ttm_pig_thumbnail_size_y',$id) ) 
{
	$thumbnailSizeX = get_field('acf_ttm_pig_thumbnail_size_x',$id);
	$thumbnailSizeY = get_field('acf_ttm_pig_thumbnail_size_y',$id);
	$imageSize = 'acf-gallery-thumbnail-'.$thumbnailSizeX.'-'.$thumbnailSizeY;//Create string for calling image custom image size
}
else
{
	$imageSize = 'acf-gallery-thumbnail';//Default string for default acf image size
}	

$x = 1;	//Set variable for image counting 
$y = 1;//Set variable for row counting

if( get_field('acf_ttm_pig_caption_disable_shadowbox',$id) == true)
{
	$shadowbox = '';
}
else
{
	$shadowbox = 'rel="shadowbox[Gallery'.$id.']"';
}

$returnValue = '<ul class="acf-pig-gallery-container">';
	foreach( $images as $image ):

		if($x % $images_per_row == 0) {$last = 'last';}
		else {$last = '';}
		
		if( $x == 1 ) $returnValue .= '<div class="row '.$y.'">';
		$returnValue .= '<li class="acf-pig-gallery-item '.$last.'">';
			$returnValue .= '<a class="acf-pig-gallery-link" href="'.$image['url'].'" '.$shadowbox.'"><img class="acf-pig-gallery-image" src="'.$image['sizes'][$imageSize].'" alt="'.$image['alt'].'"/></a>';
			if( get_field('acf_ttm_pig_caption',$id) == true) $returnValue .= '<p class="caption">'.$image['caption'].'</p>';
		$returnValue .= '</li>';
		if( $x % $images_per_row == 0 || $x == $number_of_images ) {$returnValue .= '<div class="clear"></div></div> <!-- end row '.$y.' -->';}
		if( $x % $images_per_row == 0 && $x != $number_of_images ) 
		{
			$y++;
			$returnValue .= '<div class="row '.$y.'">';
		}
		//$returnValue .= 'X value '.$x.'<br/>';
		//$returnValue .= 'Images per row value '.$images_per_row.'<br/>';
		//$returnValue .= 'Total number of images '.$number_of_images;
		$x++;
		
	endforeach;
$returnValue .= '</ul>';
//$returnValue .= print_r($images); 

endif; 
		//$returnValue .= $imageSize;
	return $returnValue;
}

add_action( 'init', 'ttm_acf_ttm_pig_register_shortcodes');

?>