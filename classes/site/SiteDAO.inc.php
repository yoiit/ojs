<?php

/**
 * SiteDAO.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package site
 *
 * Class for Site DAO.
 * Operations for retrieving and modifying the Site object.
 *
 * $Id$
 */

class SiteDAO extends DAO {

	/**
	 * Constructor.
	 */
	function SiteDAO() {
		parent::DAO();
	}
	
	/**
	 * Retrieve site information.
	 * @return Site
	 */
	function &getSite() {
		$result = &$this->retrieve(
			'SELECT * FROM site'
		);
		
		if ($result->RecordCount() == 0) {
			return null;
			
		} else {
			return $this->_returnSiteFromRow($result->GetRowAssoc(false));
		}
	}
	
	/**
	 * Internal function to return a Site object from a row.
	 * @param $row array
	 * @return Site
	 */
	function &_returnSiteFromRow(&$row) {
		$site = &new Site();
		$site->setTitle($row['title']);
		$site->setIntro($row['intro']);
		$site->setAbout($row['about']);
		$site->setJournalRedirect($row['journal_redirect']);
		$site->setContactName($row['contact_name']);
		$site->setContactEmail($row['contact_email']);
		$site->setMinPasswordLength($row['min_password_length']);

		return $site;
	}
	
	/**
	 * Insert site information.
	 * @param $site Site
	 */
	function insertSite(&$site) {
		return $this->update(
			'INSERT INTO site
				(title, intro, about, journal_redirect, contact_name, contact_email, min_password_length)
				VALUES
				(?, ?, ?, ?, ?, ?, ?)',
			array(
				$site->getTitle(),
				$site->getIntro(),
				$site->getAbout(),
				$site->getJournalRedirect(),
				$site->getContactName(),
				$site->getContactEmail(),
				$site->getMinPasswordLength()
			)
		);
	}
	
	/**
	 * Update existing site information.
	 * @param $site Site
	 */
	function updateSite(&$site) {
		return $this->update(
			'UPDATE site
				SET
					title = ?,
					intro = ?,
					about = ?,
					journal_redirect = ?,
					contact_name = ?,
					contact_email = ?,
					min_password_length = ?',
			array(
				$site->getTitle(),
				$site->getIntro(),
				$site->getAbout(),
				$site->getJournalRedirect(),
				$site->getContactName(),
				$site->getContactEmail(),
				$site->getMinPasswordLength()
			)
		);
	}
	
}

?>
