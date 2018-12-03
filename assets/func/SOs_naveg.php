<?php
function Obter_SO(){
 /**
 * Windows...
 */
 $sistemas_operativos['win95']       		= 'Windows 95';
 $sistemas_operativos['windows 95']   		= 'Windows 95';
 $sistemas_operativos['win98']        		= 'Windows 98';
 $sistemas_operativos['windows 98']    		= 'Windows 98';
 $sistemas_operativos['winnt']              = 'Windows NT';
 $sistemas_operativos['winnt4.0']           = 'Windows NT 4.0';
 $sistemas_operativos['windows nt 4.0']     = 'Windows NT 4.0';
 $sistemas_operativos['win 9x 4.90']        = 'Windows Me';
 $sistemas_operativos['windows me']         = 'Windows Me';
 $sistemas_operativos['windows nt 5.0']     = 'Windows 2000';
 $sistemas_operativos['windows nt 5.1']     = 'Windows XP';
 $sistemas_operativos['windows nt 5.2']     = 'Windows 2003';
 $sistemas_operativos['windows nt 6.0']     = 'Windows Vista';
 $sistemas_operativos['windows nt 6.1']     = 'Windows 7';
 $sistemas_operativos['windows nt 6.2']     = 'Windows 8';
 $sistemas_operativos['windows nt 10.0']    = 'Windows 10';

 /**
 * Linux...
 */
 $sistemas_operativos['linux']              = 'Linux';
 $sistemas_operativos['linux i686']         = 'Linux i686';
 $sistemas_operativos['linux i586']         = 'Linux i586';
 $sistemas_operativos['linux i486']         = 'Linux i486';
 $sistemas_operativos['linux i386']         = 'Linux i386';
 $sistemas_operativos['linux ppc']          = 'Linux PPC';
 /**
 * Unix...
 */
 $sistemas_operativos['unix']               = 'Unix';
 /**
 * Mac...
 */
 $sistemas_operativos['mac']               = 'Mac';
 $sistemas_operativos['Mac OS X']          = 'Mac OS X';
 $sistemas_operativos['Mac 10']            = 'Mac OS X';
 $sistemas_operativos['Mac OS X 10_4']     = 'Mac OS X Tiger';
 $sistemas_operativos['Mac OS X 10_5']     = 'Mac OS X Leopard';
 $sistemas_operativos['Mac OS X 10_5_2']   = 'Mac OS X Leopard';
 $sistemas_operativos['Mac OS X 10_5_3']   = 'Mac OS X Leopard';
 $sistemas_operativos['PowerPC']           = 'Mac PPC';
 $sistemas_operativos['PPC']               = 'Mac PPC';
 /**
 * So Móveis...
 */
 $sistemas_operativos['Android']           = 'Android';
 $sistemas_operativos['elaine']            = 'Palm';
 $sistemas_operativos['palm']              = 'Palm';
 $sistemas_operativos['series60']          = 'Symbian S60';
 $sistemas_operativos['symbian']           = 'Symbian';
 $sistemas_operativos['SymbianOS']         = 'Symbian OS';
 $sistemas_operativos['windows ce']        = 'Windows CE';
	if (is_array($sistemas_operativos)) {
	 	foreach ($sistemas_operativos as $ua => $sistemas_operativo) {
		 if (preg_match("|".preg_quote($ua)."|i", trim($_SERVER['HTTP_USER_AGENT']))) {
		 	return $sistemas_operativo;
		 	}
	 	}
	 }
 	return 'Desconhecido';
}
function Obter_Browser() {
 /**
 * Apenas os mais conhecidos...
 */
 $browsers['Chrome']             = 'Chrome';
 $browsers['Firebird']           = 'Firebird';
 $browsers['Firefox']            = 'Firefox';
 $browsers['Internet Explorer']  = 'Internet Explorer';
 $browsers['Konqueror']          = 'Konqueror';
 $browsers['Lynx']               = 'Lynx';
 $browsers['mobilexplorer']      = 'Mobile Explorer'; // Móvel
 $browsers['Mobile Safari']      = 'Mobile Safari'; // Móvel
 $browsers['MSIE']               = 'Internet Explorer';
 $browsers['Netscape']           = 'Netscape';
 $browsers['OmniWeb']            = 'OmniWeb';
 $browsers['Opera']              = 'Opera';
 $browsers['operamini']          = 'Opera Mini'; // Móvel
 $browsers['opera mini']         = 'Opera Mini'; // Móvel
 $browsers['Phoenix']            = 'Phoenix';
 $browsers['Safari']             = 'Safari';
 	if (is_array($browsers)) {
 		foreach ($browsers as $ua => $browser) {
 			if (preg_match("|".preg_quote($ua).".*?([0-9\.]+)|i", trim($_SERVER['HTTP_USER_AGENT']), $versao)) {
 			return $browser.' '.$versao[1];
 			}			
 		}
 	}
 	return 'Browser Desconhecido';
 }
 ?>