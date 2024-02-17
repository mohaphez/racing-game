<?php

declare(strict_types=1);

namespace App\Racing;

use App\Support\Support;
use App\Vehicle\Vehicle;
use cli\progress\Bar as ProgressBar;

class RacingGame
{

    private array $players = [];

    public function addPlayer(array $player): void
    {
        $this->players[] = $player;
    }

    public function startRace(float $distance): void
    {
        $progressBars = $this->initializeProgressBars($distance);
        $fasterVehicle = $this->getFasterVehicle();
        $speedPercent = abs($this->players[0]['vehicle']->getMaxSpeedInKmPerHour() / $this->players[1]['vehicle']->getMaxSpeedInKmPerHour());
        $flag = 0;

        while (!empty($progressBars)) {

            foreach ($this->players as $player) {
                $this->displayPlayerProgressBar($player, $progressBars, $fasterVehicle, $speedPercent, $flag);
            }

            usleep(80000);
            Support::clearScreen();

            if ($this->isRaceFinished($progressBars)) {
                $winner = $this->determineWinner();
                $this->announceWinner($winner);
                break;
            }
        }
    }

    private function displayPlayerProgressBar(array $player, array &$progressBars, Vehicle $fasterVehicle, float $speedPercent, int &$flag): void
    {
        $progressBar = $progressBars[$player['name']];
        $progressBar->display();

        if ($this->shouldSkipProgressBarUpdate($fasterVehicle, $player, $flag, $speedPercent)) {
            $flag += 1;
            return;
        }

        if ($this->shouldResetFlag($fasterVehicle, $player, $flag, $speedPercent)) {
            $flag = 0;
        }

        $progressBar->tick();
    }

    private function shouldSkipProgressBarUpdate(Vehicle $fasterVehicle, array $player, int $flag, float $speedPercent): bool
    {
        return $fasterVehicle->getName() !== $player['vehicle']->getName() && $flag < $speedPercent;
    }

    private function shouldResetFlag(Vehicle $fasterVehicle, array $player, int $flag, float $speedPercent): bool
    {
        return $fasterVehicle->getName() !== $player['vehicle']->getName() && $flag >= $speedPercent;
    }

    private function announceWinner(array $winner): void
    {
        echo "{$winner['name']}'s {$winner['vehicle']->getName()} finished the race!\n";
    }

    private function initializeProgressBars(float $distance): array
    {
        $progressBars = [];
        foreach ($this->players as $player) {
            $progressBars[$player['name']] = new ProgressBar("{$player['name']}_{$player['vehicle']->getName()}", $distance);
        }
        return $progressBars;
    }

    private function getFasterVehicle(): Vehicle
    {
        return $this->players[0]['vehicle']->getMaxSpeedInKmPerHour() > $this->players[1]['vehicle']->getMaxSpeedInKmPerHour()
            ? $this->players[0]['vehicle']
            : $this->players[1]['vehicle'];
    }

    private function displayProgressBar(ProgressBar $progressBar): void
    {
        $progressBar->display();
    }

    private function isRaceFinished(array $progressBars): bool
    {
        foreach ($progressBars as $player => $progressBar) {
            if ((int)$progressBar->percent() === 1) {
                return true;
            }
        }
        return false;
    }

    private function determineWinner(): array
    {
        $minTime = PHP_INT_MAX;
        $winner = null;

        foreach ($this->players as $player) {
            $time = $player['vehicle']->calculateTime(1000);
            if ($time < $minTime) {
                $minTime = $time;
                $winner = $player;
            }
        }

        return $winner;
    }
}
