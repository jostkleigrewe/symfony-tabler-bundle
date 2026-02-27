/**
 * DE: Stimulus Controller für Modal mit dynamisch geladenem Content.
 *     Löst das Problem, dass Bootstrap Modal und Turbo Frame nicht gut zusammenarbeiten.
 *
 * EN: Stimulus controller for modal with dynamically loaded content.
 *     Solves the issue that Bootstrap Modal and Turbo Frame don't work well together.
 *
 * Usage:
 *   <!-- Link that opens modal -->
 *   <a href="/path/to/content"
 *      data-controller="modal-frame"
 *      data-modal-frame-modal-value="#myModal"
 *      data-modal-frame-container-value="modal-content-container"
 *      data-action="click->modal-frame#open">
 *       Open Modal
 *   </a>
 *
 *   <!-- Modal structure -->
 *   <div class="modal" id="myModal">
 *       <div class="modal-dialog">
 *           <div class="modal-content" id="modal-content-container">
 *               <!-- Content will be loaded here -->
 *           </div>
 *       </div>
 *   </div>
 */
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        modal: String,      // CSS selector for modal element (e.g. "#myModal")
        container: String,  // ID of container element for content (e.g. "modal-content")
        loadingHtml: { type: String, default: '' },
    };

    /**
     * DE: Modal öffnen und Content laden
     * EN: Open modal and load content
     */
    open(event) {
        event.preventDefault();

        const url = this.element.getAttribute('href');
        if (!url) {
            console.error('modal-frame: No href attribute found');
            return;
        }

        const modal = document.querySelector(this.modalValue);
        const container = document.getElementById(this.containerValue);

        if (!modal) {
            console.error('modal-frame: Modal not found:', this.modalValue);
            return;
        }

        if (!container) {
            console.error('modal-frame: Container not found:', this.containerValue);
            return;
        }

        // DE: Modal öffnen
        // EN: Open modal
        const Modal = window.bootstrap?.Modal;
        if (!Modal) {
            console.error('modal-frame: Bootstrap Modal not available');
            return;
        }

        const bsModal = Modal.getOrCreateInstance(modal);
        bsModal.show();

        // DE: Content laden
        // EN: Load content
        this.loadContent(container, url);
    }

    /**
     * DE: Content via fetch laden
     * EN: Load content via fetch
     */
    async loadContent(container, url) {
        // DE: Loading-State anzeigen
        // EN: Show loading state
        container.innerHTML = this.getLoadingHtml();

        try {
            const response = await fetch(url, {
                headers: {
                    'Accept': 'text/html',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const html = await response.text();

            // DE: Script-Tags entfernen um XSS zu verhindern
            // EN: Remove script tags to prevent XSS
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            doc.querySelectorAll('script').forEach(s => s.remove());
            container.innerHTML = doc.body.innerHTML;

            // DE: Event dispatchen für weitere Verarbeitung
            // EN: Dispatch event for further processing
            this.dispatch('loaded', { detail: { url, container } });

        } catch (error) {
            console.error('modal-frame: Failed to load content:', error);
            container.innerHTML = this.getErrorHtml();
        }
    }

    /**
     * DE: Loading HTML generieren
     * EN: Generate loading HTML
     */
    getLoadingHtml() {
        if (this.hasLoadingHtmlValue && this.loadingHtmlValue) {
            return this.loadingHtmlValue;
        }

        return `
            <div class="modal-body text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
    }

    /**
     * DE: Error HTML generieren
     * EN: Generate error HTML
     */
    getErrorHtml() {
        return `
            <div class="modal-body text-center py-5 text-danger">
                <i class="ti ti-alert-circle fs-1 d-block mb-2"></i>
                <p class="mb-0">Failed to load content.</p>
            </div>
        `;
    }
}
