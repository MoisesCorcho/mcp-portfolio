/**
 * 2.5D Oblique Axonometric Extrusion Engine for Portfolio V2
 * Inspired by architectural drawing projections and precision workshop CAD blocks.
 * Dynamically computes right facet, bottom facet, border inks, and occluded shadows.
 * Optimized: Coalesced RAF batching, zero Forced Synchronous Layout, dimension caching.
 */

const SVG_NS = 'http://www.w3.org/2000/svg';
const LINE_WIDTH = 1.5;

function computeExtrusion(el, targetW = null, targetH = null) {
    if (!el || !el.isConnected) return;

    const rawW = targetW !== null ? targetW : el.offsetWidth;
    const rawH = targetH !== null ? targetH : el.offsetHeight;
    if (rawW <= 0 || rawH <= 0) return;

    const w = rawW - 0.75;
    const h = rawH - 0.75;

    // Cache check: avoid re-rendering SVG if dimensions haven't changed
    const sizeKey = `${w.toFixed(1)}x${h.toFixed(1)}`;
    if (el._extLastSize === sizeKey) return;
    el._extLastSize = sizeKey;

    let svg = el.querySelector(':scope > svg.v2-extruded-svg');
    if (!svg) {
        svg = document.createElementNS(SVG_NS, 'svg');
        svg.setAttribute('class', 'v2-extruded-svg');
        svg.setAttribute('aria-hidden', 'true');
        el.prepend(svg);
    }

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

    let rafId = null;
    const pendingUpdates = new Map();

    const processBatch = () => {
        rafId = null;
        pendingUpdates.forEach(({ w, h }, el) => {
            computeExtrusion(el, w, h);
        });
        pendingUpdates.clear();
    };

    const scheduleUpdate = (el, w = null, h = null) => {
        pendingUpdates.set(el, { w, h });
        if (!rafId) {
            rafId = requestAnimationFrame(processBatch);
        }
    };

    const ro = new ResizeObserver((entries) => {
        for (const entry of entries) {
            const w = entry.borderBoxSize?.[0]?.inlineSize ?? entry.contentRect.width;
            const h = entry.borderBoxSize?.[0]?.blockSize ?? entry.contentRect.height;
            scheduleUpdate(entry.target, w, h);
        }
    });

    elements.forEach((el) => {
        scheduleUpdate(el);
        ro.observe(el);
    });

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => {
            elements.forEach((el) => {
                delete el._extLastSize;
                scheduleUpdate(el);
            });
        });
    }

    // Auto-discover dynamically added elements
    const mo = new MutationObserver((mutations) => {
        for (const m of mutations) {
            for (const node of m.addedNodes) {
                if (node.nodeType === 1) {
                    if (node.hasAttribute('data-extruded')) {
                        scheduleUpdate(node);
                        ro.observe(node);
                    }
                    node.querySelectorAll?.('[data-extruded]').forEach((child) => {
                        scheduleUpdate(child);
                        ro.observe(child);
                    });
                }
            }
        }
    });

    mo.observe(document.body, { childList: true, subtree: true });
}

export default initExtrusions;
