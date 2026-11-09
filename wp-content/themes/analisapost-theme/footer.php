  <!-- 5. FOOTER LENGKAP -->
  <footer class="bg-[#0B1528] text-slate-300 pt-10 pb-6 px-4 md:px-8 border-t-4 border-red-600 mt-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-slate-800 text-xs">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <span class="text-2xl font-extrabold text-white">Analisa<span class="text-red-500">Post</span></span>
        </div>
        <p class="text-slate-400 leading-relaxed">
          Media online independen yang menyajikan informasi aktual, kritis, berimbang, dan berpegang teguh pada kode etik jurnalistik.
        </p>
      </div>
      <div>
        <h5 class="text-white font-bold uppercase tracking-wider mb-3">Redaksi & Perusahaan</h5>
        <ul class="space-y-2 text-slate-400">
          <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
          <li><a href="#" class="hover:text-white transition">Susunan Redaksi</a></li>
          <li><a href="#" class="hover:text-white transition">Pedoman Media Siber</a></li>
          <li><a href="#" class="hover:text-white transition">Info Iklan & Kerja Sama</a></li>
        </ul>
      </div>
      <div>
        <h5 class="text-white font-bold uppercase tracking-wider mb-3">Kategori Berita</h5>
        <ul class="space-y-2 text-slate-400">
          <?php
          $footer_cats = get_categories( array( 'number' => 4, 'hide_empty' => false ) );
          foreach ( $footer_cats as $fcat ) :
          ?>
            <li><a href="<?php echo esc_url( get_category_link( $fcat->term_id ) ); ?>" class="hover:text-white transition"><?php echo esc_html( $fcat->name ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <h5 class="text-white font-bold uppercase tracking-wider mb-3">Kontak & Jaringan</h5>
        <p class="text-slate-400 leading-relaxed mb-3">
          Surabaya, Jawa Timur - Indonesia<br>
          Email: redaksi@analisapost.com
        </p>
        <div class="flex space-x-2">
          <a href="#" class="w-6 h-6 bg-slate-800 rounded flex items-center justify-center text-xs font-bold text-slate-300 hover:bg-red-600 transition">f</a>
          <a href="#" class="w-6 h-6 bg-slate-800 rounded flex items-center justify-center text-xs font-bold text-slate-300 hover:bg-red-600 transition">𝕏</a>
          <a href="#" class="w-6 h-6 bg-slate-800 rounded flex items-center justify-center text-xs font-bold text-slate-300 hover:bg-red-600 transition">ig</a>
          <a href="#" class="w-6 h-6 bg-slate-800 rounded flex items-center justify-center text-xs font-bold text-slate-300 hover:bg-red-600 transition">yt</a>
        </div>
      </div>
    </div>
    <div class="pt-5 flex flex-wrap justify-between items-center text-xs text-slate-500 gap-3">
      <p>© <?php echo date('Y'); ?> AnalisaPost. All rights reserved. Simple and Independent.</p>
      <div class="flex space-x-4">
        <a href="#" class="hover:text-slate-300 transition">Privacy Policy</a>
        <a href="#" class="hover:text-slate-300 transition">Terms of Use</a>
        <a href="#" class="hover:text-slate-300 transition">Pedoman Hak Cipta</a>
      </div>
    </div>
  </footer>

</div><!-- End Wrapper Utama -->

<?php wp_footer(); ?>
</body>
</html>
