<?php
namespace GDO\Backup\Method;

use GDO\Admin\MethodAdmin;
use GDO\Backup\GDO_Backup;
use GDO\Backup\Module_Backup;
use GDO\Core\GDO;
use GDO\Date\Time;
use GDO\DB\ArrayResult;
use GDO\Table\MethodTable;
use GDO\UI\GDT_DownloadButton;
use GDO\Util\Filewalker;

/**
 * List of Backups with downloads.
 *
 * @author gizmore
 */
final class ListBackups extends MethodTable
{

	use MethodAdmin;

	private $backups;

	public function gdoTable(): GDO { return GDO_Backup::table(); }

	public function getDefaultOrder(): ?string { return 'backup_created DESC'; }

	public function getMethodTitle(): string
	{
		return t('mt_backup_listbackups');
	}

	public function gdoHeaders(): array
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

	public function getResult(): ArrayResult
	{
		$this->getBackups();
		return new ArrayResult($this->backups, GDO_Backup::table());
	}

	public function getBackups()
	{
		$this->backups = [];
		Filewalker::traverse(GDO_PATH . 'protected/backup', '/\\.zip$/', [$this, 'addBackup']);
		return $this->backups;
	}

	public function onRenderTabs(): void
	{
		$this->renderAdminBar();
		Module_Backup::instance()->renderBackupBar();
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

}
