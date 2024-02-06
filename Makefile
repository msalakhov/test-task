check: cs-fix check-cs stan psalm
cs-fix:
	docker compose exec php-cli vendor/bin/phpcbf
check-cs:
	docker compose exec php-cli vendor/bin/phpcs
stan:
	docker-compose exec php-cli vendor/bin/phpstan analyze --memory-limit=512m
psalm:
	docker-compose exec php-cli vendor/bin/psalm

refresh: drop-database drop-database-test create-database create-database-test migrate migrate-test fixtures
drop-database:
	docker-compose exec php-cli php bin/console doctrine:database:drop --if-exists --force --no-interaction
create-database:
	docker-compose exec php-cli php bin/console doctrine:database:create --no-interaction
create-migration:
	docker-compose exec php-cli php bin/console make:migration
migrate:
	docker-compose exec php-cli php bin/console doctrine:migrations:migrate --no-interaction
fixtures:
	docker-compose exec php-cli php bin/console doctrine:fixtures:load --no-interaction -v
drop-database-test:
	docker-compose exec php-cli php bin/console doctrine:database:drop --if-exists --env=test --force --no-interaction
create-database-test:
	docker-compose exec php-cli php bin/console doctrine:database:create --no-interaction --env=test
migrate-test:
	docker-compose exec php-cli php bin/console doctrine:migration:migrate --env=test --no-interaction