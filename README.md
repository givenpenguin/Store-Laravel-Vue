#  Поднятие контейнеров в Docker
В терминале проекта необходимо запустить команду
```bash
docker compose up -d
```

#  Запуск сервера
В терминале проекта необходимо запустить команду
```bash
php artisan serve
```

# Запуск приложения
В терминале проекта необходимо запустить команду
```bash
npm run dev
```

# Запуск миграций
1. Войти в контейнер
```bash
docker exec -it shop_app bash
```
2. Запустить миграции
```
php artisan migrate 
```
3. Запустить seeder
```
php artisan db:seed
```
