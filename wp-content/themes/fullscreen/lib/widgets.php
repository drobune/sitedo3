<?php
function register_fullscreen_sidebars() {
	
	register_sidebar(array(
        'name' => 'Bottom-Left',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="sub">',
        'after_title' => '</h6>',
    ));
	
	register_sidebar(array(
        'name' => 'Bottom-Middle',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="sub">',
        'after_title' => '</h6>',
    ));
	
	register_sidebar(array(
        'name' => 'Bottom-Right',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="sub">',
        'after_title' => '</h6>'
    ));
	
	register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '<div class="item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sub">',
        'after_title' => '</h3>',
    ));
	
}

add_action( 'widgets_init', 'register_fullscreen_sidebars' );