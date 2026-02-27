/**
 * Password Strength Controller
 *
 * DE: Stimulus Controller zur Visualisierung der Passwort-Stärke.
 *     Zeigt einen Balken mit 4 Stufen: schwach, mittel, stark, sehr stark.
 *     Prüft: Länge, Groß-/Kleinbuchstaben, Zahlen, Sonderzeichen.
 *
 * EN: Stimulus Controller for visualizing password strength.
 *     Shows a bar with 4 levels: weak, fair, strong, very strong.
 *     Checks: length, upper/lowercase, numbers, special characters.
 *
 * Usage:
 *     <div data-controller="jostkleigrewe--tabler-bundle--password-strength">
 *         <input type="password" data-jostkleigrewe--tabler-bundle--password-strength-target="input">
 *         <div class="tabler-fl-strength" data-jostkleigrewe--tabler-bundle--password-strength-target="meter">
 *             <div class="tabler-fl-strength-bar"></div>
 *             <div class="tabler-fl-strength-bar"></div>
 *             <div class="tabler-fl-strength-bar"></div>
 *             <div class="tabler-fl-strength-bar"></div>
 *         </div>
 *         <span data-jostkleigrewe--tabler-bundle--password-strength-target="label"></span>
 *     </div>
 */
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'meter', 'label'];

    // DE: Stärke-Stufen mit Labels und CSS-Klassen
    // EN: Strength levels with labels and CSS classes
    static levels = [
        { min: 0, class: '', label: '' },
        { min: 1, class: 'strength-weak', label: 'Schwach' },
        { min: 2, class: 'strength-fair', label: 'Mittel' },
        { min: 3, class: 'strength-strong', label: 'Stark' },
        { min: 4, class: 'strength-very-strong', label: 'Sehr stark' },
    ];

    connect() {
        if (this.hasInputTarget) {
            this.inputTarget.addEventListener('input', this.evaluate.bind(this));
            // DE: Initial-Check falls Feld bereits Wert hat
            // EN: Initial check if field already has value
            this.evaluate();
        }
    }

    disconnect() {
        if (this.hasInputTarget) {
            this.inputTarget.removeEventListener('input', this.evaluate.bind(this));
        }
    }

    /**
     * DE: Bewertet die Passwort-Stärke und aktualisiert die UI
     * EN: Evaluates password strength and updates the UI
     */
    evaluate() {
        const password = this.hasInputTarget ? this.inputTarget.value : '';
        const score = this.calculateScore(password);
        this.updateUI(score);
    }

    /**
     * DE: Berechnet Score basierend auf Kriterien (0-4)
     * EN: Calculates score based on criteria (0-4)
     */
    calculateScore(password) {
        if (!password) return 0;

        let score = 0;

        // DE: Mindestlänge 8 Zeichen
        // EN: Minimum length 8 characters
        if (password.length >= 8) score++;

        // DE: Enthält Groß- UND Kleinbuchstaben
        // EN: Contains upper AND lowercase letters
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;

        // DE: Enthält Zahlen
        // EN: Contains numbers
        if (/\d/.test(password)) score++;

        // DE: Enthält Sonderzeichen
        // EN: Contains special characters
        if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) score++;

        return score;
    }

    /**
     * DE: Aktualisiert Meter-Balken und Label
     * EN: Updates meter bars and label
     */
    updateUI(score) {
        const level = this.constructor.levels[score] || this.constructor.levels[0];

        // DE: Meter-Balken aktualisieren
        // EN: Update meter bars
        if (this.hasMeterTarget) {
            const bars = this.meterTarget.querySelectorAll('.tabler-fl-strength-bar');

            // DE: Alle Klassen entfernen
            // EN: Remove all classes
            this.meterTarget.classList.remove(
                'strength-weak',
                'strength-fair',
                'strength-strong',
                'strength-very-strong'
            );

            // DE: Aktuelle Klasse setzen
            // EN: Set current class
            if (level.class) {
                this.meterTarget.classList.add(level.class);
            }

            // DE: Balken aktivieren basierend auf Score
            // EN: Activate bars based on score
            bars.forEach((bar, index) => {
                bar.classList.toggle('active', index < score);
            });
        }

        // DE: Label aktualisieren
        // EN: Update label
        if (this.hasLabelTarget) {
            this.labelTarget.textContent = level.label;
            this.labelTarget.className = 'tabler-fl-strength-label';
            if (level.class) {
                this.labelTarget.classList.add(level.class);
            }
        }
    }
}
