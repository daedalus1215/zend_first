<?php

namespace User\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;


class User extends AbstractTableGateway
{
  public function __construct()
  {
    $this->table = 'users';
    // The FeatureSet allows not only setting the default database adapter, but
    // also adds advanced capabilities such as allowing separate reads and
    // writes between different database adapters.
    $this->featureSet = new Feature\FeatureSet();
    $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    $this->initialize();
  }

  // You might have noticed that in the preceding paragraph I wrote “almost everything”. As it stands
  // right now, the photo and the password fields will need additional custom logic in order to be
  // processed correctly. If we want to avoid copying and pasting this logic in other controllers, we
  // will have to encapsulate it in the UserModel. We can override the UserModel's insert method
  // with the following code:
  public function insert($set)
  {
    $set['photo'] = $set['photo']['tmp_name'];
    unset($set['password_verify']);
    $set['password'] = md5($set['password']); // better than clear text passwords
    return parent::insert($set);
  }




}


