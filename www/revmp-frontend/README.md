# РОЦДИ (frontend)

Структура проекта
-----------------

      build/              содержит конфигурацию сборки frontend'а
      environments/       содержит окружения необходимые для развёртывания
      frontend/           содержит весь frontend
      node_modules/       содержит зависимости frontend'а
      web/                содержит точку входения
      static/             содержит точку статику
      
Зависимости
-----------

- yarn - 1.12 (+)
- nginx - 1.15 (+)

Установка
---------

1. Склонировать репозиторий, перейти в необходимую ветку
2. Выполнить команду `yes | cp -rf ./environments/${VAL}/* .` в папке с проектом выбрав соответствующее окружение
${VAL}. Возможные значения:
    * test
    * predrelease
    * production
    * developer
3. Добавить новый host (для локального использования):
```bash
sudo sed -i "s/\(127.0.0.1\)/\1\trevmp.local/" /etc/hosts
```

4. Для настройки nginx выполните следующие команды из папки с проектом
```bash
sudo cp nginx.example /etc/nginx/sites-available/revmp
sudo ln -s /etc/nginx/sites-available/revmp /etc/nginx/sites-enabled/revmp
sudo systemctl restart nginx
```

5. Выполнить командe `yarn` в папке с проектом чтобы подтянуть зависимости
6. Сборка frontend'а:
    * Для промышленного контура `yarn build`
    * Для разработки `yarn watch`

Docker
------

При запуске контейнера указывать необходимое окружение в переменную `env`:
* test
* predrelease
* production
* developer

Например:
`docker run -dit -p 80:80 --env env=developer --network revmp-net --name revmp-frontend revmp-frontend`
