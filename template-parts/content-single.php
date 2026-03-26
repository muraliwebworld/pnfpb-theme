<?php
/**
 * Template part — single post.
 *
 * @package PNFPB_Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'pnfpb-single-post' ); ?>>

	<header class="pnfpb-single-post__header">
		<?php pnfpb_breadcrumbs(); ?>

		<?php
		$categories = get_the_category();
		if ( $categories ) :
		?>
			<div class="pnfpb-single-post__cats">
				<?php foreach ( $categories as $cat ) : ?>
					<a class="pnfpb-tag" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
						<?php echo esc_html( $cat->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<h1 class="pnfpb-single-post__title"><?php the_title(); ?></h1>

		<div class="pnfpb-single-post__meta">
			<?php pnfpb_posted_on(); ?>
			<?php pnfpb_posted_by(); ?>
			<span class="pnfpb-post-read-time">
				<?php echo wp_kses_post( pnfpb_icon( 'clock', array( 'width' => 13, 'height' => 13 ) ) ); ?>
				<?php
				$word_count   = str_word_count( wp_strip_all_tags( get_the_content() ) );
				$reading_time = max( 1, (int) ceil( $word_count / 200 ) );
				printf(
					/* translators: %d: number of minutes */
					esc_html( _n( '%d min read', '%d min read', $reading_time, PNFPB_TEXT_DOMAIN ) ),
					esc_html( $reading_time )
				);
				?>
			</span>
		</div><!-- .pnfpb-single-post__meta -->
	</header><!-- .pnfpb-single-post__header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="pnfpb-single-post__featured">
			<?php the_post_thumbnail( 'pnfpb-hero', array( 'loading' => 'eager', 'class' => 'pnfpb-single-post__hero-img' ) ); ?>
			<?php if ( get_the_post_thumbnail_caption() ) : ?>
				<figcaption><?php echo wp_kses_post( get_the_post_thumbnail_caption() ); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<div class="pnfpb-single-post__content entry-content">
		<?php the_content( esc_html__( 'Continue reading', PNFPB_TEXT_DOMAIN ) ); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="pnfpb-page-links">' . esc_html__( 'Pages:', PNFPB_TEXT_DOMAIN ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .pnfpb-single-post__content -->

	<footer class="pnfpb-single-post__footer">
		<?php
		$tags = get_the_tags();
		if ( $tags ) :
		?>
			<div class="pnfpb-single-post__tags">
				<?php echo wp_kses_post( pnfpb_icon( 'tag', array( 'width' => 14, 'height' => 14 ) ) ); ?>
				<?php foreach ( $tags as $tag ) : ?>
					<a class="pnfpb-tag" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">
						<?php echo esc_html( $tag->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<!-- Author bio -->
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="pnfpb-author-bio">
				<div class="pnfpb-author-bio__avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 72, '', '', array( 'class' => 'pnfpb-author-bio__img' ) ); ?>
				</div>
				<div class="pnfpb-author-bio__text">
					<h3 class="pnfpb-author-bio__name"><?php the_author(); ?></h3>
					<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
				</div>
			</div><!-- .pnfpb-author-bio -->
		<?php endif; ?>
	</footer><!-- .pnfpb-single-post__footer -->

</article><!-- #post-<?php the_ID(); ?> -->
