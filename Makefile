TIMEOUT_MINS ?= 120
TIMEOUT_PID_FILE := /tmp/brothers_timeout.pid

.PHONY: start stop

start:
	mysql.server start
	php -S localhost:8000 &
	@sleep 1 && open http://localhost:8000
	@echo "起動完了 → http://localhost:8000"
	@( sleep $$(($(TIMEOUT_MINS) * 60)); mysql.server stop; pkill -f "php -S" || true; echo "⏰ $(TIMEOUT_MINS)分経過：サーバーを自動停止しました" ) & echo $$! > $(TIMEOUT_PID_FILE)
	@echo "⏰ $(TIMEOUT_MINS)分後に自動停止します（即時停止: make stop）"

stop:
	mysql.server stop
	pkill -f "php -S" || true
	@-[ -f $(TIMEOUT_PID_FILE) ] && kill $$(cat $(TIMEOUT_PID_FILE)) 2>/dev/null; rm -f $(TIMEOUT_PID_FILE)
	@echo "停止完了"
