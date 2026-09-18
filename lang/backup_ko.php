<?php
namespace GDO\Backup\lang;

return [
	'cfg_backup_lastdate' => '마지막 백업 날짜',
	'cfg_backup_send_mail' => '백업 첨부파일이 포함된 메일 보내기',
	'tt_cfg_backup_send_mail' => '슬프게도 이것은 아마도 곧 매우 커질 것입니다 :(',
	'link_backup_create' => '백업 생성',
	'link_backup_import' => '백업 가져오기',
	'link_backup_downloads' => '백업 다운로드',
	'mt_backup_createbackup' => '백업 만들기',
	'mt_backup_importbackup' => '백업 가져오기',
	'btn_download' => '다운로드',
	'mt_backup_admin' => '백업',
	'mail_subj_backup' => '%s: 백업',
	'mail_body_backup' => '안녕하세요 %s님,
	
최신 백업본을 첨부합니다.
	
감사합니다,
%s 시스템입니다.',
	'cfg_mysql_path' => 'mysql 바이너리 클라이언트 경로',
	'cfg_mysqldump_path' => 'mysqldump 바이너리 경로',
	'link_backup_detect_mysqldump' => 'Mysqldump 감지',
	'mt_backup_detectmysqldump' => 'Mysqldump 감지',
	'msg_backup_created' => '새로운 백업이 생성되었습니다.',
	'err_gunzip_backup' => '데이터베이스 백업을 gunzip할 수 없습니다.',
	'msg_backup_imported' => '백업을 성공적으로 가져왔습니다.',
	'msg_extracted_backup' => '백업의 압축이 풀렸습니다.',
	'msg_imported_backup_files_db' => '파일 폴더가 복원되었습니다.',
	'msg_imported_mysql_db' => '데이터베이스를 가져왔습니다.',
	'msg_replaced_config' => 'config.php가 대체되었습니다.',
	'err_source_mysql_backup' => '데이터베이스 파일이 손상된 것 같습니다.',
	'list_backup_listbackups' => '%s 백업 사용 가능',
	'info_import_backup' => '가져오기를 수행하면 현재 사이트가 삭제됩니다. 확실합니까?',
	'err_backup_failed' => '백업 프로세스가 실패했습니다.',
];
