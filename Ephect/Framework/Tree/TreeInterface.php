<?php

namespace Ephect\Framework\Tree;

use Closure;
use IteratorAggregate;

interface TreeInterface extends IteratorAggregate
{
    public function add($object): int;

    public function addArray($array): int;

    public function insert($object, $index): bool;

    public function update($object, $index): bool;

    public function removeAt($index): bool;

    public function find($object): ?int;

    public function items(?int $index = null);

    public function count(): int;

    public function hasChildren(): bool;

    public function forEach(callable $callback, TreeInterface $tree, Closure|null $breakOn = null): void;

    public function forEachRecursive(callable $callback, TreeInterface $tree, Closure|null $breakOn = null): void;

    public function clear(): void;


}
