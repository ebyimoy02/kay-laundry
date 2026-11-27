document.addEventListener('DOMContentLoaded', function () {

    const trigger = document.getElementById('profileDropdownTrigger');
    const menu = document.getElementById('profileDropdownMenu');
    const logoutButton = document.getElementById('profileLogoutButton');
    const existingLogoutButton = document.getElementById('openLogoutModal');
    const accountButton = document.getElementById('openPengaturanAkun');

    // Pastikan elemen menu profil tersedia
    if (!trigger || !menu) {
        return;
    }

    // Buka dan tutup dropdown
    trigger.addEventListener('click', function (event) {
        event.stopPropagation();

        const isOpen = menu.classList.toggle('is-visible');

        trigger.setAttribute('aria-expanded', isOpen);
        menu.setAttribute('aria-hidden', !isOpen);
    });

    // Tutup dropdown ketika area luar diklik
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.admin-profile')) {
            menu.classList.remove('is-visible');
            trigger.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');
        }
    });

    // Tutup dropdown dengan tombol Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            menu.classList.remove('is-visible');
            trigger.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');
        }
    });

    // Buka halaman Pengaturan Akun
    if (accountButton) {
    accountButton.addEventListener('click', function () {
        window.location.href = '/pengaturan-akun';
    });
}

    // Gunakan tombol Logout lama agar modal yang sama tetap digunakan
    if (logoutButton && existingLogoutButton) {
        logoutButton.addEventListener('click', function () {
            menu.classList.remove('is-visible');
            trigger.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');

            existingLogoutButton.click();
        });
    }

});