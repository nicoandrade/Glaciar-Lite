<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glaciar Lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'glaciar-lite' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'glaciar-lite'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'glaciar-lite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'glaciar-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'glaciar-lite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" >
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'glaciar-lite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'glaciar-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'glaciar-lite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'glaciar-lite' ); ?></p>
	<?php endif; ?>

	<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$comments_args = array(
	        // remove "Text or HTML to be displayed after the set of comment fields"
	        'comment_notes_after' => '',
	        
	        // redefine your own textarea (the comment body)
	        'comment_field' => '<div class="clearfix"></div><div class="input-wrap textarea">
							      <label class="control-label" for="comment">'. esc_html__( 'Comment', 'glaciar-lite' ) .'</label>
							      <div class="controls-wrap">
									    <textarea class="input-xlarge" name="comment" id="comment" tabindex="4" rows="3"></textarea>
							      </div>
								</div>',

			'id_submit' => 'submit-respond',

			'fields' => apply_filters( 'comment_form_default_fields', array(


						'author' =>	'<div class="input-wrap">
								      <label class="control-label" for="author">'. esc_html__( 'Name', 'glaciar-lite' ) . '' . ( $req ? ' (*)' : '' ).'</label>
								      <div class="controls-wrap">
									      	<i class="fa fa-user"></i>
										    <input class="input-xlarge" type="text" name="author" id="author" value="'.  esc_attr( $comment_author ) .'" size="22" tabindex="1" ' . $aria_req . ' />
											
								      </div>
								    </div>',
						
						'email' =>	'<div class="input-wrap">
								      <label class="control-label" for="email">'. esc_html__( 'Email', 'glaciar-lite' ) . '' . ( $req ? ' (*)' : '' ).'</label>
								      <div class="controls-wrap">
									      	<i class="fa fa-envelope"></i>
										    <input class="input-xlarge" type="text" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ).'" size="22" tabindex="2" ' . $aria_req . ' />
								      </div>
								    </div>',


						'url' =>	'<div class="input-wrap">
								      <label class="control-label" for="url">'. esc_html__( 'Website', 'glaciar-lite' ) . '</label>
								      <div class="controls-wrap">
									      	<i class="fa fa-link"></i>
										    <input class="input-xlarge" type="text" name="url" id="url" value="' .  esc_attr( $commenter['comment_author_url'] ).'" size="22" tabindex="3" />
								      </div>
								    </div>'
						)
			)

	);

	comment_form( $comments_args ); 
	?> 

</div><!-- #comments -->