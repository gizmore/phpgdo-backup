<?php
namespace GDO\Backup\lang;

return [
	### Config
	'cfg_backup_lastdate' => 'Last backup date',
	'cfg_backup_send_mail' => 'Send mail with backup attachment',
	'tt_cfg_backup_send_mail' => 'This probably is very large very soon, sadly :(',
	### Links
	'link_backup_create' => 'Create Backup',
	'link_backup_import' => 'Import Backup',
	'link_backup_downloads' => 'Download Backups',
	### Create
	'mt_backup_createbackup' => 'Create a backup',
	### Import
	'mt_backup_importbackup' => 'Import a backup',
	### Download
	'btn_download' => 'Download',
	### Admin
	'mt_backup_admin' => 'Backups',
	### Mail
	'mail_subj_backup' => '%s: Backup',
	'mail_body_backup' => '
Hello %s,
	
Attached is the latest backup.
	
Kind Regards,
The %s system.',
	### mysqldump
	'cfg_mysql_path' => 'Path to mysql binary client',
	'cfg_mysqldump_path' => 'Path to mysqldump binary',
	'link_backup_detect_mysqldump' => 'Detect Mysqldump',
	'mt_backup_detectmysqldump' => 'Detect Mysqldump',
	'msg_backup_created' => 'A fresh backup has been created.',
	'err_gunzip_backup' => 'Cannot gunzip the database backup.',
	'msg_backup_imported' => 'The backup has been imported successfully.',
	'msg_extracted_backup' => 'The backup has been unzipped.',
	'msg_imported_backup_files_db' => 'The files folder has been restored.',
	'msg_imported_mysql_db' => 'The database has been imported.',
	'msg_replaced_config' => 'The config.php has been replaced.',
	'err_source_mysql_backup' => 'The Database file seems corrupt.',
	'list_backup_listbackups' => '%s Backups available',
	'info_import_backup' => 'An import will destroy the current site. Are you sure?',
	'err_backup_failed' => 'The backup process failed.',

];
