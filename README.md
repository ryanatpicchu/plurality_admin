### 設置步驟

1. `docker compose up`


2. `docker exec -it plurality_admin-admin.plurality.moda.gov.tw-1 /bin/bash` 或 `docker exec -it [CONTAINER ID] /bin/bash`


3. 重置、建立資料庫tables 及測試用登入資料: `php artisan migrate:reset --force && php artisan migrate --force && php artisan db:seed --force`

