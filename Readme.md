# Racing Game

Welcome to the Racing Game project! This simple PHP console-based game allows two players to race against each other using different vehicles.

## Features

- Choose vehicles from a predefined list.
- Race simulation with progress bars for each player.
- Determine the winner based on the first player to complete the race.

## Dependencies

This project uses the following packages:

- [PHP CLI Tools (php-cli-tools)](https://github.com/wp-cli/php-cli-tools): A collection of tools for PHP command-line applications.

## Deployment Considerations

During deployment, please ensure the following:

- PHP version 8.0 or higher is installed on the server.
- Composer is installed to manage project dependencies.

## How to Run

### Manual Execution

1. Clone the repository:

    ```bash
    git clone https://github.com/mohaphez/racing-game.git
    ```

2. Navigate to the project directory:

    ```bash
    cd racing-game
    ```

3. Install dependencies using Composer:

    ```bash
    composer install
    ```

4. Run the game:

    ```bash
    php src/index.php
    ```

### Dockerized Execution

1. Ensure Docker is installed on your machine.

2. Clone the repository:

    ```bash
    git clone https://github.com/mohaphez/racing-game.git
    ```

3. Navigate to the project directory:

    ```bash
    cd racing-game
    ```

4. Build the Docker image:

    ```bash
    docker build -t racing-game .
    ```

5. Run the Docker container:

    ```bash
    docker run -it racing-game
    ```

## Gameplay

- Players will be prompted to choose a vehicle from the available options.
- The game will simulate the race, displaying progress bars for each player.
- The winner will be declared once a player completes the race.
