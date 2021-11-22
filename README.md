## Project: Search VSCode

### Setup instructions
1. Run the following commands to get the containers up
    ```bash
    cp docker-compose-dist.yml docker-compose.yml
    docker network create svsc-bridge
    docker-compose up -d --build
    ```
2. Backend app will be available at `localhost:8089`
