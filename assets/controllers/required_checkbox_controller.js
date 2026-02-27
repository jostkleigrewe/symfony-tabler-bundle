import { Controller } from '@hotwired/stimulus';

/**
 * DE: Stimulus Controller für Pflicht-Checkboxen die nicht abgewählt werden können.
 *     Wird automatisch von ChoiceCardType/EntityCardType verwendet.
 *
 * EN: Stimulus controller for required checkboxes that cannot be unchecked.
 *     Automatically used by ChoiceCardType/EntityCardType.
 *
 * Usage:
 *   <label data-controller="required-checkbox">
 *       <input type="checkbox" data-required-checkbox-target="checkbox" checked>
 *   </label>
 */
export default class extends Controller {
    static targets = ['checkbox'];

    connect() {
        // DE: Sicherstellen, dass die Checkbox beim Connect gecheckt ist
        // EN: Ensure checkbox is checked on connect
        if (this.hasCheckboxTarget && !this.checkboxTarget.checked) {
            this.checkboxTarget.checked = true;
        }
    }

    // DE: Verhindert das Abwählen der Checkbox
    // EN: Prevents unchecking the checkbox
    prevent(event) {
        if (this.hasCheckboxTarget && this.checkboxTarget.checked) {
            event.preventDefault();
            event.stopPropagation();
        }
    }

    // DE: Stellt sicher, dass die Checkbox immer checked bleibt
    // EN: Ensures the checkbox always stays checked
    enforce(event) {
        if (this.hasCheckboxTarget && !this.checkboxTarget.checked) {
            event.preventDefault();
            this.checkboxTarget.checked = true;
        }
    }
}
