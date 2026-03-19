import './bootstrap';

import Alpine from 'alpinejs';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { animate, stagger } from 'motion';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
Alpine.start();

// ─── Utility: split text into char spans ─────────────────────────────────────
function splitTextToChars(el) {
    const text = el.textContent.trim();
    el.innerHTML = '';
    el.setAttribute('aria-label', text);
    return text.split('').map((char) => {
        const span = document.createElement('span');
        span.textContent = char === ' ' ? '\u00A0' : char;
        span.style.display = 'inline-block';
        span.setAttribute('aria-hidden', 'true');
        el.appendChild(span);
        return span;
    });
}

// ─── Hero Animations ──────────────────────────────────────────────────────────
function initHeroAnimations() {
    const heroSection = document.querySelector('#hero-section');
    if (!heroSection) return;

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    // Navbar entrance
    tl.from('.site-navbar', { y: -80, opacity: 0, duration: 0.8 }, 0);

    // Tag line badge
    const badge = heroSection.querySelector('.hero-badge');
    if (badge) {
        tl.from(badge, { y: 30, opacity: 0, duration: 0.6 }, 0.2);
    }

    // Split and animate title characters — NO rotateX (causes blur + overflow clip)
    const titleEl = heroSection.querySelector('.hero-title');
    if (titleEl) {
        const chars = splitTextToChars(titleEl);
        tl.from(chars, {
            y: 50,
            opacity: 0,
            duration: 0.55,
            stagger: 0.025,
            ease: 'power3.out',
        }, 0.4);
    }

    // Name — animate as whole element (DO NOT split — gradient-text breaks with char spans)
    const nameEl = heroSection.querySelector('.hero-name');
    if (nameEl) {
        tl.from(nameEl, {
            y: 40,
            opacity: 0,
            duration: 0.7,
            ease: 'power3.out',
        }, 0.75);
    }

    // Subtitle paragraph
    const subtitleEl = heroSection.querySelector('.hero-subtitle');
    if (subtitleEl) {
        tl.from(subtitleEl, { y: 30, opacity: 0, duration: 0.7 }, 1.1);
    }

    // CTA Button
    const ctaEl = heroSection.querySelector('.hero-cta');
    if (ctaEl) {
        tl.from(ctaEl, { y: 20, opacity: 0, duration: 0.5, ease: 'back.out(1.7)' }, 1.3);
    }

    // Social icons stagger
    const socialIcons = heroSection.querySelectorAll('.hero-social a');
    if (socialIcons.length) {
        tl.from(socialIcons, {
            y: 12,
            opacity: 0,
            duration: 0.5,
            stagger: 0.08,
            ease: 'power3.out',
        }, 1.4);
    }

    // Photo container
    const photoContainer = heroSection.querySelector('.hero-photo-container');
    if (photoContainer) {
        tl.from(photoContainer, {
            x: 60,
            opacity: 0,
            duration: 1.0,
            ease: 'power2.out',
        }, 0.5);
    }

    // Tech badge pills stagger
    const techBadges = heroSection.querySelectorAll('.tech-badge');
    if (techBadges.length) {
        tl.from(techBadges, {
            y: 20,
            opacity: 0,
            duration: 0.4,
            stagger: 0.07,
            ease: 'power2.out',
        }, 1.5);
    }

    // Decorative floating orbs
    const orbs = document.querySelectorAll('.hero-orb');
    orbs.forEach((orb, i) => {
        gsap.to(orb, {
            y: i % 2 === 0 ? -20 : 20,
            duration: 3 + i * 0.5,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
            delay: i * 0.3,
        });
    });
}

// ─── Scroll Animations ────────────────────────────────────────────────────────
function initScrollAnimations() {

    // Generic fade-up for section headers
    gsap.utils.toArray('.reveal-up').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: 'top 88%',
                toggleActions: 'play none none none',
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            ease: 'power3.out',
        });
    });

    // Stagger cards
    gsap.utils.toArray('.stagger-parent').forEach((parent) => {
        const children = parent.querySelectorAll('.stagger-child');
        if (!children.length) return;
        gsap.from(children, {
            scrollTrigger: {
                trigger: parent,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            y: 60,
            opacity: 0,
            duration: 0.7,
            stagger: 0.12,
            ease: 'power3.out',
        });
    });

    // Slide in from left
    gsap.utils.toArray('.reveal-left').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            x: -60,
            opacity: 0,
            duration: 0.9,
            ease: 'power3.out',
        });
    });

    // Slide in from right
    gsap.utils.toArray('.reveal-right').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            x: 60,
            opacity: 0,
            duration: 0.9,
            ease: 'power3.out',
        });
    });

    // About images stagger with scale
    const aboutImages = document.querySelectorAll('.about-img-item');
    if (aboutImages.length) {
        gsap.from(aboutImages, {
            scrollTrigger: {
                trigger: '.about-images-grid',
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            scale: 0.85,
            opacity: 0,
            duration: 0.7,
            stagger: 0.15,
            ease: 'power2.out',
        });
    }

    // Counter animations
    const counters = document.querySelectorAll('.count-up');
    counters.forEach((counter) => {
        const target = parseInt(counter.getAttribute('data-target'), 10);
        ScrollTrigger.create({
            trigger: counter,
            start: 'top 85%',
            onEnter: () => {
                gsap.to({ val: 0 }, {
                    val: target,
                    duration: 1.8,
                    ease: 'power2.out',
                    onUpdate: function () {
                        counter.textContent = Math.round(this.targets()[0].val);
                    },
                });
            },
        });
    });

    // Portfolio cards — GSAP entrance (gsap.from so final state is always natural/visible)
    const portfolioSection = document.querySelector('#portfolio');
    if (portfolioSection) {
        const cards = portfolioSection.querySelectorAll('.portfolio-card');
        if (cards.length) {
            gsap.from(cards, {
                scrollTrigger: {
                    trigger: portfolioSection,
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
                opacity: 0,
                y: 40,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power3.out',
                clearProps: 'opacity,transform',
            });
        }
    }

    // Section divider lines
    gsap.utils.toArray('.section-line').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: 'top 90%',
                toggleActions: 'play none none none',
            },
            scaleX: 0,
            transformOrigin: 'left center',
            duration: 1.0,
            ease: 'power3.out',
        });
    });
}

// ─── Navbar Scroll Effect ─────────────────────────────────────────────────────
function initNavbarScroll() {
    const navbar = document.querySelector('.site-navbar');
    if (!navbar) return;

    let lastY = 0;

    ScrollTrigger.create({
        start: 'top -80',
        onUpdate: (self) => {
            const currentY = self.scroll();
            if (currentY > 80) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
            // Hide on scroll down, show on scroll up (after 200px)
            if (currentY > 200) {
                if (currentY > lastY) {
                    navbar.classList.add('navbar-hidden');
                } else {
                    navbar.classList.remove('navbar-hidden');
                }
            }
            lastY = currentY;
        },
    });
}

// ─── Magnetic Button Effect ───────────────────────────────────────────────────
function initMagneticButtons() {
    const magneticEls = document.querySelectorAll('.magnetic');
    magneticEls.forEach((el) => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            gsap.to(el, {
                x: x * 0.25,
                y: y * 0.25,
                duration: 0.3,
                ease: 'power2.out',
            });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(el, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.5)' });
        });
    });
}

// ─── Parallax on hero background ─────────────────────────────────────────────
function initParallax() {
    const heroBg = document.querySelector('.hero-parallax-bg');
    if (!heroBg) return;
    gsap.to(heroBg, {
        scrollTrigger: {
            trigger: '#hero-section',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        },
        y: 120,
        ease: 'none',
    });
}

// ─── Portfolio card hover glow ────────────────────────────────────────────────
function initCardHovers() {
    const cards = document.querySelectorAll('.portfolio-card');
    cards.forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            card.style.setProperty('--mouse-x', `${x}%`);
            card.style.setProperty('--mouse-y', `${y}%`);
        });
    });
}

// ─── Hero Particle Network (interactive canvas background) ────────────────────
function initHeroParticles() {
    const canvas = document.getElementById('hero-bg-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let W = 0, H = 0;
    const mouse = { x: -9999, y: -9999 };

    const PARTICLE_COUNT  = 90;
    const CONNECT_DIST    = 140;
    const MOUSE_RADIUS    = 160;
    const RIPPLE_PUSH     = 160;

    // ── Resize ────────────────────────────────────────────────────────────────
    function resize() {
        W = canvas.width  = canvas.offsetWidth;
        H = canvas.height = canvas.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    // ── Particle class ────────────────────────────────────────────────────────
    class Particle {
        constructor() { this.spawn(); }
        spawn() {
            this.x  = Math.random() * W;
            this.y  = Math.random() * H;
            this.vx = (Math.random() - 0.5) * 1.1;
            this.vy = (Math.random() - 0.5) * 1.1;
            this.r  = Math.random() * 1.8 + 0.8;
            this.a  = Math.random() * 0.45 + 0.15;
        }
        update() {
            // Damping suave — mantiene movimiento continuo
            this.vx *= 0.995;
            this.vy *= 0.995;
            // Velocidad mínima para que nunca se detengan
            const speed = Math.hypot(this.vx, this.vy);
            if (speed < 0.3) {
                const angle = Math.random() * Math.PI * 2;
                this.vx += Math.cos(angle) * 0.15;
                this.vy += Math.sin(angle) * 0.15;
            }
            this.x  += this.vx;
            this.y  += this.vy;
            // Wrap edges
            if (this.x < -10) this.x = W + 10;
            if (this.x > W + 10) this.x = -10;
            if (this.y < -10) this.y = H + 10;
            if (this.y > H + 10) this.y = -10;
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(245,158,11,${this.a})`;
            ctx.fill();
        }
    }

    const particles = Array.from({ length: PARTICLE_COUNT }, () => new Particle());

    // ── Ripple pool ───────────────────────────────────────────────────────────
    const ripples = [];

    // ── Mouse events — en hero-section para capturar toda el área ────────────
    const heroSection = document.getElementById('hero-section');
    const eventTarget = heroSection || canvas;

    eventTarget.addEventListener('mousemove', (e) => {
        const r = canvas.getBoundingClientRect();
        mouse.x = e.clientX - r.left;
        mouse.y = e.clientY - r.top;
    });
    eventTarget.addEventListener('mouseleave', () => {
        mouse.x = -9999;
        mouse.y = -9999;
    });

    // ── Click: ripple + atraer partículas ─────────────────────────────────────
    eventTarget.addEventListener('click', (e) => {
        const r  = canvas.getBoundingClientRect();
        const cx = e.clientX - r.left;
        const cy = e.clientY - r.top;

        // Spawn ripple rings
        ripples.push({ x: cx, y: cy, r: 0, maxR: 130, opacity: 0.7, ring: 1 });
        ripples.push({ x: cx, y: cy, r: 0, maxR: 80,  opacity: 0.4, ring: 2 });

        // Atraer partículas cercanas hacia el punto de click para que se unan
        particles.forEach((p) => {
            const dx   = cx - p.x;
            const dy   = cy - p.y;
            const dist = Math.hypot(dx, dy);
            if (dist < RIPPLE_PUSH && dist > 0) {
                const force = (RIPPLE_PUSH - dist) / RIPPLE_PUSH * 3.5;
                p.vx += (dx / dist) * force;
                p.vy += (dy / dist) * force;
            }
        });
    });

    // ── Draw connections ──────────────────────────────────────────────────────
    function drawEdges() {
        for (let i = 0; i < particles.length; i++) {
            const pi = particles[i];

            // Particle-to-particle
            for (let j = i + 1; j < particles.length; j++) {
                const pj   = particles[j];
                const dx   = pi.x - pj.x;
                const dy   = pi.y - pj.y;
                const dist = Math.hypot(dx, dy);
                if (dist < CONNECT_DIST) {
                    const alpha = (1 - dist / CONNECT_DIST) * 0.22;
                    ctx.beginPath();
                    ctx.moveTo(pi.x, pi.y);
                    ctx.lineTo(pj.x, pj.y);
                    ctx.strokeStyle = `rgba(245,158,11,${alpha})`;
                    ctx.lineWidth   = 0.6;
                    ctx.stroke();
                }
            }

            // Particle-to-mouse
            const mdx   = pi.x - mouse.x;
            const mdy   = pi.y - mouse.y;
            const mdist = Math.hypot(mdx, mdy);
            if (mdist < MOUSE_RADIUS) {
                const alpha = (1 - mdist / MOUSE_RADIUS) * 0.55;
                ctx.beginPath();
                ctx.moveTo(pi.x, pi.y);
                ctx.lineTo(mouse.x, mouse.y);
                ctx.strokeStyle = `rgba(251,191,36,${alpha})`;
                ctx.lineWidth   = 0.8;
                ctx.stroke();
            }
        }
    }

    // ── Main loop ─────────────────────────────────────────────────────────────
    function loop() {
        requestAnimationFrame(loop);
        ctx.clearRect(0, 0, W, H);

        // Ripples
        for (let i = ripples.length - 1; i >= 0; i--) {
            const rp = ripples[i];
            rp.r       += 2.8;
            rp.opacity -= 0.012;
            if (rp.opacity <= 0) { ripples.splice(i, 1); continue; }
            ctx.beginPath();
            ctx.arc(rp.x, rp.y, rp.r, 0, Math.PI * 2);
            ctx.strokeStyle = `rgba(245,158,11,${rp.opacity})`;
            ctx.lineWidth   = rp.ring === 1 ? 1.5 : 0.8;
            ctx.stroke();
        }

        drawEdges();
        particles.forEach((p) => { p.update(); p.draw(); });
    }

    loop();
}

// ─── Noise Circles (SimplexNoise + GSAP scrub) ───────────────────────────────
function initNoiseCircles() {
    const container = document.getElementById('noise-circles');
    if (!container || typeof SimplexNoise === 'undefined') return;

    const simplex = new SimplexNoise();
    // Fewer circles on mobile to preserve performance
    const COUNT = window.innerWidth < 768 ? 800 : 2500;
    const fragment = document.createDocumentFragment();

    for (let i = 0; i < COUNT; i++) {
        const div = document.createElement('div');
        div.classList.add('noise-circle');

        const n1 = simplex.noise2D(i * 0.003,  i * 0.0033);
        const n2 = simplex.noise2D(i * 0.002,  i * 0.001);

        div.style.transform  = `translate(${n2 * 260}px) rotate(${n2 * 270}deg) scale(${3 + n1 * 2}, ${3 + n2 * 2})`;
        div.style.boxShadow  = `0 0 0 .2px hsla(${Math.floor(i * 0.3)}, 75%, 65%, 0.45)`;

        fragment.appendChild(div);
    }
    container.appendChild(fragment);

    const circles = container.querySelectorAll('.noise-circle');

    // Sequential reveal tied to scroll — faithful to the original technique
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: '#about',
            scrub: 0.7,
            start: 'top 75%',
            end:   'bottom 25%',
        },
    });

    circles.forEach((circle) => tl.to(circle, { opacity: 1 }));
}

// ─── Text Scramble ────────────────────────────────────────────────────────────
function initTextScramble() {
    const CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&';

    function scramble(el) {
        const original = el.getAttribute('data-original') || el.textContent.trim();
        if (!el.getAttribute('data-original')) el.setAttribute('data-original', original);

        let frame = 0;
        const totalFrames = original.length * 4;

        const interval = setInterval(() => {
            el.textContent = original.split('').map((char, i) => {
                if (char === ' ') return ' ';
                if (i < Math.floor(frame / 4)) return char;
                return CHARS[Math.floor(Math.random() * CHARS.length)];
            }).join('');
            frame++;
            if (frame >= totalFrames) {
                clearInterval(interval);
                el.textContent = original;
            }
        }, 30);
    }

    document.querySelectorAll('[data-scramble]').forEach((el) => {
        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            onEnter: () => scramble(el),
        });
    });
}

// ─── Clip-path Reveal ─────────────────────────────────────────────────────────
function initClipReveal() {
    document.querySelectorAll('[data-clip-reveal]').forEach((el) => {
        gsap.fromTo(el,
            { clipPath: 'inset(0 100% 0 0)' },
            {
                clipPath: 'inset(0 0% 0 0)',
                duration: 1.1,
                ease: 'power4.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        );
    });
}

// ─── Parallax Background Text ─────────────────────────────────────────────────
function initParallaxBgText() {
    document.querySelectorAll('[data-parallax-bg]').forEach((el) => {
        gsap.to(el, {
            yPercent: -25,
            ease: 'none',
            scrollTrigger: {
                trigger: el.parentElement,
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1.5,
            },
        });
    });
}

// ─── Videogame Section: SVG Squiggles Background ──────────────────────────────
function initVgSquiggles() {
    const section = document.getElementById('videogame');
    const svg     = document.getElementById('vg-squiggles-stage');
    if (!section || !svg) return;

    const BG_COLOR  = '#0a0a1a';
    const VG_COLORS = ['#00d4ff', '#ff0080', '#39ff14', '#f7df1e', '#ff6b35', '#a855f7'];

    function randomColor() {
        return VG_COLORS[Math.floor(Math.random() * VG_COLORS.length)];
    }

    function onResize() {
        svg.setAttribute('width',  String(section.offsetWidth));
        svg.setAttribute('height', String(section.offsetHeight));
    }
    onResize();
    window.addEventListener('resize', onResize);

    function buildPath(s, grid) {
        let x = s.x, y = s.y, dx = s.directionX, dy = s.directionY;
        const parts = ['M', x, y, 'Q'];
        let step = 0;

        function newDir(axis, goAnywhere) {
            const key = 'direction' + axis.toUpperCase();
            if (!goAnywhere && s[key] !== 0) return s[key];
            return Math.random() < 0.5 ? -1 : 1;
        }

        while (step < s.sections * 2) {
            step++;
            x += (dx * (step / 30)) * grid;
            y += (dy * (step / 30)) * grid;
            if (step !== 1) parts.push(',');
            parts.push(x, y);
            if (step % 2 !== 0) {
                dx = dx === 0 ? newDir('x', step > 8) : 0;
                dy = dy === 0 ? newDir('y', step > 8) : 0;
            }
        }
        return parts.join(' ');
    }

    function spawnSquiggle(settings, grid) {
        const pathStr  = buildPath(settings, grid);
        const count    = 3;
        let completed  = 0;

        for (let i = 0; i < count; i++) {
            const isEraser = i === count - 1;
            const el = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            el.setAttribute('d', pathStr);
            el.style.fill         = 'none';
            el.style.stroke       = isEraser ? BG_COLOR : randomColor();
            el.style.strokeLinecap = 'round';
            el.style.strokeWidth  = '0px';

            const totalLen = el.getTotalLength();
            const chunkLen = totalLen / 6;
            el.style.strokeDasharray  = `${chunkLen}, ${totalLen + chunkLen}`;
            el.style.strokeDashoffset = `${chunkLen}`;

            svg.appendChild(el);

            const proxy = { offset: chunkLen, width: 0 };
            gsap.to(proxy, {
                offset:   -totalLen,
                width:    settings.sections * 0.9,
                duration: settings.sections * 0.1,
                ease:     'power1.out',
                delay:    i * (settings.sections * 0.01),
                onUpdate() {
                    el.style.strokeDashoffset = `${proxy.offset}`;
                    el.style.strokeWidth      = `${proxy.width}px`;
                },
                onComplete() {
                    el.remove();
                    completed++;
                },
            });
        }
    }

    let lastMousePos = null;
    let direction    = null;

    function getPos(e) {
        const rect = section.getBoundingClientRect();
        return { x: e.clientX - rect.left, y: e.clientY - rect.top };
    }

    function createFromMouse(pos) {
        let sections = 4;
        if (lastMousePos) {
            const newDir = { x: 0, y: 0 };
            const xAmt = Math.abs(lastMousePos.x - pos.x);
            const yAmt = Math.abs(lastMousePos.y - pos.y);
            if (xAmt > yAmt) {
                newDir.x = lastMousePos.x - pos.x < 0 ? 1 : -1;
                sections += Math.round(xAmt / 4);
            } else {
                newDir.y = lastMousePos.y - pos.y < 0 ? 1 : -1;
                sections += Math.round(yAmt / 4);
            }
            direction = newDir;
        }
        if (direction && lastMousePos) {
            spawnSquiggle({
                x:          lastMousePos.x,
                y:          lastMousePos.y,
                directionX: direction.x,
                directionY: direction.y,
                sections:   Math.min(sections, 20),
            }, 10 + Math.random() * (Math.min(sections, 20) * 1.5));
        }
        lastMousePos = pos;
    }

    function burst(fromMouse) {
        for (let i = 0; i < 5; i++) {
            const dx = Math.random() > 0.5 ? 1 : -1;
            spawnSquiggle({
                x:          fromMouse && lastMousePos ? lastMousePos.x : section.offsetWidth  / 2,
                y:          fromMouse && lastMousePos ? lastMousePos.y : section.offsetHeight / 2,
                directionX: dx,
                directionY: 0,
                sections:   5 + Math.round(Math.random() * 15),
            }, 15 + Math.random() * 25);
        }
    }

    // Mousemove always triggers squiggles (no hold needed — matches original behaviour)
    section.addEventListener('mousedown', e  => { lastMousePos = getPos(e); });
    section.addEventListener('mousemove', e  => {
        const pos = getPos(e);
        for (let i = 0; i < 3; i++) createFromMouse(pos);
    });
    section.addEventListener('mouseup',   ()  => burst(true));

    section.addEventListener('touchstart', e => {
        lastMousePos = getPos(e.changedTouches[0]);
    }, { passive: true });
    section.addEventListener('touchmove', e => {
        e.preventDefault();
        const pos = getPos(e.changedTouches[0]);
        for (let i = 0; i < 3; i++) createFromMouse(pos);
    }, { passive: false });
    section.addEventListener('touchend', () => burst(true));
}

// ─── Videogame Section ────────────────────────────────────────────────────────
function initVideogameSection() {
    const section = document.querySelector('#videogame');
    if (!section) return;

    // ── Screenshot gallery ───────────────────────────────────────────────────
    const gallery = section.querySelector('#vg-gallery');
    if (gallery) {
        const shots = Array.from(gallery.querySelectorAll('.vg-screenshot'));
        const dots  = Array.from(gallery.querySelectorAll('.vg-gallery-dot'));
        let current = 0;
        let autoTimer;

        function showSlide(index) {
            shots[current].classList.remove('vg-screenshot--active');
            dots[current].classList.remove('vg-gallery-dot--active');
            current = index;
            shots[current].classList.add('vg-screenshot--active');
            dots[current].classList.add('vg-gallery-dot--active');
        }

        function nextSlide() {
            showSlide((current + 1) % shots.length);
        }

        autoTimer = setInterval(nextSlide, 3500);

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(autoTimer);
                showSlide(i);
                autoTimer = setInterval(nextSlide, 3500);
            });
        });
    }

    // ── Stagger entrance of .vg-animate-in elements ─────────────────────────
    const animEls = section.querySelectorAll('.vg-animate-in');
    if (animEls.length) {
        gsap.to(animEls, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 70%',
                toggleActions: 'play none none none',
            },
        });
    }

    // ── Title pixel glitch effect — fires on enter, then repeats every ~4s ──
    const title = section.querySelector('.vg-title');
    if (title) {
        const originalShadow = title.style.textShadow;
        let glitchLoop = null;

        function runGlitch() {
            let count = 0;
            const burst = setInterval(() => {
                if (count >= 8) {
                    clearInterval(burst);
                    title.style.textShadow = originalShadow;
                    return;
                }
                title.style.textShadow = count % 2 === 0
                    ? `${4 + count}px 4px 0px #ff0080, -4px -4px 0px #00d4ff`
                    : `4px 4px 0px #ff0080, 8px 8px 0px rgba(255,0,128,0.3)`;
                count++;
            }, 80);
        }

        ScrollTrigger.create({
            trigger: title,
            start: 'top 80%',
            onEnter: () => {
                runGlitch();
                glitchLoop = setInterval(runGlitch, 4000);
            },
            onLeave:      () => { clearInterval(glitchLoop); title.style.textShadow = originalShadow; },
            onEnterBack:  () => { runGlitch(); glitchLoop = setInterval(runGlitch, 4000); },
            onLeaveBack:  () => { clearInterval(glitchLoop); title.style.textShadow = originalShadow; },
        });
    }

    // ── CRT wipe transition on enter ────────────────────────────────────────
    gsap.fromTo(section,
        { clipPath: 'inset(0 100% 0 0)' },
        {
            clipPath: 'inset(0 0% 0 0)',
            duration: 1.2,
            ease: 'steps(12)',
            scrollTrigger: {
                trigger: section,
                start: 'top 90%',
                toggleActions: 'play none none none',
            },
        }
    );

    // ── Scroll indicator hide when leaving section ──────────────────────────
    const scrollIndicator = document.getElementById('vg-scroll-indicator');
    if (scrollIndicator) {
        gsap.to(scrollIndicator, {
            y: 10,
            repeat: -1,
            yoyo: true,
            duration: 0.9,
            ease: 'sine.inOut',
        });
        ScrollTrigger.create({
            trigger: section,
            start: 'bottom 80%',
            onEnter: () => gsap.to(scrollIndicator, { opacity: 0, duration: 0.4 }),
            onLeaveBack: () => gsap.to(scrollIndicator, { opacity: 1, duration: 0.4 }),
        });
    }

    // ── Scroll-out: pixel elements fly upward ───────────────────────────────
    gsap.to(section.querySelector('.container'), {
        y: -40,
        ease: 'none',
        scrollTrigger: {
            trigger: section,
            start: 'bottom 60%',
            end: 'bottom top',
            scrub: 1,
        },
    });
}

// ─── Init ─────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    initNoiseCircles();
    initHeroParticles();
    initHeroAnimations();
    initScrollAnimations();
    initNavbarScroll();
    initMagneticButtons();
    initParallax();
    initCardHovers();
    initTextScramble();
    initClipReveal();
    initParallaxBgText();
    initVgSquiggles();
    initVideogameSection();
});
