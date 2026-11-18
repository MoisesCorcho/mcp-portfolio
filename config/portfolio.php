<?php

return [

    'owner' => [
        'name' => 'Moisés Corcho Pérez',
        'brand_initial' => 'M',
        'brand_name' => 'Corcho',
        'email' => 'mcorchoperez@gmail.com',
        'phone' => '+57 3113583693',
        'location' => 'Montería, Córdoba, Colombia',
        'linkedin' => 'https://www.linkedin.com/in/moisescorcho-dev/',
        'instagram' => 'https://www.instagram.com/mc44038/',
        'github' => 'https://github.com/MoisesCorcho',
    ],

    'skills' => [
        'cycling' => [
            'PHP', 'Laravel', 'Vue.js', 'Docker', 'MySQL', 'Git',
            'Flutter', 'Alpine.js', 'Tailwind CSS', 'REST APIs', 'PostgreSQL',
            'Linux', 'Filament'
        ],
        'featured' => [
            'PHP', 'Laravel', 'Docker', 'Vue.js', 'MySQL', 'Tailwind'
        ],
    ],

    'services' => [
        [
            'id' => 'fullstack',
            'title_key' => 'home.service_fullstack_title',
            'desc_key' => 'home.service_fullstack_desc',
            'badge' => 'Core Architecture',
            'tags' => ['Laravel 12', 'Vue 3 / React', 'Clean Architecture', 'Stripe', 'REST & JSON:API'],
            'metric' => 'High-Availability Backend',
        ],
        [
            'id' => 'mobile',
            'title_key' => 'home.service_mobile_title',
            'desc_key' => 'home.service_mobile_desc',
            'badge' => 'Cross-Platform & Mobile',
            'tags' => ['Flutter', 'Dart', 'PWA', 'Offline-First', 'REST / GraphQL'],
            'metric' => 'iOS, Android & Web',
        ],
        [
            'id' => 'devops',
            'title_key' => 'home.service_devops_title',
            'desc_key' => 'home.service_devops_desc',
            'badge' => 'Infrastructure',
            'tags' => ['Docker & Sail', 'GitHub Actions', 'CI/CD Pipelines', 'MySQL / PostgreSQL', 'Linux'],
            'metric' => 'Automated Deployments',
        ],
        [
            'id' => 'ai',
            'title_key' => 'home.service_ai_title',
            'desc_key' => 'home.service_ai_desc',
            'badge' => 'Modern Automation',
            'tags' => ['Agentes CLI', 'MCP Servers', 'Spec-Driven Dev (SDD)', 'LLMs Integration', 'DataCamp Certified'],
            'metric' => 'Agentic Workflows',
        ],
    ],

    'projects' => [
        [
            'id' => 'inforeal',
            'title' => 'InfoReal',
            'category' => 'Enterprise News & CMS',
            'desc_key' => 'home.project_inforeal_desc',
            'url' => 'https://www.inforeal.com.co/',
            'github' => 'https://github.com/MoisesCorcho/NoticiasInfoReal',
            'image' => null,
            'tags' => ['Laravel 12', 'Filament v3', 'Livewire 3', 'Tailwind CSS 4', 'MySQL', 'Docker'],
            'featured' => true,
        ],
        [
            'id' => 'amatu',
            'title' => 'Amatu Café',
            'category' => 'E-Commerce & Digital Experience',
            'desc_key' => 'home.project_amatu_desc',
            'url' => 'https://amatu-cafe.vercel.app/',
            'github' => 'https://github.com/MoisesCorcho/amatu-cafe',
            'image' => null,
            'tags' => ['Next.js 16', 'React 19', 'TypeScript', 'Tailwind CSS 4', 'Vercel'],
            'featured' => true,
        ],
        [
            'id' => 'aws_hackathon',
            'title' => 'Keep Coding and Nobody Is Fired',
            'category' => 'Generative AI & Cloud Game',
            'desc_key' => 'home.project_hackathon_desc',
            'url' => null,
            'github' => 'https://github.com/dvloper-mnt/Keep-Coding-and-Nobody-Is-Fired',
            'image' => null,
            'tags' => ['AWS Bedrock', 'Next.js 16', 'TypeScript', 'ECS Fargate', 'Valkey / Redis', 'TDD (410 tests)'],
            'badge' => 'Top 30 Finalista Hackathon',
            'featured' => true,
        ],
        [
            'id' => 'sparkmvc',
            'title' => 'SparkMVC',
            'category' => 'Open Source Engine',
            'desc_key' => 'home.project_sparkmvc_desc',
            'url' => null,
            'github' => 'https://github.com/MoisesCorcho/SparkMVC',
            'image' => null,
            'tags' => ['PHP 8.2+', 'MVC Architecture', 'OOP', 'Dependency Injection'],
            'featured' => false,
        ],
        [
            'id' => 'videogame',
            'title' => "The Developer's Journey",
            'category' => 'Action-Platformer 2D',
            'desc_key' => 'home.project_videogame_desc',
            'url' => '/v2/videogame',
            'external_url' => 'https://portfolio-videogame.vercel.app/',
            'github' => 'https://github.com/MoisesCorcho/portfolio-videogame',
            'image' => null,
            'tags' => ['Phaser 3', 'Svelte', 'Pixel Art', 'State Pattern'],
            'badge' => 'Interactive Game',
            'featured' => true,
        ],
    ],

    'company_logos' => [
        'DVLOPER' => '/img/company_logos/dvloper_logo.png',
        'Imagine Apps' => '/img/company_logos/imagineappsas_logo.jpeg',
        'Universidad Cooperativa de Colombia' => '/img/company_logos/ucc_logo.jpeg',
        'DISTRACOM' => '/img/company_logos/distracom_logo.jpeg',
        'andrestelocambia' => '/img/company_logos/andrestelocambia_logo.jpeg',
    ],

    'education' => [
        [
            'degree_key' => 'home.edu_degree_systems',
            'institution_key' => 'home.edu_institution_ucc',
            'period_key' => 'home.edu_period_ucc',
            'type' => 'Formal University Degree',
            'location' => 'Montería, Córdoba',
        ],
        [
            'degree_key' => 'home.edu_degree_diploma',
            'institution_key' => 'home.edu_institution_poli',
            'period_key' => 'home.edu_period_poli',
            'type' => 'Postgraduate Diploma',
            'location' => 'Medellín, Antioquia',
        ],
    ],

    'certifications' => [
        [
            'id' => 'data_engineer',
            'title' => 'Data Engineer Associate',
            'issuer' => 'DataCamp',
            'url' => 'https://www.datacamp.com/certificate/DEA0015812718348',
            'badge' => '/img/certification_banners/data_engineer_associate/DE Associate - badge with outline.png',
            'banner' => '/img/certification_banners/data_engineer_associate/DE Associate - LinkedIn.png',
            'skills' => ['Data Pipelines', 'SQL Server / PostgreSQL', 'Data Warehousing', 'ETL Processes'],
            'featured' => true,
        ],
        [
            'id' => 'ai_engineer',
            'title' => 'AI Engineer for Developers Associate',
            'issuer' => 'DataCamp',
            'url' => 'https://www.datacamp.com/certificate/AIEDA0013044819611',
            'badge' => '/img/certification_banners/ai_engineer_for_developers_associate/certification-ai-engineer-for-developers-associate-badge.png',
            'banner' => '/img/certification_banners/ai_engineer_for_developers_associate/AIED Associate - LinkedIn.png',
            'skills' => ['LLM Orchestration', 'Prompt Engineering', 'AI System Architecture', 'API Integrations'],
            'featured' => true,
        ],
        [
            'id' => 'english_c1',
            'title' => 'EF SET English Certificate',
            'issuer' => 'EF Standard English Test',
            'url' => 'https://cert.efset.org/es/b8phnx',
            'score' => 'C1 Advanced (71/100)',
            'skills' => ['Full Professional Proficiency', 'International Collaboration', 'Technical Documentation'],
            'featured' => true,
        ],
    ],

];
