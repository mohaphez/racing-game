<?php

declare(strict_types=1);

namespace App\Racing;

use App\Support\Support;
use App\Vehicle\Vehicle;
use cli\Streams;

class RacingUtility
{
    public static function chooseVehicle(array $vehicles, string $playerName): Vehicle
    {
        while (true) {

            Streams::line("$playerName, choose a vehicle:");

            $items = [];
            foreach ($vehicles as $index => $vehicle) {
                $items[] = "{$vehicle->getName()} (Max Speed: {$vehicle->getMaxSpeed()} {$vehicle->getUnit()})";
            }

            $chosenIndex = Streams::menu($items);

            if (isset($vehicles[$chosenIndex])) {
                return $vehicles[$chosenIndex];
            }

            Support::clearScreen();
            Streams::err("Invalid selection. Please choose a valid option.\n");
        }


    }
}