<?php

/************************************************************
 * Plugin Name: Direction per post
 * Plugin URI: http://blog.rabin.io
 * Description: A brief description of the Plugin.
 * Version: 0.1
 * Author: Rabin
 * Author URI: http://blog.rabin.io
 * License: A "Slug" license name e.g. GPL2
 ************************************************************/

function set_content_direction ($text) {  
    $post_direction = get_post_meta( get_the_ID() , 'post_direction', $single = true );
    if ($post_direction != '' ) {
        $text = "<div style=\"direction: " . $post_direction['content'] . ';" >' . $text . '</div>';
    }

    return $text;
}
add_filter('the_content', 'set_content_direction');

function set_title_direction ($text) {

    if (in_the_loop()) {
        $post_direction = get_post_meta( get_the_ID() , 'post_direction', $single = true );
        if ($post_direction != '' ) {
            $text = "<div style=\"direction: " . $post_direction['title'] . ';" >' . $text . '</div>';
        }
    }

    return $text;
}
//add_filter('the_title', 'set_title_direction');
add_action('the_title', 'set_title_direction');

// -------------------------------------------------------------------------------------

function set_post_direction () {
    //update_post_meta( get_the_ID(), 'title_direction',   'rtl' );
    //update_post_meta( get_the_ID(), 'content_direction', 'rtl' );
    if (isset($_POST['post_direction-title']) && $_POST['post_direction-title'] == 'on') {
        $title_direction = 'ltr';     
    }
    else {
        $title_direction = 'rtl';
    }

    if (isset($_POST['post_direction-content']) && $_POST['post_direction-content'] == 'on') {
        $content_direction = 'ltr';
    }
    else {
        $content_direction = 'rtl';
    }

    update_post_meta( get_the_ID(), 'post_direction', array('title' => $title_direction, 'content' => $content_direction ) );
    return;
}
add_action( 'save_post', 'set_post_direction' );
// -------------------------------------------------------------------------------------

/* Display custom column */
function display_posts_direction( $column, $post_id ) {
    
    $post_direction = get_post_meta( $post_id, 'post_direction' , $single = true);
    echo 'Tile   : ' . $post_direction['title'] . '</br>';
    echo 'Content: ' . $post_direction['content'] . '</br>';
    //var_dump($post_direction);
    
}
add_action( 'manage_posts_custom_column' , 'display_posts_direction', 10, 2);
// -------------------------------------------------------------------------------------

/* Add custom column to post list */
function add_per_post_direction_column( $columns ) {
    //print_r($columns); die;
    return array_merge( $columns, array( 'post_direction' => __(  'Post Direction', 'XXXXXXXX' ) ) );
}
add_filter( 'manage_posts_columns' , 'add_per_post_direction_column' );

// -------------------------------------------------------------------------------------

//add_action( 'quick_edit_custom_box', 'display_custom_quickedit_book', 10, 2 );


add_action( 'post_submitbox_misc_actions', 'add_to_submitbox_direction_options' );

function add_to_submitbox_direction_options(){

    $post_direction = get_post_meta( $post_id = get_the_ID(), 'post_direction', $single = true);

    $plugin_dir_url = plugin_dir_url( __FILE__ );

?>
<script src="<?php echo $plugin_dir_url ?>res/Picker/jquery.fs.picker.js"></script>
<link  href="<?php echo $plugin_dir_url ?>res/Picker/jquery.fs.picker.css" rel="stylesheet" type="text/css" media="all" />
<div class="misc-pub-section my-options">
    <fieldset>
        <input type="checkbox" id="post_direction-title"   name="post_direction-title"   <?php echo ( $post_direction['title']   == 'ltr') ? 'checked' : '' ?>/><label for="post_direction-title"  >Make title direction RTL</label>
        <input type="checkbox" id="post_direction-content" name="post_direction-content" <?php echo ( $post_direction['content'] == 'ltr') ? 'checked' : '' ?>/><label for="post_direction-content">Make content direction RTL</label>
    </fieldset>
</div>

<?php

echo '<script>';
include 'res/js/document.ready.js';
echo '</script>';


}  // add_to_submitbox_direction_options


?>