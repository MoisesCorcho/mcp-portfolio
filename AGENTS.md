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
  - Main landing view: `resources/views/v2/index.blade.php` (Cyber-Industrial Continuous Chassis) with modular chambers in `resources/views/v2/sections/`.
  - Dedicated chambers: `resources/views/v2/videogame.blade.php` mounted at `/videogame`.
  - Legacy V1 archive preserved at `/v1` (`resources/views/home.blade.php`).
- **Legacy & Transition**:
  - `/v2` and `/v2/videogame` are configured with permanent 301 redirects to `/` and `/videogame`.
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

## Backend & SOLID Architecture Conventions
- **Directory Layout (Type First, Area Second)**:
  - Top-level folders under `app/` are grouped by role/type: `app/Actions/`, `app/Services/`, `app/DTOs/`, `app/Enums/`, `app/Contracts/`, `app/Gateways/`, `app/Exceptions/`.
  - Inside each type folder, group by domain area (e.g. `app/Actions/Rag/`, `app/Services/Rag/`, `app/DTOs/Rag/`, `app/Enums/Rag/`).
- **Class & Filename Suffixes (Mandatory)**:
  - Actions: `*Action.php` (single domain verb, invokable `__invoke()`).
  - Services: `*Service.php` (reusable capability shared by multiple actions).
  - DTOs: `*DTO.php` (`readonly` classes with strict types & constructor property promotion).
  - Enums: `*Enum.php` (string-backed enums, never class constants or raw string checks).
  - Contracts / Interfaces: `*Interface.php` in `app/Contracts/{Area}/`.
  - Gateways: `*Gateway.php` in `app/Gateways/{Area}/` (implementing domain contracts).
- **Strict Typing & Conventions**:
  - Every new PHP file starts with `declare(strict_types=1);`.
  - Invert external dependencies (DIP): domain actions/services must depend strictly on `*Interface`, never on concrete third-party gateways. Bindings reside in service providers.

## Git & Coding Conventions
- **Commits**: Follow Conventional Commits format (`feat:`, `fix:`, `style:`, `refactor:`, `test:`, `chore:`).
- **Attribution**: Never add AI attribution trailers or `Co-Authored-By` lines to git commits.
