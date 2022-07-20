<?php
namespace GDO\Backup;

use GDO\Core\GDO_Module;
use GDO\Core\GDT_Checkbox;
use GDO\Core\GDT_Path;
use GDO\Backup\Method\DetectMysqldump;

/**
 * Backup system for gdo6.
 * - Send backups via mail (optionally)
 * - One-click backup generation and import
 * - Backups include config, db-files and the database.
 * @TODO During an import, we want to change some config.php settings when successful; domain, db, etc.
 * @author gizmore
 * @version 6.10.1
 * @since 6.0.7
 */
final class Module_Backup extends GDO_Module
{
	public int $priority = 100;
	public function defaultEnabled() : bool { return false; }
	public function onLoadLanguage() : void { $this->loadLanguage('lang/backup'); }
	public function href_administrate_module() { return href('Backup', 'Admin'); }
	public function getDependencies() : array
	{
		return [
			'ZIP', 'Cronjob',
		];
	}
	
	##############
	### Config ###
	##############
	public function getConfig() : array
	{
		return [
			GDT_Checkbox::make('backup_send_mail')->initial('0'),
		    GDT_Path::make('mysql_path')->initial('mysql')->existingFile(),
		    GDT_Path::make('mysqldump_path')->initial('mysqldump')->existingFile(),
		];
	}
	public function cfgSendMail() { return $this->getConfigValue('backup_send_mail'); }
	public function cfgMysqlPath() { return $this->getConfigVar('mysql_path'); }
	public function cfgMysqldumpPath() { return $this->getConfigVar('mysqldump_path'); }

	###############
	### Install ###
	###############
	public function onInstall() : void
	{
	    DetectMysqldump::make()->detect();
	}
	
}