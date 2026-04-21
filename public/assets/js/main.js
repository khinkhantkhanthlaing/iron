/**
 * IronPDF for C++ — Beta Landing Page
 * main.js  |  Pure ES6 — no jQuery dependency
 *
 * Responsibilities:
 *  1. Flash-alert auto-dismiss & manual close
 *  2. Client-side email validation with accessible inline feedback
 *  3. Prevent double-submit on the sign-up form
 */

'use strict';

/* ─────────────────────────────────────────────────────────────────────────────
   1. Flash-alert handling
   ───────────────────────────────────────────────────────────────────────────── */
(function initFlashAlerts() {
    const alert = document.getElementById('js-flash-msg');
    if (!alert) return;

    // Auto-dismiss after 6 s
    const autoDismissTimer = setTimeout(() => dismissAlert(alert), 6000);

    // Manual dismiss via × button
    const closeBtn = alert.querySelector('.btn-close-alert');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            clearTimeout(autoDismissTimer);
            dismissAlert(alert);
        });
    }

    /**
     * Fade-out then remove the alert element from the DOM.
     * @param {HTMLElement} el
     */
    function dismissAlert(el) {
        el.style.transition = 'opacity 300ms ease, transform 300ms ease';
        el.style.opacity    = '0';
        el.style.transform  = 'translateY(-8px)';
        setTimeout(() => el.remove(), 320);
    }
}());


/* ─────────────────────────────────────────────────────────────────────────────
   2. Sign-up form — client-side validation & UX feedback
   ───────────────────────────────────────────────────────────────────────────── */
(function initSignupForm() {
    const form      = document.querySelector('.signup-form');
    if (!form) return;

    const emailInput = form.querySelector('#signup-email');
    const submitBtn  = form.querySelector('.btn-signup');

    if (!emailInput || !submitBtn) return;

    // Inline error element (created once, reused)
    const errorEl = createErrorEl();
    const formGroup = emailInput.closest('.signup-form-group');
    (formGroup || emailInput).insertAdjacentElement('afterend', errorEl);

    // ── Validate on blur ──────────────────────────────────────────────────
    emailInput.addEventListener('blur', () => {
        validateEmail(emailInput, errorEl);
    });

    // ── Clear error while user types ─────────────────────────────────────
    emailInput.addEventListener('input', () => {
        setError(emailInput, errorEl, '');
    });

    // ── Prevent double-submit ─────────────────────────────────────────────
    form.addEventListener('submit', (e) => {
        const valid = validateEmail(emailInput, errorEl);
        if (!valid) {
            e.preventDefault();
            emailInput.focus();
            return;
        }
        // Disable button to prevent re-submissions
        submitBtn.disabled = true;
        submitBtn.setAttribute('aria-busy', 'true');
        const originalHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending…';

        // Re-enable after 8 s as a safety net (e.g. slow connection)
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.removeAttribute('aria-busy');
            submitBtn.innerHTML = originalHTML;
        }, 8000);
    });

    /* ── Helpers ─────────────────────────────────────────────────────────── */

    /**
     * Validate the email field.  Returns true if valid.
     * @param {HTMLInputElement} input
     * @param {HTMLElement}      errEl
     * @returns {boolean}
     */
    function validateEmail(input, errEl) {
        const val = input.value.trim();

        if (!val) {
            setError(input, errEl, 'Email address is required.');
            return false;
        }

        // RFC-5322 simplified pattern
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
        if (!pattern.test(val)) {
            setError(input, errEl, 'Please enter a valid email address.');
            return false;
        }

        setError(input, errEl, '');
        return true;
    }

    /**
     * Set or clear the inline error message and ARIA attributes.
     * @param {HTMLInputElement} input
     * @param {HTMLElement}      errEl
     * @param {string}           message   — empty string to clear error
     */
    function setError(input, errEl, message) {
        if (message) {
            errEl.textContent    = message;
            errEl.hidden         = false;
            input.setAttribute('aria-invalid', 'true');
            input.setAttribute('aria-describedby', 'email-error email-hint');
        } else {
            errEl.textContent    = '';
            errEl.hidden         = true;
            input.setAttribute('aria-invalid', 'false');
            input.setAttribute('aria-describedby', 'email-hint');
        }
    }

    /**
     * Create the accessible inline-error element.
     * @returns {HTMLElement}
     */
    function createErrorEl() {
        const el      = document.createElement('p');
        el.id         = 'email-error';
        el.className  = 'signup-inline-error';
        el.setAttribute('role', 'alert');
        el.setAttribute('aria-live', 'polite');
        el.hidden     = true;
        return el;
    }
}());


/* ─────────────────────────────────────────────────────────────────────────────
   3. Smooth-reveal on scroll  (Intersection Observer — no layout jank)
   ───────────────────────────────────────────────────────────────────────────── */
(function initScrollReveal() {
    // Respect reduced-motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const targets = document.querySelectorAll(
        '.hero-content-wrap, .hero-right-image, .col-lg-8'
    );

    if (!targets.length || !('IntersectionObserver' in window)) return;

    // Start elements invisible
    targets.forEach((el) => {
        el.style.opacity   = '0';
        el.style.transform = 'translateY(24px)';
        el.style.transition = 'opacity 600ms ease, transform 600ms ease';
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity   = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 }
    );

    targets.forEach((el) => observer.observe(el));
}());
