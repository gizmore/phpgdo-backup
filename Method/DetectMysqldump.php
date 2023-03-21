<?php
namespace GDO\Backup\Method;

use GDO\Admin\MethodAdmin;
use GDO\Backup\Module_Backup;
use GDO\CLI\Process;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Form\MethodForm;

/**
 * Auto-detect mysql binaries.
 *
 * @version 6.10
 * @author gizmore
 */
final class DetectMysqldump extends MethodForm
{

	use MethodAdmin;

	public function onRenderTabs(): void
	{
		$this->renderAdminBar();
		Module_Backup::instance()->renderBackupBar();
	}

	public function createForm(GDT_Form $form): void
	{
		$form->addFields(
			GDT_AntiCSRF::make(),
		);
		$form->actions()->addField(GDT_Submit::make());
	}

	public function detect()
	{
		return $this->formValidated($this->getForm());
	}

	public function formValidated(GDT_Form $form)
	{
		# Detect mysql
		if ($path = Process::commandPath('mysql'))
		{
			Module_Backup::instance()->saveConfigVar('mysql_path', $path);
		}
		else
		{
			return $this->error('err_file_not_found', ['mysql'])->
			addField($this->renderPage());
		}

		# Detect mysqldump
		if ($path = Process::commandPath('mysqldump'))
		{
			Module_Backup::instance()->saveConfigVar('mysqldump_path', $path);
		}
		else
		{
			return $this->error('err_file_not_found', ['mysqldump'])->
			addField($this->renderPage());
		}
	}

}
