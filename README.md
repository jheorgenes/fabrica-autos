# Fabrica de Automóveis

Este projeto foi desenvolvido utilizando **Laravel 9** e o banco de dados **MySQL**

---

## Configuração do Ambiente

### **Observação Importante**
Foi publicado o arquivo .env propositalmente, por se tratar de um projeto de teste e pra facilitar o download do mesmo.

### 1 Instalar Dependências do Laravel

```bash
composer install
```

Edite o arquivo `.env` e configure as credenciais do banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_autos
DB_USERNAME=root
DB_PASSWORD=
```

### 2 Executar Migrações

```bash
php artisan migrate
```

### 3 Executar Seeders

```bash
php artisan db:seed
```

### 4 Iniciar o Servidor

```bash
php artisan serve
```

Aplicação estará disponível em: *http://localhost:8000/*

---
