<?php
namespace GDO\Backup\Method;

use GDO\Admin\MethodAdmin;
use GDO\Backup\Module_Backup;
use GDO\Core\GDT;
use GDO\Core\GDT_Response;
use GDO\Core\Method;

/**
 * A backup admin method. renders backup tabs.
 *
 * @author gizmore
 */
final class Admin extends Method
{

	use MethodAdmin;

	public function onRenderTabs(): void
	{
		$this->renderAdminBar();
		Module_Backup::instance()->renderBackupBar();
	}

	public function execute(): GDT
	{
		return GDT_Response::make();
	}

}
