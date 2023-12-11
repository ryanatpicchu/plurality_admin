### 設置步驟

1. `mv .env.example .env` 並設置DB 相關參數

2. `docker compose up`

3. `docker exec -it plurality_admin-admin.plurality.moda.gov.tw-1 /bin/bash` 或 `docker exec -it [CONTAINER ID] /bin/bash`

4. 重置、建立資料庫tables 及測試用登入資料: `php artisan migrate:reset --force && php artisan migrate --force && php artisan db:seed --force`

