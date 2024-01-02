#!/bin/bash

    # Reset the Git repository
    sudo git reset --hard

    # Pull the latest changes
    sudo git pull

    # Fixing ownership and permissions
    sudo chown -R yad:yad .
    sudo chmod -R 755 .

    # Stop and remove Docker containers
    sudo docker compose down

    # Start Docker containers in detached mode
    sudo docker compose up -d

