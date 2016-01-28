<?php
# MantisBT - a php based bugtracking system

# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package MantisBT
 * @copyright Copyright (C) 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright (C) 2002 - 2014  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 */

# This sample file contains the essential files that you MUST
# configure to your specific settings.  You may override settings
# from config_defaults_inc.php by uncommenting the config option
# and setting its value in this file.

# Rename this file to config_inc.php after configuration.

# In general the value OFF means the feature is disabled and ON means the
# feature is enabled.  Any other cases will have an explanation.

# Look in http://www.mantisbt.org/docs/ or config_defaults_inc.php for more
# detailed comments.

# --- Database Configuration ---

$g_hostname = 'localhost:8889';
$g_db_type = 'mysql';
$g_database_name = 'bugtracker';
$g_db_username = 'bugAdmin';
$g_db_password = 'admin';

# --- Anonymous Access / Signup ---
$g_allow_signup				= ON;
$g_allow_anonymous_login	= OFF;
$g_anonymous_account		= '';

$g_phpMailer_method		= PHPMAILER_METHOD_MAIL; # or PHPMAILER_METHOD_SMTP, PHPMAILER_METHOD_SENDMAIL
$g_smtp_host			= 'a2plcpnl0127.prod.iad2.secureserver.net';	
$g_smtp_connection_mode = 'ssl';
$g_smtp_port = 465;
# used with PHPMAILER_METHOD_SMTP
$g_smtp_username		= 'noreply@girlstrade.com';					# used with PHPMAILER_METHOD_SMTP
$g_smtp_password		= 'Eclipse2000';					# used with PHPMAILER_METHOD_SMTP
$g_administrator_email  = 'rchiu5hk@yahoo.com.hk';
$g_webmaster_email      = 'rchiu5hk@yahoo.com.hk';
$g_from_email           = 'noreply@girlstrade.com';	# the "From: " field in emails
$g_return_path_email    = 'rchiu5hk@yahoo.com.hk';	# the return address for bounced mail
$g_from_name			= 'Mantis Bug Tracker';
$g_enable_email_notification = ON;
$g_news_enabled = OFF;
$g_email_receive_own = ON;
$g_allow_file_upload	= ON;
# $g_email_receive_own	= OFF;
# $g_email_send_using_cronjob = OFF;

# --- Attachments / File Uploads ---
# $g_allow_file_upload	= ON;
# $g_file_upload_method	= DATABASE; # or DISK
# $g_absolute_path_default_upload_folder = ''; # used with DISK, must contain trailing \ or /.
# $g_max_file_size		= 5000000;	# in bytes
# $g_preview_attachments_inline_max_size = 256 * 1024;
# $g_allowed_files		= '';		# extensions comma separated, e.g. 'php,html,java,exe,pl'
# $g_disallowed_files		= '';		# extensions comma separated

# --- Branding ---
# $g_window_title			= 'MantisBT';
# $g_logo_image			= 'images/mantis_logo.png';
# $g_favicon_image		= 'images/favicon.ico';

# --- Real names ---
# $g_show_realname = OFF;
# $g_show_user_realname_threshold = NOBODY;	# Set to access level (e.g. VIEWER, REPORTER, DEVELOPER, MANAGER, etc)

# --- Others ---
# $g_default_home_page = 'my_view_page.php';	# Set to name of page to go to after login
