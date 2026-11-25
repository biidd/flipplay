<?php

namespace App\Models;

class DigitalReading extends Media
{
    public function getCategory(): string
    {
        return "Digital Reading";
    }
}

