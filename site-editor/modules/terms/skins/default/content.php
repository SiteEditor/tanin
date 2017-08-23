<li class="entry-item collage-item clearfix post item">

    <?php
    $term_link = get_term_link( $term );

    // If there was an error, continue to the next term.
    if ( is_wp_error( $term_link ) ) {
        $term_link = "#";
    }

    ?>

    <a href="<?php echo esc_attr( esc_url( $term_link ) );?>">

        <?php echo $term->name;?>

    </a>

</li>

