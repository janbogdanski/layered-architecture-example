docker run --rm -it  --volume $PWD:/app  composer install --ignore-platform-reqs --no-cache

docker run -it -v $PWD:/app -w /app -p 8000:8000  php:8-cli sh -c "./symfony local:server:start --allow-all-ip"

docker run -it -v $PWD:/app -w /app  php:8-cli bash

./symfony local:server:start --allow-all-ip


docker compose exec app bash