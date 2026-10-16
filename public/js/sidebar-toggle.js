document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('sidebarToggle');
    const wrapper = document.querySelector('.dashboard-wrapper');
    const sidebar = document.getElementById('sidebarMenu');

    if (!button || !wrapper || !sidebar) {
        console.error('Elemen hamburger, wrapper, atau sidebar tidak ditemukan.');
        return;
    }

    // Hindari memasang event lebih dari sekali.
    if (button.dataset.sidebarInitialized === 'true') {
        return;
    }

    button.dataset.sidebarInitialized = 'true';

    button.addEventListener('click', function () {
        const collapsed = wrapper.classList.toggle('sidebar-collapsed');

        button.setAttribute('aria-expanded', String(!collapsed));
        button.setAttribute(
            'aria-label',
            collapsed ? 'Buka sidebar' : 'Tutup sidebar'
        );
    });
});
