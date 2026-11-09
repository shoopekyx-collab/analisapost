<?php
/**
 * Main Index / Homepage Template - AnalisaPost
 */

get_header();
?>

<!-- MAIN CONTENT AREA -->
<div class="p-4 md:p-8">
  
  <div class="mb-7 pb-4 border-b border-slate-200">
    <div class="flex items-center gap-3">
      <span class="w-2.5 h-7 bg-red-600 rounded-sm"></span>
      <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
        BERITA TERBARU & INVESTIGASI
      </h2>
    </div>
    <p class="text-xs text-slate-500 mt-1 pl-5">Menyajikan berita terkini, aktual, kritis, dan berimbang</p>
  </div>

  <div class="flex flex-wrap lg:flex-nowrap gap-8 items-start">
    
    <!-- KOLOM KONTEN UTAMA (68%) -->
    <main class="w-full lg:w-[68%] space-y-8">
      
      <?php if ( have_posts() ) : ?>

        <?php
        $post_index = 0;
        $grid_posts = array();
        $list_posts = array();
        $hero_post = null;

        while ( have_posts() ) : the_post();
            $post_index++;
            if ( $post_index === 1 ) {
                $hero_post = get_post();
            } elseif ( $post_index >= 2 && $post_index <= 5 ) {
                $grid_posts[] = get_post();
            } else {
                $list_posts[] = get_post();
            }
        endwhile;
        ?>

        <!-- A. HERO ARTICLE -->
        <?php if ( $hero_post ) : 
            $post = $hero_post;
            setup_postdata( $post );
            $cats = get_the_category();
            $cat_name = ! empty( $cats ) ? $cats[0]->name : 'Berita Utama';
        ?>
          <div class="bg-slate-900 text-white rounded-xl overflow-hidden shadow-md group">
            <div class="grid grid-cols-1 md:grid-cols-12">
              <div class="md:col-span-7 relative h-64 md:h-72 overflow-hidden bg-slate-800">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'editorial-hero', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition duration-500' ) ); ?>
                <?php else : ?>
                  <img src="https://images.unsplash.com/photo-1541872703-74c5e44368f9?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <?php endif; ?>
                <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded shadow-sm tracking-wide">
                  SOROTAN UTAMA
                </span>
              </div>
              <div class="md:col-span-5 p-6 flex flex-col justify-between">
                <div>
                  <span class="text-[11px] font-bold text-red-400 uppercase tracking-wider"><?php echo esc_html( $cat_name ); ?></span>
                  <a href="<?php the_permalink(); ?>">
                    <h3 class="news-title text-base md:text-lg font-bold text-white group-hover:text-red-400 transition mt-2 leading-snug">
                      <?php the_title(); ?>
                    </h3>
                  </a>
                  <p class="text-xs text-slate-300 mt-2.5 line-clamp-3 leading-relaxed">
                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                  </p>
                </div>
                <div class="flex items-center text-[11px] text-slate-400 space-x-2 pt-4 border-t border-slate-800 mt-4">
                  <span class="text-slate-300 font-medium">✍️ <?php the_author(); ?></span>
                  <span>•</span>
                  <span><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' lalu'; ?></span>
                  <span>•</span>
                  <span>⏱️ <?php echo analisapost_reading_time(); ?> mnt baca</span>
                </div>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <!-- B. GRID BERITA 2 KOLOM -->
        <?php if ( ! empty( $grid_posts ) ) : ?>
          <div>
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200">
              <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1.5 h-4 bg-red-600 rounded-xs"></span>
                Daftar Liputan Terbaru
              </h4>
              <span class="text-xs text-slate-400">Diperbarui setiap jam</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <?php foreach ( $grid_posts as $post ) : setup_postdata( $post );
                  $p_cats = get_the_category();
                  $p_cat_name = ! empty( $p_cats ) ? $p_cats[0]->name : 'Peristiwa';
              ?>
                <article class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition group flex flex-col justify-between">
                  <div class="relative h-44 overflow-hidden bg-slate-100">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'editorial-grid', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition duration-300' ) ); ?>
                    <?php else : ?>
                      <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    <?php endif; ?>
                    <span class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-semibold px-2 py-0.5 rounded">
                      <?php echo esc_html( $p_cat_name ); ?>
                    </span>
                  </div>
                  <div class="p-4 flex-1 flex flex-col justify-between">
                    <a href="<?php the_permalink(); ?>">
                      <h5 class="news-title font-bold text-sm text-slate-900 group-hover:text-blue-600 transition leading-snug">
                        <?php the_title(); ?>
                      </h5>
                    </a>
                    <div class="flex items-center text-[11px] text-slate-400 space-x-2 mt-3 pt-2 border-t border-slate-100">
                      <span>🕒 <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' lalu'; ?></span>
                      <span>•</span>
                      <span>⏱️ <?php echo analisapost_reading_time(); ?> mnt baca</span>
                    </div>
                  </div>
                </article>
              <?php endforeach; wp_reset_postdata(); ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- C. GOOGLE ADS IN-FEED -->
        <div class="w-full h-[96px] ad-google rounded-xl flex items-center justify-between px-4 sm:px-6">
          <div>
            <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider bg-blue-50 px-2 py-0.5 rounded">
              <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> GOOGLE ADS (IN-FEED BANNER)
            </span>
            <p class="text-xs font-bold text-slate-800 mt-1">STANDAR IAB: 728 x 90 PX</p>
          </div>
          <span class="text-[10px] text-slate-400 border border-slate-200 px-1.5 py-0.5 rounded bg-white">AdChoices</span>
        </div>

        <!-- D. LIST BERITA HORIZONTAL -->
        <?php if ( ! empty( $list_posts ) ) : ?>
          <div class="space-y-4">
            <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wider mb-2">Liputan Lainnya</h4>
            <?php foreach ( $list_posts as $post ) : setup_postdata( $post ); ?>
              <article class="flex gap-4 p-3.5 rounded-xl border border-slate-100 hover:border-slate-200 hover:bg-slate-50 transition group">
                <div class="w-32 sm:w-36 h-24 overflow-hidden rounded-lg bg-slate-100 flex-shrink-0">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'editorial-list', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                  <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?auto=format&fit=crop&w=300&q=80" class="w-full h-full object-cover">
                  <?php endif; ?>
                </div>
                <div class="flex flex-col justify-between flex-1">
                  <a href="<?php the_permalink(); ?>">
                    <h5 class="news-title font-bold text-slate-900 group-hover:text-blue-600 transition text-sm leading-snug">
                      <?php the_title(); ?>
                    </h5>
                  </a>
                  <div class="flex items-center text-[11px] text-slate-400 space-x-2 mt-2">
                    <span><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' lalu'; ?></span>
                  </div>
                </div>
              </article>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
        <?php endif; ?>

        <!-- E. PAGINATION -->
        <div class="pt-6 border-t border-slate-200 flex items-center justify-between text-xs">
          <?php echo paginate_links(); ?>
        </div>

      <?php else : ?>
        <div class="bg-white p-8 rounded-xl border border-slate-200 text-center">
          <p class="text-slate-500 text-sm">Belum ada berita yang diterbitkan.</p>
        </div>
      <?php endif; ?>

    </main>

    <!-- SIDEBAR KANAN -->
    <?php get_sidebar(); ?>

  </div>

</div>

<?php get_footer(); ?>
