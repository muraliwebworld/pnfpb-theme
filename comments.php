<?php
/**
 * The template for displaying comments.
 *
 * @package PNFPB_Theme
 * @link    https://developer.wordpress.org/themes/basics/template-tags/comment-template-tags/
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="pnfpb-comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="pnfpb-comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					/* translators: %s: post title */
					esc_html__( 'One thought on &#8220;%s&#8221;', PNFPB_TEXT_DOMAIN ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					esc_html( _nx( '%1$s thought on &#8220;%2$s&#8221;', '%1$s thoughts on &#8220;%2$s&#8221;', $comment_count, 'comments title', PNFPB_TEXT_DOMAIN ) ),
					esc_html( number_format_i18n( $comment_count ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .pnfpb-comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="pnfpb-comment-nav pnfpb-comment-nav--top" aria-label="<?php esc_attr_e( 'Comments navigation', PNFPB_TEXT_DOMAIN ); ?>">
				<span class="pnfpb-comment-nav__prev"><?php previous_comments_link( esc_html__( '&larr; Older Comments', PNFPB_TEXT_DOMAIN ) ); ?></span>
				<span class="pnfpb-comment-nav__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', PNFPB_TEXT_DOMAIN ) ); ?></span>
			</nav>
		<?php endif; ?>

		<ol class="pnfpb-comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 48,
				'callback'    => 'pnfpb_comment_template',
			) );
			?>
		</ol><!-- .pnfpb-comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="pnfpb-comment-nav pnfpb-comment-nav--bottom" aria-label="<?php esc_attr_e( 'Comments navigation', PNFPB_TEXT_DOMAIN ); ?>">
				<span class="pnfpb-comment-nav__prev"><?php previous_comments_link( esc_html__( '&larr; Older Comments', PNFPB_TEXT_DOMAIN ) ); ?></span>
				<span class="pnfpb-comment-nav__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', PNFPB_TEXT_DOMAIN ) ); ?></span>
			</nav>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="pnfpb-no-comments"><?php esc_html_e( 'Comments are closed.', PNFPB_TEXT_DOMAIN ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'class_form'          => 'pnfpb-comment-form',
		'class_submit'        => 'pnfpb-btn pnfpb-btn--primary',
		'title_reply'         => esc_html__( 'Leave a Reply', PNFPB_TEXT_DOMAIN ),
		'title_reply_before'  => '<h3 class="pnfpb-comment-reply-title">',
		'title_reply_after'   => '</h3>',
	) );
	?>

</section><!-- #comments -->

<?php
/**
 * Custom comment template callback.
 *
 * @param WP_Comment $comment Comment object.
 * @param array      $args    Comment args.
 * @param int        $depth   Comment depth.
 */
function pnfpb_comment_template( WP_Comment $comment, array $args, int $depth ) : void {
	$tag  = ( 'div' === $args['style'] ) ? 'div' : 'li';
	$html = sprintf( '<%s id="comment-%d" %s>', esc_attr( $tag ), (int) $comment->comment_ID, comment_class( '', $comment, null, false ) );
	$html .= '<article class="pnfpb-comment">';
	$html .= '<footer class="pnfpb-comment__meta">';
	$html .= get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'pnfpb-comment__avatar' ) );
	$html .= '<div class="pnfpb-comment__author-meta">';
	$html .= '<cite class="pnfpb-comment__author">' . get_comment_author_link( $comment ) . '</cite>';
	$html .= sprintf(
		'<time class="pnfpb-comment__time" datetime="%s">%s</time>',
		esc_attr( get_comment_time( 'c', false, false, $comment ) ),
		esc_html( sprintf(
			/* translators: %s comment date */
			__( '%s ago', PNFPB_TEXT_DOMAIN ),
			human_time_diff( (int) get_comment_time( 'U', false, true, $comment ) )
		) )
	);
	$html .= '</div>';
	$html .= '</footer>';
	$html .= '<div class="pnfpb-comment__body">';

	if ( '0' === $comment->comment_approved ) {
		$html .= '<em class="pnfpb-comment__moderation">' . esc_html__( 'Your comment is awaiting moderation.', PNFPB_TEXT_DOMAIN ) . '</em>';
	}

	$html .= get_comment_text( $comment );
	$html .= get_comment_reply_link( array_merge( $args, array(
		'add_below' => 'comment',
		'depth'     => $depth,
		'max_depth' => $args['max_depth'],
		'before'    => '<div class="pnfpb-comment__reply">',
		'after'     => '</div>',
	) ), $comment );
	$html .= '</div>';
	$html .= '</article>';

	echo wp_kses_post( $html );
}
