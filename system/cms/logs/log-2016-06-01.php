<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2016-06-01 08:11:21 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 08:11:21 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 08:11:21 --> Unable to select database: birohukum
ERROR - 2016-06-01 08:12:54 --> Query error: Table 'birohukum.default_users' doesn't exist - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:13:03 --> Query error: Table 'birohukum.default_users' doesn't exist - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:15:05 --> Query error: Table 'birohukum.default_users' doesn't exist - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:15:10 --> Query error: Table 'birohukum.default_users' doesn't exist - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:21:22 --> Query error: Table 'birohukum.default_users' doesn't exist - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:22:33 --> Query error: Unknown column 'default_users.email' in 'where clause' - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:23:14 --> Query error: Unknown column 'default_users.group_id' in 'on clause' - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:24:12 --> Query error: Unknown column 'default_users.group_id' in 'on clause' - Invalid query: SELECT `default_users`.*, `default_groups`.`name` AS `group`, `default_groups`.`description` AS `group_description`, `default_profiles`.`first_name`, `default_profiles`.`last_name`, `default_profiles`.`company`, `default_profiles`.`bio`, `default_profiles`.`lang`, `default_profiles`.`dob`, `default_profiles`.`gender`, `default_profiles`.`phone`, `default_profiles`.`mobile`, `default_profiles`.`address_line1`, `default_profiles`.`address_line2`, `default_profiles`.`address_line3`, `default_profiles`.`postcode`, `default_profiles`.`website`, `default_profiles`.`display_name` as `display_name`, `default_profiles`.`updated_on` as `updated_on`, `default_profiles`.`user_id` as `user_id`, `default_profiles`.`id` as `profile_id`
FROM `default_users`
LEFT JOIN `default_profiles` ON `default_users`.`id` = `default_profiles`.`user_id`
LEFT JOIN `default_groups` ON `default_users`.`group_id` = `default_groups`.`id`
WHERE `default_users`.`email` IS NULL
 LIMIT 1
ERROR - 2016-06-01 08:24:25 --> Query error: Unknown column 'default_users.username' in 'field list' - Invalid query: SELECT `default_def_page_fields`.*, `default_users`.`username` as `created_by_username`, `default_users`.`id` as `created_by_user_id`, `default_users`.`email` as `created_by_email`
FROM `default_def_page_fields`
LEFT JOIN `default_users` ON `default_users`.`id` = `default_def_page_fields`.`created_by`
WHERE `default_def_page_fields`.`id` =  '1'
 LIMIT 1
ERROR - 2016-06-01 08:24:37 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 08:24:37 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 08:24:37 --> Unable to select database: produkhukum
ERROR - 2016-06-01 08:24:37 --> Query error: Table 'produkhukum.ph_entries' doesn't exist - Invalid query: SELECT `produkhukum`.`ph_categories`.`description` AS `cat_description`, `produkhukum`.`ph_entries`.`title` as `title`, `produkhukum`.`ph_entries`.`description`, `entry_id`, CAST(title as SIGNED) as title, `regyear`, `hits`, `downloaded`, `url`
FROM `produkhukum`.`ph_entries`
LEFT JOIN `produkhukum`.`ph_categories` ON `produkhukum`.`ph_entries`.`FK_category_id` = `produkhukum`.`ph_categories`.`category_id`
ORDER BY `regyear` desc, `title` desc
 LIMIT 3
ERROR - 2016-06-01 08:27:13 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 08:27:13 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 08:27:13 --> Unable to select database: produkhukum
ERROR - 2016-06-01 08:27:14 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 08:27:14 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 08:27:30 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 08:27:30 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 08:27:30 --> Unable to select database: produkhukum
ERROR - 2016-06-01 08:27:30 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 08:27:30 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 08:28:00 --> Page Missing: kontak
ERROR - 2016-06-01 08:28:00 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 08:28:00 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 08:28:00 --> Unable to select database: produkhukum
ERROR - 2016-06-01 09:42:51 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 09:42:51 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 09:42:51 --> Unable to select database: produkhukum
ERROR - 2016-06-01 09:42:53 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:42:53 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:46:04 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jakarta.go.id\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 09:46:04 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jakarta.go.id\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 09:46:04 --> Unable to select database: produkhukum
ERROR - 2016-06-01 09:46:04 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jakarta.go.id\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:46:04 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jakarta.go.id\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:48:18 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 09:48:18 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 09:48:18 --> Unable to select database: produkhukum
ERROR - 2016-06-01 09:48:18 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:48:18 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:51:12 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 09:51:12 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 09:51:12 --> Unable to select database: produkhukum
ERROR - 2016-06-01 09:51:12 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:51:12 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:52:40 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 09:52:40 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 09:52:40 --> Unable to select database: produkhukum
ERROR - 2016-06-01 09:52:40 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:52:40 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 09:53:35 --> Severity: Notice  --> Use of undefined constant ADDON_FOLDdER - assumed 'ADDON_FOLDdER' D:\xampp\htdocs\jdih_\system\cms\config\config.php 393
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:10:18 --> Unable to select database: birohukum
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Notice  --> Undefined offset: 0 D:\xampp\htdocs\jdih_\system\cms\core\MY_Controller.php 97
ERROR - 2016-06-01 10:10:18 --> Severity: Notice  --> Undefined offset: 0 D:\xampp\htdocs\jdih_\system\cms\core\MY_Controller.php 113
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::real_escape_string(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2016-06-01 10:10:18 --> Severity: Warning  --> mysqli::query(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 194
ERROR - 2016-06-01 10:16:24 --> Severity: Notice  --> Use of undefined constant AUTO_LANGUAGE - assumed 'AUTO_LANGUAGE' D:\xampp\htdocs\jdih_\system\cms\core\MY_Controller.php 82
ERROR - 2016-06-01 10:16:24 --> Severity: Notice  --> Use of undefined constant AUTO_LANGUAGE - assumed 'AUTO_LANGUAGE' D:\xampp\htdocs\jdih_\system\cms\core\MY_Controller.php 111
ERROR - 2016-06-01 10:16:25 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:16:25 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:16:25 --> Unable to select database: produkhukum
ERROR - 2016-06-01 10:16:29 --> Severity: Notice  --> Use of undefined constant AUTO_LANGUAGE - assumed 'AUTO_LANGUAGE' D:\xampp\htdocs\jdih_\system\cms\core\MY_Controller.php 82
ERROR - 2016-06-01 10:16:29 --> Severity: Notice  --> Use of undefined constant AUTO_LANGUAGE - assumed 'AUTO_LANGUAGE' D:\xampp\htdocs\jdih_\system\cms\core\MY_Controller.php 111
ERROR - 2016-06-01 10:16:30 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:16:30 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:16:30 --> Unable to select database: produkhukum
ERROR - 2016-06-01 10:29:37 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:29:37 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:29:37 --> Unable to select database: produkhukum
ERROR - 2016-06-01 10:29:37 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:29:37 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:32:58 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:32:58 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:32:58 --> Unable to select database: produkhukum
ERROR - 2016-06-01 10:32:58 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:32:58 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:33:59 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:33:59 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:33:59 --> Unable to select database: produkhukum
ERROR - 2016-06-01 10:33:59 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:33:59 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:35:29 --> Severity: Warning  --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 74
ERROR - 2016-06-01 10:35:29 --> Severity: Warning  --> mysqli::select_db(): invalid object or resource mysqli
 D:\xampp\htdocs\jdih_\system\codeigniter\database\drivers\mysqli\mysqli_driver.php 148
ERROR - 2016-06-01 10:35:29 --> Unable to select database: produkhukum
ERROR - 2016-06-01 10:35:29 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::insert() should be compatible with MY_Model::insert($data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
ERROR - 2016-06-01 10:35:29 --> Severity: Runtime Notice  --> Declaration of Photo_activity_album_m::update() should be compatible with MY_Model::update($primary_value, $data, $skip_validation = false) D:\xampp\htdocs\jdih_\addons\shared_addons\modules\photo_activity\models\photo_activity_album_m.php 149
