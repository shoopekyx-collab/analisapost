<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <style>
    .news-title { line-height: 1.35; }
    .ad-google { background: #FAFAFA; border: 1.5px dashed #4285F4; }
    .ad-mgid { background: #FFFDF7; border: 1.5px dashed #F59E0B; }
    .ad-baris { background: #F0FDF4; border: 1.5px solid #22C55E; }
  </style>
</head>
<body <?php body_class( 'bg-slate-50 text-slate-800 antialiased' ); ?>>
<?php wp_body_open(); ?>

<!-- WRAPPER UTAMA SITUS -->
<div class="max-w-[1380px] mx-auto bg-white shadow-xl min-h-screen border-x border-slate-200">
  
  <!-- 1. TOP UTILITY BAR -->
  <div class="bg-slate-900 text-slate-300 text-xs px-4 md:px-8 py-2.5 flex justify-between items-center border-b border-slate-800">
    <div class="flex items-center space-x-3 overflow-x-auto whitespace-nowrap">
      <span class="text-slate-400 font-medium hidden sm:inline">📅 <?php echo date_i18n( 'l, j F Y' ); ?></span>
      <span class="text-slate-700 hidden sm:inline">|</span>
      <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase">Trending</span>
      <div class="flex space-x-3 text-slate-300 font-medium text-xs">
        <a href="<?php echo esc_url( home_url( '/?s=Pilkada' ) ); ?>" class="hover:text-white">#PilkadaJatim</a>
        <a href="<?php echo esc_url( home_url( '/?s=Investasi' ) ); ?>" class="hover:text-white">#InvestasiSurabaya</a>
        <a href="<?php echo esc_url( home_url( '/?s=Harga+Emas' ) ); ?>" class="hover:text-white">#HargaEmasAntam</a>
        <a href="<?php echo esc_url( home_url( '/?s=BMKG' ) ); ?>" class="hover:text-white">#CuacaBMKG</a>
      </div>
    </div>
    <div class="hidden md:flex items-center space-x-4 text-xs">
      <span class="text-slate-400">Media Online Independen • Surabaya, Jawa Timur</span>
      <span class="text-slate-700">|</span>
      <div class="flex space-x-2 text-slate-300 font-bold text-[11px]">
        <a href="#" class="w-5 h-5 bg-slate-800 rounded flex items-center justify-center hover:bg-red-600 transition">f</a>
        <a href="#" class="w-5 h-5 bg-slate-800 rounded flex items-center justify-center hover:bg-red-600 transition">𝕏</a>
        <a href="#" class="w-5 h-5 bg-slate-800 rounded flex items-center justify-center hover:bg-red-600 transition">in</a>
        <a href="#" class="w-5 h-5 bg-slate-800 rounded flex items-center justify-center hover:bg-red-600 transition">yt</a>
      </div>
    </div>
  </div>

  <!-- 2. BRANDING & GOOGLE ADS LEADERBOARD (728 x 90) -->
  <header class="px-4 md:px-8 py-5 flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 bg-white">
    <!-- Logo -->
    <div>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 group">
        <span class="text-3xl font-extrabold tracking-tight text-slate-950 font-sans">
          Analisa<span class="text-red-600">Post</span>
        </span>
        <span class="bg-red-600 text-white text-[9px] font-extrabold px-1.5 py-0.5 rounded uppercase tracking-wider">News</span>
      </a>
      <p class="text-[11px] text-slate-500 font-semibold tracking-wider uppercase mt-0.5">Simple and Independent</p>
    </div>

    <!-- SLOT 1: GOOGLE ADS LEADERBOARD HEADER (728 x 90) -->
    <div class="w-full lg:w-[728px] h-[90px] ad-google rounded-xl flex items-center justify-between px-4 sm:px-6">
      <div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider bg-blue-50 px-2 py-0.5 rounded">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> GOOGLE ADS (LEADERBOARD)
        </span>
        <p class="text-xs font-bold text-slate-800 mt-1">UKURAN STANDAR IAB: 728 x 90 PX</p>
        <p class="text-[10px] text-slate-400 hidden sm:block">Slot Iklan Utama Banner Atas — Format Resmi Google AdSense</p>
      </div>
      <div class="text-right">
        <span class="text-[10px] text-slate-400 border border-slate-200 px-1.5 py-0.5 rounded bg-white">Iklan</span>
      </div>
    </div>
  </header>

  <!-- 3. MAIN NAVBAR MENU -->
  <nav class="bg-[#0B1528] text-white px-4 md:px-8 sticky top-0 z-40 shadow-md">
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-1 text-sm font-semibold tracking-wide overflow-x-auto whitespace-nowrap scrollbar-none py-1 md:py-0">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="px-3.5 py-3.5 <?php echo is_front_page() ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800'; ?> transition">HOME</a>
        
        <?php
        $categories = get_categories( array( 'number' => 6, 'hide_empty' => false ) );
        foreach ( $categories as $cat ) :
            $is_current = is_category( $cat->term_id );
            $active_class = $is_current ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800';
        ?>
          <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="px-3.5 py-3.5 <?php echo esc_attr( $active_class ); ?> transition uppercase">
            <?php echo esc_html( $cat->name ); ?>
          </a>
        <?php endforeach; ?>

        <!-- Menu Khusus Iklan Baris -->
        <a href="<?php echo esc_url( get_post_type_archive_link( 'iklan_baris' ) ); ?>" class="px-3.5 py-3.5 text-emerald-400 hover:text-emerald-300 hover:bg-slate-800 transition flex items-center gap-1 font-bold">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> IKLAN BARIS
        </a>
      </div>

      <!-- Kolom Pencarian -->
      <div class="hidden lg:flex items-center space-x-2 pl-4">
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <div class="relative">
            <input type="search" name="s" placeholder="Cari berita..." class="bg-slate-800/90 text-xs text-white placeholder-slate-400 pl-7 pr-3 py-1.5 rounded-full border border-slate-700 focus:outline-none focus:border-red-500 w-44">
            <span class="absolute left-2.5 top-1.5 text-slate-400 text-xs">🔍</span>
          </div>
        </form>
      </div>
    </div>
  </nav>
