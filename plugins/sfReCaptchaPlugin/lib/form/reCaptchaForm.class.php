<?php

class reCaptchaForm extends sfForm
{	
	public function configure()
	{
		$this->setWidgets(array('response' => new sfWidgetFormInput()));
		
		$this->validatorSchema->setPostValidator(
			new sfValidatorSchemaReCaptcha('challenge', 'response')
		);
		
		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->validatorSchema->setOption('filter_extra_fields', false);
	}
}
