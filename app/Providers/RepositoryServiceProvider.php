<?php

namespace App\Providers;

use App\Repositories\EloquentMarcaRepository;
use App\Repositories\MarcaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        MarcaRepository::class => EloquentMarcaRepository::class,
    ];
}
