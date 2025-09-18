## Notes and decisions:
- It was not specified if adding invoice should be done together with lines, for simplicity adding invoice is independent from adding line. It means more api calls to add lines one by one. it is not possible to asses if it is worse or not because of lack of requirements and estimated load
- invoice view contains all the fields from main entities, even though it was added to separate view from entity and not worry when new fields will be introduced but not expected to be exposed
- I have added calculated fields — total price and total unit price in entities and stored in database, at the very beginning I understood that >invoice structure< section describes models. Later on I understood that it is only view structure requirement, I left it untouched in initial implementation but generally it woule be enough to calculate it on the fly while rendering view, it does not seem to be complex/time consuming task so I would prefer to not store it in db as it might be error prone and more time consuming in maintenance
- Uuid is leaking across application, as a ultimate solution it would be better to have it hidden behind Value Object — I left as is for simplicity in this MVP
- There is no error handling nor logging, only Assertions in code to ensure code works, expected types are used and actions on specific objects called
- I ported task to Symfony as I am fluent in this framework and didn't want to be stuck in Laravel which I know only a little bit
- regarding point >Change the Invoice Status to sending after sending the notification.< - I would prefer store status first and then send notification. I faced race condition when notification has been sent async and processed faster than status change :)
## Setup
```
docker run --rm -it  --volume $PWD:/app composer install --ignore-platform-reqs --no-cache
docker compose up -d
docker compose exec app bin/console doctrine:migrations:migrate
```

docker compose exec app bash