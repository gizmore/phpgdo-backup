<?php
namespace GDO\Backup\Method;

use GDO\Table\MethodTable;
use GDO\Core\Application;
use GDO\Core\GDO;
use GDO\DB\ArrayResult;
use GDO\Admin\MethodAdmin;
use GDO\Util\Filewalker;
use GDO\Backup\GDO_Backup;
use GDO\Backup\Module_Backup;
use GDO\Date\Time;
use GDO\UI\GDT_DownloadButton;

/**
 * List of Backups with downloads.
 * 
 * @author gizmore
 */
final class ListBackups extends MethodTable
{
	use MethodAdmin;
	
	private $backups;
	
	public function gdoTable() : GDO { return GDO_Backup::table(); }
	
	public function getDefaultOrder() : ?string { return 'backup_created DESC'; }
	
	public function gdoHeaders() : array
	{
		$backups = GDO_Backup::table();
		return [
			GDT_DownloadButton::make('backup_link'),
			$backups->gdoColumn('backup_created'),
			$backups->gdoColumn('backup_size'),
			$backups->gdoColumn('backup_name'),
// 			$backups->gdoColumn('backup_path'),
		];
	}
	
	public function beforeExecute() : void
	{
		if (Application::instance()->isHTML())
		{
			$this->renderAdminBar();
			Module_Backup::instance()->renderBackupBar();
		}
	}
	
	public function getBackups()
	{
		$this->backups = [];
		Filewalker::traverse(GDO_PATH.'protected/backup', '/\\.zip$/', [$this, 'addBackup']);
		return $this->backups;
	}
	
	public function addBackup($entry, $fullpath)
	{
		$this->backups[] = GDO_Backup::blank([
			'backup_name' => $entry,
			'backup_path' => $fullpath,
			'backup_created' => Time::getDate(stat($fullpath)['mtime']),
			'backup_size' => filesize($fullpath),
		]);
	}

	public function getResult() : ArrayResult
	{
	    $this->getBackups();
		return new ArrayResult($this->backups, GDO_Backup::table());
	}
	
}
