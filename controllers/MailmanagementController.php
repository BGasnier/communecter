<?php
/**
 * ActionController.php
 *
 * @author: Sylvain Barbot <sylvain.barbot@gmail.com>
 * Date: 7/29/15
 * Time: 12:25 AM
 */
class MailmanagementController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'droppedmailaction'    => 'citizenToolKit.controllers.mailmanagement.DroppedMailAction'
	    );
	}
}