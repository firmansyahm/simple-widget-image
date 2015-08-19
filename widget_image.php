<?php
/*
Plugin Name: Widget Image
Plugin URI: http://firmansyahmaulana.com/
Description: Image widget for advertisement, logo or etc
Author: Firmansyah
Author URI: http://firmansyahmaulana.com/
Version: 1.0
Text Domain: widgetimage
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

add_action( 'widgets_init', 'register_widget_image' );

function register_widget_image(){
	register_widget('widgetimage' );
}

//style image 
function style_image() {
	wp_enqueue_style( 'normalize' , plugin_dir_url( __FILE__ ) . 'css/normalize.css' );
	wp_enqueue_style( 'demo' , plugin_dir_url( __FILE__ ) . 'css/demo.css' );
	wp_enqueue_style( 'set' , plugin_dir_url( __FILE__ ) . 'css/set1.css' );
	wp_enqueue_style( 'firman-fonts', 'http://fonts.googleapis.com/css?family=Raleway:400,800,300', array(), $theme->Version, 'all' );
}
add_action( 'wp_enqueue_scripts' , 'style_image' );

// // queue up the necessary js
function load_image()
{
  wp_enqueue_style('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  // moved the js to an external file, you may want to change the path
  wp_enqueue_script('jsloadimage', plugin_dir_url( __FILE__ ) . '/js/script.js', null, null, true);
}
add_action('admin_enqueue_scripts', 'load_image');

class widgetimage extends WP_widget {

	public function __construct()
  {
    parent::__construct(
         
        // base ID of the widget
        'widget_image',
         
        // name of the widget
        __('Widget Image', 'firman' ),
         
        // widget options
        array (
            'description' => __( 'for advertisement, logo, etc.', 'firman' )
        )
         
    );
  }

  public function widget( $args, $instance )
  {    ?>
    <div class="grid">
		<figure class="<?php echo $instance['style']; ?>">
			<img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo $instance['title']; ?>">
			<figcaption>
				<div>
					<h2><?php echo $instance['title']; ?></h2>
					<p><?php echo $instance['description']; ?></p>
				</div>
				<a href="<?php echo $instance['link']; ?>">View more</a>
			</figcaption>			
		</figure>
	</div>

    <?php
  }

  public function form( $instance ) {

	if ( isset( $instance[ 'image_uri' ] ) ) {
			$image_uri = $instance[ 'image_uri' ];
		}
		else {
			$image_uri = '';
		}

	if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'tokoo' );
		}
	if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		}
		else {
			$link = '';
		}
	if ( isset( $instance[ 'description' ] ) ) {
			$description = $instance[ 'description' ];
		}
		else {
			$description = '';
		}
	if ( isset( $instance[ 'style' ] ) ) {
			$style = $instance[ 'style' ];
		}
		else {
			$style = '';
		}	
  
    // removed the for loop, you can create new instances of the widget instead
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title</label><br />
      <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
      <input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>" />
      <input type="button" class="select-img" value="Select Image" />
    </p>
     <p>
      <label for="<?php echo $this->get_field_id('description'); ?>">Description</label><br />
      <input type="text" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php echo $instance['description']; ?>" class="widefat" />
    </p>
     <p>
      <label for="<?php echo $this->get_field_id('link'); ?>">Link</label><br />
      <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php echo $instance['link']; ?>" class="widefat" />
    </p>
     <p>
      <label for="<?php echo $this->get_field_id('style'); ?>">Style: 
        <select class='widefat' id="<?php echo $this->get_field_id('style'); ?>"
                name="<?php echo $this->get_field_name('style'); ?>" type="text">
                <?php
                $datasytle = array('Lily','Sadie','Honey','Layla','Oscar','Marley','Ruby','Ruxy','Bubba','Romeo','Dexter','Sarah','Chico','Milo','Selena','Apollo','Steve','Moses','Jazz','Ming','Lexi','Duke');
                	for ($i=0; $i < 22 ; $i++) { 
                		$value = $datasytle[$i];
                		$value = strtolower($value);
          		?>
				<option value='effect-<?php echo $value; ?>'> <?php echo $datasytle[$i]; ?></option>
          		<?php
                	}
                ?>
        </select>                
      </label>
     </p>

    <?php
  }

}