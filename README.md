# Adventure Blog

> **Project Summary for Recruiters**  
> Adventure Blog is a full-stack web app built with **Laravel 12**, **Inertia.js**, and **Vue 3 with TypeScript**.  
> It demonstrates my ability to design, scaffold, and deploy a modern blogging platform with a Dockerized development environment,  
> TypeScript-enabled frontend, file uploads (local + S3), authentication, and clean code organization.  
> This project highlights practical experience with PHP/Laravel, Vue/TS, Vite, and Docker.

---

## Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-35495E?logo=vue.js&logoColor=4FC08D)
![TypeScript](https://img.shields.io/badge/TypeScript-3178C6?logo=typescript&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?logo=vite&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?logo=docker&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Redis](https://img.shields.io/badge/Redis-DC382D?logo=redis&logoColor=white)
![Amazon%20S3](https://img.shields.io/badge/Amazon%20S3-569A31?logo=amazons3&logoColor=white)

---

## Features

- **Laravel 12 backend**
  - Dockerized local development using [Laravel Sail](https://laravel.com/docs/sail)
  - MySQL, Redis, Meilisearch, Mailpit, and Selenium included in the dev stack
  - Authentication, user profiles, and dashboard (via Breeze)

- **Vue 3 + TypeScript frontend**
  - Inertia.js bridges Laravel and Vue for a smooth single-page app experience
  - TypeScript enabled (`<script setup lang="ts">`) with full type-checking via Volar
  - Vite-powered asset pipeline for development and production

- **Blog Posts CRUD**
  - `Post` model with fields: `title`, `slug`, `excerpt`, `body`, `cover_path`, `published_at`
  - Controller actions: index, create, store, show
  - Image upload (cover) with disk abstraction:
    - Local storage in development
    - Amazon S3 in production (`FILESYSTEM_DISK=s3`)

- **Frontend pages**
  - `Posts/Index` – paginated post list with cover previews
  - `Posts/Create` – form for creating posts, with file upload and publish toggle
  - `Posts/Show` – detail view with cover image and publish date formatting

- **Developer experience**
  - Configured for WSL2 + Docker Desktop
  - Port conflicts resolved (runs at `http://localhost/`)
  - VS Code optimized with Volar Take Over Mode + TypeScript SDK from project
  - Hot reloading with `sail npm run dev`

---

## Getting Started

### Prerequisites
- Docker Desktop with WSL2 integration enabled  
- VS Code (recommended) with [Vue – Official](https://marketplace.visualstudio.com/items?itemName=Vue.volar) extension installed

### Local Development
```bash
# clone repo
git clone https://github.com/yourusername/adventure-blog.git
cd adventure-blog

# start containers
./vendor/bin/sail up -d

# run migrations
./vendor/bin/sail php artisan migrate

# run Vite dev server
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

Visit: [http://localhost](http://localhost)

---

### Storage
- Local dev: files are saved in `storage/app/public/covers` and served via `public/storage`
- Production: configure `.env` with your S3 bucket details:
  ```dotenv
  FILESYSTEM_DISK=s3
  AWS_ACCESS_KEY_ID=xxx
  AWS_SECRET_ACCESS_KEY=xxx
  AWS_DEFAULT_REGION=us-east-1
  AWS_BUCKET=your-bucket-name
  ```

---

## Roadmap

- Edit/update and delete posts  
- Comments system  
- Rich text editor for post body  
- Deployment config (Nginx + PHP-FPM + queue worker)  
- GitHub Actions for CI/CD  

---

## License

MIT
