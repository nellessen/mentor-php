<?php

/**
 * MWebUser class file.
 *
 * User to make admin attribute available for Yii::app()->user.
 * 
 * @author davidn
 * @see http://www.yiiframework.com/wiki/80/add-information-to-yii-app-user-by-extending-cwebuser-better-version/
 * @todo: We don't need this after creating a admin application.
 *
 */
class MWebUser extends CWebUser
{
  public function getAdmin()
  {
    return $this->id == 1;
  }
}