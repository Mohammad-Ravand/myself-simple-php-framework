<?php
namespace App\Contracts\Providers;

interface ProviderInterface{
    public function bind(): void;
    public function resolve(): void;
}