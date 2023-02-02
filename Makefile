PHONY :=
.DEFAULT_GOAL := help
SHELL := /bin/bash

OS := $(shell uname -s)

help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e "s/##//"

##Welcome to Business Trips project to get you started type 'make help'

##
##Docker Commands
##

PHONY += up
up:			## Launch project
up:
	$(call colorecho, "\nStarting project on $(OS)")
	@docker-compose up -d

PHONY += down
down: 			## Tear down project
	$(call colorecho, "\nTear down project docker\n\n- Stoping all containers...\n")
	@docker-compose down

PHONY += recreate
recreate: 			## Recreate docker containers
	$(call colorecho, "Recreate docker containers...\n")
	@docker-compose up -d --build --force-recreate  --remove-orphans

PHONY += restart
restart:		## Restart Docker
restart: down up logs

PHONY += ps
ps:			## Docker containers process status
ps:
	$(call colorecho, "\nDocker containers process status $(OS)")
	@docker-compose ps

PHONY += migration
migration:	## Create Migration files
migration:
	$(call colorecho, "\nCreating Database Migration:\n")
	@docker exec bs-php bin/console doctrine:cache:clear-metadata
	@docker exec bs-php bin/console make:migration

PHONY += migrate
migrate:		## Migrate database
migrate:
	$(call colorecho, "\nMigrating Project Datase\n")
	@docker exec bs-php bin/console doctrine:migrations:migrate --no-interaction


PHONY += ssh
attach:		## SSH to API container
attach:
	$(call colorecho, "\nAttach to console in container (bs-php docker image):\n")
	@docker exec -it bs-php /bin/sh

##
##Logs
##

PHONY += logs
logs:			## View Logs from Docker
logs:
	@docker-compose logs -f

PHONY += appl
appl:			## View Application Logs from Docker
appl:
	@docker exec -it bs-php tail -f /application/var/log/dev.log

PHONY += clear
clear:	## Clear API (Symfony) cache command
	$(call colorecho, "\nClearing Cache\n")
	@docker exec bs-php rm -rf var/cache
	@docker exec bs-php composer dump-autoload --optimize --classmap-authoritative --ansi
	@docker exec bs-php php bin/console cache:warmup

PHONY += composer install
composer install:	## Running composer install
	$(call colorecho, "\nRunning composer install\n")
	@docker exec bs-php composer install

PHONY += quality
quality:         ## Run quality checks
quality:
	$(call colorecho, "\nStart checking quality of code\n")
	@docker exec bs-php vendor/squizlabs/php_codesniffer/bin/phpcs --config-set installed_paths vendor/escapestudios/symfony2-coding-standard
	@docker exec bs-php php bin/phpcs --standard=phpcs.xml --report=full -p src
	@docker exec bs-php php bin/phpstan analyse -l 6 -c phpstan.neon src/ --memory-limit=8000M
	@docker exec bs-php php bin/phpmd src/ text ruleset.xml

PHONY += test
test:           ## Run unit tests
test:
	$(call colorecho, "\nStarting unit tests\n")
	@docker exec bs-php php bin/phpspec run -c phpspec.yml

define colorecho
	@tput -T xterm setaf 3
	@shopt -s xpg_echo && echo $1
	@tput -T xterm sgr0
endef
