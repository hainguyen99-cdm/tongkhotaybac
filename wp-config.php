<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'wordpress' );

/** Username của database */
define( 'DB_USER', 'wordpress' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '123456' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Dun04=>+Q&f9LL}NKvTs8-E]$kwV5[:@n9O|B4z4kET]ZAqeA<YLY&>ikzq%GSf2' );
define( 'SECURE_AUTH_KEY',  'K%vV?p4JNHo_Ndg$[<+Nz{rc*unuamx,~Qk*VgVv{E%-23[<4}k (p6,NiR]Mc|1' );
define( 'LOGGED_IN_KEY',    'ocb8B]`OmT):J(8}NnDbxbj8)`} O/,;ExrXm434BWKa{kftezk&t1Y{l5s]d<]c' );
define( 'NONCE_KEY',        'c-. rExp{L[p|33{9vd;U{/91*&a@.y)FC:mEWJU0xX#:mVtNo]JiBp@t *wCIw:' );
define( 'AUTH_SALT',        '7?g{3M,d(RB`Xi[G/Lu8og&H[dvBN}DD<2JNiYxpIgJ4+AZZaUODVz[G#Y.K.S-p' );
define( 'SECURE_AUTH_SALT', ':,l4C@]]T,R3g%:2 aGJ$Z *XR^Koy{s?f.SXy&{mN@j|}2WvjUYdqU7106?g,?f' );
define( 'LOGGED_IN_SALT',   '3~xzyqy~2x]2HlT /.sm,K53j_jYz+~}SeaiA9yfdW3:/GpNDn@iC{:CR5n<Dz){' );
define( 'NONCE_SALT',       'F@!#r|VS@8?0JK?!+xxWe1YFTB* K7E=gb[*=t#7{.H=/9<BPlKm`~})5$:De>8`' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
