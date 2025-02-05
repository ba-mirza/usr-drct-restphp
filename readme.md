# Справочник для управления пользователями

<p align="center">
  <img src="https://www.php.net/images/logos/php-logo.svg" alt="PHP Logo" width="80"> 
  <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" alt="MySQL Logo" width="80">
  <img src="https://vitejs.dev/logo.svg" alt="Vite Logo" width="80">
</p>

## Реализованные функции:
| Функция                           | Статус |
|------------------------------------|--------|
| Создание нового пользователя      | Done   |
| Редактирование существующего пользователя | Done   |
| Блокировка пользователя            | Done   |

## Использованные технологии:
- **Backend:** PHP + MySQL
- **Frontend:** Vite + VanillaJS + Webix

## Модели таблиц:
```sql
CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_name VARCHAR(50) NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  login VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role_id INT NOT NULL,
  is_blocked BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);
```

## Инструкция по запуску:

### Clone:
```bash
git clone <repository>
cd <project_folder>
```

### Backend:
```bash
cd backend
php -S localhost:8000
```

### Frontend:
```bash
npm i
npm run dev
```

---
**Замечание:** Да, можно сделать лучше, вынести в .env, разбить на модули и т.д.

