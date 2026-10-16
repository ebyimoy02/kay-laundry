/* =========================================================
   script.js  -  Halaman Data Transaksi
   ---------------------------------------------------------
   Daftar isi:
   1. Data contoh (ganti dengan data database/API Anda)
   2. Fungsi bantu
   3. Tabel + pencarian + hapus
   4. Pindah tampilan: Data Transaksi <-> Detail Transaksi
   5. Modal Tambah Transaksi
   6. Hamburger menu (sidebar)
   ========================================================= */
(function () {
    'use strict';

    /* ---------------------------------------------------------
       1. DATA CONTOH
       --------------------------------------------------------- */
    var pelanggan = [
        { id: 1, nama: 'Andi Pratama', hp: '081234567890', alamat: 'Jl. Melati No. 10' },
        { id: 2, nama: 'Budi Santoso', hp: '081298765432', alamat: 'Jl. Kenanga No. 5' },
        { id: 3, nama: 'Siti Aminah',  hp: '081355556666', alamat: 'Jl. Mawar No. 20' },
        { id: 4, nama: 'Rudi Hartono', hp: '081377788899', alamat: 'Jl. Anggrek No. 12' },
        { id: 5, nama: 'Dewi Lestari', hp: '081399900011', alamat: 'Jl. Flamboyan No. 3' }
    ];

    var paket = [
        { id: 1, nama: 'Reguler',      harga: 15000, satuan: 'Kg' },
        { id: 2, nama: 'Express',      harga: 25000, satuan: 'Kg' },
        { id: 3, nama: 'Kiloan',       harga: 35000, satuan: 'Kg' },
        { id: 4, nama: 'Cuci Setrika', harga: 20000, satuan: 'Kg' }
    ];

    // Data pertama (TRX001) mengikuti gambar desain: 5 Kg, total Rp 15.000
    var transaksi = [
        { kode: 'TRX001', tanggal: '2025-06-17', pelangganId: 1, paketId: 1, berat: 5,   total: 15000 },
        { kode: 'TRX002', tanggal: '2025-06-17', pelangganId: 2, paketId: 2, berat: 2,   total: 50000 },
        { kode: 'TRX003', tanggal: '2025-06-16', pelangganId: 3, paketId: 3, berat: 3,   total: 105000 },
        { kode: 'TRX004', tanggal: '2025-06-16', pelangganId: 4, paketId: 1, berat: 4,   total: 60000 },
        { kode: 'TRX005', tanggal: '2025-06-15', pelangganId: 5, paketId: 2, berat: 1.5, total: 37500 }
    ];

    /* ---------------------------------------------------------
       2. FUNGSI BANTU
       --------------------------------------------------------- */
    function $(id) { return document.getElementById(id); }

    function rupiah(n) { return 'Rp ' + Math.round(n).toLocaleString('id-ID'); }

    function esc(text) {
        return String(text)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;')
            .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function findById(list, id) {
        for (var i = 0; i < list.length; i++) {
            if (list[i].id === id) { return list[i]; }
        }
        return null;
    }

    function findTransaksi(kode) {
        for (var i = 0; i < transaksi.length; i++) {
            if (transaksi[i].kode === kode) { return transaksi[i]; }
        }
        return null;
    }

    function pad(n) { return (n < 10 ? '0' : '') + n; }

    function formatBerat(n) { return String(n).replace('.', ',') + ' Kg'; }

    // "dd-mm-yyyy" -> "yyyy-mm-dd" (null bila tidak valid)
    function dmyToIso(text) {
        var m = /^(\d{2})-(\d{2})-(\d{4})$/.exec(String(text).trim());
        if (!m) { return null; }
        var d = +m[1], mo = +m[2], y = +m[3];
        var dt = new Date(y, mo - 1, d);
        if (dt.getFullYear() !== y || dt.getMonth() !== mo - 1 || dt.getDate() !== d) { return null; }
        return y + '-' + pad(mo) + '-' + pad(d);
    }

    function isoToDmy(iso) {
        var p = iso.split('-');
        return p[2] + '-' + p[1] + '-' + p[0];
    }

    function todayDmy() {
        var d = new Date();
        return pad(d.getDate()) + '-' + pad(d.getMonth() + 1) + '-' + d.getFullYear();
    }

    /* ---------------------------------------------------------
       3. TABEL + PENCARIAN + HAPUS
       --------------------------------------------------------- */
    var tbody = $('transaksiBody');
    var info = $('transaksiInfo');
    var search = $('searchTransaksi');

    var ICON_EDIT = '<svg viewBox="0 0 24 24"><path d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/><path d="M18.4 2.6a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>';
    var ICON_TRASH = '<svg viewBox="0 0 24 24"><path d="M4 7h16"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M6 7l1 13h10l1-13"/><path d="M9 7V4h6v3"/></svg>';

    function render() {
        var q = search.value.trim().toLowerCase();

        var data = transaksi.filter(function (t) {
            return findById(pelanggan, t.pelangganId).nama.toLowerCase().indexOf(q) !== -1;
        });

        if (!data.length) {
            tbody.innerHTML = '<tr><td colspan="6" class="empty">Data transaksi tidak ditemukan.</td></tr>';
            info.textContent = 'Menampilkan 0 dari 0 data';
            return;
        }

        tbody.innerHTML = data.map(function (t, i) {
            var p = findById(pelanggan, t.pelangganId);
            var k = findById(paket, t.paketId);

            return '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + esc(t.tanggal) + '</td>' +
                '<td><button type="button" class="name-link" data-detail="' + t.kode + '">' + esc(p.nama) + '</button></td>' +
                '<td>' + esc(k.nama) + '</td>' +
                '<td>' + rupiah(k.harga) + '</td>' +
                '<td><div class="actions">' +
                    '<button type="button" class="icon-btn edit" data-detail="' + t.kode + '" title="Lihat detail" aria-label="Lihat detail ' + esc(t.kode) + '">' + ICON_EDIT + '</button>' +
                    '<button type="button" class="icon-btn delete" data-hapus="' + t.kode + '" title="Hapus" aria-label="Hapus ' + esc(t.kode) + '">' + ICON_TRASH + '</button>' +
                '</div></td>' +
            '</tr>';
        }).join('');

        info.textContent = 'Menampilkan 1 - ' + data.length + ' dari ' + data.length + ' data';
    }

    search.addEventListener('input', render);

    // Satu penangkap klik untuk seluruh isi tabel (nama, Edit, Hapus)
    tbody.addEventListener('click', function (e) {
        var detailBtn = e.target.closest('[data-detail]');
        if (detailBtn) {
            showDetail(detailBtn.getAttribute('data-detail'));
            return;
        }

        var hapusBtn = e.target.closest('[data-hapus]');
        if (hapusBtn) {
            var kode = hapusBtn.getAttribute('data-hapus');
            if (confirm('Hapus transaksi ' + kode + '?')) {
                transaksi = transaksi.filter(function (t) { return t.kode !== kode; });
                render();
            }
        }
    });

    /* ---------------------------------------------------------
       4. PINDAH TAMPILAN: DATA TRANSAKSI <-> DETAIL TRANSAKSI
       --------------------------------------------------------- */
    var viewList = $('viewList');
    var viewDetail = $('viewDetail');

    function setText(id, text) { $(id).textContent = text; }

    function showDetail(kode) {
        var t = findTransaksi(kode);
        if (!t) { return; }

        var p = findById(pelanggan, t.pelangganId);
        var k = findById(paket, t.paketId);

        // Card 1: Informasi Transaksi
        setText('dKode', t.kode);
        setText('dTanggal', t.tanggal);
        setText('dPelanggan', p.nama);
        setText('dPaket', k.nama);
        setText('dBerat', formatBerat(t.berat));
        setText('dHarga', rupiah(k.harga));
        setText('dTotal', rupiah(t.total));

        // Card 2: Detail Paket Laundry
        setText('pNama', k.nama);
        setText('pHarga', rupiah(k.harga));
        setText('pSatuan', k.satuan);

        // Card 3: Data Pelanggan
        setText('cNama', p.nama);
        setText('cHp', p.hp);
        setText('cAlamat', p.alamat);

        viewList.hidden = true;
        viewDetail.hidden = false;
        document.title = 'Detail Transaksi - ' + t.kode;
        window.scrollTo(0, 0);
        $('detailTitle').focus();
    }

    function showList() {
        viewDetail.hidden = true;
        viewList.hidden = false;
        document.title = 'Data Transaksi';
        window.scrollTo(0, 0);
    }

    $('btnKembali').addEventListener('click', showList);

    /* ---------------------------------------------------------
       5. MODAL TAMBAH TRANSAKSI
       --------------------------------------------------------- */
    var modal = $('modalTransaksi');
    var form = $('formTransaksi');
    var inputTanggal = $('inputTanggal');
    var picker = $('tanggalPicker');
    var selectPelanggan = $('selectPelanggan');
    var selectPaket = $('selectPaket');
    var inputBerat = $('inputBerat');
    var inputHarga = $('inputHarga');
    var inputTotal = $('inputTotal');
    var lastFocus = null;

    // Isi pilihan dropdown dari data
    pelanggan.forEach(function (p) {
        selectPelanggan.insertAdjacentHTML('beforeend',
            '<option value="' + p.id + '">' + esc(p.nama) + '</option>');
    });

    paket.forEach(function (k) {
        selectPaket.insertAdjacentHTML('beforeend',
            '<option value="' + k.id + '">' + esc(k.nama) + '</option>');
    });

    function parseBerat() {
        var n = parseFloat(inputBerat.value.replace(',', '.'));
        return isNaN(n) ? 0 : n;
    }

    // Harga mengikuti paket terpilih, Total = Harga x Berat
    function hitung() {
        var k = findById(paket, parseInt(selectPaket.value, 10));
        var harga = k ? k.harga : 0;
        inputHarga.value = rupiah(harga);
        inputTotal.value = rupiah(harga * parseBerat());
    }

    function clearErrors() {
        form.querySelectorAll('.field').forEach(function (f) { f.classList.remove('invalid'); });
    }

    function openModal() {
        lastFocus = document.activeElement;
        form.reset();
        clearErrors();
        inputTanggal.value = todayDmy();
        hitung();
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(function () { selectPelanggan.focus(); }, 60);
    }

    function closeModal() {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (lastFocus && lastFocus.focus) { lastFocus.focus(); }
    }

    // Buka modal
    $('btnTambahTransaksi').addEventListener('click', openModal);

    // Tutup modal: tombol "Batal" dan "×"
    modal.querySelectorAll('[data-close-modal]').forEach(function (btn) {
        btn.addEventListener('click', closeModal);
    });

    // Tutup modal: klik area gelap di luar kotak
    modal.addEventListener('click', function (e) {
        if (e.target === modal) { closeModal(); }
    });

    // Tutup modal: tombol Esc
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) { closeModal(); }
    });

    // Harga & Total otomatis
    selectPaket.addEventListener('change', hitung);
    inputBerat.addEventListener('input', function () {
        inputBerat.value = inputBerat.value.replace(/[^\d.,]/g, '');
        hitung();
    });

    // Tanggal: ketik angka saja, tanda "-" ditambahkan otomatis (dd-mm-yyyy)
    inputTanggal.addEventListener('input', function () {
        var d = inputTanggal.value.replace(/\D/g, '').slice(0, 8);
        var out = d.slice(0, 2);
        if (d.length > 2) { out += '-' + d.slice(2, 4); }
        if (d.length > 4) { out += '-' + d.slice(4); }
        inputTanggal.value = out;
    });

    // Ikon kalender membuka pemilih tanggal bawaan browser
    $('btnKalender').addEventListener('click', function () {
        picker.value = dmyToIso(inputTanggal.value) || '';
        try {
            if (picker.showPicker) { picker.showPicker(); }
            else { picker.focus(); picker.click(); }
        } catch (err) {
            picker.focus();
            picker.click();
        }
    });

    picker.addEventListener('change', function () {
        if (picker.value) {
            inputTanggal.value = isoToDmy(picker.value);
            inputTanggal.closest('.field').classList.remove('invalid');
        }
    });

    // Tanda error pada sebuah field hilang begitu field itu diisi/diubah
    ['input', 'change'].forEach(function (evt) {
        form.addEventListener(evt, function (e) {
            var field = e.target.closest('.field');
            if (field) { field.classList.remove('invalid'); }
        });
    });

    // Simpan: validasi, lalu tambahkan ke tabel
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        clearErrors();

        var iso = dmyToIso(inputTanggal.value);
        var pelangganId = parseInt(selectPelanggan.value, 10);
        var paketId = parseInt(selectPaket.value, 10);
        var berat = parseBerat();
        var invalid = [];

        if (!iso) { invalid.push(inputTanggal); }
        if (!pelangganId) { invalid.push(selectPelanggan); }
        if (!paketId) { invalid.push(selectPaket); }
        if (!(berat > 0)) { invalid.push(inputBerat); }

        if (invalid.length) {
            invalid.forEach(function (el) { el.closest('.field').classList.add('invalid'); });
            invalid[0].focus();
            return;
        }

        var maxNo = transaksi.reduce(function (max, t) {
            return Math.max(max, parseInt(t.kode.replace('TRX', ''), 10) || 0);
        }, 0);

        var k = findById(paket, paketId);

        transaksi.unshift({
            kode: 'TRX' + String(maxNo + 1).padStart(3, '0'),
            tanggal: iso,
            pelangganId: pelangganId,
            paketId: paketId,
            berat: berat,
            total: Math.round(k.harga * berat)
        });

        search.value = '';
        render();
        closeModal();
    });

    /* ---------------------------------------------------------
       6. HAMBURGER MENU
       Desktop: sidebar dilipat jadi ikon saja / dibuka lagi.
       Layar kecil: sidebar muncul sebagai panel geser.
       --------------------------------------------------------- */
    var app = $('app');
    var sidebar = $('sidebar');
    var sidebarOverlay = $('sidebarOverlay');
    var small = window.matchMedia('(max-width: 768px)');

    function setSidebarOpen(open) {
        sidebar.classList.toggle('open', open);
        sidebarOverlay.classList.toggle('show', open);
    }

    $('menuBtn').addEventListener('click', function () {
        if (small.matches) {
            setSidebarOpen(!sidebar.classList.contains('open'));
        } else {
            app.classList.toggle('sidebar-collapsed');
        }
    });

    sidebarOverlay.addEventListener('click', function () { setSidebarOpen(false); });

    var onResize = function () { setSidebarOpen(false); };
    if (small.addEventListener) { small.addEventListener('change', onResize); }
    else if (small.addListener) { small.addListener(onResize); }

    /* ---------------------------------------------------------
       MULAI
       --------------------------------------------------------- */
    render();
})();