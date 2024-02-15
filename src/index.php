<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Racing\RacingGame;
use App\Racing\RacingUtility;
use App\Support\Support;
use App\Vehicle\Vehicle;
use cli\Streams;

$asciiArt = "
 _______  _______  _______  _______ 
(  ____ )(  ___  )(  ____ \(  ____ )
| (    )|| (   ) || (    \/| (    )|
| (____)|| (___) || (__    | (____)|
|     __)|  ___  ||  __)   |     __)
| (\ (   | (   ) || (      | (\ (   
| ) \ \__| )   ( || (____/\| ) \ \__
|/   \__/|/     \|(_______/|/   \__/
";

Streams::line($asciiArt);
Streams::line("Welcome to the Racing Game!");
Streams::line("Get ready for an exciting race!");
Streams::line("-----------------------------------------------------------");

$vehiclesJsonPath = __DIR__ . '/public/vehicles.json';
$vehiclesData = json_decode(file_get_contents($vehiclesJsonPath), true);

$vehicles = [];
foreach ($vehiclesData as $vehicleData) {
    $vehicles[] = new Vehicle($vehicleData['name'], $vehicleData['maxSpeed'], $vehicleData['unit']);
}

$chosenVehiclePlayer1 = RacingUtility::chooseVehicle($vehicles, 'Player 1');
$chosenVehiclePlayer2 = RacingUtility::chooseVehicle($vehicles, 'Player 2');

Support::clearScreen();
Streams::line("Player 1 has chosen: {$chosenVehiclePlayer1->getName()}\n");
Streams::line("Player 2 has chosen: {$chosenVehiclePlayer2->getName()}\n");
sleep(3);
Support::clearScreen();

for($i = 0; $i < 5; $i++) {
    Streams::line("Game starting in " . (5 - $i) . "...");
    sleep(1);
    Support::clearScreen();
}

$player1 = ['name' => 'Player 1', 'vehicle' => $chosenVehiclePlayer1];
$player2 = ['name' => 'Player 2', 'vehicle' => $chosenVehiclePlayer2];


$game = new RacingGame();
$game->addPlayer($player1);
$game->addPlayer($player2);

$game->startRace(1000);