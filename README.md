# EduSched — School Exam Scheduling System

EduSched is a web-based application developed for an **Information Systems Analysis and Design (APSI), Semester 3** course project. It is designed to help schools or tutoring organizations organize exam schedules, coordinate teacher activity, and manage question files associated with each schedule.

> **Project type:** Web application  
> **Project context:** Academic project — Semester 3  
> **Public showcase:** [EduSched-Showcase](https://github.com/SamuelPhe/EduSched-Showcase)

## 1. Application preview

Full application screenshots are not currently included in this repository. The existing image assets are branding and template resources, not verified screenshots of the running application.

Suggested screenshots to add:
- Login screen
- Administrator schedule management
- Teacher schedule and task view
- Activity history and PDF report

Use sample school, teacher, class, and schedule data. Do not upload real exam papers, student information, or private profile images.

## 2. Main features

- Login with **administrator** and **teacher** roles
- Exam schedule management by school, class, and subject
- Schedule dates, descriptions, and work-status tracking
- Question-file uploads associated with schedules
- User account management
- Activity history and change tracking
- Monthly activity summaries and PDF report export

## 3. Technology stack

- PHP (native)
- MySQL / MariaDB
- MySQLi
- HTML, CSS, and JavaScript
- Bootstrap
- Dompdf for PDF generation

## 4. Architecture overview

EduSched uses a page-oriented PHP application structure. Browser requests are handled by PHP pages and action scripts. The application connects to MySQL through a shared MySQLi connection, stores schedule and user records in the database, handles question-file uploads on the server, and uses Dompdf for PDF reports.

```mermaid
flowchart TD
    U[Administrator or Teacher] --> UI[Browser Interface]
    UI --> PHP[PHP Pages and Action Scripts]
    PHP --> AUTH[Authentication and Role Guard]
    PHP --> DBL[Shared MySQLi Connection]
    DBL --> DB[(MySQL / MariaDB)]
    PHP --> FS[Server File Storage]
    PHP --> PDF[Dompdf Report Generator]
    PDF --> OUT[PDF Report]
```

## 5. Demo and local setup

There is currently **no publicly hosted demo**. The application can be explored locally after preparing PHP and the database.

1. Install PHP with the `mysqli` and `fileinfo` extensions, plus MySQL or MariaDB.
2. Create a database named `edusched`.
3. Import [apsib/database/schema.sql](apsib/database/schema.sql).
4. Configure the database settings used by `apsib/koneksi.php` through environment variables or a local `apsib/.env` file:
   - `DB_HOST` (default: `127.0.0.1`)
   - `DB_PORT` (default: `3306`)
   - `DB_NAME` (default: `edusched`)
   - `DB_USER`
   - `DB_PASSWORD`
5. Start the PHP development server from the repository root:

   ```bash
   php -S 127.0.0.1:8000 -t apsib
   ```

6. Open `http://127.0.0.1:8000/login.php`.

The schema file contains table structure rather than real user data. Create a local administrator account before testing. No public demo credentials are provided.

## 6. Project structure

- `apsib/` — PHP application pages, scripts, styles, and assets
- `apsib/koneksi.php` — MySQLi database connection
- `apsib/auth_guard.php` — authenticated access and role checks
- `apsib/database/schema.sql` — database structure
- `apsib/dompdf/` — PDF generation library
- `apsib/lib/` — frontend libraries and assets

## 7. Copyright and license

This is a collaborative academic project developed by the following team members:

- Davent Gravando
- Marsha Marthalina
- Samuel
- Wendy Lo

This attribution recognizes the project team and does not claim that the entire project or every contribution is solely owned by Samuel Phe. Ownership and rights in jointly created materials and individual contributions remain with the respective authors or rightsholders, subject to any applicable team, course, institutional, or other agreements.

No open-source license is granted by this repository for project materials created by the team. Permission to copy, modify, redistribute, sublicense, or reuse team-created materials should be obtained from the relevant rightsholders. Dompdf and other bundled third-party libraries remain subject to their own licenses and notices. See the [LICENSE](LICENSE) file.
---

This is an academic portfolio project, not a production-ready school information system. Integration testing, comprehensive upload validation, CSRF coverage, and further SQL/security review are still required before use with real school data.


## Project team and credits

This academic project was developed collaboratively by the following team members:

- Davent Gravando
- Marsha Marthalina
- Samuel
- Wendy Lo

The names above acknowledge the project team as a whole. Individual module-level responsibilities are not assigned here because a verified task-allocation record was not provided. This credit does not imply that every member authored every file or that each contribution was identical.


## Copyright and licensing

This is a collaborative academic project credited to the team members listed above. This notice does not assign or transfer copyright and does not make a legal determination about ownership of jointly created work. Rights in individual contributions remain with their respective authors or rightsholders, subject to any applicable team, course, institutional, or other agreements. No open-source license is granted by this repository. Permission to reuse team-created materials should be obtained from the relevant rightsholders. Third-party libraries and assets remain subject to their own licenses and notices. See [LICENSE](LICENSE).
