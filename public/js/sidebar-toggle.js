(function () {
    function initSidebarToggle() {
        const button = document.getElementById('sidebarToggle');
        const wrapper = document.querySelector('.dashboard-wrapper');
        const sidebar = document.getElementById('sidebarMenu');

        if (!button || !wrapper || !sidebar) {
            return;
        }

        const mobileQuery = window.matchMedia('(max-width: 800px)');

        // Ambil kondisi sidebar desktop yang tersimpan.
        const savedState = localStorage.getItem(
            'kayLaundrySidebarCollapsed'
        );

        const isCollapsed = savedState === 'true';

        wrapper.classList.toggle(
            'sidebar-collapsed',
            isCollapsed
        );

        function isMobile() {
            return mobileQuery.matches;
        }

        function updateButton() {
            if (isMobile()) {
                const isOpen = wrapper.classList.contains(
                    'mobile-sidebar-open'
                );

                button.setAttribute('aria-expanded', String(isOpen));
                button.setAttribute(
                    'aria-label',
                    isOpen ? 'Tutup menu' : 'Buka menu'
                );
            } else {
                const collapsed = wrapper.classList.contains(
                    'sidebar-collapsed'
                );

                button.setAttribute('aria-expanded', String(!collapsed));
                button.setAttribute(
                    'aria-label',
                    collapsed ? 'Buka sidebar' : 'Tutup sidebar'
                );
            }
        }

        function closeMobileSidebar() {
            wrapper.classList.remove('mobile-sidebar-open');
            updateButton();
        }

        updateButton();

        // Hindari memasang event klik berulang kali.
        if (button.dataset.sidebarToggleReady === 'true') {
            return;
        }

        button.dataset.sidebarToggleReady = 'true';

        button.addEventListener('click', function (event) {
            event.preventDefault();

            if (isMobile()) {
                // HP: buka atau tutup panel sidebar.
                wrapper.classList.toggle('mobile-sidebar-open');
            } else {
                // Desktop: pertahankan fungsi sidebar lama.
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
            }

            updateButton();
        });

        // Tutup sidebar HP setelah menu dipilih.
        sidebar.addEventListener('click', function (event) {
            if (
                isMobile() &&
                event.target.closest('a')
            ) {
                closeMobileSidebar();
            }
        });

        // Tutup sidebar HP dengan tombol Escape.
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && isMobile()) {
                closeMobileSidebar();
            }
        });

        // Tutup sidebar ketika ukuran layar kembali ke desktop.
        mobileQuery.addEventListener('change', function () {
            wrapper.classList.remove('mobile-sidebar-open');
            updateButton();
        });
    }

    // Jalankan setelah DOM siap.
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