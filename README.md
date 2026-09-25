# Friendbox

A PHP-based social networking web application where users can connect, share photos, chat, and interact with each other in real time.

---

## Features

- **Authentication** — Register with profile & cover photo, login with bcrypt-hashed passwords
- **News Feed** — View posts from people you follow, like and comment on posts
- **Friends System** — Follow/unfollow users, view followers and following lists, friend suggestions
- **Photo Sharing** — Upload and share photos with captions
- **Real-time Chat** — Direct messaging between users
- **Bookmarks** — Save posts and view them in a dedicated saved feed
- **Profile Pages** — View and edit your profile, cover photo, and account details
- **User Search** — Search for other users by username
- **Admin Panel** — Separate admin dashboard for managing users and content

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8+ |
| Database | MySQL (MySQLi with prepared statements) |
| Frontend | HTML5, CSS3, JavaScript (jQuery) |
| Auth | Session-based, bcrypt password hashing |
| File Uploads | Server-side MIME validation, random filenames |

---

## Project Structure

```
friendbox/
├── api/                 # AJAX endpoints (likes, comments, chat, friends, etc.)
├── assets/
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript files
│   ├── fonts/           # Web fonts
│   └── images/          # Static images
├── includes/            # Shared PHP partials
│   ├── config.php       # Database connection
│   ├── nav.php          # Top navigation bar
│   ├── footer.php       # Footer
│   ├── sidenav.php      # Side navigation
│   ├── profileheader.php
│   └── userprofile.php
├── uploads/             # User-uploaded content
│   ├── posts/
│   ├── profileimg/
│   └── coverimg/
├── admin/               # Admin panel
├── database/            # SQL schema
├── index.php            # News feed (home)
├── login.php            # Login & registration
├── chat.php             # Messaging
├── friends.php          # Friends / following
├── photos.php           # Your photos
├── saved.php            # Bookmarked posts
├── viewprofile.php      # View another user's profile
├── updateprofile.php    # Edit your profile
└── detail.php           # Profile detail view
```

---

## Getting Started

### Prerequisites

- PHP 8.0+
- MySQL 5.7+ or MariaDB
- Apache / Nginx with `mod_rewrite` enabled (XAMPP / WAMP / Laragon work fine)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Avikheni35/Friendbox.git
   cd Friendbox
   ```

2. **Import the database**
   - Open phpMyAdmin (or any MySQL client)
   - Create a new database named `friendbox`
   - Import `database/friendbox.sql`

3. **Configure the database connection**

   Edit `includes/config.php`:
   ```php
   $conn = mysqli_connect("localhost", "root", "", "friendbox");
   ```
   Update the host, username, and password to match your environment.

4. **Set upload folder permissions**
   ```bash
   chmod 755 uploads/posts uploads/profileimg uploads/coverimg
   ```

5. **Start your server**

   Place the project in your web server's root directory (e.g. `htdocs/` for XAMPP) and visit:
   ```
   http://localhost/friendbox/login.php
   ```

---

## Security

- All database queries use **prepared statements** (no raw SQL interpolation)
- Passwords stored with **bcrypt** (`password_hash` / `password_verify`)
- File uploads validated by **MIME type**, **extension whitelist**, and **size limit (5 MB)**
- Uploaded files renamed with **random hex filenames** to prevent path traversal
- All API endpoints require an authenticated session

---

## License

This project is open source and available under the [MIT License](LICENSE).
