<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package editvetklinikabars
 */

get_header();
?>

	<main id="primary" class="ps-site-main">
		<section class="first_screen first_screen-default" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/4f11f305837eaa2cdfbd2da4984da5e1.png');">
			<div class="container">
				<?php if ( have_posts() ): ?>
					<?php while ( have_posts() ): ?>
						<?php the_post(); ?>
						<main id="content">
							<?php
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumbs--css">','</p>' );
								}
							?>

							<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							<?php endif; ?>
							<div class="page-content ps-page-content">
								<?php echo ps_article_meta_func(); ?>
								 <div class="post-intro">
								  <div class="post-toc">
								    <div id="dynamic-toc">
								      <strong>Оглавление:</strong>
								      <ul></ul>
								    </div>
								  </div>
								  <div class="post-thumbnail">
								    <?php if (has_post_thumbnail()) : ?>
								      <div class="featured-image">
								        <?php the_post_thumbnail('large', ['style' => 'width:100%; border-radius: 10px;']); ?>
								      </div>
								    <?php endif; ?>
								  </div>
								</div>
								<?php the_content(); ?>
								<div class="ps-share">
									<div class="ps-share__main">
										<div class="ps-share__row">
											<div class="ps-share__col ps-share__col_label">
												<div class="ps-share__label">Поделиться:</div>
											</div>
											<div class="ps-share__col ps-share__col_content">
												<div class="ps-share__content">
													<script src="https://yastatic.net/share2/share.js">
													</script>
													<div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp,skype">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

	              <?php $article = get_field('article') ?>
	              <?php $author = $article['author'] ?>
	              <?php if (isset($author['expert']) && !empty($author['expert'])): ?>
	              <div class="ps-author">
	                <div class="ps-author__main">
	                  <div class="ps-author__picture">
	                    <div class="ps-author__pic">
												<?php if ( has_post_thumbnail($author['expert']) ): ?>
													<a href="<?php the_permalink($author['expert']) ?>"><?php echo get_the_post_thumbnail($author['expert'], 'medium'); ?></a>
												<?php else: ?>
													<a href="<?php the_permalink($author['expert']) ?>"><img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/noimg.png" alt="noimg" class="ps-blogcard__noimg"></a>
												<?php endif ?>
	                    </div>
	                  </div>
	                  <div class="ps-author__content">
	                    <div class="ps-author__name">Автор: <b><a href="<?php the_permalink($author['expert']) ?>"><?php echo ps_expert_fio($author['expert']) ?></a></b></div>
	                    <div class="ps-author__description">
												<?php $expert = get_field('expert', $author['expert']) ?>
												<?php if (isset($expert['jobtitle']) && !empty($expert['jobtitle'])): ?>
													<?php echo $expert['jobtitle'] ?>
												<?php endif ?>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            	<?php elseif( isset($author['name']) && !empty($author['name']) ): ?>
	              <div class="ps-author">
	                <div class="ps-author__main">
	                  <div class="ps-author__picture">
	                    <div class="ps-author__pic">
												<?php if ( isset($author['image']['sizes']['medium']) && !empty($author['image']['sizes']['medium']) ): ?>
													<img loading="lazy" src="<?php echo $author['image']['sizes']['medium'] ?>" alt="noimg" class="ps-blogcard__noimg">
												<?php else: ?>
													<img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/noimg.png" alt="noimg" class="ps-blogcard__noimg">
												<?php endif ?>
	                    </div>
	                  </div>
	                  <div class="ps-author__content">
	                    <div class="ps-author__name">Автор: <b><?php echo $author['name'] ?></b></div>
	                    <div class="ps-author__description"><?php echo $author['description'] ?></div>
	                  </div>
	                </div>
	              </div>
	              <?php endif ?>

								<?php if ( function_exists('the_ratings') ): ?>
									<div class="ps-rating">
										<div class="ps-rating__main">
											<div class="ps-rating__title">Оцените материал:</div>
											<div class="ps-rating__content"><?php echo the_ratings('div', 0, false) ?></div>
										</div>
									</div>
								<?php endif ?>

								<?php wp_link_pages(); ?>
							</div>
						</main>
					<?php endwhile ?>
				<?php else: ?>
					<?php get_template_part( 'template-parts/content', 'none' ) ?>
				<?php endif ?>
			</div>
		</section>
<?php
$related_products = get_field('related_products');
if ($related_products) : ?>
<section class="related-products-section">
  <div class="container">
    <h2 class="section-title">Рекомендуемые товары</h2>

    <div class="carousel-container">
      <div class="products-carousel">
        <?php
          foreach ($related_products as $post) :
            setup_postdata($post);
            $product = wc_get_product($post->ID);
            if (!$product) continue;
        ?>
          <article class="product-card">
            <a href="<?php the_permalink(); ?>" class="product-link">
              <div class="product-thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('woocommerce_thumbnail', ['class' => 'product-image']); ?>
                <?php else: ?>
                  <div class="no-image-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
                  </div>
                <?php endif; ?>

                <?php if ($product->is_on_sale()) : ?>
                  <span class="sale-badge">Акция</span>
                <?php endif; ?>
              </div>
            </a>

            <div class="product-title"><?php the_title(); ?></div>

            <div class="product-content">
              <div class="product-meta">
                <div class="product-price">
                  <?php echo $product->get_price_html(); ?>
                </div>

                <?php if ($product->get_average_rating() > 0) : ?>
                  <div class="product-rating">
                    <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                    <span class="review-count">(<?php echo $product->get_review_count(); ?>)</span>
                  </div>
                <?php endif; ?>
              </div>

              <a href="<?php the_permalink(); ?>" class="add-to-cart-btn">Заказать</a>
            </div>
          </article>
        <?php
          endforeach;
          wp_reset_postdata();
        ?>
      </div>

      <button class="carousel-btn prev-btn" aria-label="Предыдущий слайд">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 18L9 12L15 6" stroke="#2A7D69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <button class="carousel-btn next-btn" aria-label="Следующий слайд">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 6L15 12L9 18" stroke="#2A7D69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </div>
</section>
<?php endif; ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/slider.js"></script>


	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
