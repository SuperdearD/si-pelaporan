-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for emergency_response_team
CREATE DATABASE IF NOT EXISTS `emergency_response_team` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `emergency_response_team`;

-- Dumping structure for table emergency_response_team.accidents
CREATE TABLE IF NOT EXISTS `accidents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint unsigned NOT NULL,
  `accident_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident_description` text COLLATE utf8mb4_unicode_ci,
  `safety_incidents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accidents_incident_id_foreign` (`incident_id`),
  CONSTRAINT `accidents_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.accidents: ~0 rows (approximately)
INSERT INTO `accidents` (`id`, `incident_id`, `accident_place`, `accident_condition`, `accident_description`, `safety_incidents`) VALUES
	(1, 1, 'KM 12', 'Hujan Deras', 'Saat Melakukan Perjalanan angkutan Unit Amblas', 'Unit Amblas');

-- Dumping structure for table emergency_response_team.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.cache: ~3 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('emergency-response-team-cache-livewire-rate-limiter:59d6ad626907b5a0341aba51c3754cd265bffec5', 'i:1;', 1780583201),
	('emergency-response-team-cache-livewire-rate-limiter:59d6ad626907b5a0341aba51c3754cd265bffec5:timer', 'i:1780583201;', 1780583201),
	('emergency-response-team-cache-spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:77:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:13:"View Any User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:9:"View User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:11:"Create User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:11:"Update User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:11:"Delete User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:12:"Restore User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:17:"Force Delete User";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:13:"View Any Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:9:"View Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:11:"Create Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:10;a:4:{s:1:"a";i:11;s:1:"b";s:11:"Update Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:11;a:4:{s:1:"a";i:12;s:1:"b";s:11:"Delete Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:12;a:4:{s:1:"a";i:13;s:1:"b";s:12:"Restore Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:13;a:4:{s:1:"a";i:14;s:1:"b";s:17:"Force Delete Role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:14;a:4:{s:1:"a";i:15;s:1:"b";s:19:"View Any Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:15;a:4:{s:1:"a";i:16;s:1:"b";s:15:"View Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:16;a:4:{s:1:"a";i:17;s:1:"b";s:17:"Create Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:17;a:4:{s:1:"a";i:18;s:1:"b";s:17:"Update Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:18;a:4:{s:1:"a";i:19;s:1:"b";s:17:"Delete Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:19;a:4:{s:1:"a";i:20;s:1:"b";s:18:"Restore Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:20;a:4:{s:1:"a";i:21;s:1:"b";s:23:"Force Delete Permission";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:21;a:4:{s:1:"a";i:22;s:1:"b";s:17:"View Any Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:"a";i:23;s:1:"b";s:13:"View Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:"a";i:24;s:1:"b";s:15:"Create Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:"a";i:25;s:1:"b";s:15:"Update Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:"a";i:26;s:1:"b";s:15:"Delete Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:"a";i:27;s:1:"b";s:16:"Restore Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:"a";i:28;s:1:"b";s:21:"Force Delete Accident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:"a";i:29;s:1:"b";s:29:"View Any Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:29;a:4:{s:1:"a";i:30;s:1:"b";s:25:"View Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:30;a:4:{s:1:"a";i:31;s:1:"b";s:27:"Create Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:31;a:4:{s:1:"a";i:32;s:1:"b";s:27:"Update Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:32;a:4:{s:1:"a";i:33;s:1:"b";s:27:"Delete Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:33;a:4:{s:1:"a";i:34;s:1:"b";s:28:"Restore Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:34;a:4:{s:1:"a";i:35;s:1:"b";s:33:"Force Delete Development Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:35;a:4:{s:1:"a";i:36;s:1:"b";s:27:"View Any Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:36;a:4:{s:1:"a";i:37;s:1:"b";s:23:"View Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:37;a:4:{s:1:"a";i:38;s:1:"b";s:25:"Create Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:38;a:4:{s:1:"a";i:39;s:1:"b";s:25:"Update Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:39;a:4:{s:1:"a";i:40;s:1:"b";s:25:"Delete Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:40;a:4:{s:1:"a";i:41;s:1:"b";s:26:"Restore Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:41;a:4:{s:1:"a";i:42;s:1:"b";s:31:"Force Delete Development Report";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:42;a:4:{s:1:"a";i:43;s:1:"b";s:27:"View Any Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:43;a:4:{s:1:"a";i:44;s:1:"b";s:23:"View Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:44;a:4:{s:1:"a";i:45;s:1:"b";s:25:"Create Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:45;a:4:{s:1:"a";i:46;s:1:"b";s:25:"Update Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:46;a:4:{s:1:"a";i:47;s:1:"b";s:25:"Delete Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:47;a:4:{s:1:"a";i:48;s:1:"b";s:26:"Restore Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:48;a:4:{s:1:"a";i:49;s:1:"b";s:31:"Force Delete Follow Up Progress";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:49;a:4:{s:1:"a";i:50;s:1:"b";s:17:"View Any Incident";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:50;a:4:{s:1:"a";i:51;s:1:"b";s:13:"View Incident";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:51;a:4:{s:1:"a";i:52;s:1:"b";s:15:"Create Incident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:52;a:4:{s:1:"a";i:53;s:1:"b";s:15:"Update Incident";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:53;a:4:{s:1:"a";i:54;s:1:"b";s:15:"Delete Incident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:54;a:4:{s:1:"a";i:55;s:1:"b";s:16:"Restore Incident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:55;a:4:{s:1:"a";i:56;s:1:"b";s:21:"Force Delete Incident";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:56;a:4:{s:1:"a";i:57;s:1:"b";s:23:"View Any Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:57;a:4:{s:1:"a";i:58;s:1:"b";s:19:"View Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:58;a:4:{s:1:"a";i:59;s:1:"b";s:21:"Create Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:"a";i:60;s:1:"b";s:21:"Update Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:60;a:4:{s:1:"a";i:61;s:1:"b";s:21:"Delete Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:61;a:4:{s:1:"a";i:62;s:1:"b";s:22:"Restore Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:62;a:4:{s:1:"a";i:63;s:1:"b";s:27:"Force Delete Incident Cause";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:"a";i:64;s:1:"b";s:29:"View Any Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:64;a:4:{s:1:"a";i:65;s:1:"b";s:25:"View Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:65;a:4:{s:1:"a";i:66;s:1:"b";s:27:"Create Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:66;a:4:{s:1:"a";i:67;s:1:"b";s:27:"Update Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:67;a:4:{s:1:"a";i:68;s:1:"b";s:27:"Delete Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:68;a:4:{s:1:"a";i:69;s:1:"b";s:28:"Restore Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:69;a:4:{s:1:"a";i:70;s:1:"b";s:33:"Force Delete Incident Development";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:70;a:4:{s:1:"a";i:71;s:1:"b";s:27:"View Any Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:71;a:4:{s:1:"a";i:72;s:1:"b";s:23:"View Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:72;a:4:{s:1:"a";i:73;s:1:"b";s:25:"Create Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:73;a:4:{s:1:"a";i:74;s:1:"b";s:25:"Update Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:74;a:4:{s:1:"a";i:75;s:1:"b";s:25:"Delete Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:75;a:4:{s:1:"a";i:76;s:1:"b";s:26:"Restore Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:76;a:4:{s:1:"a";i:77;s:1:"b";s:31:"Force Delete Incident Follow Up";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}}s:5:"roles";a:4:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:13:"Administrator";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:4:"User";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:4;s:1:"b";s:3:"PIC";s:1:"c";s:3:"web";}i:3;a:3:{s:1:"a";i:3;s:1:"b";s:8:"Direktur";s:1:"c";s:3:"web";}}}', 1780668193);

-- Dumping structure for table emergency_response_team.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.cache_locks: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.development_progress
CREATE TABLE IF NOT EXISTS `development_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_development_id` bigint unsigned NOT NULL,
  `message_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hasil_progress` text COLLATE utf8mb4_unicode_ci,
  `persentase` int NOT NULL DEFAULT '0',
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `development_progress_incident_development_id_foreign` (`incident_development_id`),
  CONSTRAINT `development_progress_incident_development_id_foreign` FOREIGN KEY (`incident_development_id`) REFERENCES `incident_developments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.development_progress: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.development_reports
CREATE TABLE IF NOT EXISTS `development_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_development_id` bigint unsigned NOT NULL,
  `message_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil` text COLLATE utf8mb4_unicode_ci,
  `kesimpulan` text COLLATE utf8mb4_unicode_ci,
  `rekomendasi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `development_reports_incident_development_id_foreign` (`incident_development_id`),
  CONSTRAINT `development_reports_incident_development_id_foreign` FOREIGN KEY (`incident_development_id`) REFERENCES `incident_developments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.development_reports: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.exports
CREATE TABLE IF NOT EXISTS `exports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int unsigned NOT NULL DEFAULT '0',
  `total_rows` int unsigned NOT NULL,
  `successful_rows` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exports_user_id_foreign` (`user_id`),
  CONSTRAINT `exports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.exports: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.failed_import_rows
CREATE TABLE IF NOT EXISTS `failed_import_rows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data` json NOT NULL,
  `import_id` bigint unsigned NOT NULL,
  `validation_error` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `failed_import_rows_import_id_foreign` (`import_id`),
  CONSTRAINT `failed_import_rows_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.failed_import_rows: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.follow_up_progress
CREATE TABLE IF NOT EXISTS `follow_up_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_follow_up_id` bigint unsigned NOT NULL,
  `message_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `persentase_progress` int NOT NULL DEFAULT '0',
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follow_up_progress_incident_follow_up_id_foreign` (`incident_follow_up_id`),
  CONSTRAINT `follow_up_progress_incident_follow_up_id_foreign` FOREIGN KEY (`incident_follow_up_id`) REFERENCES `incident_follow_ups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.follow_up_progress: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.imports
CREATE TABLE IF NOT EXISTS `imports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int unsigned NOT NULL DEFAULT '0',
  `total_rows` int unsigned NOT NULL,
  `successful_rows` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imports_user_id_foreign` (`user_id`),
  CONSTRAINT `imports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.imports: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.incidents
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `work_experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsibility` text COLLATE utf8mb4_unicode_ci,
  `user_id` json DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incidents_approved_by_foreign` (`approved_by`),
  CONSTRAINT `incidents_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.incidents: ~0 rows (approximately)
INSERT INTO `incidents` (`id`, `date`, `time`, `department`, `position`, `age`, `work_experience`, `responsibility`, `user_id`, `is_approved`, `approved_by`, `created_at`, `updated_at`) VALUES
	(1, '2026-06-04', '14:30:00', 'Unit Produksi', 'Staff', 22, '1 Tahun', 'Melakukan Welding', NULL, 1, 3, '2026-06-04 05:48:15', '2026-06-04 06:13:18');

-- Dumping structure for table emergency_response_team.incident_causes
CREATE TABLE IF NOT EXISTS `incident_causes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint unsigned NOT NULL,
  `unsafe_action` text COLLATE utf8mb4_unicode_ci,
  `unsafe_condition` text COLLATE utf8mb4_unicode_ci,
  `person_factor` text COLLATE utf8mb4_unicode_ci,
  `job_factor` text COLLATE utf8mb4_unicode_ci,
  `env_factor` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `incident_causes_incident_id_foreign` (`incident_id`),
  CONSTRAINT `incident_causes_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.incident_causes: ~0 rows (approximately)
INSERT INTO `incident_causes` (`id`, `incident_id`, `unsafe_action`, `unsafe_condition`, `person_factor`, `job_factor`, `env_factor`) VALUES
	(1, 1, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table emergency_response_team.incident_developments
CREATE TABLE IF NOT EXISTS `incident_developments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint unsigned NOT NULL,
  `bentuk_pengembangan` text COLLATE utf8mb4_unicode_ci,
  `hasil_pengembangan` text COLLATE utf8mb4_unicode_ci,
  `persentase` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incident_developments_incident_id_foreign` (`incident_id`),
  KEY `incident_developments_user_id_foreign` (`user_id`),
  CONSTRAINT `incident_developments_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incident_developments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.incident_developments: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.incident_follow_ups
CREATE TABLE IF NOT EXISTS `incident_follow_ups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint unsigned NOT NULL,
  `corrective_action` text COLLATE utf8mb4_unicode_ci,
  `target_pengendalian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bentuk_pengendalian` text COLLATE utf8mb4_unicode_ci,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incident_follow_ups_incident_id_foreign` (`incident_id`),
  CONSTRAINT `incident_follow_ups_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.incident_follow_ups: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.incident_user
CREATE TABLE IF NOT EXISTS `incident_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incident_user_incident_id_foreign` (`incident_id`),
  KEY `incident_user_user_id_foreign` (`user_id`),
  CONSTRAINT `incident_user_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incident_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.incident_user: ~0 rows (approximately)
INSERT INTO `incident_user` (`id`, `incident_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL),
	(2, 1, 2, NULL, NULL);

-- Dumping structure for table emergency_response_team.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.jobs: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.job_batches: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.migrations: ~1 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_12_23_044112_create_permission_tables', 1),
	(5, '2025_12_23_044944_create_notifications_table', 1),
	(6, '2025_12_23_165309_create_imports_table', 1),
	(7, '2025_12_23_165310_create_exports_table', 1),
	(8, '2025_12_23_165311_create_failed_import_rows_table', 1),
	(9, '2026_04_28_134325_create_incidents_table', 1),
	(10, '2026_04_28_134326_create_accidents_table', 1),
	(11, '2026_04_28_134327_create_incident_causes_table', 1),
	(12, '2026_04_28_134328_create_incident_follow_ups_table', 1),
	(13, '2026_04_28_134330_create_incident_developments_table', 1),
	(14, '2026_04_28_134331_create_follow_up_progress_table', 1),
	(15, '2026_04_28_134332_create_development_progress_table', 1),
	(16, '2026_04_28_134333_create_development_reports_table', 1),
	(17, '2026_06_04_133255_create_incident_user_table', 1);

-- Dumping structure for table emergency_response_team.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.model_has_roles: ~2 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 3),
	(4, 'App\\Models\\User', 4);

-- Dumping structure for table emergency_response_team.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.notifications: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table emergency_response_team.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.permissions: ~21 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'View Any User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(2, 'View User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(3, 'Create User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(4, 'Update User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(5, 'Delete User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(6, 'Restore User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(7, 'Force Delete User', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(8, 'View Any Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(9, 'View Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(10, 'Create Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(11, 'Update Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(12, 'Delete Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(13, 'Restore Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(14, 'Force Delete Role', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(15, 'View Any Permission', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(16, 'View Permission', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(17, 'Create Permission', 'web', '2026-06-04 05:37:45', '2026-06-04 05:37:45'),
	(18, 'Update Permission', 'web', '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(19, 'Delete Permission', 'web', '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(20, 'Restore Permission', 'web', '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(21, 'Force Delete Permission', 'web', '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(22, 'View Any Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(23, 'View Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(24, 'Create Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(25, 'Update Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(26, 'Delete Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(27, 'Restore Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(28, 'Force Delete Accident', 'web', '2026-06-04 05:56:47', '2026-06-04 05:56:47'),
	(29, 'View Any Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(30, 'View Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(31, 'Create Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(32, 'Update Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(33, 'Delete Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(34, 'Restore Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(35, 'Force Delete Development Progress', 'web', '2026-06-04 05:56:59', '2026-06-04 05:56:59'),
	(36, 'View Any Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(37, 'View Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(38, 'Create Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(39, 'Update Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(40, 'Delete Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(41, 'Restore Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(42, 'Force Delete Development Report', 'web', '2026-06-04 05:57:07', '2026-06-04 05:57:07'),
	(43, 'View Any Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(44, 'View Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(45, 'Create Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(46, 'Update Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(47, 'Delete Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(48, 'Restore Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(49, 'Force Delete Follow Up Progress', 'web', '2026-06-04 05:57:17', '2026-06-04 05:57:17'),
	(50, 'View Any Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(51, 'View Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(52, 'Create Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(53, 'Update Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(54, 'Delete Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(55, 'Restore Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(56, 'Force Delete Incident', 'web', '2026-06-04 05:57:23', '2026-06-04 05:57:23'),
	(57, 'View Any Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(58, 'View Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(59, 'Create Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(60, 'Update Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(61, 'Delete Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(62, 'Restore Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(63, 'Force Delete Incident Cause', 'web', '2026-06-04 05:57:30', '2026-06-04 05:57:30'),
	(64, 'View Any Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(65, 'View Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(66, 'Create Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(67, 'Update Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(68, 'Delete Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(69, 'Restore Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(70, 'Force Delete Incident Development', 'web', '2026-06-04 05:57:38', '2026-06-04 05:57:38'),
	(71, 'View Any Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45'),
	(72, 'View Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45'),
	(73, 'Create Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45'),
	(74, 'Update Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45'),
	(75, 'Delete Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45'),
	(76, 'Restore Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45'),
	(77, 'Force Delete Incident Follow Up', 'web', '2026-06-04 05:57:45', '2026-06-04 05:57:45');

-- Dumping structure for table emergency_response_team.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'web', '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(2, 'User', 'web', '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(3, 'Direktur', 'web', '2026-06-04 05:58:53', '2026-06-04 05:58:53'),
	(4, 'PIC', 'web', '2026-06-04 05:59:49', '2026-06-04 05:59:49');

-- Dumping structure for table emergency_response_team.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.role_has_permissions: ~21 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(77, 1),
	(22, 2),
	(23, 2),
	(24, 2),
	(25, 2),
	(26, 2),
	(27, 2),
	(28, 2),
	(50, 2),
	(51, 2),
	(52, 2),
	(53, 2),
	(54, 2),
	(55, 2),
	(56, 2),
	(57, 2),
	(58, 2),
	(59, 2),
	(60, 2),
	(61, 2),
	(62, 2),
	(63, 2),
	(50, 3),
	(51, 3),
	(29, 4),
	(30, 4),
	(31, 4),
	(32, 4),
	(33, 4),
	(34, 4),
	(35, 4),
	(36, 4),
	(37, 4),
	(38, 4),
	(39, 4),
	(40, 4),
	(41, 4),
	(42, 4),
	(43, 4),
	(44, 4),
	(45, 4),
	(46, 4),
	(47, 4),
	(48, 4),
	(49, 4),
	(50, 4),
	(51, 4),
	(53, 4),
	(64, 4),
	(65, 4),
	(66, 4),
	(67, 4),
	(68, 4),
	(69, 4),
	(70, 4),
	(71, 4),
	(72, 4),
	(73, 4),
	(74, 4),
	(75, 4),
	(76, 4),
	(77, 4);

-- Dumping structure for table emergency_response_team.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('XTbNti5bQCUST2leTjq3H96YplxycyEKSiGxdDkN', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNnhGelFrTzVNcGZxUDU3ZzJ3U21QMXBMYU1nMUlEVWp6QWhuMzVhTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBvcmFuLWluc2lkZW4iO3M6NToicm91dGUiO3M6NDY6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5sYXBvcmFuLWluc2lkZW4uaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkZ2VMLlMzVDdaLjFnMnZOTmYxcTJVT3BSQmN2Qm9mUHVvUkcvbjhvVVpFQWJkQ2dQTUtNaDYiO3M6NjoidGFibGVzIjthOjQ6e3M6NDA6IjBmOWU1NDc5OTBjYTU3Y2Y2Y2ViYWFiOTUwNTZjYzczX2NvbHVtbnMiO2E6Nzp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjExOiJpbmNpZGVudC5pZCI7czo1OiJsYWJlbCI7czo4OiJJbmNpZGVudCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InBlcnNlbnRhc2UiO3M6NToibGFiZWwiO3M6MTA6IlBlcnNlbnRhc2UiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czo2OiJTdGF0dXMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjc6InRhbmdnYWwiO3M6NToibGFiZWwiO3M6NzoiVGFuZ2dhbCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6OToidXNlci5uYW1lIjtzOjU6ImxhYmVsIjtzOjQ6IlVzZXIiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJDcmVhdGVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJVcGRhdGVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9fXM6NDA6Ijk2YWM1MWYyYzIzZDI0MDZkZjQ4Mjg3YWExMmIxNGY3X2NvbHVtbnMiO2E6ODp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjIzOiJpbmNpZGVudF9kZXZlbG9wbWVudF9pZCI7czo1OiJsYWJlbCI7czoyMzoiSW5jaWRlbnQgZGV2ZWxvcG1lbnQgaWQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJtZXNzYWdlX2lkIjtzOjU6ImxhYmVsIjtzOjEwOiJNZXNzYWdlIGlkIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czozOiJwaWMiO3M6NToibGFiZWwiO3M6MzoiUGljIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo3OiJ0YW5nZ2FsIjtzOjU6ImxhYmVsIjtzOjc6IlRhbmdnYWwiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJwZXJzZW50YXNlIjtzOjU6ImxhYmVsIjtzOjEwOiJQZXJzZW50YXNlIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJmaWxlIjtzOjU6ImxhYmVsIjtzOjQ6IkZpbGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJDcmVhdGVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo3O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJVcGRhdGVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9fXM6NDA6ImQ5YzI2ZmQ3ZDdhNWY4OWExNzExYjRiYmFhYjU5ODYxX2NvbHVtbnMiO2E6NDp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjIzOiJpbmNpZGVudF9kZXZlbG9wbWVudF9pZCI7czo1OiJsYWJlbCI7czoyMzoiSW5jaWRlbnQgZGV2ZWxvcG1lbnQgaWQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJtZXNzYWdlX2lkIjtzOjU6ImxhYmVsIjtzOjEwOiJNZXNzYWdlIGlkIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiQ3JlYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoidXBkYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiVXBkYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQwOiI4N2ViNmMyM2ZhZjBjM2VhNWEwMzEwYzViOTdkMzFkNl9jb2x1bW5zIjthOjk6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJkYXRlIjtzOjU6ImxhYmVsIjtzOjE0OiJXYWt0dSBLZWphZGlhbiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjU6ImFjY2lkZW50LnNhZmV0eV9pbmNpZGVudHMiO3M6NToibGFiZWwiO3M6MTk6IktsYXNpZmlrYXNpIEluc2lkZW4iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1c2Vycy5uYW1lIjtzOjU6ImxhYmVsIjtzOjI0OiJQZWxhcG9yICZhbXA7IFVuaXQgS2VyamEiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjM6ImFnZSI7czo1OiJsYWJlbCI7czo0OiJVc2lhIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjE1OiJ3b3JrX2V4cGVyaWVuY2UiO3M6NToibGFiZWwiO3M6MTA6IlBlbmdhbGFtYW4iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTQ6InJlc3BvbnNpYmlsaXR5IjtzOjU6ImxhYmVsIjtzOjE0OiJUYW5nZ3VuZyBKYXdhYiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fWk6NjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czo2OiJEaWJ1YXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjc7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6NjoiRGl1YmFoIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo4O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjExOiJpc19hcHByb3ZlZCI7czo1OiJsYWJlbCI7czo2OiJTdGF0dXMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9fX19', 1780583922);

-- Dumping structure for table emergency_response_team.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nip_unique` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emergency_response_team.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `nip`, `email_verified_at`, `password`, `avatar_url`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@starter.com', '0765833', NULL, '$2y$12$geL.S3T7Z.1g2vNNf1q2UOpRBcvBofPuoRG/n8oUZEAbdCgPMKMh6', NULL, NULL, '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(2, 'User', 'user@starter.com', '0788932', NULL, '$2y$12$fZ6VarJL.uZAVgk6lwI6neTAi98XhA.qUfBz.sOUgcqNg08k3KHUm', NULL, NULL, '2026-06-04 05:37:46', '2026-06-04 05:37:46'),
	(3, 'Direkrur', 'direktur@imm.com', '0678965', NULL, '$2y$12$4eXuOL1RKPx42QtYWTB.5.Mb9TQF9S8cEk4e560.nSdhjyfjQxlji', NULL, NULL, '2026-06-04 06:00:26', '2026-06-04 06:00:26'),
	(4, 'PIC IMM', 'pic@imm.com', '0677854', NULL, '$2y$12$HNmqGSrrqzboCobbg9wrAOo5pBGb..8Hpi7psmysO0fLauYXbXswO', NULL, NULL, '2026-06-04 06:01:03', '2026-06-04 06:01:03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
