<?php
declare(strict_types=1);
namespace GDO\Backup\Method;

use GDO\Admin\MethodAdmin;
use GDO\Backup\GDO_Backup;
use GDO\Backup\Module_Backup;
use GDO\Core\GDO_ArgException;
use GDO\Core\GDO_Error;
use GDO\Core\GDT;
use GDO\Core\GDT_Path;
use GDO\Core\GDT_Response;
use GDO\Core\Method;
use GDO\Net\Stream;

/**
 * Download a backup.
 *
 * @version 7.0.3
 * @since 6.9.0
 * @author gizmore
 */
final class Download extends Method
{

	use MethodAdmin;

	public function isTrivial(): bool
	{
		return false;
	}

	public function getPermission(): ?string { return 'admin'; }

	public function onRenderTabs(): void
	{
		$this->renderAdminBar();
		Module_Backup::instance()->renderBackupBar();
	}

	public function getMethodTitle(): string
	{
		return t('link_backup_downloads');
	}

	public function gdoParameters(): array
	{
		return [
			GDT_Path::make('backup_name')->notNull()->existingFile(),
		];
	}

	/**
	 * @throws GDO_ArgException
	 * @throws GDO_Error
	 */
	public function execute(): GDT
	{
		$backup = GDO_Backup::findByName($this->gdoParameterVar('backup_name'));
		Stream::serve($backup->getFile());
		return GDT_Response::make();
	}

}
