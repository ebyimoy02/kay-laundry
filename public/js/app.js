
document.addEventListener('alpine:init', function () {
    Alpine.data('laundryLayout', function () {
        return {
            sidebarOpen: true,
            isMobile: window.innerWidth <= 768,

            init() {
                this.sidebarOpen = !this.isMobile;

                this.handleResize = () => {
                    const mobileNow = window.innerWidth <= 768;

                    if (mobileNow !== this.isMobile) {
                        this.isMobile = mobileNow;
                        this.sidebarOpen = !mobileNow;
                    }
                };

                window.addEventListener('resize', this.handleResize);
            },

            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
            },

            closeSidebar() {
                this.sidebarOpen = false;
            },

            closeOnMobile() {
                if (this.isMobile) {
                    this.sidebarOpen = false;
                }
            }
        };
    });
});

document.addEventListener('DOMContentLoaded', function () {
    if (window.lucide) {
        window.lucide.createIcons();
    }
});
