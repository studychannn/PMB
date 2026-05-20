-- create_admin_table.sql
-- One-time SQL script to create `admins` table and optionally copy admin accounts from `users`.
-- IMPORTANT: Backup your database before running these queries.

/* 1) Create admins table */
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(191) NOT NULL,
  `email` VARCHAR(191) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* 2) (Optional) Copy admin accounts from users into admins
   This copies hashed passwords as-is. It avoids duplicates if the email
   already exists in `admins`. */
INSERT INTO admins (nama, email, password)
SELECT nama, email, password
FROM users
WHERE role = 'admin'
  AND email NOT IN (SELECT email FROM admins);

/* 3) (Optional, safer) Reset role on users rows that were admin to a non-admin
   value (e.g. 'calon_mahasiswa') so you keep the user record but not admin role. */
UPDATE users
SET role = 'calon_mahasiswa'
WHERE role = 'admin';

/* 4) (Optional, destructive) If you prefer to remove admin rows from `users` entirely
   (ONLY run AFTER you confirmed admins exist in `admins` and you have a backup):
DELETE FROM users WHERE role = 'admin';

-- After running: verify admins with SELECT * FROM admins; and then remove this SQL file.
