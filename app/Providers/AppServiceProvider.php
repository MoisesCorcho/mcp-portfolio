<?php

namespace App\Providers;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\LlmProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\Gateways\Rag\OpenAiEmbeddingGateway;
use App\Gateways\Rag\OpenAiLlmGateway;
use App\Gateways\Rag\PineconeVectorStoreGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EmbeddingProviderInterface::class, OpenAiEmbeddingGateway::class);
        $this->app->singleton(VectorStoreInterface::class, PineconeVectorStoreGateway::class);
        $this->app->singleton(LlmProviderInterface::class, OpenAiLlmGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
