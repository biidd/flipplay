<?php

namespace App\Models;

class Video extends Media
{
    public function getCategory(): string
    {
        return "Streaming Video";
    }
}

