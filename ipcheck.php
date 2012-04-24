<?php
	

	function validip($ip) {
 
if (!empty($ip) && ip2long($ip)!=-1) {
 
$reserved_ips = array (
 
array('0.0.0.0','2.255.255.255'),
 
array('10.0.0.0','10.255.255.255'),
 
array('127.0.0.0','127.255.255.255'),
 
array('169.254.0.0','169.254.255.255'),
 
array('172.16.0.0','172.31.255.255'),
 
array('192.0.2.0','192.0.2.255'),
 
array('192.168.0.0','192.168.255.255'),
 
array('255.255.255.0','255.255.255.255')
 
);
 
 
foreach ($reserved_ips as $r) {
 
$min = ip2long($r[0]);
 
$max = ip2long($r[1]);
 
if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
 
}
 
return true;
 
} else {
 
return false;
 
}
 }
 
 function getip() {
 
if (validip($_SERVER["HTTP_CLIENT_IP"])) {
 
return $_SERVER["HTTP_CLIENT_IP"];
 
}
 
foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
 
if (validip(trim($ip))) {
 
return $ip;
 
}
 
}
 
if (validip($_SERVER["HTTP_X_FORWARDED"])) {
 
return $_SERVER["HTTP_X_FORWARDED"];
 
} elseif (validip($_SERVER["HTTP_FORWARDED_FOR"])) {
 
return $_SERVER["HTTP_FORWARDED_FOR"];
 
} elseif (validip($_SERVER["HTTP_FORWARDED"])) {
 
return $_SERVER["HTTP_FORWARDED"];
 
} elseif (validip($_SERVER["HTTP_X_FORWARDED"])) {
 
return $_SERVER["HTTP_X_FORWARDED"];
 
} else {
 
return $_SERVER["REMOTE_ADDR"];
 
}
	}


	function get_ip_address() {
 	   foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
       		 if (array_key_exists($key, $_SERVER) === true) {
           		 foreach (explode(',', $_SERVER[$key]) as $ip) {
               			 if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                   			 return $ip;
	        	        }
        	    	}
        	}
    	   }
	}

       $ip=getip();
       print_r(geoCheckIP($ip));
       //Array ( [domain] => dslb-094-219-040-096.pools.arcor-ip.net [country] => DE - Germany [state] => Hessen [town] => Erzhausen )

       //Get an array with geoip-infodata
       function geoCheckIP($ip)
       {
               //check, if the provided ip is valid
               if(!filter_var($ip, FILTER_VALIDATE_IP))
               {
                       throw new InvalidArgumentException("IP is not valid");
               }

               //contact ip-server
               $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
               if (empty($response))
               {
                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");
               }

               //Array containing all regex-patterns necessary to extract ip-geoinfo from page
               $patterns=array();
               $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
               $patterns["country"] = '#Country: (.*?)&nbsp;#i';
               $patterns["state"] = '#State/Region: (.*?)<br#i';
               $patterns["town"] = '#City: (.*?)<br#i';

               //Array where results will be stored
               $ipInfo=array();

               //check response from ipserver for above patterns
               foreach ($patterns as $key => $pattern)
               {
                       //store the result in array
                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
               }

               return $ipInfo;
       }

?>
