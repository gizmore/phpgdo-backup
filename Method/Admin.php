<?php
namespace GDO\Backup\Method;

use GDO\Core\Method;
use GDO\Admin\MethodAdmin;
use GDO\Core\Application;
use GDO\Backup\Module_Backup;

/**
 * A backup admin method. renders backup tabs.
 * @author gizmore
 */
final class Admin extends Method
{
	use MethodAdmin;
	
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
	}
	
}
