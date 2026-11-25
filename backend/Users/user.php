<?php

namespace App\Users;

use App\Models\Media;

class User
{
    private string $name;
    private array $collection = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addToCollection(Media $media): void
    {
        $this->collection[] = $media;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
