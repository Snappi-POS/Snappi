<?php return array (
  6 => 'view',
  9 => 'hashing',
  14 => 'concurrency',
  'app' => 
  array (
    'name' => 'Snappi',
    'env' => 'codecanyon',
    'debug' => false,
    'url' => 'https://snappi.com.ng',
    'frontend_url' => 'http://localhost:3000',
    'asset_url' => NULL,
    'timezone' => 'Africa/Lagos',
    'locale' => 'en',
    'fallback_locale' => 'eng',
    'faker_locale' => 'en_US',
    'cipher' => 'AES-256-CBC',
    'key' => 'base64:wID/CO/WkfE3yoWpQOoy15de8FtOpvC3dM/z5FuHiEU=',
    'previous_keys' => 
    array (
    ),
    'maintenance' => 
    array (
      'driver' => 'file',
      'store' => 'database',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Concurrency\\ConcurrencyServiceProvider',
      6 => 'Illuminate\\Cookie\\CookieServiceProvider',
      7 => 'Illuminate\\Database\\DatabaseServiceProvider',
      8 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      9 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      10 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      11 => 'Illuminate\\Hashing\\HashServiceProvider',
      12 => 'Illuminate\\Mail\\MailServiceProvider',
      13 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      14 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      15 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      16 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      17 => 'Illuminate\\Queue\\QueueServiceProvider',
      18 => 'Illuminate\\Redis\\RedisServiceProvider',
      19 => 'Illuminate\\Session\\SessionServiceProvider',
      20 => 'Illuminate\\Translation\\TranslationServiceProvider',
      21 => 'Illuminate\\Validation\\ValidationServiceProvider',
      22 => 'Illuminate\\View\\ViewServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
      24 => 'App\\Providers\\FortifyServiceProvider',
      25 => 'App\\Providers\\JetstreamServiceProvider',
      26 => 'Froiden\\LaravelInstaller\\Providers\\LaravelInstallerServiceProvider',
      27 => 'App\\Providers\\CustomConfigProvider',
      28 => 'Illuminate\\Translation\\TranslationServiceProvider',
      29 => 'Macellan\\Zip\\ZipServiceProvider',
      30 => 'App\\Providers\\FileStorageCustomConfigProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Concurrency' => 'Illuminate\\Support\\Facades\\Concurrency',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Context' => 'Illuminate\\Support\\Facades\\Context',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Number' => 'Illuminate\\Support\\Number',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Process' => 'Illuminate\\Support\\Facades\\Process',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schedule' => 'Illuminate\\Support\\Facades\\Schedule',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Uri' => 'Illuminate\\Support\\Uri',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
    ),
    'main_application_subdomain' => '',
    'short_domain_name' => false,
    'redirect_https' => false,
    'logo' => 'https://snappi.com.ng/user-uploads/logo/787f77108a28bd19e6d5e752a77a548b.png',
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'pusher',
    'connections' => 
    array (
      'reverb' => 
      array (
        'driver' => 'reverb',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'host' => NULL,
          'port' => 443,
          'scheme' => 'https',
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => 'a2828c3c589699e0be21',
        'secret' => '10503a5ae78690456f1e',
        'app_id' => '1921689',
        'options' => 
        array (
          'cluster' => 'mt1',
          'host' => 'api-mt1.pusher.com',
          'port' => 443,
          'scheme' => 'https',
          'encrypted' => true,
          'useTLS' => true,
          'curl_options' => 
          array (
            81 => 0,
            64 => 0,
            13 => 30,
          ),
        ),
        'client_options' => 
        array (
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/iyxnkmcv/public_html/storage/framework/cache/data',
        'lock_path' => '/home/iyxnkmcv/public_html/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'snappi_cache_',
  ),
  'cashier' => 
  array (
    'key' => NULL,
    'secret' => NULL,
    'path' => 'stripe',
    'webhook' => 
    array (
      'secret' => NULL,
      'tolerance' => 300,
      'events' => 
      array (
        0 => 'customer.subscription.created',
        1 => 'customer.subscription.updated',
        2 => 'customer.subscription.deleted',
        3 => 'customer.updated',
        4 => 'customer.deleted',
        5 => 'payment_method.automatically_updated',
        6 => 'invoice.payment_action_required',
        7 => 'invoice.payment_succeeded',
      ),
    ),
    'currency' => 'usd',
    'currency_locale' => 'en',
    'payment_notification' => NULL,
    'invoices' => 
    array (
      'renderer' => 'Laravel\\Cashier\\Invoices\\DompdfInvoiceRenderer',
      'options' => 
      array (
        'paper' => 'letter',
      ),
    ),
    'logger' => NULL,
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => '*',
    ),
    'allowed_methods' => 
    array (
      0 => 'GET',
      1 => 'POST',
      2 => 'PUT',
      3 => 'PATCH',
      4 => 'DELETE',
      5 => 'OPTIONS',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 86400,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'iyxnkmcv_db',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'iyxnkmcv_db',
        'username' => 'iyxnkmcv_root',
        'password' => '5l.Xua185t(AUS',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => 'innoDb',
        'options' => 
        array (
        ),
      ),
      'mariadb' => 
      array (
        'driver' => 'mariadb',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'iyxnkmcv_db',
        'username' => 'iyxnkmcv_root',
        'password' => '5l.Xua185t(AUS',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'iyxnkmcv_db',
        'username' => 'iyxnkmcv_root',
        'password' => '5l.Xua185t(AUS',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'iyxnkmcv_db',
        'username' => 'iyxnkmcv_root',
        'password' => '5l.Xua185t(AUS',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 
    array (
      'table' => 'migrations',
      'update_date_on_publish' => true,
    ),
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'snappi_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => false,
    'hide_empty_tabs' => true,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'open' => NULL,
      'driver' => 'file',
      'path' => '/home/iyxnkmcv/public_html/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'editor' => 'phpstorm',
    'remote_sites_path' => NULL,
    'local_sites_path' => NULL,
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'ajax_handler_auto_show' => false,
    'ajax_handler_enable_tab' => true,
    'defer_datasets' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => true,
      'events' => true,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => true,
      'cache' => true,
      'models' => true,
      'livewire' => true,
      'jobs' => false,
    ),
    'options' => 
    array (
      'time' => 
      array (
        'memory_usage' => true,
      ),
      'messages' => 
      array (
        'trace' => true,
      ),
      'memory' => 
      array (
        'reset_peak' => false,
        'with_baseline' => false,
        'precision' => 0,
      ),
      'auth' => 
      array (
        'show_name' => true,
        'show_guards' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
        'show_copy' => true,
        'slow_threshold' => false,
        'memory_usage' => true,
        'soft_limit' => 100,
        'hard_limit' => 500,
      ),
      'mail' => 
      array (
        'timeline' => false,
        'show_body' => true,
      ),
      'views' => 
      array (
        'timeline' => true,
        'data' => false,
        'group' => 50,
        'exclude_paths' => 
        array (
          0 => 'vendor/filament',
        ),
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'session' => 
      array (
        'hiddens' => 
        array (
        ),
      ),
      'symfony_request' => 
      array (
        'hiddens' => 
        array (
        ),
      ),
      'events' => 
      array (
        'data' => false,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_middleware' => 
    array (
    ),
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => '/home/iyxnkmcv/public_html/public/fonts',
      'font_cache' => '/home/iyxnkmcv/public_html/storage/fonts',
      'temp_dir' => '/tmp',
      'chroot' => '/home/iyxnkmcv/public_html',
      'allowed_protocols' => 
      array (
        'data://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'artifactPathValidation' => NULL,
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => false,
      'allowed_remote_hosts' => NULL,
      'font_height_ratio' => 1.100000000000000088817841970012523233890533447265625,
      'enable_html5_parser' => true,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
        'test_auto_detect' => true,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'guess',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
      'cells' => 
      array (
        'middleware' => 
        array (
        ),
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
      'default_ttl' => 10800,
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => '/home/iyxnkmcv/public_html/storage/framework/cache/laravel-excel',
      'local_permissions' => 
      array (
      ),
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/iyxnkmcv/public_html/public/user-uploads',
        'throw' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/iyxnkmcv/public_html/storage/app/public',
        'url' => 'https://snappi.com.ng/storage',
        'visibility' => 'public',
        'throw' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
      ),
      'custom_public' => 
      array (
        'driver' => 'local',
        'root' => '/home/iyxnkmcv/public_html/public/receipts',
        'url' => 'https://snappi.com.ng/receipts',
        'visibility' => 'public',
      ),
      'aws_s3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
      ),
      'digitalocean' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'endpoint' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
      'wasabi' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'eu-central-1',
        'bucket' => NULL,
        'endpoint' => 'https://s3.wasabisys.com',
      ),
      'minio' => 
      array (
        'driver' => 's3',
        'use_path_style_endpoint' => true,
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'bucket' => NULL,
        'endpoint' => '',
      ),
      'storage' => 
      array (
        'driver' => 'local',
        'root' => '/home/iyxnkmcv/public_html/storage/app',
      ),
      'localBackup' => 
      array (
        'driver' => 'local',
        'root' => '/home/iyxnkmcv/public_html/storage',
      ),
    ),
    'links' => 
    array (
      '/home/iyxnkmcv/public_html/public/storage' => '/home/iyxnkmcv/public_html/storage/app/public',
    ),
    'cloud' => 's3',
  ),
  'flutterwave' => 
  array (
    'publicKey' => NULL,
    'secretKey' => NULL,
    'secretHash' => '',
  ),
  'fortify-options' => 
  array (
    'two-factor-authentication' => 
    array (
      'confirm' => true,
      'confirmPassword' => true,
    ),
  ),
  'fortify' => 
  array (
    'guard' => 'web',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'auth_middleware' => 'auth',
    'passwords' => 'users',
    'username' => 'email',
    'email' => 'email',
    'views' => true,
    'home' => '/dashboard',
    'prefix' => '',
    'domain' => NULL,
    'lowercase_usernames' => true,
    'limiters' => 
    array (
      'login' => 'login',
      'two-factor' => 'two-factor',
    ),
    'paths' => 
    array (
      'login' => NULL,
      'logout' => NULL,
      'password' => 
      array (
        'request' => NULL,
        'reset' => NULL,
        'email' => NULL,
        'update' => NULL,
        'confirm' => NULL,
        'confirmation' => NULL,
      ),
      'register' => NULL,
      'verification' => 
      array (
        'notice' => NULL,
        'verify' => NULL,
        'send' => NULL,
      ),
      'user-profile-information' => 
      array (
        'update' => NULL,
      ),
      'user-password' => 
      array (
        'update' => NULL,
      ),
      'two-factor' => 
      array (
        'login' => NULL,
        'enable' => NULL,
        'confirm' => NULL,
        'disable' => NULL,
        'qr-code' => NULL,
        'secret-key' => NULL,
        'recovery-codes' => NULL,
      ),
    ),
    'redirects' => 
    array (
      'logout' => 'login',
    ),
    'features' => 
    array (
      0 => 'reset-passwords',
      1 => 'update-profile-information',
      2 => 'update-passwords',
      3 => 'two-factor-authentication',
    ),
  ),
  'froiden_envato' => 
  array (
    'setting' => 'App\\Models\\GlobalSetting',
    'redirectRoute' => 'login',
    'envato_item_id' => 55116396,
    'envato_product_name' => 'ovendor',
    'envato_product_url' => 'https://ovendor.shop/',
    'tmp_path' => '/home/iyxnkmcv/public_html/storage/app',
    'update_baseurl' => 'https://ovendor.shop/ovendor',
    'verify_url' => 'https://ovendor.shop/verify-purchase',
    'updater_file_path' => 'https://ovendor.shop/ovendor/laraupdater.json',
    'middleware' => 
    array (
      0 => 'web',
      1 => 'auth',
    ),
    'allow_users_id' => true,
    'xss_ignore_index' => 
    array (
      0 => 'widget_code',
    ),
    'plugins_url' => 'https://ovendor.shop/plugins/55116396',
    'latest_version_file' => 'https://ovendor.shop/latest-version/55116396',
    'versionLog' => 'https://ovendor.shop/version-log/ovendor',
  ),
  'installer' => 
  array (
    'core' => 
    array (
      'minPhpVersion' => '8.2',
    ),
    'requirements' => 
    array (
      0 => 'openssl',
      1 => 'pdo',
      2 => 'mbstring',
      3 => 'tokenizer',
      4 => 'fileinfo',
      5 => 'curl',
      6 => 'intl',
      7 => 'zip',
    ),
    'permissions' => 
    array (
      'storage/app/' => '775',
      'storage/framework/' => '775',
      'storage/logs/' => '775',
      'bootstrap/cache/' => '775',
    ),
  ),
  'jetstream-options' => 
  array (
    'teams' => 
    array (
      'invitations' => true,
    ),
  ),
  'jetstream' => 
  array (
    'stack' => 'livewire',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'features' => 
    array (
      0 => 'profile-photos',
      1 => 'teams',
      2 => 'account-deletion',
    ),
    'profile_photo_disk' => 'public',
    'auth_session' => 'Laravel\\Jetstream\\Http\\Middleware\\AuthenticateSession',
    'guard' => 'sanctum',
  ),
  'livewire' => 
  array (
    'class_namespace' => 'App\\Livewire',
    'view_path' => '/home/iyxnkmcv/public_html/resources/views/livewire',
    'layout' => 'layouts.app',
    'lazy_placeholder' => NULL,
    'temporary_file_upload' => 
    array (
      'disk' => 'local',
      'rules' => 
      array (
        0 => 'required',
        1 => 'file',
        2 => 'max:12288',
      ),
      'directory' => NULL,
      'middleware' => NULL,
      'preview_mimes' => 
      array (
        0 => 'png',
        1 => 'gif',
        2 => 'bmp',
        3 => 'svg',
        4 => 'wav',
        5 => 'mp4',
        6 => 'mov',
        7 => 'avi',
        8 => 'wmv',
        9 => 'mp3',
        10 => 'm4a',
        11 => 'jpg',
        12 => 'jpeg',
        13 => 'mpga',
        14 => 'webp',
        15 => 'wma',
        16 => 'ico',
      ),
      'max_upload_time' => 5,
      'cleanup' => true,
    ),
    'render_on_redirect' => false,
    'legacy_model_binding' => false,
    'inject_assets' => true,
    'navigate' => 
    array (
      'show_progress_bar' => true,
      'progress_bar_color' => '#000000',
    ),
    'inject_morph_markers' => true,
    'pagination_theme' => 'tailwind',
  ),
  'livewire-alert' => 
  array (
    'alert' => 
    array (
      'position' => 'top-end',
      'timer' => 3000,
      'toast' => true,
      'text' => NULL,
      'showCancelButton' => false,
      'showConfirmButton' => false,
    ),
    'confirm' => 
    array (
      'icon' => 'warning',
      'position' => 'center',
      'toast' => false,
      'timer' => NULL,
      'showConfirmButton' => true,
      'showCancelButton' => true,
      'cancelButtonText' => 'No',
      'confirmButtonColor' => '#3085d6',
      'cancelButtonColor' => '#d33',
    ),
  ),
  'log-viewer' => 
  array (
    'enabled' => true,
    'api_only' => false,
    'require_auth_in_production' => true,
    'route_domain' => NULL,
    'route_path' => 'log-viewer',
    'back_to_system_url' => 'https://snappi.com.ng',
    'back_to_system_label' => NULL,
    'timezone' => NULL,
    'datetime_format' => 'Y-m-d H:i:s',
    'middleware' => 
    array (
      0 => 'web',
      1 => 'auth',
      2 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
      3 => 'App\\Http\\Middleware\\SuperAdmin',
    ),
    'api_middleware' => 
    array (
      0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
      1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
    ),
    'api_stateful_domains' => NULL,
    'hosts' => 
    array (
      'local' => 
      array (
        'name' => 'Codecanyon',
      ),
    ),
    'include_files' => 
    array (
      0 => '*.log',
      1 => '**/*.log',
      '/var/log/httpd/*' => 'Apache',
      '/var/log/nginx/*' => 'Nginx',
      2 => '/opt/homebrew/var/log/nginx/*',
      3 => '/opt/homebrew/var/log/httpd/*',
      4 => '/opt/homebrew/var/log/php-fpm.log',
      5 => '/opt/homebrew/var/log/postgres*log',
      6 => '/opt/homebrew/var/log/redis*log',
      7 => '/opt/homebrew/var/log/supervisor*log',
    ),
    'exclude_files' => 
    array (
    ),
    'hide_unknown_files' => true,
    'shorter_stack_trace_excludes' => 
    array (
      0 => '/vendor/symfony/',
      1 => '/vendor/laravel/framework/',
      2 => '/vendor/barryvdh/laravel-debugbar/',
    ),
    'cache_driver' => NULL,
    'cache_key_prefix' => 'lv',
    'lazy_scan_chunk_size_in_mb' => 50,
    'strip_extracted_context' => true,
    'per_page_options' => 
    array (
      0 => 10,
      1 => 25,
      2 => 50,
      3 => 100,
      4 => 250,
      5 => 500,
    ),
    'defaults' => 
    array (
      'use_local_storage' => true,
      'folder_sorting_method' => 'ModifiedTime',
      'folder_sorting_order' => 'desc',
      'log_sorting_order' => 'desc',
      'per_page' => 25,
      'theme' => 'System',
      'shorter_stack_traces' => false,
    ),
    'root_folder_prefix' => 'root',
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'deprecations' => 
    array (
      'channel' => 'null',
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/iyxnkmcv/public_html/storage/logs/laravel.log',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/iyxnkmcv/public_html/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'replace_placeholders' => true,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
        'replace_placeholders' => true,
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
        'facility' => 8,
        'replace_placeholders' => true,
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/home/iyxnkmcv/public_html/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'url' => NULL,
        'host' => 'mail.snappi.com.ng',
        'port' => '587',
        'encryption' => 'tls',
        'username' => 'support@snappi.com.ng',
        'password' => '5l.Xua185t(AUS',
        'timeout' => NULL,
        'local_domain' => 'snappi.com.ng',
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'resend' => 
      array (
        'transport' => 'resend',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
      'roundrobin' => 
      array (
        'transport' => 'roundrobin',
        'mailers' => 
        array (
          0 => 'ses',
          1 => 'postmark',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'support@snappi.com.ng',
      'name' => 'Snappi',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/iyxnkmcv/public_html/resources/views/vendor/mail',
      ),
    ),
    'verified' => false,
  ),
  'modules' => 
  array (
    'namespace' => 'Modules',
    'stubs' => 
    array (
      'enabled' => false,
      'path' => '/home/iyxnkmcv/public_html/vendor/nwidart/laravel-modules/src/Commands/stubs',
      'files' => 
      array (
        'routes/web' => 'routes/web.php',
        'routes/api' => 'routes/api.php',
        'views/index' => 'resources/views/index.blade.php',
        'views/master' => 'resources/views/layouts/master.blade.php',
        'scaffold/config' => 'config/config.php',
        'composer' => 'composer.json',
        'assets/js/app' => 'resources/assets/js/app.js',
        'assets/sass/app' => 'resources/assets/sass/app.scss',
        'vite' => 'vite.config.js',
        'package' => 'package.json',
      ),
      'replacements' => 
      array (
        'routes/web' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'KEBAB_NAME',
          3 => 'MODULE_NAMESPACE',
          4 => 'CONTROLLER_NAMESPACE',
        ),
        'routes/api' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'KEBAB_NAME',
          3 => 'MODULE_NAMESPACE',
          4 => 'CONTROLLER_NAMESPACE',
        ),
        'vite' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'KEBAB_NAME',
        ),
        'json' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'KEBAB_NAME',
          3 => 'MODULE_NAMESPACE',
          4 => 'PROVIDER_NAMESPACE',
        ),
        'views/index' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'views/master' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'KEBAB_NAME',
        ),
        'scaffold/config' => 
        array (
          0 => 'STUDLY_NAME',
        ),
        'composer' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'VENDOR',
          3 => 'AUTHOR_NAME',
          4 => 'AUTHOR_EMAIL',
          5 => 'MODULE_NAMESPACE',
          6 => 'PROVIDER_NAMESPACE',
          7 => 'APP_FOLDER_NAME',
        ),
      ),
      'gitkeep' => true,
    ),
    'paths' => 
    array (
      'modules' => '/home/iyxnkmcv/public_html/Modules',
      'assets' => '/home/iyxnkmcv/public_html/public/modules',
      'migration' => '/home/iyxnkmcv/public_html/database/migrations',
      'app_folder' => 'app/',
      'generator' => 
      array (
        'actions' => 
        array (
          'path' => 'Actions',
          'generate' => false,
        ),
        'casts' => 
        array (
          'path' => 'Casts',
          'generate' => false,
        ),
        'channels' => 
        array (
          'path' => 'Broadcasting',
          'generate' => false,
        ),
        'class' => 
        array (
          'path' => 'Classes',
          'generate' => false,
        ),
        'command' => 
        array (
          'path' => 'Console',
          'generate' => false,
        ),
        'component-class' => 
        array (
          'path' => 'View/Components',
          'generate' => false,
        ),
        'emails' => 
        array (
          'path' => 'Emails',
          'generate' => false,
        ),
        'event' => 
        array (
          'path' => 'Events',
          'generate' => false,
        ),
        'enums' => 
        array (
          'path' => 'Enums',
          'generate' => false,
        ),
        'exceptions' => 
        array (
          'path' => 'Exceptions',
          'generate' => false,
        ),
        'jobs' => 
        array (
          'path' => 'Jobs',
          'generate' => false,
        ),
        'helpers' => 
        array (
          'path' => 'Helpers',
          'generate' => false,
        ),
        'interfaces' => 
        array (
          'path' => 'Interfaces',
          'generate' => false,
        ),
        'listener' => 
        array (
          'path' => 'Listeners',
          'generate' => false,
        ),
        'model' => 
        array (
          'path' => 'Entities',
          'generate' => false,
        ),
        'notifications' => 
        array (
          'path' => 'Notifications',
          'generate' => false,
        ),
        'observer' => 
        array (
          'path' => 'Observers',
          'generate' => false,
        ),
        'policies' => 
        array (
          'path' => 'Policies',
          'generate' => false,
        ),
        'provider' => 
        array (
          'path' => 'Providers',
          'generate' => true,
        ),
        'repository' => 
        array (
          'path' => 'Repositories',
          'generate' => false,
        ),
        'resource' => 
        array (
          'path' => 'Transformers',
          'generate' => false,
        ),
        'route-provider' => 
        array (
          'path' => 'Providers',
          'generate' => true,
        ),
        'rules' => 
        array (
          'path' => 'Rules',
          'generate' => false,
        ),
        'services' => 
        array (
          'path' => 'Services',
          'generate' => false,
        ),
        'scopes' => 
        array (
          'path' => 'Models/Scopes',
          'generate' => false,
        ),
        'traits' => 
        array (
          'path' => 'Traits',
          'generate' => false,
        ),
        'controller' => 
        array (
          'path' => 'Http/Controllers',
          'generate' => true,
        ),
        'filter' => 
        array (
          'path' => 'Http/Middleware',
          'generate' => false,
        ),
        'request' => 
        array (
          'path' => 'Http/Requests',
          'generate' => false,
        ),
        'config' => 
        array (
          'path' => 'Config',
          'generate' => true,
        ),
        'factory' => 
        array (
          'path' => 'Database/Factories',
          'generate' => true,
        ),
        'migration' => 
        array (
          'path' => 'Database/Migrations',
          'generate' => true,
        ),
        'seeder' => 
        array (
          'path' => 'Database/Seeders',
          'generate' => true,
        ),
        'lang' => 
        array (
          'path' => 'Resources/lang',
          'generate' => false,
        ),
        'assets' => 
        array (
          'path' => 'Resources/assets',
          'generate' => true,
        ),
        'component-view' => 
        array (
          'path' => 'Resources/views/components',
          'generate' => false,
        ),
        'views' => 
        array (
          'path' => 'Resources/views',
          'generate' => true,
        ),
        'routes' => 
        array (
          'path' => 'Routes',
          'generate' => true,
        ),
        'test-feature' => 
        array (
          'path' => 'tests/Feature',
          'generate' => true,
        ),
        'test-unit' => 
        array (
          'path' => 'tests/Unit',
          'generate' => true,
        ),
      ),
    ),
    'auto-discover' => 
    array (
      'migrations' => true,
      'translations' => false,
    ),
    'commands' => 
    array (
      0 => 'Nwidart\\Modules\\Commands\\Actions\\CheckLangCommand',
      1 => 'Nwidart\\Modules\\Commands\\Actions\\DisableCommand',
      2 => 'Nwidart\\Modules\\Commands\\Actions\\DumpCommand',
      3 => 'Nwidart\\Modules\\Commands\\Actions\\EnableCommand',
      4 => 'Nwidart\\Modules\\Commands\\Actions\\InstallCommand',
      5 => 'Nwidart\\Modules\\Commands\\Actions\\ListCommand',
      6 => 'Nwidart\\Modules\\Commands\\Actions\\ModelPruneCommand',
      7 => 'Nwidart\\Modules\\Commands\\Actions\\ModelShowCommand',
      8 => 'Nwidart\\Modules\\Commands\\Actions\\ModuleDeleteCommand',
      9 => 'Nwidart\\Modules\\Commands\\Actions\\UnUseCommand',
      10 => 'Nwidart\\Modules\\Commands\\Actions\\UpdateCommand',
      11 => 'Nwidart\\Modules\\Commands\\Actions\\UseCommand',
      12 => 'Nwidart\\Modules\\Commands\\Database\\MigrateCommand',
      13 => 'Nwidart\\Modules\\Commands\\Database\\MigrateRefreshCommand',
      14 => 'Nwidart\\Modules\\Commands\\Database\\MigrateResetCommand',
      15 => 'Nwidart\\Modules\\Commands\\Database\\MigrateRollbackCommand',
      16 => 'Nwidart\\Modules\\Commands\\Database\\MigrateStatusCommand',
      17 => 'Nwidart\\Modules\\Commands\\Database\\SeedCommand',
      18 => 'Nwidart\\Modules\\Commands\\Make\\ActionMakeCommand',
      19 => 'Nwidart\\Modules\\Commands\\Make\\CastMakeCommand',
      20 => 'Nwidart\\Modules\\Commands\\Make\\ChannelMakeCommand',
      21 => 'Nwidart\\Modules\\Commands\\Make\\ClassMakeCommand',
      22 => 'Nwidart\\Modules\\Commands\\Make\\CommandMakeCommand',
      23 => 'Nwidart\\Modules\\Commands\\Make\\ComponentClassMakeCommand',
      24 => 'Nwidart\\Modules\\Commands\\Make\\ComponentViewMakeCommand',
      25 => 'Nwidart\\Modules\\Commands\\Make\\ControllerMakeCommand',
      26 => 'Nwidart\\Modules\\Commands\\Make\\EventMakeCommand',
      27 => 'Nwidart\\Modules\\Commands\\Make\\EventProviderMakeCommand',
      28 => 'Nwidart\\Modules\\Commands\\Make\\EnumMakeCommand',
      29 => 'Nwidart\\Modules\\Commands\\Make\\ExceptionMakeCommand',
      30 => 'Nwidart\\Modules\\Commands\\Make\\FactoryMakeCommand',
      31 => 'Nwidart\\Modules\\Commands\\Make\\InterfaceMakeCommand',
      32 => 'Nwidart\\Modules\\Commands\\Make\\HelperMakeCommand',
      33 => 'Nwidart\\Modules\\Commands\\Make\\JobMakeCommand',
      34 => 'Nwidart\\Modules\\Commands\\Make\\ListenerMakeCommand',
      35 => 'Nwidart\\Modules\\Commands\\Make\\MailMakeCommand',
      36 => 'Nwidart\\Modules\\Commands\\Make\\MiddlewareMakeCommand',
      37 => 'Nwidart\\Modules\\Commands\\Make\\MigrationMakeCommand',
      38 => 'Nwidart\\Modules\\Commands\\Make\\ModelMakeCommand',
      39 => 'Nwidart\\Modules\\Commands\\Make\\ModuleMakeCommand',
      40 => 'Nwidart\\Modules\\Commands\\Make\\NotificationMakeCommand',
      41 => 'Nwidart\\Modules\\Commands\\Make\\ObserverMakeCommand',
      42 => 'Nwidart\\Modules\\Commands\\Make\\PolicyMakeCommand',
      43 => 'Nwidart\\Modules\\Commands\\Make\\ProviderMakeCommand',
      44 => 'Nwidart\\Modules\\Commands\\Make\\RepositoryMakeCommand',
      45 => 'Nwidart\\Modules\\Commands\\Make\\RequestMakeCommand',
      46 => 'Nwidart\\Modules\\Commands\\Make\\ResourceMakeCommand',
      47 => 'Nwidart\\Modules\\Commands\\Make\\RouteProviderMakeCommand',
      48 => 'Nwidart\\Modules\\Commands\\Make\\RuleMakeCommand',
      49 => 'Nwidart\\Modules\\Commands\\Make\\ScopeMakeCommand',
      50 => 'Nwidart\\Modules\\Commands\\Make\\SeedMakeCommand',
      51 => 'Nwidart\\Modules\\Commands\\Make\\ServiceMakeCommand',
      52 => 'Nwidart\\Modules\\Commands\\Make\\TraitMakeCommand',
      53 => 'Nwidart\\Modules\\Commands\\Make\\TestMakeCommand',
      54 => 'Nwidart\\Modules\\Commands\\Make\\ViewMakeCommand',
      55 => 'Nwidart\\Modules\\Commands\\Publish\\PublishCommand',
      56 => 'Nwidart\\Modules\\Commands\\Publish\\PublishConfigurationCommand',
      57 => 'Nwidart\\Modules\\Commands\\Publish\\PublishMigrationCommand',
      58 => 'Nwidart\\Modules\\Commands\\Publish\\PublishTranslationCommand',
      59 => 'Nwidart\\Modules\\Commands\\ComposerUpdateCommand',
      60 => 'Nwidart\\Modules\\Commands\\LaravelModulesV6Migrator',
      61 => 'Nwidart\\Modules\\Commands\\SetupCommand',
      62 => 'Nwidart\\Modules\\Commands\\UpdatePhpunitCoverage',
      63 => 'Nwidart\\Modules\\Commands\\Database\\MigrateFreshCommand',
    ),
    'scan' => 
    array (
      'enabled' => false,
      'paths' => 
      array (
        0 => '/home/iyxnkmcv/public_html/vendor/*/*',
      ),
    ),
    'composer' => 
    array (
      'vendor' => 'nwidart',
      'author' => 
      array (
        'name' => 'Nicolas Widart',
        'email' => 'n.widart@gmail.com',
      ),
      'composer-output' => false,
    ),
    'register' => 
    array (
      'translations' => true,
      'files' => 'register',
    ),
    'activators' => 
    array (
      'file' => 
      array (
        'class' => 'Nwidart\\Modules\\Activators\\FileActivator',
        'statuses-file' => '/home/iyxnkmcv/public_html/storage/app/modules_statuses.json',
      ),
    ),
    'activator' => 'file',
  ),
  'modules-livewire' => 
  array (
    'namespace' => 'Livewire',
    'view' => 'Resources/views/livewire',
    'volt_view_namespaces' => 
    array (
      0 => 'livewire',
      1 => 'pages',
    ),
    'custom_modules' => 
    array (
    ),
  ),
  'payfast' => 
  array (
    'testing' => true,
    'merchant' => 
    array (
      'merchant_id' => '10000100',
      'merchant_key' => '46f0cd694581a',
      'return_url' => 'http://your-domain.co.za/success',
      'cancel_url' => 'http://your-domain.co.za/cancel',
      'notify_url' => 'http://your-domain.co.za/itn',
    ),
    'hosts' => 
    array (
      0 => 'www.payfast.co.za',
      1 => 'sandbox.payfast.co.za',
      2 => 'w1w.payfast.co.za',
      3 => 'w2w.payfast.co.za',
    ),
    'passphrase' => NULL,
  ),
  'paystack' => 
  array (
    'publicKey' => false,
    'secretKey' => false,
    'paymentUrl' => false,
    'merchantEmail' => false,
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'role_pivot_key' => NULL,
      'permission_pivot_key' => NULL,
      'model_morph_key' => 'model_id',
      'team_foreign_key' => 'restaurant_id',
    ),
    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'events_enabled' => false,
    'teams' => false,
    'team_resolver' => 'Spatie\\Permission\\DefaultTeamResolver',
    'use_passport_client_credentials' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      \DateInterval::__set_state(array(
         'from_string' => true,
         'date_string' => '24 hours',
      )),
      'key' => 'spatie.permission.cache',
      'store' => 'default',
    ),
  ),
  'printer' => 
  array (
    'types' => 
    array (
      '58mm' => 
      array (
        'name' => '58mm Thermal Printer',
        'chars_per_line' => 32,
      ),
      '76mm' => 
      array (
        'name' => '76mm Thermal Printer',
        'chars_per_line' => 42,
      ),
      '80mm' => 
      array (
        'name' => '80mm Thermal Printer',
        'chars_per_line' => 48,
      ),
    ),
    'default' => '80mm',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'batching' => 
    array (
      'database' => 'mysql',
      'table' => 'job_batches',
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'snappi.com.ng',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'token_prefix' => '',
    'middleware' => 
    array (
      'authenticate_session' => 'Laravel\\Sanctum\\Http\\Middleware\\AuthenticateSession',
      'encrypt_cookies' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
      'validate_csrf_token' => 'Illuminate\\Foundation\\Http\\Middleware\\ValidateCsrfToken',
    ),
  ),
  'services' => 
  array (
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'resend' => 
    array (
      'key' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'slack' => 
    array (
      'notifications' => 
      array (
        'bot_user_oauth_token' => NULL,
        'channel' => NULL,
      ),
    ),
    'pusher' => 
    array (
      'instance_id' => NULL,
      'beam_secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'database',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/iyxnkmcv/public_html/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'snappi_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
  ),
  'translation-manager' => 
  array (
    'route' => 
    array (
      'prefix' => 'translations',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'auth',
      ),
    ),
    'delete_enabled' => true,
    'exclude_groups' => 
    array (
    ),
    'exclude_langs' => 
    array (
    ),
    'sort_keys' => false,
    'trans_functions' => 
    array (
      0 => 'trans',
      1 => 'trans_choice',
      2 => 'Lang::get',
      3 => 'Lang::choice',
      4 => 'Lang::trans',
      5 => 'Lang::transChoice',
      6 => '@lang',
      7 => '@choice',
      8 => '__',
      9 => '$trans.get',
    ),
    'db_connection' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/iyxnkmcv/public_html/resources/views',
    ),
    'compiled' => '/home/iyxnkmcv/public_html/storage/framework/views',
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 12,
      'verify' => true,
      'limit' => NULL,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
      'verify' => true,
    ),
    'rehash_on_login' => true,
  ),
  'concurrency' => 
  array (
    'default' => 'process',
  ),
  'blade-heroicons' => 
  array (
    'prefix' => 'heroicon',
    'fallback' => '',
    'class' => '',
    'attributes' => 
    array (
    ),
  ),
  'blade-icons' => 
  array (
    'sets' => 
    array (
    ),
    'class' => '',
    'attributes' => 
    array (
    ),
    'fallback' => '',
    'components' => 
    array (
      'disabled' => false,
      'default' => 'icon',
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
