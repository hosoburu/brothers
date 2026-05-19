TIMEOUT_MINS ?= 120
TIMEOUT_PID_FILE := /tmp/brothers_timeout.pid

-include .env

.PHONY: start stop deploy

start:
	mysql.server start
	php -S localhost:8000 -t public &
	@sleep 1 && open http://localhost:8000/index.php
	@echo "起動完了 → http://localhost:8000/index.php"
	@( sleep $$(($(TIMEOUT_MINS) * 60)); mysql.server stop; pkill -f "php -S" || true; echo "⏰ $(TIMEOUT_MINS)分経過：サーバーを自動停止しました" ) & echo $$! > $(TIMEOUT_PID_FILE)
	@echo "⏰ $(TIMEOUT_MINS)分後に自動停止します（即時停止: make stop）"

stop:
	mysql.server stop
	pkill -f "php -S" || true
	@-[ -f $(TIMEOUT_PID_FILE) ] && kill $$(cat $(TIMEOUT_PID_FILE)) 2>/dev/null; rm -f $(TIMEOUT_PID_FILE)
	@echo "停止完了"

deploy:
	@printf "本番環境にデプロイします。よろしいですか？ [y/N]: "; \
	read ans; \
	if [ "$$ans" != "y" ] && [ "$$ans" != "Y" ]; then echo "キャンセルしました"; exit 1; fi; \
	echo "デプロイを開始します..."; \
	ssh $(DEPLOY_USER)@$(DEPLOY_HOST) -p $(DEPLOY_PORT) -i $(DEPLOY_KEY) \
		"cd $(DEPLOY_DIR) && \
		/home/$(DEPLOY_USER)/git fetch && \
		/home/$(DEPLOY_USER)/git checkout master && \
		/home/$(DEPLOY_USER)/git branch -D develop && \
		/home/$(DEPLOY_USER)/git checkout develop && \
		echo 'デプロイ完了'"
