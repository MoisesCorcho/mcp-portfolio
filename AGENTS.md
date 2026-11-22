# Agent Guidelines — mcp-portfolio

## Project Overview
Personal portfolio and professional showcase for Moisés Corcho (Systems Engineer & Full-Stack Developer).
Built with Laravel 12, Laravel Sail (Docker), Tailwind CSS, Alpine.js, GSAP, and Vite.

## Environments & Development Commands
- **Docker / Laravel Sail**:
  - Local development runs containerized on port 80 via Laravel Sail.
  - Execute tests: `./vendor/bin/sail test` (or fallback `php artisan test`)
  - Run Artisan commands: `./vendor/bin/sail artisan <command>`
  - Compile frontend assets: `npm run build` (or `npm run dev` for Vite HMR)
- **Testing Standard**:
  - Feature tests live in `tests/Feature/ExampleTest.php` (and dedicated feature tests).
  - Always run tests and verify 100% pass before declaring a task complete.

## Frontend Architecture & Design System
- **Current Production (`/`)**:
  - Main landing view: `resources/views/home.blade.php` with components in `resources/views/components/home/`.
  - Stays frozen and intact until V2 reaches 100% feature parity.
- **Next Generation (`/v2`)**:
  - All new design work belongs exclusively in `resources/views/v2/`.
  - Master continuous chassis: `resources/views/v2/index.blade.php`.
  - Modular chambers: `resources/views/v2/sections/`.
- **Design System Authority**:
  - Follow `DESIGN.md` at project root for all styling decisions.
  - **Zero "Sci-Fi Cosplay" Rule**: Never inject decorative pseudotext, faux code comments (`//`), fake specification tags (`SPEC:`), or mock coordinates. Content must remain 100% authentic.
  - Typography: `Oxanium` (Display/Headings) and `Roboto Mono` (Body/UI/Code).

## Zero-Hardcoding & Centralization Rules
- **Semantic Color Tokens**:
  - Always use theme tokens from `tailwind.config.js`: `bg-canvas`, `bg-chamber`, `bg-card`, `bg-floor`, `bg-void`, `border-zinc-800`, `text-amber-500`, etc.
  - NEVER use arbitrary `#hex` color classes (e.g. `bg-[#07090e]`) in Blade templates. All shades must be registered in `tailwind.config.js`.
- **Text & Localization**:
  - All user-facing copy must be localized via `__()` referencing `lang/es/home.php` and `lang/en/home.php`.
  - Never pass string fallbacks as argument #2 to `__()` (`__($key, $replace = [])` takes an array as argument #2).
- **Data Collections & Profiles**:
  - Technical skills, services, projects, education, author details, and social links belong in `config/portfolio.php` and must be consumed via `config('portfolio.*')`.
  - Templates must iterate configured collections instead of hardcoding lists in markup.

## Modularity, Decoupling & Pragmatic Architecture
- **Continuous Architectural Audit**: Always audit code to prevent monolithic files, mixed concerns, or bloated templates. Proactively identify opportunities for clean extraction.
- **Single Responsibility & Componentization**: Extract distinct subdomains, complex cards, interactive drawers, and self-contained widgets into dedicated Blade components (`resources/views/components/v2/`). Chamber files in `resources/views/v2/sections/` should act as clean structural orchestrators (~80-120 lines), not 300+ line monoliths.
- **DRY Design Primitives**: Centralize repeated structural patterns (such as section header strips, CAD reticles, and alignment pins) into atomic components.
- **Zero Overengineering**: Modularity serves maintainability, readability, and testability. Never introduce gratuitous abstraction layers, speculative generic classes, or micro-fragmentation where a clean Blade component or standard Laravel idiom solves the problem directly.

## Git & Coding Conventions
- **Commits**: Follow Conventional Commits format (`feat:`, `fix:`, `style:`, `refactor:`, `test:`, `chore:`).
- **Attribution**: Never add AI attribution trailers or `Co-Authored-By` lines to git commits.
