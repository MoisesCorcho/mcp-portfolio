# Project: Leen Honey (Enterprise E-Commerce Engine)

## Overview & Links
- **Official Production Domain**: https://leenhoney.com/
- **Repository**: https://github.com/MoisesCorcho/ecommerce
- **Role**: Lead Systems Architect & Full-Stack Developer

## Architecture & Engineering
- **Core Stack**: Laravel 13, Filament v5, Spatie Permission (RBAC), Laravel Fortify, Pest 4.
- **Payments & FinTech Integration**: Multi-gateway payment orchestration supporting Stripe and Bold Webhooks.
- **Architecture Pattern**: Pragmatic SOLID with strict type-first conventions (`app/Actions/`, `app/Services/`, `app/DTOs/`, `app/Enums/`, `app/Contracts/`, `app/Gateways/`).
- **Idempotency & Resilience**: Built dedicated webhook idempotency keys to guarantee zero double-charging or duplicate order fulfillment under network retries.
- **Multi-Currency & Internationalization**: Dynamic currency conversion, multi-locale localization (ES/EN), and regional tax/shipping engines.

## Key Technical Achievements & What Moisés Did
- Engineered decoupled payment gateways adhering strictly to Dependency Inversion (DIP).
- Implemented transactional order state machines transitioning safely across Pending, Paid, Shipped, Refunded.
- Designed comprehensive test suites with Pest covering payment mocks, inventory locking, and discount calculations.
- Integrated high-performance catalog search and administrative management through Filament v5.

## What Moisés CAN Build Based on This
- Complex multi-currency e-commerce platforms.
- Resilient FinTech webhooks and payment integrations with idempotency guarantees.
- Large-scale administrative backoffices with granular role-based permissions (RBAC).

## Limitations
- Does not build proprietary in-house credit card clearing or PCI-DSS Level 1 payment processor hardware (uses certified APIs like Stripe/Bold).
