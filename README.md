# IronPDF for C++ — Beta Landing Page

A single-page marketing site for the **IronPDF for C++ Beta Software Programme**. Visitors can read about the library, see what's coming soon, and submit their email address to join the early-access list.

---

## Technology

| Layer | Choice |
|---|---|
| Language | PHP 8.1+ |
| Framework | CodeIgniter 4.5 |
| Frontend CSS | Bootstrap 5.3 + custom `style.css` |
| Frontend JS | Vanilla ES6 (`main.js`) — no jQuery |
| Icons | Bootstrap Icons 1.11 |
| Content | `data/content.json` (CMS-style flat file) |
| Package manager | Composer |
| Dev tools | PHPUnit 10, FakerPHP, Kint |

---

## Project structure

```
app/
  Controllers/Home.php     # Landing page + sign-up form handler
  Views/
    layouts/main.php       # Base HTML layout
    home/index.php         # Page template (sections 1–7)
  Config/Routes.php        # GET / and POST /signup
data/
  content.json             # All copy, labels, and settings
public/
  index.php                # Front controller
  assets/
    css/style.css          # All custom styles
    js/main.js             # Flash-alert dismiss, form validation
    images/                # Section backgrounds, logos, icons
```

---

## Requirements

- PHP **8.1** or higher with the extensions `intl`, `mbstring`, and `json`
- Composer 2

---

## Setup


**1. Clone the repository**

Clone the project from GitHub:

```bash
git clone https://github.com/khinkhantkhanthlaing/iron.git
cd iron
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Copy the example environment file**

```bash
cp env.example .env

```

**4. Start the development server**

```bash
php spark serve
```

Open [http://localhost:8080](http://localhost:8080) in your browser.

---

## Form submissions

The sign-up form (`POST /signup`) validates the email address server-side and logs it via CodeIgniter's logger (`writable/logs/`). To forward submissions to a database or mailing-list provider, update `App\Controllers\Home::signup()`.

---

## Troubleshooting Permissions

If you see an error like:

    Cache unable to write to "writable/cache/"

or any other permission-related error for the `writable` directory, run the following command to fix permissions:

```bash
chmod -R 775 writable
```
