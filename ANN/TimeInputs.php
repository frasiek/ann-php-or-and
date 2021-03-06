<?php

/**
 * Artificial Neural Network - Version 2.3
 *
 * For updates and changes visit the project page at http://ann.thwien.de/
 *
 *
 *
 * <b>LICENCE</b>
 *
 * The BSD 2-Clause License
 *
 * http://opensource.org/licenses/bsd-license.php
 *
 * Copyright (c) 2007 - 2012, Thomas Wien
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 * 1. Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright
 * notice, this list of conditions and the following disclaimer in the
 * documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Thomas Wien <info_at_thwien_dot_de>
 * @version ANN Version 2.3 by Thomas Wien
 * @copyright Copyright (c) 2007-2012 by Thomas Wien
 * @package ANN
 */

namespace ANN;

/**
 * @package ANN
 * @access public
 */

final class TimeInputs
{
	/**#@+
	 * @ignore
	 */
	
	/**
	 * @var string
	 */
	protected $strTime = null;
	
	/**#@-*/
	
	/**
	 * @param string $strTime (Default: null)
	 * @uses checkTimeFormat()
	 * @throws Exception
	 */
		
	public function __construct($strTime = null)
	{
		if($strTime && !$this->checkTimeFormat($strTime))
			throw new Exception('Constraints: $strTime should be HH:MM format');
		
		$this->strTime = $strTime;
	}
	
	/**
	 * @param string $strTime
	 * @uses checkTimeFormat()
	 * @throws Exception
	 */
	
	public function setDefaultTime($strTime)
	{
		if(!$this->checkTimeFormat($strTime))
			throw new Exception('Constraints: $strTime should be HH:MM format');
		
		$this->strTime = $strTime;
	}
	
	/**
	 * @param string $strTime (Default: null)
	 * @return array
	 * @uses checkTimeFormat()
	 * @throws Exception
	 */
	
	public function getTimeOfDay($strTime = null)
	{
		if(!$strTime)
			$strTime = $this->getDefaultTime();
		
		if(!$this->checkTimeFormat($strTime))
			throw new Exception('Constraints: $strTime should be HH:MM format');
		
		$arrReturn = array();
	
		$intHour = date('G', strtotime($strTime));
		
		$arrReturn[0] = ($intHour < 6) ? 1 : 0;
		
		$arrReturn[1] = ($intHour >= 6 && $intHour < 12) ? 1 : 0;
		
		$arrReturn[2] = ($intHour >= 12 && $intHour < 18) ? 1 : 0;
		
		$arrReturn[3] = ($intHour >= 18) ? 1 : 0;
		
		return $arrReturn;
	}
	
	/**
	 * @param string $strTime (Default: null)
	 * @return array
	 * @uses checkTimeFormat()
	 * @throws Exception
	 */
	
	public function getHour($strTime = null)
	{
		if(!$strTime)
			$strTime = $this->getDefaultTime();
		
		if(!$this->checkTimeFormat($strTime))
			throw new Exception('Constraints: $strTime should be HH:MM format');
		
		for($intHour = 0; $intHour <= 23; $intHour++)
			$arrReturn[$intHour] = 0;
			
		$intHour = date('G', strtotime($strTime));
		
		$arrReturn[$intHour] = 1;
		
		return $arrReturn;
	}
	
	/**
	 * @return string
	 */
	
	protected function getDefaultTime()
	{
		if(!$this->strTime)
			return date('H:i');
			
		return $this->strTime;
	}
	
	/**
	 * @param string $strTime
	 * @return boolean
	 */
	
	protected function checkTimeFormat($strTime)
	{
		return preg_match('/^[0-2][0-9]:[0-5][0-9]$/', $strTime);	
	}
}
