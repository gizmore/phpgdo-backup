<?php
declare(strict_types=1);
namespace GDO\Backup;

use GDO\Core\GDO;
use GDO\Core\GDO_Exception;
use GDO\Core\GDT_Filesize;
use GDO\Core\GDT_Path;
use GDO\Core\GDT_String;
use GDO\Date\GDT_DateTime;
use GDO\Date\Time;
use GDO\File\GDO_File;
use GDO\Util\FileUtil;

/**
 * This GDO is not installed to the database.
 * They get created from the file system.
 *
 * @version 7.0.3
 * @since 6.8.0
 * @author gizmore
 */
final class GDO_Backup extends GDO
{

	/**
	 * @throws GDO_Exception
	 */
	public static function findByName(string $name): self
	{
		$path = GDO_PATH . 'protected/backup/' . $name;
		if (FileUtil::isFile($path))
		{
			return GDO_Backup::blank([
				'backup_name' => $name,
				'backup_path' => $path,
				'backup_created' => Time::getDate(stat($path)['mtime']),
				'backup_size' => filesize($path),
			]);
		}
		throw new GDO_Exception('err_file_not_found', [html($path)]);
	}

	###########
	### GDO ###
	###########

	public function isTestable(): bool
	{
		return false;
	}

	############
	### HREF ###
	############

	public function gdoColumns(): array
	{
		return [
			GDT_String::make('backup_name')->label('name'),
			GDT_Path::make('backup_path')->existingFile(),
			GDT_DateTime::make('backup_created')->label('created_at'),
			GDT_Filesize::make('backup_size'),
		];
	}

	##############
	### Getter ###
	##############

	public function getID(): ?string { return null; }

	public function href_backup_link(): string { return href('Backup', 'Download', '&backup_name=' . urlencode($this->getName())); }

	public function getName(): ?string { return $this->gdoVar('backup_name'); }

	##############
	### Static ###
	##############

	public function getFile(): GDO_File
	{
		$path = $this->gdoVar('backup_path');
		return GDO_File::blank([
			'file_name' => $this->getName(),
			'file_type' => 'application/zip',
			'file_size' => filesize($path),
		])->tempPath($path);
	}

}
