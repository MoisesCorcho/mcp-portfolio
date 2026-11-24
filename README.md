# Moisés Corcho — Systems Engineer & Full-Stack / AI Developer Portfolio

[![Laravel](https://img.shields.io/badge/Laravel-12%2F13-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%20--%208.4-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-v3-8BC0D0?style=flat&logo=alpinedotjs&logoColor=white)](https://alpinejs.dev)
[![Pinecone](https://img.shields.io/badge/Pinecone-Vector_DB-000000?style=flat&logo=pinecone&logoColor=white)](https://www.pinecone.io)
[![OpenAI](https://img.shields.io/badge/OpenAI-Embeddings_%26_LLM-412991?style=flat&logo=openai&logoColor=white)](https://openai.com)
[![ElevenLabs](https://img.shields.io/badge/ElevenLabs-Voice_Cloning-black?style=flat)](https://elevenlabs.io)
[![Tests](https://img.shields.io/badge/Tests-33%20Passed%20(134%20Assertions)-success?style=flat&logo=pest)](tests/)

Personal portfolio and professional showcase for **Moisés Corcho Pérez** (Systems Engineer, Full-Stack Developer & AI Developer). Built on a **Cyber-Industrial Neo-Brutalist Continuous Chassis** (V2) with an enterprise-grade, fully decoupled **RAG (Retrieval-Augmented Generation) Knowledge Engine** and bidirectional voice assistant.

---

## 🏛️ Architecture Overview

The system strictly adheres to **Pragmatic SOLID** design principles and clean architecture conventions, separating the domain model from external infrastructure dependencies.

```text
mcp-portfolio/
├── app/
│   ├── Actions/Rag/                  # Single-purpose domain verbs (Invokable)
│   │   ├── IndexKnowledgeBaseAction.php       # Ingests, chunks, embeds & upserts to Pinecone
│   │   └── RetrieveRelevantContextAction.php  # Semantic search with score threshold filtering
│   ├── Contracts/Rag/                # Ports / Inversion of Control interfaces (DIP)
│   │   ├── EmbeddingProviderInterface.php     # Vector embedding generation contract
│   │   ├── LlmProviderInterface.php           # Non-streaming & streaming LLM contract
│   │   ├── VectorStoreInterface.php           # High-dimensional vector database contract
│   │   └── TtsProviderInterface.php           # Audio text-to-speech synthesis contract
│   ├── DTOs/Rag/                     # Immutable, typed data transfer objects (readonly)
│   │   ├── ChatMessageDTO.php                 # Role/content chat interaction payload
│   │   ├── ChatPromptDTO.php                  # Guardrailed LLM inference context
│   │   ├── DocumentChunkDTO.php               # Partitioned Markdown chunk with metadata
│   │   ├── ScoredChunkDTO.php                 # Search match with similarity score
│   │   └── VectorRecordDTO.php                # High-dimensional vector + Pinecone payload
│   ├── Enums/Rag/                    # String-backed domain vocabularies (*Enum suffix)
│   │   ├── EmbeddingModelEnum.php             # text-embedding-3-small (1536) / large (3072)
│   │   ├── LlmModelEnum.php                   # gpt-4o-mini / gpt-4o
│   │   ├── MessageRoleEnum.php                # system / user / assistant
│   │   └── RagDocumentTypeEnum.php            # project / experience / skill / general
│   ├── Gateways/Rag/                 # Concrete infrastructure adapters implementing contracts
│   │   ├── OpenAiEmbeddingGateway.php         # OpenAI API v1/embeddings adapter
│   │   ├── OpenAiLlmGateway.php               # OpenAI chat completions & cURL stream adapter
│   │   ├── PineconeVectorStoreGateway.php     # Pinecone serverless REST data plane adapter
│   │   └── ElevenLabsTtsGateway.php           # ElevenLabs cloned voice synthesis adapter
│   ├── Http/Controllers/Rag/
│   │   ├── ChatController.php                 # Server-Sent Events (SSE) streaming endpoint
│   │   └── TtsController.php                  # MP3 voice generation endpoint with caching
│   └── Services/Rag/
│       ├── MarkdownChunkerService.php         # Semantic Markdown partitioning by headings
│       └── SystemPromptService.php            # 3rd-person technical persona & guardrails
├── storage/rag/knowledge/            # 10 comprehensive technical Markdown dossiers
│   ├── 01-profile-and-capabilities.md
│   ├── 02-leenhoney-ecommerce.md
│   ├── 03-carfleet-saas.md
│   ├── 04-anime-recommender-ai.md
│   ├── 05-skytrack-flight-pwa.md
│   ├── 06-interval-timer-flutter.md
│   ├── 07-keep-coding-hackathon.md
│   ├── 08-inforeal-cms.md
│   ├── 09-amatu-cafe.md
│   └── 10-videogame-and-pdf-tooling.md
└── resources/views/
    ├── components/v2/
    │   ├── rag-drawer.blade.php      # Cyber-Industrial HUD Drawer with Alpine.js streaming & STT/TTS
    │   ├── brand-logo.blade.php      # Feline laptop vector mark with organic idle cycle
    │   ├── extruded-box.blade.php    # 2.5D axonometric box with specular glint & press physics
    │   └── page-loader.blade.php     # System page loader with hardware-accelerated logo
    └── v2/sections/                  # Modular Continuous Chassis chambers (80-120 lines each)
```

---

## 🚀 Core Features

### 1. Cyber-Industrial Continuous Chassis (`/`)
* **Monolithic Grid Spine:** A continuous 1280px (`max-w-7xl`) structural chassis running unbroken from navbar to footer with CAD reticles, corner pins, and coordinate grid planes.
* **Polymorphic 2.5D Extruded Boxes:** Axonometric structural cards and interactive buttons (`<x-v2.extruded-box>`) featuring realistic chiaroscuro facet shading, tactile press physics, and GPU-accelerated specular glass glint.
* **Zero "Sci-Fi Cosplay":** Free of fake pseudotext or mock coordinates; all technical telemetry and system labels reflect authentic architecture.
* **Internationalization:** Full dynamic localization (`lang/es/` and `lang/en/`) covering copy, project metadata, and CV details.

### 2. Enterprise AI Project Advisor (RAG & Voice HUD Drawer)
* **Grounded Semantic Retrieval:** Custom vector search over 10 structured Markdown dossiers detailing Moisés's real repositories, tech stacks, engineering decisions, and architectural scope.
* **Zero Hallucination Guardrails:** The system speaks as an objective 3rd-person technical advisor. When asked about technologies outside Moisés's expertise (e.g. low-level embedded C, AAA Unreal Engine 3D games, or blockchain smart contracts), it explicitly clarifies boundaries and redirects to proven capabilities.
* **High-Performance Streaming (SSE):** Token-by-token streaming via Server-Sent Events (`POST /api/rag/chat`) with time-to-first-token (TTFT) under 50ms, accompanied by real-time source citations and similarity scores.
* **Bidirectional Voice Interface:**
  * **Speech-to-Text (STT):** Integrated Web Speech API for real-time microphone dictation at zero latency and zero API cost.
  * **Text-to-Speech (TTS):** Direct integration with **ElevenLabs** using Moisés's custom cloned voice, paired with an automated fallback to the browser's native speech synthesis when quotas expire or credentials are unset.

### 3. Dedicated Chambers & Legacy Archives
* **Retro Arcade Chamber (`/videogame`):** Dedicated showcase for *The Developer's Journey* and *But Why?...* (Game Jam Cultura Abierta 2025) with retro typography (*Press Start 2P*).
* **Legacy V1 Archive (`/v1`):** Complete historical preservation of Portfolio V1.

---

## ⚖️ Architectural Decisions & Industry Best Practices

### Why Pinecone instead of `pgvector` for this deployment?
1. **CloudPanel & VPS Simplicity:** Production runs containerized on a Hostinger Linux VPS managed with **CloudPanel**. CloudPanel is engineered specifically around MySQL / MariaDB (providing automated GUI backups, user management, and cron jobs).
2. **Infrastructure Isolation:** Running `pgvector` would require spinning up a secondary PostgreSQL instance outside CloudPanel's management scope, adding RAM overhead to the VPS.
3. **Decoupled Serverless Vector Store:** In modern enterprise architectures where MySQL serves OLTP traffic, offloading semantic search to a serverless vector database (**Pinecone**) is the standard pattern. It provides sub-30ms search latency, permanent free tier capacity, and zero server maintenance.
4. **Dependency Inversion (DIP):** Because the engine is programmed against `VectorStoreInterface`, migrating to `PgVectorStore` or `QdrantVectorStore` requires writing a single class and updating one line in `AppServiceProvider.php`.

### Why Server-Sent Events (SSE) instead of WebSockets?
* LLM completions are strictly one-directional streams from server to client.
* SSE runs over standard HTTP/1.1 or HTTP/2, requires zero stateful socket daemons (like Pusher or Laravel Reverb), works seamlessly through corporate proxies, and reconnects automatically.

### Why Web Speech API for STT + ElevenLabs for TTS?
* **Cost & Quota Protection:** Speech recognition happens client-side directly in the browser at 0 cost, saving OpenAI token credits.
* **Personalized Brand Experience:** ElevenLabs provides authentic voice cloning for recruiters and visitors, while the automated fallback ensures the application never crashes if the monthly quota is exhausted.

---

## 🔑 Environment Variables & API Keys

Create a `.env` file in the project root based on `.env.example`:

| Variable | Required | Description | Example / Default |
| :--- | :---: | :--- | :--- |
| `OPENAI_API_KEY` | **Yes** | OpenAI API key for `text-embedding-3-small` and `gpt-4o-mini` | `sk-proj-...` |
| `PINECONE_API_KEY` | **Yes** | Pinecone Data Plane API key | `pcsk_...` |
| `PINECONE_INDEX_NAME` | **Yes** | Target Pinecone vector index | `mcp-portfolio-rag` |
| `PINECONE_HOST` | **Yes** | Pinecone serverless host URL | `https://mcp-portfolio-rag-....pinecone.io` |
| `ELEVENLABS_API_KEY` | Optional | ElevenLabs API key for cloned voice synthesis | `sk_...` |
| `ELEVENLABS_VOICE_ID` | Optional | Voice ID of cloned voice in ElevenLabs | `21m00Tcm4TlvDq8ikWAM` |
| `ELEVENLABS_MODEL_ID` | Optional | ElevenLabs multilingual model | `eleven_multilingual_v2` |

> [!NOTE]
> The Pinecone index must be created with **Dimension: 1536** and **Metric: Cosine** to match the OpenAI `text-embedding-3-small` model.

---

## 🛠️ Local Development & Setup

### Prerequisites
* Docker & Docker Compose (or PHP 8.2+, Composer, Node.js 20+, MySQL 8.4+)
* Git

### Step-by-Step Installation

```bash
# 1. Clone the repository
git clone https://github.com/MoisesCorcho/mcp-portfolio.git
cd mcp-portfolio

# 2. Checkout feature branch
git checkout feat/v2-ai-chatbot-rag

# 3. Setup environment file
cp .env.example .env
# Edit .env and supply your OPENAI_API_KEY, PINECONE_*, and ELEVENLABS_* credentials

# 4. Install PHP dependencies
composer install

# 5. Generate application key
php artisan key:generate

# 6. Install Node dependencies and compile frontend assets
npm install
npm run build

# 7. Start environment (using Laravel Sail Docker)
./vendor/bin/sail up -d

# 8. Run database migrations & seeders
./vendor/bin/sail artisan migrate --seed
```

### Ingesting & Indexing the RAG Knowledge Base

To chunk the technical Markdown dossiers, generate embeddings with OpenAI, and index them into your Pinecone vector database, execute:

```bash
# Using Sail:
./vendor/bin/sail artisan rag:index

# Or native PHP:
php artisan rag:index
```

Output:
```text
Starting RAG Knowledge Base indexing...
  → Chunked 01-profile-and-capabilities.md (4 chunks)
  → Chunked 02-leenhoney-ecommerce.md (4 chunks)
  ...
  → Generated embeddings for batch 1/2
  → Successfully upserted 38 vector records into Pinecone.
Indexing completed! Total vector records indexed: 38
```

---

## 🧪 Testing Standard

The test suite covers unit domain models, gateway mock integrations, API streaming endpoints, and UI rendering:

```bash
# Run full test suite
php artisan test

# Run isolated RAG test suite
php artisan test --filter=Rag
```

Current test matrix:
* `Tests\Unit\Rag\RagDomainTest`: DTOs, Enums, dimensions, immutability (5 tests).
* `Tests\Unit\Rag\RagGatewaysTest`: Mocked OpenAI & Pinecone HTTP adapters, DI container binding (6 tests).
* `Tests\Unit\Rag\RagIndexingTest`: Markdown semantic chunking, upsert orchestration, Artisan command (3 tests).
* `Tests\Feature\Rag\RagChatApiTest`: Context retrieval, threshold filtering, SSE streaming output (3 tests).
* `Tests\Feature\Rag\RagDrawerRenderTest`: Blade view rendering, HUD triggers, localization (1 test).
* `Tests\Feature\Rag\RagTtsTest`: ElevenLabs audio synthesis, 503 fallback handling (4 tests).
* `Tests\Feature\V2ExtrudedBoxTest`: 2.5D extruded box physics, CAD corner pins (5 tests).

---

## 🌐 Production Deployment (Hostinger VPS + CloudPanel)

```bash
# 1. Pull latest release on server
git pull origin main

# 2. Install production dependencies
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# 3. Cache configuration, routes, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Synchronize RAG vector embeddings
php artisan rag:index

# 5. Restart PHP-FPM / Octane
systemctl restart php8.2-fpm
```

---

## 📄 License
This project is open-source software licensed under the [MIT License](LICENSE).
