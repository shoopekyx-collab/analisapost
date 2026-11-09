<?php
/**
 * Category Template - AnalisaPost
 * Dioptimalkan untuk PHP 8.3 & WordPress 6.x
 */

get_header();
$current_cat = get_queried_object();
$cat_id = ( $current_cat instanceof \WP_Term ) ? (int) $current_cat->term_id : 0;
?>

<!-- 4. MAIN CONTENT AREA -->
<div class="p-4 md:p-8">
  
  <!-- Breadcrumb & Kategori Header -->
  <div class="mb-7 pb-4 border-b border-slate-200">
    <div class="flex items-center text-xs text-slate-400 space-x-2 mb-2 font-medium">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-blue-600">Beranda</a>
      <span>›</span>
      <span class="text-red-600 font-semibold"><?php single_cat_title(); ?></span>
    </div>
    
    <div class="flex flex-wrap items-end justify-between gap-4">
      <div>
        <div class="flex items-center gap-3">
          <span class="w-2.5 h-7 bg-red-600 rounded-sm"></span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight uppercase">
            <?php single_cat_title(); ?>
          </h2>
        </div>
        <p class="text-xs text-slate-500 mt-1 pl-5">
          <?php echo category_description() ? category_description() : 'Daftar berita terkini, liputan investigasi, dan kabar daerah terpercaya.'; ?>
        </p>
      </div>

      <!-- Sub-Category Filter Pills -->
      <div class="flex items-center space-x-2 text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">
        <?php if ( $cat_id > 0 ) : ?>
          <a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>" class="px-3.5 py-1.5 bg-slate-900 text-white rounded-full shadow-xs">Semua</a>
          <?php
          $subcats = get_categories( array( 'parent' => $cat_id, 'hide_empty' => false ) );
          if ( ! empty( $subcats ) && is_array( $subcats ) ) :
              foreach ( $subcats as $subcat ) :
          ?>
            <a href="<?php echo esc_url( get_category_link( $subcat->term_id ) ); ?>" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-full transition">
              <?php echo esc_html( $subcat->name ); ?>
            </a>
          <?php 
              endforeach;
          endif;
        endif; 
        ?>
      </div>
    </div>
  </div>

  <!-- GRID UTAMA: KONTEN KIRI (68%) + SIDEBAR KANAN (32%) -->
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

        <!-- A. HERO ARTICLE / SOROTAN UTAMA KATEGORI -->
        <?php if ( $hero_post ) : 
            $post = $hero_post;
            setup_postdata( $post );
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
                  <span class="text-[11px] font-bold text-red-400 uppercase tracking-wider"><?php single_cat_title(); ?></span>
                  <a href="<?php the_permalink(); ?>">
                    <h3 class="news-title text-base md:text-lg font-bold text-white group-hover:text-red-400 transition mt-2 leading-snug">
                      <?php the_title(); ?>
                    </h3>
                  </a>
                  <p class="text-xs text-slate-300 mt-2.5 line-clamp-3 leading-relaxed">
                    <?php echo wp_trim_words( (string) get_the_excerpt(), 20, '...' ); ?>
                  </p>
                </div>
                <div class="flex items-center text-[11px] text-slate-400 space-x-2 pt-4 border-t border-slate-800 mt-4">
                  <span class="text-slate-300 font-medium">✍️ <?php the_author(); ?></span>
                  <span>•</span>
                  <span><?php echo human_time_diff( (int) get_the_time('U'), (int) current_time('timestamp') ) . ' lalu'; ?></span>
                  <span>•</span>
                  <span>⏱️ <?php echo (int) analisapost_reading_time(); ?> mnt baca</span>
                </div>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <!-- B. GRID BERITA REGULER (2 KOLOM RAPI & LEGA) -->
        <?php if ( ! empty( $grid_posts ) ) : ?>
          <div>
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200">
              <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1.5 h-4 bg-red-600 rounded-xs"></span>
                Daftar Liputan Terbaru
              </h4>
              <span class="text-xs text-slate-400">Diperbarui berkala</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <?php foreach ( $grid_posts as $post ) : setup_postdata( $post ); ?>
                <article class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition group flex flex-col justify-between">
                  <div class="relative h-44 overflow-hidden bg-slate-100">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'editorial-grid', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition duration-300' ) ); ?>
                    <?php else : ?>
                      <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    <?php endif; ?>
                    <span class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-semibold px-2 py-0.5 rounded">
                      <?php single_cat_title(); ?>
                    </span>
                  </div>
                  <div class="p-4 flex-1 flex flex-col justify-between">
                    <a href="<?php the_permalink(); ?>">
                      <h5 class="news-title font-bold text-sm text-slate-900 group-hover:text-blue-600 transition leading-snug">
                        <?php the_title(); ?>
                      </h5>
                    </a>
                    <div class="flex items-center text-[11px] text-slate-400 space-x-2 mt-3 pt-2 border-t border-slate-100">
                      <span>🕒 <?php echo human_time_diff( (int) get_the_time('U'), (int) current_time('timestamp') ) . ' lalu'; ?></span>
                      <span>•</span>
                      <span>⏱️ <?php echo (int) analisapost_reading_time(); ?> mnt baca</span>
                    </div>
                  </div>
                </article>
              <?php endforeach; wp_reset_postdata(); ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- C. SLOT 2: GOOGLE ADS IN-FEED BANNER (728 x 90) -->
        <div class="w-full h-[96px] ad-google rounded-xl flex items-center justify-between px-4 sm:px-6">
          <div>
            <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider bg-blue-50 px-2 py-0.5 rounded">
              <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> GOOGLE ADS (IN-FEED BANNER)
            </span>
            <p class="text-xs font-bold text-slate-800 mt-1">STANDAR IAB: 728 x 90 PX (LEADERBOARD IN-FEED)</p>
            <p class="text-[10px] text-slate-500 hidden sm:block">Ramping & elegan — menghasilkan CTR tinggi tanpa memotong alur baca artikel</p>
          </div>
          <div class="text-right">
            <span class="text-[10px] text-slate-400 border border-slate-200 px-1.5 py-0.5 rounded bg-white">AdChoices</span>
          </div>
        </div>

        <!-- D. LIST ARTIKEL HORIZONTAL -->
        <?php if ( ! empty( $list_posts ) ) : ?>
          <div class="space-y-4">
            <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wider mb-2">Liputan Terkait Lainnya</h4>
            
            <?php foreach ( $list_posts as $post ) : setup_postdata( $post ); ?>
              <article class="flex gap-4 p-3.5 rounded-xl border border-slate-100 hover:border-slate-200 hover:bg-slate-50 transition group">
                <div class="w-32 sm:w-36 h-24 overflow-hidden rounded-lg bg-slate-100 flex-shrink-0">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'editorial-list', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition' ) ); ?>
                  <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?auto=format&fit=crop&w=300&q=80" class="w-full h-full object-cover">
                  <?php endif; ?>
                </div>
                <div class="flex flex-col justify-between flex-1">
                  <div>
                    <span class="text-[10px] font-bold text-red-600 uppercase"><?php single_cat_title(); ?></span>
                    <a href="<?php the_permalink(); ?>">
                      <h5 class="news-title font-bold text-slate-900 group-hover:text-blue-600 transition text-sm mt-0.5 leading-snug">
                        <?php the_title(); ?>
                      </h5>
                    </a>
                  </div>
                  <div class="flex items-center text-[11px] text-slate-400 space-x-2 mt-2">
                    <span><?php echo human_time_diff( (int) get_the_time('U'), (int) current_time('timestamp') ) . ' lalu'; ?></span>
                    <span>•</span>
                    <span>⏱️ <?php echo (int) analisapost_reading_time(); ?> mnt baca</span>
                  </div>
                </div>
              </article>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
        <?php endif; ?>

        <!-- E. SLOT 3: MGID NATIVE AD WIDGET -->
        <div class="ad-mgid rounded-xl p-5 shadow-2xs">
          <div class="flex items-center justify-between border-b border-amber-200/80 pb-2 mb-4">
            <div class="flex items-center gap-2">
              <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
              <h4 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider">KONTEN SPONSOR & REKOMENDASI</h4>
            </div>
            <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded uppercase">Promoted by MGID</span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-2.5 rounded-xl border border-amber-100 shadow-2xs cursor-pointer hover:shadow-sm transition">
              <div class="h-28 bg-slate-200 rounded-lg overflow-hidden mb-2">
                <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
              </div>
              <p class="text-xs font-bold text-slate-800 line-clamp-2 leading-snug">Cara Baru Hasilkan Penghasilan Tambahan dari Rumah</p>
              <span class="text-[10px] text-amber-700 font-semibold mt-1.5 block">Sponsor • Pelajari Lebih Lanjut</span>
            </div>

            <div class="bg-white p-2.5 rounded-xl border border-amber-100 shadow-2xs cursor-pointer hover:shadow-sm transition">
              <div class="h-28 bg-slate-200 rounded-lg overflow-hidden mb-2">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
              </div>
              <p class="text-xs font-bold text-slate-800 line-clamp-2 leading-snug">Gawai Pintar Terbaru 2026 Ini Jadi Rebutan di Indonesia</p>
              <span class="text-[10px] text-amber-700 font-semibold mt-1.5 block">Sponsor • Promo Spesial</span>
            </div>

            <div class="bg-white p-2.5 rounded-xl border border-amber-100 shadow-2xs cursor-pointer hover:shadow-sm transition">
              <div class="h-28 bg-slate-200 rounded-lg overflow-hidden mb-2">
                <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
              </div>
              <p class="text-xs font-bold text-slate-800 line-clamp-2 leading-snug">Dokter Spesialis Ungkap Rahasia Menjaga Stamina</p>
              <span class="text-[10px] text-amber-700 font-semibold mt-1.5 block">Sponsor • Baca Selengkapnya</span>
            </div>
          </div>
        </div>

        <!-- F. PAGINATION -->
        <div class="pt-6 border-t border-slate-200 flex items-center justify-between text-xs">
          <?php
          echo paginate_links( array(
              'prev_text' => '« Sebelumnya',
              'next_text' => 'Berikutnya »',
              'type'      => 'plain',
          ) );
          ?>
        </div>

      <?php else : ?>
        <div class="bg-white p-8 rounded-xl border border-slate-200 text-center">
          <p class="text-slate-500 text-sm">Belum ada berita dalam kategori ini.</p>
        </div>
      <?php endif; ?>

    </main>

    <!-- SIDEBAR KANAN (32%) -->
    <?php get_sidebar(); ?>

  </div>

</div>

<?php get_footer(); ?>
