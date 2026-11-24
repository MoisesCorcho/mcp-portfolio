# Project: CarFleet (Enterprise Fleet & Operations SaaS)

## Overview & Links
- **Repository**: https://github.com/MoisesCorcho/carfleet
- **Role**: Software Architect & Full-Stack Engineer

## Architecture & Engineering
- **Core Stack**: Laravel 13, Filament v4, Filament Shield, Pest 4, MySQL, Docker.
- **Domain**: Vehicle fleet management, driver logging, fuel consumption tracking, and digital maintenance scheduling.
- **Security & Authorization**: Granular RBAC using Filament Shield, separating fleet managers, drivers, mechanics, and executive auditors.
- **Digital Signatures**: Integrated biometric and touch-based digital signature captures on mobile web for vehicle inspection sign-offs.

## Key Technical Achievements & What Moisés Did
- Modeled complex vehicle lifecycle states (Available, In Transit, In Maintenance, Decommissioned).
- Built automated maintenance alert jobs calculating mileage intervals and scheduling preventive inspections.
- Implemented digital PDF sign-off reports with captured signatures and inspection checklists.
- 100% test coverage for critical operational workflows using Pest.

## What Moisés CAN Build Based on This
- Enterprise logistics, vehicle tracking, and asset management platforms.
- Systems requiring legally compliant digital signatures and inspection audit trails.
- High-security multi-role portals with Filament and Laravel.

## Limitations
- Does not write custom OBD-II vehicle telemetry firmware in C++ (consumes standard GPS/telematics APIs or manual operational inputs).
