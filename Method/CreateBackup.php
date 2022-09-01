<?php
namespace GDO\Backup\Method;

use GDO\Form\MethodForm;
use GDO\Form\GDT_Form;
use GDO\Admin\MethodAdmin;
use GDO\Backup\Module_Backup;
use GDO\Core\Application;
use GDO\Form\GDT_Submit;
use GDO\Form\GDT_AntiCSRF;

final class CreateBackup extends MethodForm
{
	use MethodAdmin;
	
	public function getPermission() : ?string { return 'admin'; }
	
	public function onRenderTabs() : void
	{
		$this->renderAdminBar();
		Module_Backup::instance()->renderBackupBar();
	}
	
	public function createForm(GDT_Form $form) : void
	{
		$form->addFields(
			GDT_AntiCSRF::make(),
		);
		$form->actions()->addField(GDT_Submit::make());
	}
	
	public function formValidated(GDT_Form $form)
	{
		if (Cronjob::make()->doBackup())
		{
			$this->message('msg_backup_created');
		}
		else
		{
			$this->error('err_backup_failed');
		}
		return $this->renderPage();
	}
	
}
