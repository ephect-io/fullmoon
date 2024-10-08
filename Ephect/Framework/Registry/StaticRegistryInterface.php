<?php

namespace Ephect\Framework\Registry;

interface StaticRegistryInterface
{
    static function getInstance(): RegistryInterface;

    static function write(string $key, $item): void;

    static function read($key, $item = null);

    static function items(): array;

    static function save(): bool;

    static function load(): bool;

    static function delete(string $key): void;

    static function exists(string $key): bool;

    static function setCacheDirectory(string $directory): void;

    static function getCacheFilename(): string;

    static function getFlatFilename(): string;
}
