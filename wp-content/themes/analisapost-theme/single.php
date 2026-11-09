<?php
/**
 * Single Post Template - AnalisaPost
 * Dioptimalkan untuk PHP 8.3 & WordPress 6.x
 */

get_header();
?>

<div class="p-4 md:p-8">
  
  <?php while ( have_posts() ) : the_post(); 
      $categories = get_the_category();
      $cat_name = ( ! empty( $categories ) && isset( $categories[0]->name ) ) ? $categories[0]->name : 'Berita';
      $cat_link = ( ! empty( $categories ) && isset( $categories[0]->term_id ) ) ? get_category_link( $categories[0]->term_id ) : home_url();
  ?>

    <!-- Breadcrumb -->
    <div class="flex items-center text-xs text-slate-400 space-x-2 mb-4 font-medium">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-blue-600">Beranda</a>
      <span>›</span>
      <a href="<?php echo esc_url( $cat_link ); ?>" class="hover:text-blue-600"><?php echo esc_html( $cat_name ); ?></a>
      <span>›</span>
      <span class="text-slate-600 truncate max-w-xs"><?php the_title(); ?></span>
    </div>

    <!-- 2 KOLOM: ARTIKEL (68%) + SIDEBAR (32%) -->
    <div class="flex flex-wrap lg:flex-nowrap gap-8 items-start">
      
      <!-- KOLOM BACA ARTIKEL -->
      <article class="w-full lg:w-[68%] bg-white rounded-xl border border-slate-200 p-6 md:p-8 shadow-xs">
        
        <!-- Kategori & Judul -->
        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-extrabold rounded-full uppercase tracking-wider mb-3">
          <?php echo esc_html( $cat_name ); ?>
        </span>

        <h1 class="news-title text-2xl md:text-4xl font-extrabold text-slate-950 tracking-tight leading-tight mb-4">
          <?php the_title(); ?>
        </h1>

        <!-- Metadata Wartawan & Waktu -->
        <div class="flex flex-wrap items-center justify-between gap-3 py-3 border-y border-slate-100 text-xs text-slate-500 mb-6">
          <div class="flex items-center space-x-3">
            <span class="font-bold text-slate-800">✍️ <?php the_author(); ?></span>
            <span>•</span>
            <span>📅 <?php echo esc_html( get_the_date( 'l, j F Y H:i' ) ); ?> WIB</span>
            <span>•</span>
            <span>⏱️ <?php echo (int) analisapost_reading_time(); ?> mnt baca</span>
          </div>
          <span class="text-slate-400">Dilihat: <?php echo esc_html( analisapost_get_post_views( (int) get_the_ID() ) ); ?> kali</span>
        </div>

        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="rounded-xl overflow-hidden mb-6 bg-slate-900">
            <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
            <?php if ( get_the_post_thumbnail_caption() ) : ?>
              <p class="text-[11px] text-slate-400 p-2 text-center bg-slate-900">
                📷 <?php echo esc_html( get_the_post_thumbnail_caption() ); ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <!-- KONTEN ARTIKEL -->
        <div class="prose prose-slate max-w-none text-slate-800 text-base leading-relaxed space-y-4">
          <?php the_content(); ?>
        </div>

        <!-- GOOGLE ADS IN-ARTICLE (300 x 250 / 728 x 90) -->
        <div class="my-8 p-4 ad-google rounded-xl text-center">
          <span class="text-[9px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">GOOGLE ADS IN-ARTICLE</span>
          <p class="text-xs font-bold text-slate-700 mt-1">RESPONSIVE AD DISPLAY</p>
          <span class="text-[9px] text-slate-400 block mt-0.5">Iklan oleh Google</span>
        </div>

        <!-- TAGS -->
        <?php
        $tags = get_the_tags();
        if ( ! empty( $tags ) && is_array( $tags ) ) :
        ?>
          <div class="mt-8 pt-4 border-t border-slate-200">
            <span class="text-xs font-bold text-slate-700 block mb-2">Topik Terkait:</span>
            <div class="flex flex-wrap gap-2">
              <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="px-3 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-xs font-medium text-slate-700 transition">
                  #<?php echo esc_html( $tag->name ); ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- MGID NATIVE UNDER-ARTICLE WIDGET -->
        <div class="mt-10 pt-6 border-t-2 border-slate-100">
          <div class="ad-mgid rounded-xl p-5 shadow-2xs">
            <div class="flex items-center justify-between border-b border-amber-200/80 pb-2 mb-4">
              <span class="font-extrabold text-xs text-slate-900 uppercase">KONTEN REKOMENDASI SPONSOR</span>
              <span class="text-[9px] font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded uppercase">MGID</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div class="bg-white p-2 rounded-lg border border-amber-100">
                <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded mb-2">
                <p class="text-xs font-bold text-slate-800 line-clamp-2">Tips Praktis Meningkatkan Pendapatan di Era Digital</p>
                <span class="text-[9px] text-amber-600 block mt-1">Sponsor Content</span>
              </div>
              <div class="bg-white p-2 rounded-lg border border-amber-100">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded mb-2">
                <p class="text-xs font-bold text-slate-800 line-clamp-2">Inovasi Gadget Teranyar yang Ramai Dibahas Pekan Ini</p>
                <span class="text-[9px] text-amber-600 block mt-1">Sponsor Content</span>
              </div>
              <div class="bg-white p-2 rounded-lg border border-amber-100">
                <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded mb-2">
                <p class="text-xs font-bold text-slate-800 line-clamp-2">Cara Menjaga Kesehatan Mata bagi Pekerja Depan Layar</p>
                <span class="text-[9px] text-amber-600 block mt-1">Sponsor Content</span>
              </div>
            </div>
          </div>
        </div>

      </article>

      <!-- SIDEBAR KANAN -->
      <?php get_sidebar(); ?>

    </div>

  <?php endwhile; ?>

</div>

<?php get_footer(); ?>
