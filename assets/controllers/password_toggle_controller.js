/**
 * Password Toggle Controller
 *
 * DE: Stimulus Controller zum Ein-/Ausblenden von Passwörtern.
 *     Wechselt zwischen type="password" und type="text".
 *     Tabler Icons: ti-eye (sichtbar) / ti-eye-off (versteckt).
 *
 * EN: Stimulus Controller for showing/hiding passwords.
 *     Toggles between type="password" and type="text".
 *     Tabler Icons: ti-eye (visible) / ti-eye-off (hidden).
 *
 * Usage:
 *     <div data-controller="jostkleigrewe--tabler-bundle--password-toggle">
 *         <input type="password" data-jostkleigrewe--tabler-bundle--password-toggle-target="input">
 *         <button type="button" data-action="jostkleigrewe--tabler-bundle--password-toggle#toggle">
 *             <i data-jostkleigrewe--tabler-bundle--password-toggle-target="icon" class="ti ti-eye-off"></i>
 *         </button>
 *     </div>
 */
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'icon'];

    /**
     * DE: Initialer Zustand - Passwort ist versteckt
     * EN: Initial state - password is hidden
     */
    connect() {
        this.visible = false;
        this.updateIcon();
    }

    /**
     * DE: Toggle zwischen sichtbar/versteckt
     * EN: Toggle between visible/hidden
     */
    toggle(event) {
        event.preventDefault();
        this.visible = !this.visible;

        if (this.hasInputTarget) {
            this.inputTarget.type = this.visible ? 'text' : 'password';
        }

        this.updateIcon();
        this.updateAriaState(event.currentTarget);
    }

    /**
     * DE: Icon aktualisieren basierend auf Zustand
     * EN: Update icon based on state
     */
    updateIcon() {
        if (!this.hasIconTarget) return;

        // DE: ti-eye = sichtbar, ti-eye-off = versteckt
        // EN: ti-eye = visible, ti-eye-off = hidden
        this.iconTarget.classList.remove('ti-eye', 'ti-eye-off');
        this.iconTarget.classList.add(this.visible ? 'ti-eye' : 'ti-eye-off');
    }

    /**
     * DE: ARIA-Attribute für Accessibility aktualisieren
     * EN: Update ARIA attributes for accessibility
     */
    updateAriaState(button) {
        if (!button) return;

        button.setAttribute('aria-pressed', this.visible ? 'true' : 'false');
        button.setAttribute(
            'aria-label',
            this.visible ? 'Passwort verbergen' : 'Passwort anzeigen'
        );
    }
}
