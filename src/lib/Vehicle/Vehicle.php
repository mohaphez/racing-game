<?php
declare(strict_types=1);

namespace App\Vehicle;

class Vehicle
{
    private string $name;
    private int $maxSpeed;
    private string $unit;

    public function __construct(string $name, int $maxSpeed, string $unit)
    {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
        $this->unit = $unit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMaxSpeed(): int
    {
        return $this->maxSpeed;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function calculateTime(float $distance): float
    {
        return $distance / $this->maxSpeed;
    }
}
