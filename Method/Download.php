<?php
namespace GDO\Backup\Method;

use GDO\Core\Application;
use GDO\Core\Method;
use GDO\Core\GDT_String;
use GDO\Net\Stream;
use GDO\Backup\GDO_Backup;
use GDO\Backup\Module_Backup;
use GDO\Admin\MethodAdmin;

/**
 * Download a backup.
 * 
 * @author gizmore
 * @version 7.0.1
 */
final class Download extends Method
{
	use MethodAdmin;
	
	public function getPermission() : ?string { return 'admin'; }
	
	public function getMethodTitle() : string
	{
		return t('link_backup_downloads');
	}
	
	public function gdoParameters() : array
	{
		return [
			GDT_String::make('backup_name')->notNull(),
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
	
	public function execute()
	{
		$backup = GDO_Backup::findByName($this->gdoParameterVar('backup_name'));
		Stream::serve($backup->getFile());
	}
	
}
