<?php
/////////////////////////////////////////////////////////////////////////////
// PhoenixScan
// - Web Application Vulnerability Scanning Software
//
// Copyright (C) 2021 Arjun Goel (phoenixwebscan@gmail.com)
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// This project includes other open source projects which are as follows:
// - PHPCrawl(http://phpcrawl.cuab.de/) - Licensed under GNU General Public 
//   License Version 2.
// - PHP HTTP Protocol Client(http://www.phpclasses.org/package/3-PHP-HTTP-
//   client-to-access-Web-site-pages.html) - Licensed under BSD 2-Clause 
//   License
// - PHP Simple HTML DOM Parser (http://simplehtmldom.sourceforge.net/) - 
//   Licensed under the MIT license
// - TCPDF(http://www.tcpdf.org/) - Licensed under GNU Lesser General Public 
//   License Version 3
// - jQuery(http://jquery.com/) - Dual licensed the MIT or GNU General Public
//   License Version 2 licenses
// - Calliope(http://www.towfiqi.com/xhtml-template-calliope.html) - 
//   Licensed under the Creative Commons Attribution 3.0 Unported License 
//
// This software was developed, and should only be used, entirely for 
// ethical purposes. Running security testing tools such as this on a 
// website(web application) could damage it. In order to stay ethical, 
// you must ensure you have permission of the owners before testing 
// a website(web application). Testing the security of a website(web application) 
// without authorisation is unethical and against the law in many countries.
//
/////////////////////////////////////////////////////////////////////////////

//Commonly used functions

//Check if a string contains a substring
function contains($substring, $string) 
{
    $pos = strpos($string, $substring);
 
    if($pos === false) 
	{
         return false;
    }
    else 
	{
        return true;
    }
}

//Find domain and directory(if any) of site being tested
//e.g. convert http://127.0.0.1/testsitewithvulns/search.php to 
//http://127.0.0.1/testsitewithvulns/, or convert 
//http://example.com/search.php to http://example.com/
function getSiteBeingTested($urlToScan)
{
	$countSlashes = 0;
	$lastIndexOfSlash = 0;
	$lastIndexOfDot = 0;
	$siteBeingTested = $urlToScan;
	for($i=0; $i<strlen($siteBeingTested); $i++)
	{
		if($siteBeingTested[$i] == '/')
		{
			$lastIndexOfSlash = $i;
			$countSlashes++;
		}
		if($siteBeingTested[$i] == '.')
		{
			$lastIndexOfDot = $i;
		}
	}
	if(($lastIndexOfDot < $lastIndexOfSlash) && (substr($siteBeingTested, -1) != '/'))
		$siteBeingTested .= '/';
	else if($countSlashes > 2)
		$siteBeingTested = substr($siteBeingTested, 0 , $lastIndexOfSlash+1);

	return $siteBeingTested;
}

?>
