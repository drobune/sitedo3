<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tc_comment_callback()
 *
 * @package Customizr
 * @since Customizr 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<?php if ( have_comments() ) : ?>

	<hr class="featurette-divider">

<?php endif; ?>

<div id="comments" class="comments-area">


<!-- X:S ZenBackWidget -->
<script type="text/javascript">document.write(unescape("%3Cscript")+" src='http://widget.zenback.jp/?base_uri=http%3A//sitedo3.net&nsid=115532946567383525%3A%3A115532964015640761&rand="+Math.ceil((new Date()*1)*Math.random())+"' type='text/javascript'"+unescape("%3E%3C/script%3E"));
</script>
<!-- X:E ZenBackWidget -->

</div><!-- #comments .comments-area -->