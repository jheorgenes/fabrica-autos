<?php

namespace App\Providers;

use App\Repositories\EloquentMarcaRepository;
use App\Repositories\EloquentModeloRepository;
use App\Repositories\MarcaRepository;
use App\Repositories\ModeloRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        MarcaRepository::class => EloquentMarcaRepository::class,
        ModeloRepository::class => EloquentModeloRepository::class
    ];
}
