<?php
/**
 * 
 * EAllowedChars class
 *
 * The validator check if input contains allowed characters
 *
 * @see			http://www.yiiframework.com
 * @version		1.0
 * @access		public
 * @author		osh (osh@okijana.com)
 * @date		12/11/2014
 */
class EAllowedChars extends CValidator
{
    // default exceptions
    public $exceptions = null;
    
    /**
	 * (non-PHPdoc)
	 * @see CValidator::validateAttribute()
	 */
    protected function validateAttribute($object,$attribute)
	{
		if(!$this->allowedChars($object->$attribute)){
            $message=$this->message!==null?$this->message:Yii::t("EAllowedChars","{attribute} has illegal characters!.");
			$this->addError($object, $attribute, $message);
		}
    }
  
    protected function allowedChars($attribute)
    {
		// Allowable characters already in regex:
        // a-z (alphabets, include uppercase)
        // 0-9
        // \040 (space)
        // period
        // comma
        // dash
        if (!empty($attribute)){
			if (isset($this->exceptions)){
				$expl = explode(',', $this->exceptions);
				foreach ($expl as $e){
					$this->exceptions .= '\\'.$e;
				}
			}
			
			$pattern = '/^[a-z0-9\040.,\-'.$this->exceptions.']+$/i';
			
			if (preg_match($pattern, $attribute))
				return true;
			else
				return false;
		}else{
			return true;
		}
    }
}