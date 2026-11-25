<?php

namespace App\Services;

use App\Models\Media;

class Library
{
    private array $mediaList = [];

    public function addMedia(Media $media): void
    {
        $this->mediaList[] = $media; 
    }

    public function getAllMedia(): array
    {
        return $this->mediaList;
    }

    public function searchByTitle(string $title): ?Media
    {
        foreach ($this->mediaList as $media) {
            if (stripos($media->getTitle(), $title) !== false) {
                return $media;
            }
        }

        return null;
    }

    public function findById(int $id): ?Media
    {
        foreach ($this->mediaList as $media) {
            if ($media->getId() === $id) {
                return $media;
            }
        }

        return null;
    }
}
