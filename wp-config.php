<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'test1wp');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-8,N++) c8{D&>x9OY8rP{|JsMKG?,R*[O-sRiv*Z|iVY:`lPaGhkCSz~&TJ-G&Y');
define('SECURE_AUTH_KEY',  '_C3ll+9E=BfItnK.d(ri$<T|#:O(,68jzj=MhX;RMeJp`&Mf5,?R~%W;(0Y}!+<s');
define('LOGGED_IN_KEY',    '>(C#L_a+`n>q7xl!s@g )tF|5-|cmAaB-oV<?@n#]H~J>.>yovt({k`DB-/S7OD?');
define('NONCE_KEY',        '3*i|QZ- 2,=BIPwvvD+6:`6~>+Vqb<s2]h$%blO @Vg-1dZ+Ji&W?OvayCwRd:F`');
define('AUTH_SALT',        ':q,e[ >25^H@= ^Am:Tse(&P3e+tl*Y-h2cvO)Yp0Z,J5!+=6PSGu$1,MWl)aiJG');
define('SECURE_AUTH_SALT', 'Cgt5@s9(qXOD}>FiTY&Qjgx1Ho($4v0b-`mU5Yh>Ka#-V^f#pP}v1Z{ouRm)6)0P');
define('LOGGED_IN_SALT',   'Fy][3e~(S4c9l=1%m(o0;=X$ gYJ#;&ptoIOY+_TDEF7_(Q{~PxD[ vY_Ta+KH-$');
define('NONCE_SALT',       '[fqnjUC}dz^BEbQu1D#6U3k^u7nQ>v9t,%FJUTgFB>d8t~U=|B~Gug1`|}emSVzE');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
