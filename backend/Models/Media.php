<?php

namespace App\Models;

abstract class Media
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $type;

    public function __construct(
        int $id,
        string $title,
        string $description,
        string $type
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    abstract public function getCategory(): string;

    public function getDetail(): string
    {
        return "ID: {$this->id}\n"
            . "Judul: {$this->title}\n"
            . "Deskripsi: {$this->description}\n"
            . "Tipe: {$this->type}\n"
            . "Kategori: {$this->getCategory()}";
    }
}
