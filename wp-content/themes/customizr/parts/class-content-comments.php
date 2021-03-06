<?php
/**
* Comments actions
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

class TC_comments {

    function __construct () {
        add_action ( '__comment_title'                   , array( $this , 'tc_comment_title' ));
        add_action ( '__comment_list'                    , array( $this , 'tc_comment_list' ));
        add_action ( '__comment_navigation'              , array( $this , 'tc_comment_navigation' ));
        add_action ( '__comment_close'                   , array( $this , 'tc_comment_close' ));
    }

    /**
      * Comment title rendering
      *
      * @package Customizr
      * @since Customizr 3.0
     */
      function tc_comment_title() {
        printf( '<h2 class="comments-title">%1$s' ,
              sprintf( _n( 'One thought on &ldquo;%2$s&rdquo;' , '%1$s thoughts on &ldquo;%2$s&rdquo;' , get_comments_number(), 'customizr' ),
              number_format_i18n( get_comments_number() ), 
              '<span>' . get_the_title() . '</span></h2>' 
            ));
      }



     /**
      * Comments Rendering
      *
      * @package Customizr
      * @since Customizr 3.0
     */
      function tc_comment_list() {
      	?>

      		<ul class="commentlist">
      			<?php wp_list_comments( array( 'callback' => array ( $this , 'tc_comment_callback' ) , 'style' => 'ul' ) ); ?>
      		</ul><!-- .commentlist -->

    		<?php
    	}




	 /**
     * Template for comments and pingbacks.
     *
     *
      * Used as a callback by wp_list_comments() for displaying the comments.
      *  Inspired from Twenty Twelve 1.0
      * @package Customizr
      * @since Customizr 1.0 
     */
     function tc_comment_callback( $comment, $args, $depth ) {
      $GLOBALS['comment'] = $comment;
      switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
      ?>
      <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
          <p><?php _e( 'Pingback:' , 'customizr' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)' , 'customizr' ), '<span class="edit-link btn btn-success btn-mini">' , '</span>' ); ?></p>
        </article>
      <?php
          break;
        default :
        // Proceed with normal comments.
        global $post;
      ?>
      <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article class="comment">
            <div class="row-fluid">
              <div class="comment-avatar span2">
                <?php echo get_avatar( $comment, 80 ); ?>
              </div>
              <div class="span10">
                <?php if(get_option( 'thread_comments' ) == 1) : //check if the nested comment option is checked?>
                    <div class="reply btn btn-small">
                      <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply' , 'customizr' ), 'after' => ' <span>&darr;</span>' , 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->
                <?php endif; ?>
                <header class="comment-meta comment-author vcard">
                    <?php
                    printf( '<cite class="fn">%1$s %2$s %3$s</cite>' ,
                      get_comment_author_link(),
                      // If current post author is also comment author, make it known visually.
                      ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author' , 'customizr' ) . '</span>' : '' ,
                      edit_comment_link( __( 'Edit' , 'customizr' ), '<p class="edit-link btn btn-success btn-mini">' , '</p>' )
                    );
                    printf( '<a class="comment-date" href="%1$s"><time datetime="%2$s">%3$s</time></a>' ,
                      esc_url( get_comment_link( $comment->comment_ID ) ),
                      get_comment_time( 'c' ),
                      /* translators: 1: date, 2: time */
                      sprintf( __( '%1$s at %2$s' , 'customizr' ), get_comment_date(), get_comment_time() )
                    );
                  ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                  <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' , 'customizr' ); ?></p>
                <?php endif; ?>

                <section class="comment-content comment">
                  <?php comment_text(); ?>
                </section><!-- .comment-content -->
            </div><!-- .span8 -->
          </div><!-- .row -->
        </article><!-- #comment-## -->
        <?php
          break;
        endswitch; // end comment_type check
      }




      /**
      * Comment navigation rendering
      *
      * @package Customizr
      * @since Customizr 3.0
     */
      function tc_comment_navigation () {
          if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through
            ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
              <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation' , 'customizr' ); ?></h1>
              <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments' , 'customizr' ) ); ?></div>
              <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;' , 'customizr' ) ); ?></div>
            </nav>
            <?php 
          endif; // check for comment navigation
        }



      /**
      * Comment close rendering
      *
      * @package Customizr
      * @since Customizr 3.0
      */
      function tc_comment_close() {
        /* If there are no comments and comments are closed, let's leave a note.
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if ( ! comments_open() && get_comments_number() ) : 
          ?>
            <p class="nocomments"><?php _e( 'Comments are closed.' , 'customizr' ); ?></p>
          <?php 
        endif;
      }
    
}//end class