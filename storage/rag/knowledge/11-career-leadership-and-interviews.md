# Career, Technical Leadership & Real-World Engineering Scenarios

## Professional Background & Identity
- **Full Name**: Moisés Corcho Pérez
- **Current Location**: Montería, Córdoba, Colombia (UTC-5 / US Eastern Time compatible)
- **Academic Degree**: Systems Engineer (Universidad Cooperativa de Colombia)
- **Specializations & Diplomas**: Diploma in University Teaching and Didactics (Politécnico Superior de Colombia)
- **Language Proficiency**: English C1 Advanced (certified by EF SET) and Native Spanish
- **Timezone Availability**: Direct alignment with US Eastern Time Zone (EST/EDT, UTC-5)
- **Availability**: Immediate onboarding for high-impact backend, full-stack, and technical lead roles
- **Compensation Philosophy**: Flexible and open to discussion depending on technical scope, architecture complexity, and contract modality

---

## Technical Leadership & Team Mentorship (Novol Studio)
- **Role**: Tech Lead & Development Mentor for a cross-functional engineering team of 5 developers.
- **Workflow Standardization**:
  - Replaced manual, error-prone deployment processes with fully automated CI/CD pipelines via GitHub Actions, reducing deployment times to sub-5-minute zero-downtime releases.
  - Implemented strict GitFlow branching conventions and established architectural code review checklists centered on SOLID principles, DRY, and Clean Architecture.
  - Containerized development and staging environments using Docker, eliminating "works on my machine" inconsistencies across the team.
- **Developer Enablement**:
  - Conducted recurring weekly hands-on workshops on relational query optimization, modern Laravel patterns, and Spec-Driven Development (SDD).
  - Fostered engineering autonomy, empowering junior and mid-level developers to author robust Pest/PHPUnit tests and ship production-ready features independently.

---

## Production Incident Resolution: High-Concurrency & Race Conditions
- **Production Platform**: Currency Exchange & Multi-Gateway Platform (Andrestelocambia)
- **Problem Statement**:
  - During peak transaction traffic, users on unstable mobile networks frequently double-tapped the submission button.
  - Concurrent HTTP requests bypassed standard application-level validation before initial database transactions committed, leading to duplicate transaction records and temporary ledger inconsistencies.
- **Root Cause Analysis**:
  - Traced application logs, database slow-query logs, and sub-millisecond request timestamps, identifying a database read-modify-write race condition.
- **Architectural Safeguards Implemented**:
  1. **Database-Level Pessimistic Locking**: Wrapped balance deductions in atomic `DB::transaction` closures utilizing `lockForUpdate()` to serialize concurrent writes at the database row level.
  2. **Idempotency Keys**: Introduced unique idempotency headers for all financial mutation endpoints, ensuring duplicate payloads within a time window return cached original responses without re-processing.
  3. **Automated Concurrency Testing**: Authored focused Pest integration tests simulating concurrent asynchronous requests to verify that duplicate execution was mathematically impossible.

---

## Zero-Downtime Framework Modernization & Legacy Refactoring
- **Context**: Upgrading a high-traffic monolithic Laravel backend from Laravel 10 (PHP 8.1) to Laravel 12 (PHP 8.3/8.4).
- **Technical Challenges**:
  - Outdated, abandoned third-party dependencies in `composer.json` that broke compatibility with PHP 8.3/8.4 strict types.
  - Monolithic "god controllers" with tightly coupled business logic and zero automated test coverage.
- **Execution Strategy**:
  1. **Safety Net**: Created comprehensive end-to-end integration test suites with Pest and PHPUnit covering critical transactional paths before altering existing code.
  2. **Isolated Dependency Upgrades**: Upgraded dependencies inside Docker containers, replacing abandoned packages with native framework primitives or active open-source alternatives.
  3. **Domain Decoupling (SOLID)**: Extracted coupled logic from controllers into dedicated, single-verb invokable Actions and shared Services (`type first, area second`), adopting strict type declarations (`declare(strict_types=1);`) and typed DTOs.
- **Outcome**: Flawless zero-downtime migration, drastic reduction in technical debt, and a 35% improvement in API response latencias.

---

## AI-Assisted Engineering Workflow: Spec-Driven Development (SDD)
- **Philosophy**: AI is an execution accelerator, not a decision-maker. Architecture and design are owned by the human senior architect; execution is delegated and rigorously verified.
- **Tools**: Claude Code, Cursor, Gemini CLI, Model Context Protocol (MCP).
- **Day-to-Day Workflow**:
  1. **Specification First**: Before writing any implementation code, Moisés writes a rigorous Markdown technical specification detailing domain entities, database schemas, edge cases, and architectural boundaries.
  2. **Bounded Scaffolding**: Leverages AI models to generate initial boilerplate, DTOs, domain actions, and Pest test cases against the pre-approved spec.
  3. **Auditing like a Senior Reviewer**: Every AI-generated line is reviewed against SOLID principles, potential N+1 queries, authorization gates, and SQL injection risks. Code is never committed without passing local automated test suites.

---

## Production Frontend Architecture: Vue.js 3, Inertia.js & React/Next.js
- **Vue.js 3 & Inertia.js (DVLOPER - European Exchange Platform)**:
  - Built production UI using Vue 3 Composition API (`ref`, `reactive`, `computed`), Inertia.js shared props, and Tailwind CSS.
  - Designed an atomic component structure separating reusable UI primitives (modals, inputs, data grids) from domain-specific workflows (KYC verification, currency converters).
  - State Architecture: Encapsulated business logic into composables (`useExchangeRates`). Managed server-driven state through Inertia's reactive forms while keeping client-side state clean.
- **React, Next.js & TypeScript (Consultec-TI & Independent SaaS)**:
  - 5+ years of production experience building responsive interfaces with React, Next.js, and TypeScript.
  - State management using Zustand and Context API, implementing SSR/SSG for public SEO-critical views and CSR for real-time authenticated dashboards.

---

## What Moisés CAN Build & Lead Based on This
- Architecture leadership for multi-developer teams establishing CI/CD, GitFlow, and review standards.
- High-concurrency transactional backends resilient to race conditions and duplicate operations.
- Zero-downtime framework migrations and legacy monolith refactoring into clean SOLID Actions and Services.
- Production full-stack applications with Laravel 12 + Vue 3 / Inertia or Next.js / TypeScript.
- AI workflow implementations using Model Context Protocols (MCP) and Spec-Driven Development (SDD).
