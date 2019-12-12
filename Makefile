DOCKER_COMPOSE_DIR=./docker
DOCKER_COMPOSE_FILE=$(DOCKER_COMPOSE_DIR)/docker-compose.yml
DOCKER_COMPOSE=docker-compose -f $(DOCKER_COMPOSE_FILE) --project-directory $(DOCKER_COMPOSE_DIR)

DEFAULT_GOAL := help
help:
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z0-9_-]+:.*?##/ { printf "  \033[36m%-27s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

##@ [Docker] Build
.PHONY: docker-build
docker-build: ## Build all docker images, install composer dependencies.
	$(DOCKER_COMPOSE) build --parallel && \
	docker run --rm -it -v $(shell pwd):/app composer install

.PHONY: docker-up
docker-up: ## Start all docker containers.
	$(DOCKER_COMPOSE) up --build -d $(CONTAINER)

.PHONY: docker-down
docker-down: ## Stop all docker containers.
	$(DOCKER_COMPOSE) down $(CONTAINER)

.PHONY: docker-prune
docker-prune: ## Remove unused docker resources via 'docker system prune -a -f --volumes'.
	docker system prune -a -f --volumes
