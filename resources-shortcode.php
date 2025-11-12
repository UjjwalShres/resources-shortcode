<?php
/**
 * Plugin Name: Resources Shortcode
 * Description: Registers a "Resources" custom post type and provides a shortcode to display latest resources.
 * Version: 1.0
 * Author: Ujjwal Shrestha
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct access
}

/**
 * Register Custom Post Type: Resources
 */
function rs_register_resources_cpt() {

    $labels = array(
        'name'               => __( 'Resources', 'rs' ),
        'singular_name'      => __( 'Resource', 'rs' ),
        'add_new'            => __( 'Add New Resource', 'rs' ),
        'add_new_item'       => __( 'Add New Resource', 'rs' ),
        'edit_item'          => __( 'Edit Resource', 'rs' ),
        'new_item'           => __( 'New Resource', 'rs' ),
        'all_items'          => __( 'All Resources', 'rs' ),
        'view_item'          => __( 'View Resource', 'rs' ),
        'search_items'       => __( 'Search Resources', 'rs' ),
        'not_found'          => __( 'No resources found', 'rs' ),
        'menu_name'          => __( 'Resources', 'rs' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'resources', $args );
}
add_action( 'init', 'rs_register_resources_cpt' );

/**
 * Enqueue styles for shortcode output
 */
function rs_enqueue_styles() {
    wp_enqueue_style( 'rs-style', plugin_dir_url( __FILE__ ) . 'css/resources-style.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'rs_enqueue_styles' );

/**
 * Shortcode to display latest resources
 * Usage: [latest_resources limit="5"]
 */
function rs_latest_resources_shortcode( $atts ) {

    // Shortcode attributes
    $atts = shortcode_atts( array(
        'limit' => 5,
    ), $atts, 'latest_resources' );

    // Query the Resources CPT
    $query = new WP_Query( array(
        'post_type'      => 'resources',
        'posts_per_page' => intval( $atts['limit'] ),
    ) );

    ob_start();

    if ( $query->have_posts() ) {
        echo '<div class="rs-resources-grid">';

        while ( $query->have_posts() ) : $query->the_post();
            ?>
            <div class="rs-resource-item">
                <a href="<?php the_permalink(); ?>" class="rs-thumb">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'medium' );
                    } ?>
                </a>
                <h3 class="rs-title">
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                </h3>
                <div class="rs-excerpt">
                    <?php echo esc_html( get_the_excerpt() ); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="rs-readmore">Read More →</a>
            </div>
            <?php
        endwhile;

        echo '</div>';
    } else {
        echo '<p>No resources found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'latest_resources', 'rs_latest_resources_shortcode' );
