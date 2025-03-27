<?php

namespace App\Providers;

use App\Repositories\CarroRepository;
use App\Repositories\EloquentCarroRepository;
use App\Repositories\EloquentMarcaRepository;
use App\Repositories\EloquentModeloRepository;
use App\Repositories\EloquentVendaRepository;
use App\Repositories\MarcaRepository;
use App\Repositories\ModeloRepository;
use App\Repositories\VendaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        MarcaRepository::class => EloquentMarcaRepository::class,
        ModeloRepository::class => EloquentModeloRepository::class,
        CarroRepository::class => EloquentCarroRepository::class,
        VendaRepository::class => EloquentVendaRepository::class
    ];
}
