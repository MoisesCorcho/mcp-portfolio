# Project: Anime Recommender Engine

## Overview & Links
- **Repository**: https://github.com/MoisesCorcho/anime-recommender
- **Role**: AI Engineer & Full-Stack Developer

## Architecture & Engineering
- **Core Stack**: Laravel 13, PostgreSQL 18, `pgvector`, OpenAI Embeddings (`text-embedding-3-small`), Redis Queues, Livewire 3, Tailwind CSS.
- **Vector Search Engine**: High-dimensional semantic search over thousands of anime titles, synopses, and genre embeddings using HNSW indexing and cosine similarity.
- **Asynchronous Pipeline**: Heavy vector embeddings and metadata ingestion processed via background Redis queue workers.

## Key Technical Achievements & What Moisés Did
- Designed vector ingestion pipeline parsing large unstructured text synopses into semantic embeddings.
- Configured PostgreSQL `pgvector` with HNSW (`m=16`, `ef_construction=64`) for sub-10ms nearest neighbor queries across high-dimensional space.
- Combined traditional relational filters (genre, release year, studio) with vector similarity scoring for hybrid recommendation results.
- Built reactive search and recommendation UI in Livewire 3 with instant filter feedback.

## What Moisés CAN Build Based on This
- Semantic recommendation systems and AI-powered product discoverability engines.
- PostgreSQL + `pgvector` hybrid retrieval architectures (combining SQL metadata with vector search).
- Background queue-driven batch embedding generation pipelines.

## Limitations
- Does not train deep learning neural network foundation models from scratch (uses transfer learning, fine-tuning, embeddings, and vector similarity).
