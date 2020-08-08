include .env

ROOT_DIR := $(shell pwd)
CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)
CURRENT_USER := $(CURRENT_UID)":"$(CURRENT_GID)
CALENDAR_DIR := $(ROOT_DIR)"/www/calendar"

initenv:
	@cp ${CALENDAR_DIR}/.env.example ${CALENDAR_DIR}/.env
	@sed -i 's/APP_NAME=MVM/APP_NAME=${APP_NAME}/g' ${CALENDAR_DIR}/.env
	@sed -i 's/APP_URL=http:\/\/localhost/APP_URL=${PROTOCOL}:\/\/${HOST}/g' ${CALENDAR_DIR}/.env
	@sed -i 's/DB_HOST=127.0.0.1/DB_HOST=${MYSQL_HOST}/g' ${CALENDAR_DIR}/.env
	@sed -i 's/DB_DATABASE=laravel/DB_DATABASE=${MYSQL_DATABASE}/g' ${CALENDAR_DIR}/.env
	@sed -i 's/DB_USERNAME=root/DB_USERNAME=${MYSQL_USER}/g' ${CALENDAR_DIR}/.env
	@sed -i 's/DB_PASSWORD=/DB_PASSWORD=${MYSQL_PASSWORD}/g' ${CALENDAR_DIR}/.env

install:
	@docker-compose build
	@make initenv
	@make yarn-install
	@make yarn-dev
	@docker-compose run --rm phpfpm composer install
	@docker-compose run --rm phpfpm php artisan key:generate
	@make up

uninstall:
	@docker-compose down -v
	@rm ${CALENDAR_DIR}/.env
	@rm -rf ${CALENDAR_DIR}/vendor
	@rm -rf ${CALENDAR_DIR}/node_modules
	@rm -rf ${ROOT_DIR}/logs/nginx/*.log

# App
up:
	@docker-compose up -d

start:
	@docker-compose start

stop:
	@docker-compose stop

db:
	@docker-compose exec phpfpm php artisan migrate:fresh
	@docker-compose exec phpfpm php artisan db:seed


node:
	@docker run --rm -it -v $(CALENDAR_DIR):/app -w /app --user $(CURRENT_USER) node:${NODE_VERSION} /bin/bash

php:
	@docker exec -it mvm_phpfpm_1 /bin/bash


yarn-install:
	@docker run --rm -v $(CALENDAR_DIR):/app -w /app --user $(CURRENT_USER) node:${NODE_VERSION} yarn install

yarn-watch:
	@docker run --rm -v $(CALENDAR_DIR):/app -w /app --user $(CURRENT_USER) node:${NODE_VERSION} yarn watch-poll

yarn-dev:
	@docker run --rm -v $(CALENDAR_DIR):/app -w /app --user $(CURRENT_USER) node:${NODE_VERSION} yarn development
