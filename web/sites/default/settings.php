<?php

use Drupal\Core\Site\Settings;

// Ensure errors are logged properly.
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load environment variables
$db_name   = getenv('DB_NAME') ?: 'drupal';
$db_user   = getenv('DB_USER') ?: 'drupaluser';
$db_socket = getenv('DB_SOCKET') ?: '/cloudsql/alter-consult-464302:us-central1:drupal-db';

// Cloud Run Secret: DB_PASSWORD
$db_password = getenv('DB_PASSWORD') ?: '';

// Drupal database configuration
$databases['default']['default'] = [
  'database' => $db_name,
  'username' => $db_user,
  'password' => $db_password,
  'host' => $db_socket,
  'driver' => 'mysql',
  'prefix' => '',
];

// Use default hash salt if not already defined
if (!defined('DRUPAL_HASH_SALT')) {
    define('DRUPAL_HASH_SALT', getenv('DRUPAL_HASH_SALT') ?: 'replace-with-your-own-salt');
}

// Trusted host patterns to allow your Cloud Run URL
$settings['trusted_host_patterns'] = [
  '^alterconsult-155305720214\.us-central1\.run\.app$',
];

// Temporary file path
$settings['file_temp_path'] = '/tmp';

// Optional: Disable CSS/JS aggregation for Cloud Run dev testing
$settings['css_gzip_compression'] = FALSE;
$settings['js_gzip_compression'] = FALSE;

// Reverse proxy / HTTPS settings for Cloud Run
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// Other default Drupal settings
$settings['update_free_access'] = FALSE;
$settings['skip_permissions_hardening'] = TRUE;
$settings['config_sync_directory'] = '/var/www/html/config/sync';

