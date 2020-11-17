setup_application:
	@echo "making .env"
	cp src/.env.example src/.env
	@echo "\n\nsetting up docker"
	docker-compose build && docker-compose up -d
	@echo "\n\nRunning Composer in Docker"
	docker exec -it app composer install
	@echo "\n\nNow lets migrate"
	docker exec -it app php artisan migrate
	@echo "\n\nRun command to get offer and save to db"
	docker exec -it app php artisan offers:get
	@echo "\n\nnow you can navigate to https://localhost:8080"
	open http://localhost:8080

