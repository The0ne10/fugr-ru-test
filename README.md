1. Сделал Api как SPA, так и просто.
2. Cделал документацию через Swagger
3. Сделал небольшие тесты через Laravel TDD
4. Сделал конфигурацию Докер.


Тестовое задание на позицию php разработчика

Результат выполнения задания нужно будет оформить здесь же, на гитхабе. В качестве ответа не нужно присылать никаких ZIP-архивов и наборов файлов. Все ваши ответы должны быть оформлены на https://github.com/ или на https://bitbucket.org/ Присылаете ссылку на ваш репозиторий в форму https://24.future-group.ru/pub/form/4/xnof82/.

Если у вас еще нет аккаунта на github, то это хороший повод его завести.

Если есть вопросы, вы всегда их можете задать в чате https://t.me/futuregroup_php_chat

ЕСЛИ ВЫСЫЛАЕТЕ ПОДОБНОЕ ЗАДАНИЕ, ТО ПОДГОТОВЬТЕ ОПИСАНИЕ ФУНКЦИОНАЛА ДЛЯ ПРОВЕРЯЮЩЕГО.

Срок 5 рабочих дней с момента получения задания, срок проверки — 5 рабочих дней. Мы отправим ответ на email, если ответа нет, проверьте спам.

Разработать REST API для записной книжки . Примерная структура методов:

1.1. GET /api/v1/notebook/
1.2. POST /api/v1/notebook/
1.3. GET /api/v1/notebook/<id>/
1.4. POST /api/v1/notebook/<id>/
1.5. DELETE /api/v1/notebook/<id>/

Поля для POST запискной книжки:

1. ФИО (обязательное)
2. Компания
3. Телефон (обязательное)
4. Email (обязательное)
5. Дата рождения 
6. Фото

Нужна возможность выводить информацию в списке постранично

Swagger для отображения методов api (https://swagger.io/)

Так же напишите нам, как вы тестировали результат своей работы. Какие используете инструменты и как вы осуществляете тестирование.

Дополнительным плюсом будет: Финальный билд приложения должен быть запускаться из Docker контейнера (хотябы с минимальной конфигурацией)
