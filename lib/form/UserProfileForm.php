<?php
class UserProfileForm extends sfFormPropel
{
  public function configure()
  {
    //get profile object
    $user = $this->getObject();
    if(!$user->getUserProfile()){
        $profile = UserProfilePeer::retrieveByPK($user->getUserId());
        if(!$profile){
            $profile = new UserProfile();
            $profile->setUserId($user->getUserId());
        }
        $user->setUserProfile($profile);
    }
  	// build state criteria
   // echo $profile->getCountry().'&';
  	$stateC = new Criteria();
    $stateC->add(CpStatesPeer::COUNTRY_ID,$user->getUserProfile()->getCountry());
  	// build city criteria
   	$cityC = new Criteria();
    $cityC->add(CpCitiesPeer::STATE_ID,$user->getUserProfile()->getState());

    $this->setWidgets(array(
      'country_id'		=> new sfWidgetFormPropelSelect(array('model'=>'CpCountries','add_empty'=>'-- Country --','order_by'=>array('Name','asc'))),
      'state_id'		=> new sfWidgetFormPropelSelect(array('model'=>'CpStates','add_empty'=>'-- State/Province --','order_by'=>array('Name','asc'),'criteria'=>$stateC)),
      'city_id'			=> new sfWidgetFormPropelSelect(array('model'=>'CpCities','add_empty'=>'-- City --','order_by'=>array('Name','asc'),'criteria'=>$cityC)),
      'id'				=> new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
    	'country_id'	=> new sfValidatorPropelChoice(
    							array(
    								'model'		=> 'CpCountries',
    								'column'	=> 'id',
    							),array(
    								'required'	=> '- Please choose country',
    								'invalid'	=> '- Invalid country',
    							)
    					),
    	'state_id'		=> new sfValidatorPropelChoice(
    							array(
    								'model'		=> 'CpStates',
    								'column'	=> 'id',
    								'criteria'	=> clone $stateC,
    							),array(
    								'required'	=> '- Please choose state',
    								'invalid'	=> '- Invalid state',
    							)
    					),
    	'city_id'		=> new sfValidatorPropelChoice(
    							array(
    								'model'		=> 'CpCities',
    								'column'	=> 'id',
    								'criteria'	=> clone $cityC,
    							),array(
    								'required'	=> '- Please choose city',
    								'invalid'	=> '- Invalid city',
    							)
    					),
    	'id'			=> new sfValidatorNumber(array('required'=>false)),
    ));

	//$this->widgetSchema->setLabels(array(
	//	'name'	=> 'Name',
	//));

	$this->widgetSchema->setNameFormat('user[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }

  public function getModelName()
  {
  	return 'Users';
  }
  }
