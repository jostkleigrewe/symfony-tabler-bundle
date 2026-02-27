/**
 * DE: Stimulus Controller für Clipboard-Operationen.
 *     Generische Copy-to-Clipboard Funktionalität für verschiedene Anwendungsfälle.
 *
 * EN: Stimulus controller for clipboard operations.
 *     Generic copy-to-clipboard functionality for various use cases.
 *
 * Usage:
 *   <!-- Simple: Copy from text value -->
 *   <button data-controller="clipboard"
 *           data-clipboard-text-value="Text to copy"
 *           data-action="click->clipboard#copy">
 *       Copy
 *   </button>
 *
 *   <!-- From source element -->
 *   <div data-controller="clipboard">
 *       <pre data-clipboard-target="source">Code here</pre>
 *       <button data-action="click->clipboard#copy">Copy</button>
 *   </div>
 *
 *   <!-- Multiple sources (code + curl) -->
 *   <div data-controller="clipboard">
 *       <pre data-clipboard-target="source">code</pre>
 *       <pre data-clipboard-target="sourceCurl" class="d-none">curl command</pre>
 *       <button data-action="click->clipboard#copy" data-clipboard-mode-param="code">Copy Code</button>
 *       <button data-action="click->clipboard#copy" data-clipboard-mode-param="curl">Copy cURL</button>
 *   </div>
 *
 *   <!-- With icon/text feedback (for CodeBlock component) -->
 *   <div data-controller="clipboard">
 *       <pre data-clipboard-target="source">code</pre>
 *       <button data-action="click->clipboard#copy">
 *           <i data-clipboard-target="icon" class="ti ti-copy"></i>
 *           <span data-clipboard-target="text">Copy</span>
 *       </button>
 *   </div>
 */
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['source', 'sourceCurl', 'button', 'icon', 'text'];

    static values = {
        text: String,
        separator: String,
        successText: { type: String, default: 'Copied!' },
        successDuration: { type: Number, default: 2000 },
    };

    async copy(event) {
        const button = event?.currentTarget;
        let text = this.getTextToCopy(event);

        if (!text) {
            console.warn('Clipboard: No text to copy');
            return;
        }

        // DE: Separator durch Newlines ersetzen
        // EN: Replace separator with newlines
        if (this.hasSeparatorValue && this.separatorValue) {
            text = text.split(this.separatorValue).join('\n');
        }

        try {
            await navigator.clipboard.writeText(text);
            this.showSuccess(button);
        } catch (err) {
            // DE: Fallback für ältere Browser
            // EN: Fallback for older browsers
            this.fallbackCopy(text, button);
        }
    }

    getTextToCopy(event) {
        // DE: 1. Priorität: text-Value
        // EN: 1. Priority: text value
        if (this.hasTextValue && this.textValue) {
            return this.textValue;
        }

        // DE: 2. Priorität: Mode-basierte Source (code/curl)
        // EN: 2. Priority: Mode-based source (code/curl)
        const mode = event?.params?.mode || 'code';

        if (mode === 'curl' && this.hasSourceCurlTarget) {
            return this.getTargetText(this.sourceCurlTarget);
        }

        // DE: 3. Priorität: Standard source Target
        // EN: 3. Priority: Default source target
        if (this.hasSourceTarget) {
            return this.getTargetText(this.sourceTarget);
        }

        return null;
    }

    getTargetText(element) {
        // DE: Input/Textarea haben .value, andere .textContent
        // EN: Input/Textarea have .value, others .textContent
        return element.value || element.textContent || element.innerText;
    }

    /**
     * DE: Fallback-Methode für Browser ohne Clipboard API
     * EN: Fallback method for browsers without Clipboard API
     */
    fallbackCopy(text, button) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-9999px';
        textArea.style.top = '0';
        document.body.appendChild(textArea);
        textArea.select();

        try {
            document.execCommand('copy');
            this.showSuccess(button);
        } catch (err) {
            console.error('Clipboard fallback failed:', err);
            this.showError(button);
        }

        document.body.removeChild(textArea);
    }

    showSuccess(button) {
        // DE: Verschiedene Feedback-Modi unterstützen
        // EN: Support different feedback modes

        // Modus 1: Icon + Text Targets (für CodeBlock)
        if (this.hasIconTarget && this.hasTextTarget) {
            this.showIconTextFeedback(true);
            return;
        }

        // Modus 2: Button-basiertes Feedback
        if (button) {
            this.showButtonFeedback(button, true);
        }
    }

    showError(button) {
        if (this.hasIconTarget && this.hasTextTarget) {
            this.showIconTextFeedback(false);
            return;
        }

        if (button) {
            this.showButtonFeedback(button, false);
        }
    }

    /**
     * DE: Feedback über Icon + Text Targets (CodeBlock-Stil)
     * EN: Feedback via icon + text targets (CodeBlock style)
     */
    showIconTextFeedback(success) {
        const originalIcon = this.iconTarget.className;
        const originalText = this.textTarget.textContent;

        if (success) {
            this.iconTarget.className = 'ti ti-check text-success';
            this.textTarget.textContent = this.successTextValue;
            this.textTarget.classList.add('text-success');
        } else {
            this.iconTarget.className = 'ti ti-x text-danger';
            this.textTarget.textContent = 'Error';
            this.textTarget.classList.add('text-danger');
        }

        setTimeout(() => {
            this.iconTarget.className = originalIcon;
            this.textTarget.textContent = originalText;
            this.textTarget.classList.remove('text-success', 'text-danger');
        }, this.successDurationValue);
    }

    /**
     * DE: Feedback über Button-Styling
     * EN: Feedback via button styling
     */
    showButtonFeedback(button, success) {
        // DE: Original-Inhalt als DocumentFragment speichern (sicher, kein innerHTML)
        // EN: Save original content as DocumentFragment (safe, no innerHTML)
        const originalNodes = Array.from(button.childNodes).map(n => n.cloneNode(true));
        const originalClasses = [...button.classList];

        // DE: Button-Inhalt sicher via DOM-API ersetzen (kein innerHTML = kein XSS)
        // EN: Replace button content safely via DOM API (no innerHTML = no XSS)
        const icon = document.createElement('i');
        icon.className = success ? 'ti ti-check me-1' : 'ti ti-x me-1';

        button.textContent = '';
        button.appendChild(icon);
        button.append(success ? ' ' + this.successTextValue : ' Error');
        button.classList.remove('btn-outline-secondary', 'btn-outline-primary', 'btn-primary');
        button.classList.add(success ? 'btn-success' : 'btn-danger');

        setTimeout(() => {
            button.textContent = '';
            originalNodes.forEach(n => button.appendChild(n));
            button.classList.remove('btn-success', 'btn-danger');
            // DE: Original-Klassen wiederherstellen
            // EN: Restore original classes
            originalClasses.forEach(c => {
                if (c.startsWith('btn-')) button.classList.add(c);
            });
        }, this.successDurationValue);
    }
}
