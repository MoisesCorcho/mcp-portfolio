# Agent Guidelines — mcp-portfolio

## Project Overview
Personal portfolio and professional showcase for Moisés Corcho (Systems Engineer & Full-Stack Architect).
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

## Git & Coding Conventions
- **Commits**: Follow Conventional Commits format (`feat:`, `fix:`, `style:`, `refactor:`, `test:`, `chore:`).
- **Attribution**: Never add AI attribution trailers or `Co-Authored-By` lines to git commits.
