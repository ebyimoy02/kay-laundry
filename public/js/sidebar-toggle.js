
(function () {
    function initSidebarToggle() {
        const button = document.getElementById('sidebarToggle');
        const wrapper = document.querySelector('.dashboard-wrapper');
        const sidebar = document.getElementById('sidebarMenu');

        if (!button || !wrapper || !sidebar) {
            return;
        }

        // Terapkan kondisi sidebar yang tersimpan.
        const savedState = localStorage.getItem(
            'kayLaundrySidebarCollapsed'
        );

        const isCollapsed = savedState === 'true';

        wrapper.classList.toggle(
            'sidebar-collapsed',
            isCollapsed
        );

        function updateButton(collapsed) {
            button.setAttribute(
                'aria-expanded',
                String(!collapsed)
            );

            button.setAttribute(
                'aria-label',
                collapsed ? 'Buka sidebar' : 'Tutup sidebar'
            );
        }

        updateButton(isCollapsed);

        // Hindari memasang event klik berulang kali.
        if (button.dataset.sidebarToggleReady === 'true') {
            return;
        }

        button.dataset.sidebarToggleReady = 'true';

        button.addEventListener('click', function (event) {
            event.preventDefault();

            const collapsed = !wrapper.classList.contains(
                'sidebar-collapsed'
            );

            wrapper.classList.toggle(
                'sidebar-collapsed',
                collapsed
            );

            localStorage.setItem(
                'kayLaundrySidebarCollapsed',
                String(collapsed)
            );

            updateButton(collapsed);
        });
    }

    // Berfungsi baik jika DOM belum selesai maupun sudah siap.
    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            initSidebarToggle,
            { once: true }
        );
    } else {
        initSidebarToggle();
    }
})();
