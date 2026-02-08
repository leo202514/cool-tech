# Cool Tech - Laravel CMS

A dynamic technology news and blog platform built with Laravel. This project features a full authentication system with role-based access control (RBAC), allowing for separate Admin, Writer, and Guest experiences.

## 🚀 Features

- **Role-Based Access Control:**
    - **Admins:** Manage users, categories, and all site content via a dedicated User Admin Console.
    - **Writers:** Create and manage their own tech articles through a private Writer Console.
    - **Users:** Register to view content and search the database.
- **Advanced Search Engine:** - Search by keyword (title/content).
    - Search by specific Article ID with error handling for non-existent IDs.
    - Filter by Category and Tags using "search-as-you-type" datalists.
- **Dynamic Homepage:** Automatically displays the 5 most recent articles.
- **Article Archive:** A full listing of all published articles with pagination support.

## 🛠️ Technical Stack

- **Framework:** Laravel 11.x
- **Language:** PHP 8.4
- **Database:** MySQL / SQLite
- **Frontend:** Blade Templates & Custom CSS

---

## 💻 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/yourusername/cool-tech.git](https://github.com/yourusername/cool-tech.git)
   cd cool-tech

```

2. **Install dependencies:**
```bash
composer install

```


3. **Environment Setup:**
```bash
cp .env.example .env
php artisan key:generate

```


4. **Database Migration & Seeding:**
```bash
php artisan migrate:fresh --seed

```


*Note: This will wipe your database and create the default Admin and Writer accounts.*

---

## 🔑 Default Credentials

After seeding, use these accounts to explore the different permission levels:

| Role | Email | Password |
| --- | --- | --- |
| **Admin** | `admin@cooltech.com` | `admin123` |
| **Writer** | `writer@cooltech.com` | `writer123` |

---

## 📂 Project Structure Highlights

* **`App\Http\Middleware`**: Contains `AdminAuth` and `AuthorAuth` for route security.
* **`App\Http\Controllers`**:
* `UserAdminController.php`: Manages user roles and account deletion.
* `ArticleController.php`: Handles the public search and article views.
* `WriterController.php`: Manages the writing/editing workflow.


* **`resources/views/layouts/app.blade.php`**: The master template containing the dynamic navbar.

---

## 📝 License

This project is open-source and available under the [MIT License](https://www.google.com/search?q=LICENSE).

```

### Pro Tip for GitHub
When you upload this to GitHub, the `README.md` will automatically be rendered as a professional-looking landing page for your repository.

**Would you like me to help you write a `.gitignore` file to make sure you don't accidentally upload your private `.env` passwords to GitHub?**

```
