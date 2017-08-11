<div <?php echo $sed_attrs; ?> class="module module-vertical-header module-vertical-header-default <?php echo $class; ?> ">

    <section class="menu-container">

        <div class="sed-row-boxed">
            <div class="right-panel">

                <div class="sed_vertical_header_vertical_menu_wrap">
                    <ul id="sed_vertical_header_vertical_menu" class="list-menu list-unstyled">

                        <?php wp_nav_menu(array('theme_location' => 'top', 'container' => '', 'items_wrap' => '%3$s')); ?>

                    </ul>
                </div>

            </div>

        </div>

    </section>
    
</div>