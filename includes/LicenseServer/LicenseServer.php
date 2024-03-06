<?php

class LicenseServer extends Wpup_UpdateServer {
	protected $db;

	public function __construct($serverUrl = null, $db = null) {
		parent::__construct($serverUrl);

		if ( $db === null ) {
			if ( !file_exists(DB_FILE) ) {
				$db = new SQLite3(DB_FILE, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
				$sql_script = file_get_contents(LICENSES_SQL_FILE);
    			$db->exec($sql_script);
			} else {
				$db = new SQLite3(DB_FILE, SQLITE3_OPEN_READWRITE);
			}
		}
		$this->db = $db;
	}

	public function __destruct() {
		if ( $this->db ) {
			$this->db->close();
		}
	}

	protected function dispatch($request) {
		if ( $request->action === 'get_metadata' ) {
			$this->actionGetMetadata($request);
		} else if ( $request->action === 'download' ) {
			$this->actionDownload($request);
		} else if ( $request->action === 'create_license' ) {
			$this->actionCreateLicense($request); 
		} else if ( $request->action === 'check_license ') {
			$this->actionCheckLicense($request);
		} else if ( $request->action === 'register_license' ) {
			$this->actionRegisterLicense($request);
		} else if ( $request->action === 'unregister_license' ) {
			$this->actionUnregisterLicense($request);
		} else {
			$this->exitWithError(sprintf('Invalid action "%s".', htmlentities($request->action)), 400);
		}
	}

	protected function filterMetadata($meta, $request) {
		$meta = parent::filterMetadata($meta, $request);
		unset($meta['download_url']);
		return $meta;
	}
	
	protected function actionDownload(Wpup_Request $request) {
		$this->exitWithError('Downloads are disabled.', 403);
	}

	protected function actionCreateLicense(Wpup_Request $request) {
		$this->exitWithError('License creation is disabled.', 403);
	}

	protected function actionCheckLicense(Wpup_Request $request) {
		$this->exitWithError('License checks are disabled.', 403);
	}

	protected function actionRegisterLicense(Wpup_Request $request) {
		$this->exitWithError('License registration is disabled.', 403);
	}

	protected function actionUnregisterLicense(Wpup_Request $request) {
		$this->exitWithError('License unregistration is disabled.', 403);
	}
}