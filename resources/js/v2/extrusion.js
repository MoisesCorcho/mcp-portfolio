/**
 * 2.5D Oblique Axonometric Extrusion Engine for Portfolio V2
 * Inspired by architectural drawing projections and precision workshop CAD blocks.
 * Dynamically computes right facet, bottom facet, border inks, and occluded shadows.
 */

const SVG_NS = 'http://www.w3.org/2000/svg';
const LINE_WIDTH = 1.5;

function computeExtrusion(el) {
    if (!el || !el.isConnected) return;

    let svg = el.querySelector(':scope > svg.v2-extruded-svg');
    if (!svg) {
        svg = document.createElementNS(SVG_NS, 'svg');
        svg.setAttribute('class', 'v2-extruded-svg');
        svg.setAttribute('aria-hidden', 'true');
        el.prepend(svg);
    }

    const w = el.offsetWidth - 0.75;
    const h = el.offsetHeight - 0.75;
    if (w <= 0 || h <= 0) return;

    const isMobile = typeof window !== 'undefined' && window.innerWidth < 640;
    const baseDepth = +(el.dataset.depth || 8);
    const depth = (isMobile && baseDepth > 8) ? 8 : baseDepth;
    const dx = depth;
    const dy = Math.round(depth * 0.72);
    const sd = Math.round(depth * 0.9);

    const rightColor = el.dataset.extRight || 'var(--ext-right, #27272a)';
    const bottomColor = el.dataset.extBottom || 'var(--ext-bottom, #14151b)';
    const borderColor = el.dataset.extBorder || 'var(--ext-border, #52525b)';
    const shadowColor = el.dataset.extShadow || 'var(--ext-shadow, rgba(161, 161, 170, 0.25))';

    svg.setAttribute('width', `${w + dx + sd + 8}`);
    svg.setAttribute('height', `${h + dy + sd + 8}`);

    const ptString = (arr) => arr.map(([x, y]) => `${x.toFixed(1)},${y.toFixed(1)}`).join(' ');

    const silhouette = [
        [0, 0],
        [w, 0],
        [w + dx, dy],
        [w + dx, h + dy],
        [dx, h + dy],
        [0, h]
    ];

    const maskId = `ext-mask-${Math.random().toString(36).substring(2, 9)}`;

    svg.innerHTML = `
        <defs>
            <mask id="${maskId}">
                <rect x="-20" y="-20" width="${w + dx + sd + 60}" height="${h + dy + sd + 60}" fill="#fff"/>
                <polygon points="${ptString(silhouette)}" fill="#000"/>
            </mask>
        </defs>
        <polygon points="${ptString(silhouette.map(([x, y]) => [x + sd, y + sd * 0.8]))}" fill="${shadowColor}" mask="url(#${maskId})"/>
        <polygon points="${ptString([[w, 0], [w + dx, dy], [w + dx, h + dy], [w, h]])}" fill="${rightColor}"/>
        <polygon points="${ptString([[0, h], [w, h], [w + dx, h + dy], [dx, h + dy]])}" fill="${bottomColor}"/>
        <polyline points="${ptString([[w, 0], [w + dx, dy], [w + dx, h + dy], [dx, h + dy], [0, h]])}" fill="none" stroke="${borderColor}" stroke-width="${LINE_WIDTH}" stroke-linejoin="miter"/>
        <line x1="${w.toFixed(1)}" y1="${h.toFixed(1)}" x2="${(w + dx).toFixed(1)}" y2="${(h + dy).toFixed(1)}" stroke="${borderColor}" stroke-width="${LINE_WIDTH}"/>
    `;
}

export function initExtrusions() {
    const elements = [...document.querySelectorAll('[data-extruded]')];
    if (elements.length === 0) return;

    const ro = new ResizeObserver((entries) => {
        entries.forEach((entry) => computeExtrusion(entry.target));
    });

    elements.forEach((el) => {
        computeExtrusion(el);
        ro.observe(el);
    });

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => {
            elements.forEach((el) => computeExtrusion(el));
        });
    }

    // Auto-discover dynamically added elements
    const mo = new MutationObserver((mutations) => {
        let hasNew = false;
        mutations.forEach((m) => {
            m.addedNodes.forEach((node) => {
                if (node.nodeType === 1) {
                    if (node.hasAttribute('data-extruded')) {
                        computeExtrusion(node);
                        ro.observe(node);
                        hasNew = true;
                    }
                    node.querySelectorAll?.('[data-extruded]').forEach((child) => {
                        computeExtrusion(child);
                        ro.observe(child);
                        hasNew = true;
                    });
                }
            });
        });
    });

    mo.observe(document.body, { childList: true, subtree: true });
}

export default initExtrusions;
