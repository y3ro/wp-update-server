<?php

class LicenseServer extends Wpup_UpdateServer {
	protected function dispatch($request) {
		if ( $request->action === 'get_metadata' ) {
			$this->actionGetMetadata($request);
		} else if ( $request->action === 'download' ) {
			$this->actionDownload($request);
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