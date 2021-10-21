-include .env

export PROJECT=$(PROJECT_NAME)
export PORT=$(WEB_PORT)

DOCKER_COMPOSE ?= docker-compose
EXECUTE_APP ?= $(DOCKER_COMPOSE) exec app
RUN_PHP ?= $(DOCKER_COMPOSE) run --rm --no-deps app
RUN_COMPOSER = $(RUN_PHP) composer

all: create-network install ps --print-link
.PHONY: all

create-network:
	docker network create supermetrics.$(PROJECT) || true
.PHONY: create-network

install: up composer-install
.PHONY: install

up:
	$(DOCKER_COMPOSE) up --build --remove-orphans -d
.PHONY: up

composer-install:
	$(RUN_COMPOSER) install
.PHONY: composer-install

setup-bash:
	$(EXECUTE_APP) /bin/sh -c "echo 'source /etc/profile' > ~/.bashrc"
	$(EXECUTE_APP) /bin/sh -c "echo 'source <(bin/console _completion --generate-hook --shell-type=bash)' >> ~/.bashrc"
.PHONY: setup-bash

down:
	$(DOCKER_COMPOSE) down --remove-orphans
.PHONY: down

ps:
	$(DOCKER_COMPOSE) ps
.PHONY: ps

ssh:
	@$(EXECUTE_APP) /bin/sh
.PHONY: ssh

--print-link:
	@echo "\nIs everything ready!\n"\
	"It remains to click on the link to open the application:\n"\
	http://localhost:8081/users?email=test1@gmail.com
