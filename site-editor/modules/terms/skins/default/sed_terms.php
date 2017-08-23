<div <?php echo $sed_attrs; ?> class="module module-terms module-terms-default <?php echo $class; ?> ">

    <?php
    if( $show_title ) {
        ?>
        <div class="terms-entry-title"><?php echo $title;?></div>
        <?php
    }

    if ( !empty( $terms ) ){

        ?>

        <ul>

            <?php
            // Start the Loop.
            foreach( $terms AS $term ){

                include dirname(__FILE__) . '/content.php';

            }

            ?>

        </ul>

        <?php

    }else{ ?>

        <div class="not-found-term">
            <p><?php echo __("Not found result" , "site-editor" ); ?> </p>
        </div>

    <?php

    }
    
    ?>
    
</div>
