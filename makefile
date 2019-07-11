COMPOSE_FILES=docker-compose.yml

USER_ID := $(shell id -u)

help:
	@echo "up"
	@echo "  Create and start containers."
	@echo ""
	@echo "shell"
	@echo "  Starting a zsh shell as \"www-data\" user in php container."
	@echo ""
	@echo "shell-as-root"
	@echo "  Starting a bash shell as \"root\" user in php container."
	@echo ""
	@echo "destroy"
	@echo "  Stop and remove containers, networks, and volumes."
	@echo ""
	@echo "provision"
	@echo "  Prepare project to run."
	@echo "";
	@echo

up:
	docker-compose -f $(COMPOSE_FILES) up -d

destroy:
	docker-compose -f $(COMPOSE_FILES) down

shell:
	docker-compose -f $(COMPOSE_FILES) exec --user=www-data php bash

shell-as-root:
	docker-compose -f $(COMPOSE_FILES) exec php bash

provision:
	docker-compose -f $(COMPOSE_FILES) exec -T php sed -i 's/www-data:x:33:33/www-data:x:$(USER_ID):$(USER_ID)/g' /etc/passwd
	docker-compose -f $(COMPOSE_FILES) exec -T php sed -i 's/www-data:x:33:/www-data:x:$(USER_ID):/g' /etc/group
	docker-compose -f $(COMPOSE_FILES) exec -T php service apache2 reload

	docker-compose -f $(COMPOSE_FILES) exec -T php composer update --prefer-dist
	docker-compose -f $(COMPOSE_FILES) exec -T php composer install
	docker-compose -f $(COMPOSE_FILES) exec --user=www-data php bash -c "echo yes | ./yii migrate"
	docker-compose -f $(COMPOSE_FILES) exec --user=www-data php bash -c "echo yes | ./tests/bin/yii migrate"
