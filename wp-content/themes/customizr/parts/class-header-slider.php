<?php
/**
* Slider actions
*
*
* @package      Customizr
* @subpackage   classes
* @since        3.0
* @author       Nicolas GUILLAUME <nicolas@themesandco.com>
* @copyright    Copyright (c) 2013, Nicolas GUILLAUME
* @link         http://themesandco.com/customizr
* @license      http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

class TC_slider {

    function __construct () {
        add_action( '__slider'                              , array( $this , 'tc_display_slider' ));
        add_action( 'wp_footer'                             , array( $this , 'tc_slider_footer_options' ),20);
    }


  /**
   *
   * @package Customizr
   * @since Customizr 1.0
   *
   */
  function tc_display_slider() {
      //prevent the main ID override when creating a new query. (only if it is included in the main loop but who knows...)
      if (is_404() || is_archive() || is_search())
        return;

      $__options             = tc__f ( '__options' );

      //get the current slider id
      $slider_name_id               = tc__f ( '__screen_slider' );

        if ( is_front_page() && $__options['tc_front_slider'] !=null) {
          $slider_name_id           = $__options['tc_front_slider'];
        }

      //is the slider on?
      $slider_active                = esc_attr(get_post_meta( get_the_ID(), $key = 'post_slider_check_key' , $single = true ));
        if ( is_front_page() && $__options['tc_front_slider'] !=null) {
          $slider_active            = true;
      }

      //get slider options if any
      $layout_value                 = esc_attr(get_post_meta( get_the_ID(), $key = 'slider_layout_key' , $single = true ));
      if (is_home() || is_front_page()) {
        $layout_value               = tc__f ( '__get_option' , 'tc_slider_width' );
      }

      $layout_class                 = '';
      $img_size                     = 'slider';

      if ( $layout_value == 0) {//if boxed slider is checked
        $layout_class               = 'container';
        $img_size                   = 'slider';
      }
      else {
        $img_size                   = 'slider-full';
      }

      //render the slider : two cases
      switch ( $slider_name_id) {
        case 'demo':

        //admin link if user logged in
        $admin_link                 = '';
        if (is_user_logged_in())
          $admin_link                = 'http://sitedo3.net'//admin_url().'customize.php';

        ?>
          <div id="customizr-slider" class="<?php echo $layout_class ?> carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                   <div class="carousel-image">
                      <img width="1200" height="500" src="<?php echo TC_BASE_URL ?>inc/img/surf.jpg" class="slide wp-post-image" alt="<?php _e( 'Customizr is a clean responsive theme' , 'customizr' ) ?>">
                    </div>
                    <div class="carousel-caption">
                        <h1><?php _e( "Welcome !  I'm Yuichi."  , 'customizr' ) ?></h1>
                          <p class="lead"><?php _e( 'Here is a portfolio site of Japanese programmer. This site title means my favarite Japanese commander.' , 'customizr' ) ?></p>
                    </div>
                </div>
              <div class="item">
                 <div class="carousel-image">
                      <img width="1200" height="500" src="<?php echo TC_BASE_URL ?>inc/img/screen.jpg" class="slide wp-post-image" alt="<?php _e( 'Style your WordPress site live!' , 'customizr' ) ?>">
                  </div>
                  <div class="carousel-caption">
                      <h1><?php _e( 'Programmer\'s blog' , 'customizr' ) ?></h1>
                        <p class="lead"><?php _e( 'about web-programming and startups in japan. I try to write articles in Japanese and English!' , 'customizr' ) ?></p>
                    </div>
                </div>
              <div class="item">
                 <div class="carousel-image">
                  <img width="1200" height="500" src="<?php echo TC_BASE_URL ?>inc/img/skate.jpg" class="slide wp-post-image" alt="<?php _e( 'Create beautiful sliders' , 'customizr' ) ?>">
                </div>
                <div class="carousel-caption">
                  <h1><?php _e( 'Works' , 'customizr' ) ?></h1>
                      <p class="lead"><?php _e( 'My products...' , 'customizr' ) ?></p>
                </div>
              </div>
            </div><!-- /.carousel-inner -->
            <a class="left carousel-control" href="#customizr-slider" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#customizr-slider" data-slide="next">&rsaquo;</a>
          </div>
          <?php
          break;



        default:
            $__options['another_query_in_the_main_loop'] = true;
            $__options['original_ID'] = get_the_ID();

            //get the slider ID
            /*There is a tricky case with the blog page. If we choose to assign a page for the blog posts, then this page will return a
            *'true' value if we test it with is_home(). Even if it is not the home page of the website!
            *to solve this problem, we check with is_front_page().
            */

            //do we have a slider?
            if(empty( $__options['tc_sliders'][$slider_name_id])) {
              return;
            }

            //slider active?
            if (isset( $slider_active) && !$slider_active) {
              return;
            }

            $slides = $__options['tc_sliders'][$slider_name_id];

            //init slide index
            $i = 0;
            ?>
            <?php if( $slides) : ?>

              <div id="customizr-slider" class="<?php echo $layout_class ?> carousel slide">

                  <div class="carousel-inner">

                    <?php foreach ( $slides as $s) {
                        $slide_object   = get_post( $s);

                        //next loop if attachment does not exist anymore
                        if (!isset( $slide_object)) {
                          continue;
                        }

                        //set up variables
                        $id                 = $slide_object -> ID;
                        $slider_checked     = esc_attr(get_post_meta( $id, $key = 'slider_check_key' , $single = true ));
                        $alt                = trim(strip_tags(get_post_meta( $id, '_wp_attachment_image_alt' , true)));
                        $title              = esc_attr(get_post_meta( $id, $key = 'slide_title_key' , $single = true ));
                        $text               = esc_textarea(get_post_meta( $id, $key = 'slide_text_key' , $single = true ));
                        $text_color         = esc_attr(get_post_meta( $id, $key = 'slide_color_key' , $single = true ));
                        $button_text        = esc_attr(get_post_meta( $id, $key = 'slide_button_key' , $single = true ));
                        $button_link        = esc_attr(get_post_meta( $id, $key = 'slide_link_key' , $single = true ));

                        //set the first slide active
                        $active             = '';
                        if ( $i==0) {$active ='active';}

                        //check if $text_color is set and create an html style attribute
                        $color_style        ='';
                        if ( $text_color != null) {
                          $color_style      = 'style="color:'.$text_color.'"';
                        }

                      ?>

                      <?php if (isset( $slider_checked) && $slider_checked == 1) : ?>

                        <div class="item <?php echo $active; ?>">

                           <div class="carousel-image <?php echo $img_size ?>">
                            <?php echo wp_get_attachment_image( $id, $img_size, array( 'class' => 'slide' , 'alt' => $alt ) ); ?>
                           </div>

                            <?php if ( $title != null || $text != null || $button_text != null ) : ?>

                              <div class="carousel-caption">

                                <?php if( $title != null) : ?>
                                  <h1 <?php echo $color_style ?>><?php echo $title ?></h1>
                                <?php endif; ?>

                                <?php if( $text != null) : ?>
                                  <p <?php echo $color_style ?> class="lead"><?php echo $text ?></p>
                                <?php endif; ?>

                                <?php if( $button_text != null && $button_link != null) : ?>
                                  <a class="btn btn-large btn-primary" href="<?php echo get_permalink( $button_link); ?>"><?php echo $button_text; ?></a>

                                <?php elseif( $button_text != null ) : ?>
                                 <a class="btn btn-large btn-primary" href="#"><?php echo $button_text;?></a>
                               <?php endif; ?>

                              </div>

                            <?php endif; ?>

                        </div>

                      <?php endif; //check if $slider_checked ?>

                    <?php
                     $i++;
                     }//end slides loop
                    ?>
                  </div><!-- /.carousel-inner -->

                  <a class="left carousel-control" href="#customizr-slider" data-slide="prev">&lsaquo;</a>
                  <a class="right carousel-control" href="#customizr-slider" data-slide="next">&rsaquo;</a>

                </div><!-- /.carousel -->
              <?php endif; ?>

            <?php
          break;
      }//end switch
    }




    /**
     * Add a the slider options script in wp_footer()
     * @package Customizr
     * @since Customizr 1.0
     *
    **/
    function tc_slider_footer_options() {
      //get slider options if any
      $name_value       = get_post_meta( get_the_ID(), $key = 'post_slider_key' , $single = true );
      $delay_value      = get_post_meta( get_the_ID(), $key = 'slider_delay_key' , $single = true );

      //get the slider id and delay if we display home/front page
      if ( is_front_page() || is_home()) {
        $name_value     = tc__f ( '__get_option' , 'tc_front_slider' );
        $delay_value    = tc__f ( '__get_option' , 'tc_slider_delay' );
      }

      //render the delay script
      if(!empty( $delay_value)) {
          $delay = '{interval:'.$delay_value.'}';
      }
      else {
          $delay = '';
      }

      //fire the slider with the optionnal delay parameter
      if( $name_value != null) {//check if a slider is defined

        ?>
          <script type="text/javascript">
            !function ( $) {
              jQuery(function(){
                // slider init
                $( '#customizr-slider' ).carousel(<?php echo $delay; ?>)
              })
            }(window.jQuery)
          </script>

        <?php
      }//end if slider defined
    }

} //end of class
