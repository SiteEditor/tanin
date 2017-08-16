<?php
/**
 * The template for displaying beauty archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) : ?>

            <div class="sed-shop-faq-wrapper sed-post-type-faq-content">
                <div class="sed-shop-faq-wrapper-inner">

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                $classes = array(
                    'faq-item-heading'
                );

                $excerpt_length = 800;

                $content_post = apply_filters('the_excerpt', get_the_excerpt()); //var_dump($content_post);

                # FILTER EXCERPT LENGTH
                if( strlen( $content_post ) > $excerpt_length )
                    $content_post = mb_substr( $content_post , 0 , $excerpt_length - 3 ) . '...';

                ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
                        <div class="faq-heading-inner">
                            <h5><?php the_title(); ?></h5>
                        </div>
                    </div>

                    <div class="faq-item-content">
                        <div class="faq-content-inner">
                            <div><?php echo $content_post; ?></div>
                            <div class="text-right text-uppercase">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button text-second-main"><?php _e("Read More","twentyseventeen") ?></a>
                            </div>
                        </div>
                    </div><!-- #post-## -->

                <?php   
                endwhile;
                ?>

                </div> 
            </div> 

            <?php
            the_posts_pagination( array(
                'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
                'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
            ) );

        else :

            get_template_part( 'template-parts/post/content', 'none' );

        endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();




