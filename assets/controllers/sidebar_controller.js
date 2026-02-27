/**
 * DE: Stimulus Controller für Tabler Sidebar mit Collapse-Funktionalität.
 *     Unterstützt Desktop-Collapse und Mobile-Navigation mit Backdrop.
 *
 * EN: Stimulus controller for Tabler Sidebar with collapse functionality.
 *     Supports desktop collapse and mobile navigation with backdrop.
 *
 * Usage:
 *   <body data-controller="sidebar"
 *         data-sidebar-storage-key-value="my-app-sidebar"
 *         data-sidebar-menu-id-value="sidebar-menu">
 *
 *       <button data-action="click->sidebar#toggle">Toggle Sidebar</button>
 *
 *       <aside class="navbar navbar-vertical">
 *           <div id="sidebar-menu" class="collapse navbar-collapse">
 *               <!-- Navigation items -->
 *           </div>
 *       </aside>
 *   </body>
 */
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        storageKey: { type: String, default: 'tabler-sidebar-state' },
        menuId: { type: String, default: 'sidebar-menu' },
        collapsedClass: { type: String, default: 'sidebar-collapsed' },
        breakpoint: { type: Number, default: 992 },
    };

    connect() {
        this.tooltips = [];

        // DE: Gespeicherten State wiederherstellen
        // EN: Restore saved state
        const state = this.getStoredState();
        if (state === 'collapsed') {
            document.body.classList.add(this.collapsedClassValue);
            this.enableTooltips();
        }

        // DE: Mobile Navigation Setup
        // EN: Mobile navigation setup
        this.setupMobileNavigation();
    }

    disconnect() {
        this.removeMobileBackdrop();
        this.disableTooltips();
    }

    /**
     * DE: Sidebar ein-/ausklappen (Desktop)
     * EN: Toggle sidebar collapse (Desktop)
     */
    toggle() {
        document.body.classList.toggle(this.collapsedClassValue);
        const collapsed = document.body.classList.contains(this.collapsedClassValue);

        this.storeState(collapsed ? 'collapsed' : 'expanded');

        if (collapsed) {
            this.enableTooltips();
        } else {
            this.disableTooltips();
        }
    }

    /**
     * DE: Sidebar ausklappen
     * EN: Expand sidebar
     */
    expand() {
        document.body.classList.remove(this.collapsedClassValue);
        this.storeState('expanded');
        this.disableTooltips();
    }

    /**
     * DE: Sidebar einklappen
     * EN: Collapse sidebar
     */
    collapse() {
        document.body.classList.add(this.collapsedClassValue);
        this.storeState('collapsed');
        this.enableTooltips();
    }

    // --- Mobile Navigation ---

    /**
     * DE: Initialisiert Mobile Navigation mit Backdrop und Event Listeners
     * EN: Initializes mobile navigation with backdrop and event listeners
     */
    setupMobileNavigation() {
        const sidebarMenu = document.getElementById(this.menuIdValue);
        if (!sidebarMenu) return;

        sidebarMenu.addEventListener('show.bs.collapse', () => {
            this.showMobileBackdrop();
        });

        sidebarMenu.addEventListener('hide.bs.collapse', () => {
            this.hideMobileBackdrop();
        });

        // DE: Sidebar-Links schließen mobile Sidebar
        // EN: Sidebar links close mobile sidebar
        const navLinks = sidebarMenu.querySelectorAll('.nav-link:not(.dropdown-toggle)');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < this.breakpointValue) {
                    this.hideMobileSidebar();
                }
            });
        });
    }

    showMobileBackdrop() {
        if (window.innerWidth >= this.breakpointValue) return;

        let backdrop = document.getElementById('sidebar-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.id = 'sidebar-backdrop';
            backdrop.className = 'sidebar-backdrop';
            backdrop.addEventListener('click', () => {
                this.hideMobileSidebar();
            });
            document.body.appendChild(backdrop);
        }

        // DE: Force reflow für Animation
        // EN: Force reflow for animation
        backdrop.offsetHeight;
        backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    hideMobileBackdrop() {
        const backdrop = document.getElementById('sidebar-backdrop');
        if (backdrop) {
            backdrop.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    removeMobileBackdrop() {
        const backdrop = document.getElementById('sidebar-backdrop');
        if (backdrop) {
            backdrop.remove();
            document.body.style.overflow = '';
        }
    }

    hideMobileSidebar() {
        const sidebarMenu = document.getElementById(this.menuIdValue);
        if (!sidebarMenu) return;

        const Collapse = window.bootstrap?.Collapse;
        if (Collapse) {
            const bsCollapse = Collapse.getInstance(sidebarMenu);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }
    }

    // --- State Persistence ---

    getStoredState() {
        try {
            return window.localStorage.getItem(this.storageKeyValue);
        } catch (e) {
            return null;
        }
    }

    storeState(state) {
        try {
            window.localStorage.setItem(this.storageKeyValue, state);
        } catch (e) {
            // DE: Storage nicht verfügbar (z.B. Private Mode)
            // EN: Storage not available (e.g. Private Mode)
        }
    }

    // --- Tooltips (für collapsed state) ---

    enableTooltips() {
        const Tooltip = window.bootstrap?.Tooltip;
        if (!Tooltip) return;

        // DE: Nur innerhalb des Controllers oder mit Selector
        // EN: Only within controller or with selector
        const selector = this.element.tagName === 'BODY'
            ? '.navbar-vertical [data-bs-toggle="tooltip"]'
            : '[data-bs-toggle="tooltip"]';

        const elements = document.querySelectorAll(selector);
        elements.forEach((el) => {
            const instance = Tooltip.getInstance(el) || new Tooltip(el);
            this.tooltips.push(instance);
        });
    }

    disableTooltips() {
        if (this.tooltips.length === 0) return;

        this.tooltips.forEach((tooltip) => {
            try {
                tooltip.dispose();
            } catch (e) {
                // DE: Tooltip bereits entfernt
                // EN: Tooltip already disposed
            }
        });
        this.tooltips = [];
    }
}
