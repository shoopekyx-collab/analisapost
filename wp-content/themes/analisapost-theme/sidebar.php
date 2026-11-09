<?php
/**
 * Sidebar AnalisaPost
 * Dioptimalkan untuk PHP 8.3
 */
?>
<aside class="w-full lg:w-[32%] space-y-6 mt-8 lg:mt-0">
  
  <!-- SLOT 4: GOOGLE ADS SIDEBAR MEDIUM RECTANGLE (300 x 250) -->
  <div class="w-full max-w-[300px] h-[250px] mx-auto ad-google rounded-xl flex flex-col justify-between p-4 text-center">
    <div class="flex justify-between items-center text-[10px]">
      <span class="font-extrabold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">GOOGLE ADS (SIDEBAR)</span>
      <span class="text-slate-400">AdChoices</span>
    </div>
    <div class="my-auto">
      <p class="text-xs font-bold text-slate-800">MEDIUM RECTANGLE</p>
      <p class="text-[11px] font-bold text-blue-700 mt-0.5">STANDAR IAB: 300 x 250 PX</p>
      <p class="text-[10px] text-slate-500 mt-2 leading-tight">Posisi paling premium di sidebar dengan nilai RPM tertinggi</p>
    </div>
    <span class="text-[9px] text-slate-400">Iklan oleh Google</span>
  </div>

  <!-- WIDGET 1: BERITA TERPOPULER -->
  <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs">
    <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-4">
      <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wider flex items-center gap-2">
        <span class="text-red-600 text-base">🔥</span> TERPOPULER
      </h4>
      <span class="text-[11px] text-slate-400 font-medium">Minggu Ini</span>
    </div>

    <div class="space-y-4">
      <?php
      $popular_args = array(
          'post_type'      => 'post',
          'posts_per_page' => 4,
          'meta_key'       => 'analisapost_views',
          'orderby'        => 'meta_value_num',
          'order'          => 'DESC',
      );
      $popular_query = new WP_Query( $popular_args );
      $rank = 1;

      if ( $popular_query->have_posts() ) :
          while ( $popular_query->have_posts() ) : $popular_query->the_post();
              $badge_color = ( $rank === 1 ) ? 'bg-red-600' : 'bg-slate-700';
      ?>
          <div class="flex items-start gap-3 group cursor-pointer <?php echo ( $rank > 1 ) ? 'pt-3 border-t border-slate-100' : ''; ?>">
            <span class="w-6 h-6 rounded-md <?php echo esc_attr( $badge_color ); ?> text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0 mt-0.5 shadow-xs">
              <?php echo (int) $rank; ?>
            </span>
            <div class="flex-1">
              <a href="<?php the_permalink(); ?>">
                <h5 class="news-title text-xs font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug">
                  <?php the_title(); ?>
                </h5>
              </a>
              <span class="text-[10px] text-slate-400 mt-1 block"><?php echo esc_html( analisapost_get_post_views( (int) get_the_ID() ) ); ?> pembaca</span>
            </div>
          </div>
      <?php
              $rank++;
          endwhile;
          wp_reset_postdata();
      else :
          // Fallback jika belum ada view artikel
          $recent_popular = new WP_Query( array( 'posts_per_page' => 3 ) );
          $rank = 1;
          while ( $recent_popular->have_posts() ) : $recent_popular->the_post();
      ?>
          <div class="flex items-start gap-3 group cursor-pointer <?php echo ( $rank > 1 ) ? 'pt-3 border-t border-slate-100' : ''; ?>">
            <span class="w-6 h-6 rounded-md bg-red-600 text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0 mt-0.5 shadow-xs"><?php echo (int) $rank; ?></span>
            <div class="flex-1">
              <a href="<?php the_permalink(); ?>">
                <h5 class="news-title text-xs font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug"><?php the_title(); ?></h5>
              </a>
              <span class="text-[10px] text-slate-400 mt-1 block"><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></span>
            </div>
          </div>
      <?php
              $rank++;
          endwhile;
          wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>

  <!-- SLOT 5: WIDGET IKLAN BARIS JAWA TIMUR (CLASSIFIED ADS LOKAL) -->
  <div class="ad-baris rounded-xl p-5 shadow-xs">
    <div class="flex items-center justify-between border-b border-emerald-200 pb-2.5 mb-3.5">
      <div class="flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
        <h4 class="font-extrabold text-xs text-emerald-950 uppercase tracking-wide">IKLAN BARIS JAWA TIMUR</h4>
      </div>
      <span class="text-[10px] font-bold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded">Lokal Surabaya</span>
    </div>

    <!-- List Iklan Baris -->
    <div class="space-y-3 text-xs">
      <?php
      $iklan_query = new WP_Query( array(
          'post_type'      => 'iklan_baris',
          'posts_per_page' => 3,
      ) );

      if ( $iklan_query->have_posts() ) :
          while ( $iklan_query->have_posts() ) : $iklan_query->the_post();
              $harga = (string) get_post_meta( get_the_ID(), '_iklan_harga', true );
              $wa = (string) get_post_meta( get_the_ID(), '_iklan_wa', true );
              $clean_wa = (string) preg_replace( '/[^0-9]/', '', $wa );
              if ( str_starts_with( $clean_wa, '0' ) ) {
                  $clean_wa = '62' . substr( $clean_wa, 1 );
              }
      ?>
          <div class="bg-white p-3 rounded-lg border border-emerald-100 shadow-2xs">
            <div class="flex items-center justify-between mb-1">
              <span class="text-[9px] font-extrabold bg-blue-100 text-blue-800 px-1.5 py-0.2 rounded">PROPERTI</span>
              <?php if ( ! empty( $harga ) ) : ?><span class="text-[11px] font-bold text-slate-900"><?php echo esc_html( $harga ); ?></span><?php endif; ?>
            </div>
            <p class="text-slate-800 font-semibold leading-snug"><?php the_title(); ?></p>
            <?php if ( ! empty( $clean_wa ) ) : ?>
            <div class="mt-2 pt-2 border-t border-slate-100 flex justify-between items-center text-[11px]">
              <span class="text-slate-400">Respon Cepat</span>
              <a href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>" target="_blank" rel="noopener" class="text-emerald-700 font-bold hover:underline">💬 Chat WhatsApp →</a>
            </div>
            <?php endif; ?>
          </div>
      <?php
          endwhile;
          wp_reset_postdata();
      else :
          // Contoh Default / Placeholder
      ?>
          <!-- Contoh Properti -->
          <div class="bg-white p-3 rounded-lg border border-emerald-100 shadow-2xs">
            <div class="flex items-center justify-between mb-1">
              <span class="text-[9px] font-extrabold bg-blue-100 text-blue-800 px-1.5 py-0.2 rounded">PROPERTI</span>
              <span class="text-[11px] font-bold text-slate-900">Rp 1,8 M (Nego)</span>
            </div>
            <p class="text-slate-800 font-semibold leading-snug">Dijual Ruko 2 Lantai Siap Usaha di Raya Darmo Surabaya SHM Strategis</p>
            <div class="mt-2 pt-2 border-t border-slate-100 flex justify-between items-center text-[11px]">
              <span class="text-slate-400">Hub: Bpk. Gunawan</span>
              <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="text-emerald-700 font-bold hover:underline">💬 Chat WhatsApp →</a>
            </div>
          </div>

          <!-- Contoh Lowongan -->
          <div class="bg-white p-3 rounded-lg border border-emerald-100 shadow-2xs">
            <div class="flex items-center justify-between mb-1">
              <span class="text-[9px] font-extrabold bg-amber-100 text-amber-800 px-1.5 py-0.2 rounded">LOWONGAN</span>
              <span class="text-[10px] text-slate-500">Surabaya Barat</span>
            </div>
            <p class="text-slate-800 font-semibold leading-snug">Dibutuhkan Staf Admin & Reporter Liputan Daerah Jatim Max 28 Th</p>
            <div class="mt-2 pt-2 border-t border-slate-100 flex justify-between items-center text-[11px]">
              <span class="text-slate-400">Kirim CV Segera</span>
              <a href="https://wa.me/6281378901234" target="_blank" rel="noopener" class="text-emerald-700 font-bold hover:underline">💬 Chat WhatsApp →</a>
            </div>
          </div>
      <?php endif; ?>
    </div>

    <!-- Tombol Pasang Iklan Baris -->
    <div class="mt-3.5 pt-3 border-t border-emerald-200 text-center">
      <a href="https://wa.me/6281234567890?text=Halo%20Redaksi%20AnalisaPost,%20saya%20ingin%20pasang%20iklan%20baris" target="_blank" rel="noopener" class="inline-block w-full py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-bold transition shadow-xs">
        + Pasang Iklan Baris Anda (Mulai Rp 25.000 / Hari)
      </a>
      <span class="text-[10px] text-emerald-800 mt-1.5 block font-medium">Tayang langsung & terhubung ke calon pembeli</span>
    </div>
  </div>

  <!-- SLOT 6: MGID SIDEBAR NATIVE WIDGET (VERTICAL) -->
  <div class="p-4 ad-mgid rounded-xl shadow-2xs">
    <div class="flex justify-between items-center text-[10px] mb-3 border-b border-amber-200/80 pb-1.5">
      <span class="font-extrabold text-amber-900 uppercase">PROMOTED STORIES</span>
      <span class="text-amber-700 font-bold bg-amber-100 px-1.5 py-0.2 rounded text-[9px]">MGID</span>
    </div>
    
    <div class="space-y-3">
      <div class="flex gap-3 bg-white p-2 rounded-lg border border-amber-100 cursor-pointer">
        <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=150&q=80" class="w-16 h-16 object-cover rounded flex-shrink-0">
        <div class="flex flex-col justify-between">
          <p class="text-[11px] font-bold text-slate-800 leading-snug line-clamp-2">Tips Cerdas Kelola Keuangan Usaha Kecil agar Terus Bertumbuh</p>
          <span class="text-[9px] text-amber-700 font-semibold">Sponsor Content</span>
        </div>
      </div>

      <div class="flex gap-3 bg-white p-2 rounded-lg border border-amber-100 cursor-pointer">
        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=150&q=80" class="w-16 h-16 object-cover rounded flex-shrink-0">
        <div class="flex flex-col justify-between">
          <p class="text-[11px] font-bold text-slate-800 leading-snug line-clamp-2">Aplikasi Pendukung Produktivitas Kerja Paling Dicari Tahun Ini</p>
          <span class="text-[9px] text-amber-700 font-semibold">Sponsor Content</span>
        </div>
      </div>
    </div>
  </div>

  <!-- WIDGET 2: TOPIK TERHANGAT (TAG CLOUD) -->
  <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs">
    <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wider mb-3 flex items-center gap-2">
      <span>🏷️</span> TOPIK TERHANGAT
    </h4>
    <div class="flex flex-wrap gap-2 text-xs font-medium">
      <?php
      $tags = get_tags( array( 'number' => 8, 'orderby' => 'count', 'order' => 'DESC' ) );
      if ( ! empty( $tags ) && is_array( $tags ) ) :
          foreach ( $tags as $tag ) :
      ?>
          <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="px-2.5 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-slate-700 transition">
            #<?php echo esc_html( $tag->name ); ?>
          </a>
      <?php
          endforeach;
      else :
      ?>
        <a href="#" class="px-2.5 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-slate-700 transition">#SurabayaTerkini</a>
        <a href="#" class="px-2.5 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-slate-700 transition">#Hukum & Keadilan</a>
        <a href="#" class="px-2.5 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-slate-700 transition">#BansosPangan</a>
        <a href="#" class="px-2.5 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-slate-700 transition">#PilkadaJatim</a>
        <a href="#" class="px-2.5 py-1 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-md text-slate-700 transition">#BMKGUpdate</a>
      <?php endif; ?>
    </div>
  </div>

</aside>
