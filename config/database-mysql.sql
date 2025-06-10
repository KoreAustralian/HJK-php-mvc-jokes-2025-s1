-- ======================================> BEGIN SECTION <=====================================
-- BEFORE COMMENCING:
-- 
-- - Replace all instances of YYYY with the current year
--   For example, 2025
-- - Replace all instances of SN with S followed by the semester number
--   For example, S1 for semester 1
-- - Replace ALL instances of XXX with your initials
--   For example, AJG for Adrian Gould
-- 
-- We have split the file into sections each surrounded with a BEGIN SECTION and END SECTION
-- comment line. These sections may be copied and pasted into the SQL interface for the RDBMS
-- and executed to perform the steps.
--
-- Alternatively, copy the whole file and paste into the SQL command interface provided for/by
-- your GUI based RDBMS management software.
-- ======================================> BEGIN SECTION <=====================================



-- ======================================> BEGIN SECTION <=====================================
-- USER & DATABASE REMOVAL
-- In this section we perform a clean-up of any existing database and user(s) associated with
-- this database.
--
-- It is important to understand that this DESTROYS all data associated with the database and
-- the database user(s) and CANNOT be recovered.
-- --------------------------------------------------------------------------------------------

-- --------------------------------------------------------------------------------------------
-- Clean up existing database and user(s)
-- --------------------------------------------------------------------------------------------
DROP DATABASE IF EXISTS HJK_SaaS_FED_2025_S1;
DROP USER IF EXISTS 'HJK_SaaS_FED_2025_S1'@'localhost';
DROP USER IF EXISTS 'HJK_SaaS_FED_2025_S1'@'127.0.0.1';
-- ====================================> END SECTION <=========================================



-- ======================================> BEGIN SECTION <=====================================
-- USER & DATABASE CREATION
--
-- In this section we (re)create the database and user(s) associated with the new database.
-- We assign the relevant privileges to the user to access the database and to be able to
-- authenticate against the RDBMS.
-- --------------------------------------------------------------------------------------------

-- --------------------------------------------------------------------------------------------
-- Create Database named 'HJK_SaaS_FED_2025_S1'
-- --------------------------------------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS HJK_SaaS_FED_2025_S1;

-- --------------------------------------------------------------------------------------------
-- Create User & Grant Permissions
-- We create users that are able to access the database via localhost and 127.0.0.1  just in
-- case IPv6 is detected. Some RDBMS systems may not be 100% compatible with IPv6 IP addresses.
-- --------------------------------------------------------------------------------------------
CREATE USER 'HJK_SaaS_FED_2025_S1'@'localhost'
    IDENTIFIED WITH mysql_native_password
        BY 'Password1234';

CREATE USER 'HJK_SaaS_FED_2025_S1'@'127.0.0.1'
    IDENTIFIED WITH mysql_native_password
        BY 'Password1234';

GRANT USAGE ON *.*
    TO 'HJK_SaaS_FED_2025_S1'@'localhost';

GRANT USAGE ON *.*
    TO 'HJK_SaaS_FED_2025_S1'@'127.0.0.1';

GRANT ALL PRIVILEGES
    ON `HJK_SaaS_FED_2025_S1`.*
    TO 'HJK_SaaS_FED_2025_S1'@'localhost';

GRANT ALL PRIVILEGES
    ON `HJK_SaaS_FED_2025_S1`.*
    TO 'HJK_SaaS_FED_2025_S1'@'127.0.0.1';

-- --------------------------------------------------------------------------------------------
-- Apply the user's privileges.
-- --------------------------------------------------------------------------------------------
FLUSH PRIVILEGES;
-- ====================================> END SECTION <=========================================



-- ======================================> BEGIN SECTION <=====================================
-- CREATE USER TABLE(S)
-- This section creates the 'users' table, one of the most commonly created database table
-- structures. The basic user table will vary depending on the developer's choices.
-- For example, the user's address information may be moved into a second table that contains
-- data associated with their profile.
-- --------------------------------------------------------------------------------------------

-- --------------------------------------------------------------------------------------------
-- Tell MySQL to use the HJK_SaaS_FED_2025_S1 database for commands.
-- --------------------------------------------------------------------------------------------
USE HJK_SaaS_FED_2025_S1;

-- --------------------------------------------------------------------------------------------
-- Remove any existing Users table
-- --------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `HJK_SaaS_FED_2025_S1`.`users`;

-- --------------------------------------------------------------------------------------------
-- Create the table structure for the 'users' table
-- --------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `HJK_SaaS_FED_2025_S1`.`users`
(
    `id`            int            NOT NULL AUTO_INCREMENT,
    `given_name`    varchar(128)   NOT NULL,
    `family_name`   varchar(128)   DEFAULT NULL,
    `nickname`      varchar(255)   NOT NULL,
    `email`         varchar(255)   NOT NULL,
    `password`      varchar(255)   NOT NULL,
    `city`          varchar(45)    DEFAULT NULL,
    `state`         varchar(45)    DEFAULT NULL,
    `country`       varchar(45)    DEFAULT 'Australia',
    `created_at`    timestamp      NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    timestamp      NULL DEFAULT NULL,
    PRIMARY KEY (`id`)

    ) ENGINE = InnoDB
    AUTO_INCREMENT = 7
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_general_ci;
-- ====================================> END SECTION <=========================================



-- ======================================> BEGIN SECTION <=====================================
-- CREATE ADDITIONAL TABLES
-- This section creates additional table(s). In the case of this example, it creates the
-- 'products' table.
-- --------------------------------------------------------------------------------------------

-- --------------------------------------------------------------------------------------------
-- Tell MySQL to use the HJK_SaaS_FED_2025_S1 database for commands.
-- --------------------------------------------------------------------------------------------
USE HJK_SaaS_FED_2025_S1;

-- --------------------------------------------------------------------------------------------
-- Remove any existing Products table
-- --------------------------------------------------------------------------------------------


-- --------------------------------------------------------------------------------------------
-- Create the Products table structure
-- --------------------------------------------------------------------------------------------


-- --------------------------------------------------------------------------------------------
-- Tell MySQL to use the HJK_SaaS_FED_2025_S1 database for commands.
-- --------------------------------------------------------------------------------------------
USE HJK_SaaS_FED_2025_S1;

-- --------------------------------------------------------------------------------------------
-- Remove any existing Categories table
-- --------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `HJK_SaaS_FED_2025_S1`.`categories`;

-- --------------------------------------------------------------------------------------------
-- Create the Categories table structure
-- --------------------------------------------------------------------------------------------
CREATE TABLE `HJK_php_mvc_jokes_2025_s1`.`categories`
(
    `id`         BIGINT         UNSIGNED    AUTO_INCREMENT,
    `name`       VARCHAR(64)    NOT NULL    DEFAULT 'Unknown',
    `user_id`    BIGINT         UNSIGNED    DEFAULT 10,
    `created_at` DATETIME       NOT NULL    DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME       NULL        DEFAULT NULL,

    PRIMARY KEY (`id`),
    UNIQUE `category_name_unique` (`name`)

) ENGINE = InnoDB
  CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci;

-- --------------------------------------------------------------------------------------------
-- Tell MySQL to use the HJK_SaaS_FED_2025_S1 database for commands.
-- --------------------------------------------------------------------------------------------
USE HJK_SaaS_FED_2025_S1;

-- --------------------------------------------------------------------------------------------
-- Remove any existing Jokes table
-- --------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `HJK_SaaS_FED_2025_S1`.`jokes`;

-- --------------------------------------------------------------------------------------------
-- Create the Jokes table structure
-- --------------------------------------------------------------------------------------------
CREATE TABLE `HJK_php_mvc_jokes_2025_s1`.`jokes`
(
    `id`          BIGINT UNSIGNED AUTO_INCREMENT,
    `title`       VARCHAR(128) NOT NULL,
    `body`        TEXT         NOT NULL,
    `category_id` BIGINT UNSIGNED       DEFAULT 1,
    `tags`        VARCHAR(255) NULL     DEFAULT NULL,
    `author_id`   BIGINT UNSIGNED       DEFAULT 1,
    `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  DATETIME     NULL     DEFAULT NULL,

    PRIMARY KEY (`id`),
    FULLTEXT `joke_text` (`body`),
    FULLTEXT `tag_index` (`tags`)

) ENGINE = InnoDB
  CHARSET = utf8mb4
  COLLATE utf8mb4_general_ci;
-- ====================================> END SECTION <=========================================



-- ======================================> BEGIN SECTION <=====================================
-- SEEDING THE DATABASE
-- Seeders are used to add data to initialise the database tables
-- ====================================> END SECTION <=========================================



-- ======================================> BEGIN SECTION <=====================================
-- Users TABLE SEEDING
-- Insert initial data into the 'users' table.
-- --------------------------------------------------------------------------------------------

-- --------------------------------------------------------------------------------------------
-- Tell MySQL to use the HJK_SaaS_FED_2025_S1 database for commands.
-- --------------------------------------------------------------------------------------------
USE HJK_SaaS_FED_2025_S1;

-- --------------------------------------------------------------------------------------------
-- Seed Users Table
-- The Password is Password1 hashed using the PHP password_hash() method.
-- --------------------------------------------------------------------------------------------
INSERT INTO `HJK_SaaS_FED_2025_S1`.`users`
VALUES (10, 'Ad','Ministrator', 'Administrator', 'admin@example.com',
        '$2y$10$4Ae3n2iQ0MwXMNz0UEmNne2PaNyfYsBFYb97nayHWTDCwpnuPi6f.',
        'Perth', 'WA', 'Australia', '2000-01-01 00:00:01', NULL);

INSERT INTO `HJK_SaaS_FED_2025_S1`.`users`
VALUES (20, 'Adrian', 'Gould', 'Adrian Gould', 'adrian@example.com',
        '$2y$10$4Ae3n2iQ0MwXMNz0UEmNne2PaNyfYsBFYb97nayHWTDCwpnuPi6f.',
        'Perth', 'WA', 'Australia', '2024-01-01 10:30:01', NULL),
       (30, 'HONG JAE', 'KIM', 'HONG JAE KIM', 'GIVEN_NAME@example.com',
        '$2y$10$4Ae3n2iQ0MwXMNz0UEmNne2PaNyfYsBFYb97nayHWTDCwpnuPi6f.',
        'Perth', 'WA', 'Australia', '2024-08-10 16:11:43', NULL);

INSERT INTO `HJK_SaaS_FED_2025_S1`.`users`
VALUES (100, 'John', 'Doe', 'John Doe', 'user1@example.com',
        '$2y$10$4Ae3n2iQ0MwXMNz0UEmNne2PaNyfYsBFYb97nayHWTDCwpnuPi6f.',
        'Bunbury', 'WA', 'Australia', '2024-08-15 13:04:21', NULL),
       (101,'Jane', 'Doe', 'Jane Doe', 'user2@example.com',
        '$2y$10$4Ae3n2iQ0MwXMNz0UEmNne2PaNyfYsBFYb97nayHWTDCwpnuPi6f.',
        'Melbourne', 'VIC', 'Australia', '2024-08-20 13:17:21', NULL),
       (102, 'Steve', 'Smith', 'Steve Smith', 'user3@example.com',
        '$2y$10$4Ae3n2iQ0MwXMNz0UEmNne2PaNyfYsBFYb97nayHWTDCwpnuPi6f.',
        'Adelaide', 'SA', 'Australia', '2024-08-20 17:59:13', NULL);
-- ====================================> END SECTION <=========================================



-- ======================================> BEGIN SECTION <=====================================
-- ADDITIONAL TABLE SEEDING
-- Insert initial data into other tables as required
-- --------------------------------------------------------------------------------------------

-- --------------------------------------------------------------------------------------------
-- Seed Products Table
-- --------------------------------------------------------------------------------------------


-- --------------------------------------------------------------------------------------------
-- Seed Categories Table
-- --------------------------------------------------------------------------------------------

INSERT INTO `HJK_php_mvc_jokes_2025_s1`.`categories`(`id`, `name`, `created_at`)
VALUES (1, 'unknown', '1970-01-01 00:00:01');

INSERT INTO `HJK_php_mvc_jokes_2025_s1`.`categories`(`id`, `name`, `created_at`)
VALUES (11, 'dad', '1970-01-01 00:00:01');

INSERT INTO `HJK_php_mvc_jokes_2025_s1`.`categories`(`id`, `name`, `created_at`)
VALUES (9, 'geek', '1970-01-01 00:00:02'),
       (10, 'programmer', '1970-01-01 00:00:02'),
       (2, 'web', '1970-01-01 00:00:02'),
       (3, 'knock-knock', '1970-01-01 00:00:03'),
       (4, 'rude', '1970-01-01 00:00:04'),
       (5, 'dog', '1970-01-01 00:00:05'),
       (6, 'cat', '1970-01-01 00:00:06'),
       (7, 'halloween', '1970-01-01 00:00:07'),
       (8, 'animal', '1970-01-01 00:00:08');


-- --------------------------------------------------------------------------------------------
-- Seed Jokes Table
-- --------------------------------------------------------------------------------------------

INSERT INTO `HJK_php_mvc_jokes_2025_s1`.`jokes`(`id`, `title`, `body`, `category_id`, `tags`,
                                                `author_id`, `created_at`, `updated_at`)
VALUES (1, 'Skeleton Fight',
        '&lt;p&gt;Why don\'t skeletons fight each other?&lt;/p&gt;&lt;p&gt;They don\'t have the guts.&lt;/p&gt;',
        7, 'spooky,funny', 1, now(), null),
       (2, 'Parallel Lines',
        '&lt;p&gt;Parallel lines have so much in common.&lt;/p&gt;&lt;p&gt;It\'s a shame they\'ll never meet.&lt;/p&gt;',
        9, 'geometry,puns', 105, now(), null),
       (3, 'Embracing Mistakes',
        '&lt;p&gt;I told my wife she should embrace her mistakes.&lt;/p&gt;&lt;p&gt;She gave me a hug.&lt;/p&gt;',
        11, 'relationships,dad jokes', 104, now(), null),
       (4, 'Broken Pencil',
        '&lt;p&gt;I was going to tell a joke about a broken pencil, but it was pointless.&lt;/p&gt;',
        11, 'puns,funny', 103, now(), null),
       (5, 'Light Sleeper',
        '&lt;p&gt;I told my wife she should stop sleeping in the fridge.&lt;/p&gt;&lt;p&gt;She said she\'s just a light sleeper.&lt;/p&gt;',
        11, 'sleep,puns', 105, now(), null),
       (6, 'Elevator Business',
        '&lt;p&gt;I\'m thinking of starting a business installing elevators.&lt;/p&gt;&lt;p&gt;I hear it has its ups and downs.&lt;/p&gt;',
        11, 'work,puns', 104, now(), null);

-- ====================================> END SECTION <=========================================


