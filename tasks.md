# Mod Hosting Backend Checklist

## 1. Core Domain Models
- **User**
    - id, username, email, password (hashed), role (admin, mod, user), created_at, updated_at
- **Mod**
    - id, slug, name, description, category, loaders (e.g., Fabric, Forge), side (client/server/both), downloads (counter), license, created_at, updated_at
- **File**
    - id, mod_id, version string (e.g., `1.2.0`), changelog, file upload, checksum (SHA256), supported game versions
- **Category**
    - id, name (e.g., “Technology”, “Magic”, “QoL”)
- **Loader**
    - id, name (Forge, Fabric, Quilt, NeoForge, etc.)
- **GameVersion**
    - id, version string (e.g., `1.20.1`)

---

## 2. User & Authentication
- Registration/login (email + password, OAuth optional)
- Password hashing (bcrypt/argon2)
- JWT or session-based authentication
- Roles/permissions (admin, moderator, uploader, viewer)

---

## 3. Mod Management
- Create a mod (submit metadata + logo + description)
- Update mod info (name, description, category, loaders, license)
- Delete/archive mods (soft delete recommended)
- Moderation tools (approve mods, flag inappropriate content)

---

## 4. Version / File Management
- Upload release files (JAR/ZIP)
- Validate file size and type
- Store files (local storage)
- Generate checksums for integrity
- Link versions to supported game versions and loaders
- Changelog support

---

## 5. Search & Discovery
- Browse mods by category, loader, game version, side, license
- Search by name/keywords
- Sort by popularity, date, downloads
- Pagination

---

## 6. Download System
- Count downloads per mod and per version
- Serve files efficiently (CDN recommended)
- Optional: download analytics (by user, region, time)

---

## 7. Moderation & Reporting
- Admin dashboard (approve mods, review reports)
- Report system (users can report mods/files)
- Ban/suspend users

---

## 8. API
- REST (or GraphQL) endpoints
- Authentication middleware (e.g., JWT bearer token)
- Rate limiting to prevent abuse

