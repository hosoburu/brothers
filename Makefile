.PHONY: start stop

start:
	mysql.server start
	php -S localhost:8000 &
	@sleep 1 && open http://localhost:8000
	@echo "起動完了 → http://localhost:8000"

stop:
	mysql.server stop
	pkill -f "php -S" || true
	@echo "停止完了"
