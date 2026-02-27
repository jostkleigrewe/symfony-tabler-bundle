// DE: Stimulus Controller für CollapsiblePanel
// EN: Stimulus controller for CollapsiblePanel

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['button', 'content', 'chevron'];
    static values = {
        expanded: { type: Boolean, default: false }
    };

    connect() {
        this.updateState();
    }

    toggle() {
        this.expandedValue = !this.expandedValue;
        this.updateState();
    }

    expand() {
        this.expandedValue = true;
        this.updateState();
    }

    collapse() {
        this.expandedValue = false;
        this.updateState();
    }

    updateState() {
        const isExpanded = this.expandedValue;

        // DE: ARIA-Attribute aktualisieren // EN: Update ARIA attributes
        if (this.hasButtonTarget) {
            this.buttonTarget.setAttribute('aria-expanded', isExpanded.toString());
        }

        // DE: Content ein-/ausblenden // EN: Show/hide content
        if (this.hasContentTarget) {
            this.contentTarget.classList.toggle('d-none', !isExpanded);
        }

        // DE: Chevron rotieren // EN: Rotate chevron
        if (this.hasChevronTarget) {
            this.chevronTarget.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
            this.chevronTarget.style.transition = 'transform 0.2s ease';
        }
    }
}
