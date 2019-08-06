<?php

$method = "default";
$path = getcwd() . DIRECTORY_SEPARATOR;
$repository = array();
$ignore = array();
$letzteVersion = "";
$hostname = "http://ftp.4players.de/pub/hosted/ts3/releases/";
$content = file_get_contents($hostname);

preg_match_all("/(.*)<a href=\"(?<version>.*)\/\">(.*)<\/a>/m", $content, $matches);

if(file_exists("versions.json"))
{
	$content = file_get_contents("versions.json");
	if(strlen($content) > 0)
	{
		$repository = json_decode("[{$content}]", true);		
		$repository = checkArray($repository);
	}
} else {
	echo "Kein Archiv gefunden!" . PHP_EOL;
	echo "Lese gesamtes Online Repository!" . PHP_EOL;
	sleep(5);
}

if(count($matches)<>false)
{
	foreach($matches["version"] as $inhalt)
	{
		if(((int)$inhalt)==0)
		{
			continue;
		}

		if(isset($repository[$inhalt]))
		{
			echo "Gefunden: (Archiv) {$inhalt}" . PHP_EOL;
			if(getVersionAsFloat($inhalt) > getVersionAsFloat($letzteVersion))
			{
				echo "Gefunden: {$inhalt} wurde als letzteVersion gesetzt!" . PHP_EOL;
				$letzteVersion = $inhalt;
			}			
			continue;
		}

		

		switch ($method) {
			case 'preg': {
				// need to thing about this 
			}
			
			default: 
			{
				foreach(array("tar.gz", "tar.bz", "tar.bz2") as $package)
				{
					foreach(array("teamspeak3-server_linux-", "teamspeak3-server_linux_") as $name) 
					{   
                        $arch = "amd64";
						$letzteVersion = $inhalt;
						$filename = "{$name}{$arch}-{$inhalt}.{$package}";			
						$url = "{$hostname}{$inhalt}/{$filename}";
						if(($check = checkFileExists($url)) == 200)
						{
                            echo "Gefunden:{$check}\t{$url}" . PHP_EOL;                            
                            $repository[$inhalt] = array("filename" => $filename, "arch" => $arch);


                            $arch = "x86"; //overwrite filename arch
                            $repository[$inhalt] = array("filename" => "{$name}{$arch}-{$inhalt}.{$package}", "arch" => $arch);     
						}			 
					}
				}
				break;
			}
		}
	}	
}

file_put_contents("versions.json", json_encode($repository));

foreach ($repository as $release => $data) {
	$arch = $data["arch"];
	$filename = $data["filename"];

	system("docker build --build-arg TS3_VERSION={$release} --build-arg TS3_BUILD={$arch} --build-arg TS3_FILENAME={$filename} -t teamspeak:{$release}-{$arch} {$path}");
	system("docker tag teamspeak:{$release}-{$arch} dpilichiewicz/teamspeak:{$release}-{$arch}");

	if($letzteVersion == $release)
	{
		switch($arch)
		{
			case "x86":
				echo "Tag dpilichiewicz/teamspeak:latest-x86 gesetzt" . PHP_EOL;
				system("docker tag teamspeak:{$release}-{$arch} dpilichiewicz/teamspeak:latest-x86");		
			break;
	
			default:
				echo "Tag dpilichiewicz/teamspeak:latest gesetzt" . PHP_EOL;
				system("docker tag teamspeak:{$release}-{$arch} dpilichiewicz/teamspeak:latest");
			break;
		}	
	}
}

system("docker push dpilichiewicz/teamspeak");

function getVersionAsFloat($string = "0.0.0")
{
	$float = 0;
	$explode = explode(".", $string);

	foreach($explode as $depth => $number)
	{
		switch($depth)
		{
			case 0: $float += $number; break; 
			case 1: $float += $number / 10; break;
			case 2: $float += $number / 100; break;
			case 3: $float += $number / 1000; break;
			case 4: $float += $number / 10000; break;
		}
	}

	
	return $float;
}

function checkArray($array = array())
{
	$return = $array;
	if(isset($array[0]))
	{
		$return = checkArray($array[0]);
	}
	return $return;
}

function checkFileExists($url = "")
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_NOBODY, 1);   
	curl_exec($ch);

	return curl_getinfo($ch, CURLINFO_HTTP_CODE);
}