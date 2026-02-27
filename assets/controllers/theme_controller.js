import { Controller } from '@hotwired/stimulus';

/**
 * DE: Theme Controller - Dark/Light Mode + Farbschema
 * EN: Theme Controller - Dark/Light mode + color scheme
 *
 * @see Jostkleigrewe\TablerBundle\Twig\Components\ThemePicker
 *
 * Supports:
 * - Dark/Light/Auto mode switching (data-bs-theme)
 * - Color theme switching (data-theme="eurip|forest|sunset|ocean|purple|rose")
 */
export default class extends Controller {
    static targets = ['option', 'label', 'icon', 'indicator', 'autoIndicator', 'themeOption', 'currentTheme'];

    static values = {
        themes: { type: Array, default: ['eurip', 'forest', 'sunset', 'ocean', 'purple', 'rose'] },
        modeStorageKey: { type: String, default: 'tabler-theme-mode' },
        themeStorageKey: { type: String, default: 'tabler-theme-color' }
    };

    connect() {
        this.media = window.matchMedia('(prefers-color-scheme: dark)');
        this.mode = this.getStoredMode() || 'auto';

        // DE: Farbschema laden
        // EN: Load color scheme
        this.theme = this.getStoredTheme() || 'eurip';
        this.applyTheme(this.theme, false);

        this.applyMode(this.mode);

        this.onMediaChange = () => {
            if (this.mode === 'auto') {
                this.applyMode('auto');
            }
        };

        if (this.media.addEventListener) {
            this.media.addEventListener('change', this.onMediaChange);
        } else {
            this.media.addListener(this.onMediaChange);
        }
    }

    disconnect() {
        if (!this.media) {
            return;
        }

        if (this.media.removeEventListener) {
            this.media.removeEventListener('change', this.onMediaChange);
        } else {
            this.media.removeListener(this.onMediaChange);
        }
    }

    choose(event) {
        const mode = event.currentTarget.dataset.themeValue;
        this.applyMode(mode);
        this.storeMode(mode);
    }

    // DE: Toggle zwischen Light und Dark (für Switch-Style)
    // EN: Toggle between light and dark (for switch style)
    toggle() {
        const current = document.documentElement.getAttribute('data-bs-theme');
        const newMode = current === 'dark' ? 'light' : 'dark';
        this.applyMode(newMode);
        this.storeMode(newMode);
    }

    // DE: Zyklisch durch Light → Dark → Auto → Light...
    // EN: Cycle through Light → Dark → Auto → Light...
    cycle() {
        const cycleOrder = ['light', 'dark', 'auto'];
        const currentIndex = cycleOrder.indexOf(this.mode);
        const nextIndex = (currentIndex + 1) % cycleOrder.length;
        const newMode = cycleOrder[nextIndex];

        this.applyMode(newMode);
        this.storeMode(newMode);
    }

    applyMode(mode) {
        this.mode = mode;
        const resolved = mode === 'auto' ? (this.media.matches ? 'dark' : 'light') : mode;

        // DE: Theme setzen
        // EN: Set theme
        document.documentElement.setAttribute('data-bs-theme', resolved);

        // DE: Mode-Attribut für CSS (wichtig für Auto-Erkennung)
        // EN: Mode attribute for CSS (important for auto detection)
        if (mode === 'auto') {
            document.documentElement.setAttribute('data-theme-mode', 'auto');
        } else {
            document.documentElement.removeAttribute('data-theme-mode');
        }

        this.updateOptions(mode);
        this.updateLabel(mode);
        this.updateIndicator(mode);
    }

    updateOptions(mode) {
        if (!this.hasOptionTarget) {
            return;
        }

        this.optionTargets.forEach((option) => {
            const active = option.dataset.themeValue === mode;
            option.classList.toggle('active', active);
            option.setAttribute('aria-pressed', active ? 'true' : 'false');
        });
    }

    updateLabel(mode) {
        const labelMap = { light: 'Hell', dark: 'Dunkel', auto: 'Auto' };
        const iconMap = { light: 'ti ti-sun', dark: 'ti ti-moon', auto: 'ti ti-device-laptop' };

        if (this.hasLabelTarget) {
            this.labelTarget.textContent = labelMap[mode] || 'Auto';
        }

        if (this.hasIconTarget) {
            this.iconTarget.className = iconMap[mode] || iconMap.auto;
            this.iconTarget.classList.add('me-2');
        }
    }

    // DE: Indicator-Position für Tristate aktualisieren
    // EN: Update indicator position for tristate
    updateIndicator(mode) {
        if (this.hasIndicatorTarget) {
            // DE: Setze data-mode auf dem Parent für CSS
            // EN: Set data-mode on parent for CSS
            this.element.setAttribute('data-mode', mode);
        }
    }

    // =========================================================================
    // COLOR THEME METHODS
    // =========================================================================

    /**
     * DE: Farbschema wählen
     * EN: Select color theme
     */
    selectTheme(event) {
        const theme = event.currentTarget.dataset.theme;
        if (theme && this.themesValue.includes(theme)) {
            this.applyTheme(theme, true);
        }
    }

    /**
     * DE: Farbschema anwenden
     * EN: Apply color theme
     */
    applyTheme(theme, save = true) {
        this.theme = theme;
        document.documentElement.setAttribute('data-theme', theme);

        if (save) {
            this.storeTheme(theme);
        }

        this.updateThemeOptions(theme);
        this.dispatch('themeChanged', { detail: { theme } });
    }

    /**
     * DE: Theme-Options UI aktualisieren
     * EN: Update theme options UI
     */
    updateThemeOptions(theme) {
        if (this.hasThemeOptionTarget) {
            this.themeOptionTargets.forEach((option) => {
                const isActive = option.dataset.theme === theme;
                option.classList.toggle('theme-selector__option--active', isActive);
                option.setAttribute('aria-pressed', isActive);
            });
        }

        if (this.hasCurrentThemeTarget) {
            const labels = {
                'eurip': 'EURIP',
                'forest': 'Forest',
                'sunset': 'Sunset',
                'ocean': 'Ocean',
                'purple': 'Purple',
                'rose': 'Rose'
            };
            this.currentThemeTarget.textContent = labels[theme] || theme;
        }
    }

    // =========================================================================
    // STORAGE METHODS
    // =========================================================================

    getStoredMode() {
        try {
            return window.localStorage.getItem(this.modeStorageKeyValue);
        } catch (e) {
            return null;
        }
    }

    storeMode(mode) {
        try {
            window.localStorage.setItem(this.modeStorageKeyValue, mode);
        } catch (e) {
            // ignore storage errors
        }
    }

    getStoredTheme() {
        try {
            return window.localStorage.getItem(this.themeStorageKeyValue);
        } catch (e) {
            return null;
        }
    }

    storeTheme(theme) {
        try {
            window.localStorage.setItem(this.themeStorageKeyValue, theme);
        } catch (e) {
            // ignore storage errors
        }
    }
}
