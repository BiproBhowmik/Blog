<?php 
	
	/**
	 * Helper
	 */
	class helper
	{
		public function validation($value)
		{
			return trim(htmlspecialchars(stripcslashes($value)));
		}
	}
	


?>