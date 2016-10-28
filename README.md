# Getting started with Lo-module-email

### 1. Установка

```bash
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/loveorigami/lo-module-email.git"
    }
  ],
  "minimum-stability": "dev",
  "require": {
       "loveorigami/lo-module-email": "*"
  }
```

### 2. Update database schema

```bash
$ php yii migrate/up --migrationPath=@vendor/loveorigami/lo-module-email/src/migrations
$ php yii migrate/down --migrationPath=@vendor/loveorigami/lo-module-email/src/migrations
```

### 3. Create database schema
```bash
$ php yii migrate/create --migrationPath=@vendor/loveorigami/lo-module-email/src/migrations "email_country"

```