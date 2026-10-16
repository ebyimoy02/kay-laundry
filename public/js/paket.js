/* =========================================================
   sidebar-toggle.js
   Simpan di: public/js/sidebar-toggle.js
   Membuat tombol hamburger (.toggle-btn) berfungsi:
   - Layar lebar (> 992px): sidebar dilipat jadi ikon saja / dibuka lagi.
     Pilihan diingat (localStorage) dan berlaku di semua halaman.
   - Layar kecil (<= 992px): sidebar muncul sebagai panel di atas konten,
     ditutup lewat klik area gelap, tombol Esc, atau hamburger lagi.
   Cukup tambahkan SATU baris ini di halaman mana pun yang memakai
   sidebar + topbar (Dashboard, Pelanggan, Paket, dst.):
       <script src="{{ asset('js/sidebar-toggle.js') }}"></script>
   CSS yang dibutuhkan disuntikkan oleh file ini sendiri.
   ========================================================= */
(function () {
    'use strict';

    var css = [
        '.sidebar-backdrop{display:none;position:fixed;inset:0;z-index:55;background:rgba(15,30,60,.45)}',
        '.dashboard-page .sidebar{transition:flex-basis .2s ease,width .2s ease}',

        /* Desktop: sidebar dilipat jadi ikon */
        '@media (min-width:993px){',
        '.dashboard-page.sidebar-collapsed .sidebar{flex-basis:76px;width:76px}',
        '.dashboard-page.sidebar-collapsed .sidebar-brand{justify-content:center;padding:0}',
        '.dashboard-page.sidebar-collapsed .sidebar-brand h2,',
        '.dashboard-page.sidebar-collapsed .sidebar-link span{display:none}',
        '.dashboard-page.sidebar-collapsed .sidebar-menu{padding:14px 8px 24px}',
        '.dashboard-page.sidebar-collapsed .sidebar-link{justify-content:center;padding:0}',
        '}',

        /* Layar kecil: sidebar terbuka menjadi panel penuh di atas konten */
        '@media (max-width:992px){',
        '.dashboard-page.sidebar-open .sidebar{position:fixed;top:0;left:0;flex-basis:230px;width:230px;z-index:60;box-shadow:8px 0 30px rgba(4,40,92,.3)}',
        '.dashboard-page.sidebar-open .sidebar-brand{justify-content:flex-start;padding:0 20px}',
        '.dashboard-page.sidebar-open .sidebar-brand h2{display:block}',
        '.dashboard-page.sidebar-open .sidebar-link span{display:inline}',
        '.dashboard-page.sidebar-open .sidebar-menu{padding:14px 10px 24px}',
        '.dashboard-page.sidebar-open .sidebar-link{justify-content:flex-start;padding:0 20px}',
        '.dashboard-page.sidebar-open .sidebar-backdrop{display:block}',
        '.dashboard-page.sidebar-open .main-content{margin-left:76px}',
        '}',
        '@media (max-width:576px){',
        '.dashboard-page.sidebar-open .main-content{margin-left:60px}',
        '}'
    ].join('\n');

    var style = document.createElement('style');
    style.setAttribute('data-sidebar-toggle', '');
    style.textContent = css;
    document.head.appendChild(style);

    var btn = document.querySelector('.dashboard-topbar .toggle-btn');
    var sidebar = document.querySelector('.sidebar');
    if (!btn || !sidebar) { return; }

    var body = document.body;
    var small = window.matchMedia('(max-width: 992px)');
    var STORE_KEY = 'sidebarCollapsed';

    var backdrop = document.createElement('div');
    backdrop.className = 'sidebar-backdrop';
    body.appendChild(backdrop);

    function setOpen(open) {
        body.classList.toggle('sidebar-open', open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    function setCollapsed(collapsed) {
        body.classList.toggle('sidebar-collapsed', collapsed);
        btn.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
        try { localStorage.setItem(STORE_KEY, collapsed ? '1' : '0'); } catch (e) { /* diabaikan */ }
    }

    // Pulihkan pilihan terakhir (desktop)
    try {
        if (!small.matches && localStorage.getItem(STORE_KEY) === '1') {
            body.classList.add('sidebar-collapsed');
            btn.setAttribute('aria-expanded', 'false');
        }
    } catch (e) { /* diabaikan */ }

    btn.setAttribute('aria-label', 'Buka/tutup menu');

    btn.addEventListener('click', function () {
        if (small.matches) {
            setOpen(!body.classList.contains('sidebar-open'));
        } else {
            setCollapsed(!body.classList.contains('sidebar-collapsed'));
        }
    });

    backdrop.addEventListener('click', function () { setOpen(false); });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { setOpen(false); }
    });

    // Ganti ukuran layar: tutup panel geser agar tidak tertinggal terbuka
    var onChange = function () { setOpen(false); };
    if (small.addEventListener) { small.addEventListener('change', onChange); }
    else if (small.addListener) { small.addListener(onChange); }
})();