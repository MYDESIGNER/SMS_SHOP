<?php
	
	# Pobieranie pliku konfiguracyjnego 
	include('config.php');
	include('MinecraftRcon.class.php');

	$Web = new Website;
	$alert = new alert;
	$log = new Logging;

	$script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	 
	// for PHP before version 5.2.0
	$script_name = basename($_SERVER['PHP_SELF']);
	$script_name = substr($script_name, 0, -4); // php extension and dot are not needed

	class Website {

		function buy($id, $nick, $code, $number, $cmd){
			include('config.php');
			global $alert;
			global $log;
			if(isset($_POST['kup'])){
				if(!empty($nick) and !empty($code) and !empty($id) and !empty($number) and !empty($cmd)){

					if (preg_match("/^[A-Za-z0-9]{8}$/", $code)) {

						$handle = fopen("http://microsms.pl/api/check.php?userid=". $config['user_id'] ."&number=" . $number . "&code=" . $code . '&serviceid='.$config['sms_id'].'', 'r');
			            $check  = fgetcsv($handle, 1024);
			            fclose($handle);
			            
						if($check[0] != 'E') { 
							if($check[0] == 1) {

									if($config['logs_save'] == TRUE){

										// set path and name of log file (optional)
										$log->lfile('logs.txt');
										 
										// write message to the log file
										$log->lwrite('Nick['.$nick.']-Kod['.$code.']-ID_ITEM['.$id.']-NUMBER['.$number.']-CMD['.$cmd.']');
										 
										// close log file
										$log->lclose();

									}

									define( 'MQ_SERVER_ADDR', ''.$server['server_ip'].'' ); //ip serwera minecraft
									define( 'MQ_SERVER_PORT', ''.$server['server_port_rcon'].'' ); //RCon port serwera minecraft
									define( 'MQ_SERVER_PASS', ''.$server['server_password'].''); //haslo rcon serwera minecraft
									define( 'MQ_TIMEOUT', 2 );


									$Rcon = new MinecraftRcon;
									$komenda = str_replace("{GRACZ}", $nick, $cmd);
									$Rcon->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_SERVER_PASS, MQ_TIMEOUT );		
									$Data = $Rcon->Command($komenda);
									$Data = $Rcon->Command($komenda2);			
									$Rcon->Disconnect();

								// System pobiera automatycznei dane.
								$alert->Success('Pomyślnie zakupiłeś usługę bądź przedmiot w sklepie !');
								$alert->Warn('Po wejsciu na serwer powinieneś już otrzymać usługę bądź przedmiot !');


							}else $alert->Error('Nie prawidłowy kod zwrotny');
						}else $alert->Error('Skontaktuj się z administracją serwera !');			            
			        }else $alert->Error('Nie prawidłowy format kodu zwrotnego.');

				}else $alert->Error('Prosze uzupełnić wszystkie dane !');
			}
		}

	}

	class Logging {
	    // declare log file and file pointer as private properties
	    private $log_file, $fp;
	    // set log file (path and name)
	    public function lfile($path) {
	        $this->log_file = $path;
	    }
	    // write message to the log file
	    public function lwrite($message) {
	        // if file pointer doesn't exist, then open log file
	        if (!is_resource($this->fp)) {
	            $this->lopen();
	        }
	        // define script name
	        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	        // define current time and suppress E_WARNING if using the system TZ settings
	        // (don't forget to set the INI setting date.timezone)
	        $time = @date('[d/M/Y:H:i:s]');
	        // write current time, script name and message to the log file
	        fwrite($this->fp, "$time (BARTOZ-SMSSHOP) $message" . PHP_EOL);
	    }
	    // close log file (it's always a good idea to close a file when you're done with it)
	    public function lclose() {
	        fclose($this->fp);
	    }
	    // open log file (private method)
	    private function lopen() {
	        // in case of Windows set default log file
	        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	            $log_file_default = 'c:/php/logfile.txt';
	        }
	        // set default log file for Linux and other systems
	        else {
	            $log_file_default = 'logs.txt';
	        }
	        // define log file from lfile method or use previously set default
	        $lfile = $this->log_file ? $this->log_file : $log_file_default;
	        // open log file for writing only and place file pointer at the end of the file
	        // (if the file does not exist, try to create it)
	        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
	    }
	}

	class alert { // Allerts

		public function SessionAlert(){
			if(isset($_SESSION['Alert'])){

				$desc = $_SESSION['Alert'];

				echo '
					<div class="alert alert-dismissible alert-success">
					  <button type="button" class="close" data-dismiss="alert">X</button>
					  <strong>OK !</strong> '.$desc.'
					</div>
				';
			}
		}

		public function Error($desc){
			echo '
				<div class="alert alert-dismissible alert-danger">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  <strong>O NIE !</strong> '.$desc.'
				</div>
			';
		}

		public function Info($desc){
			echo '
				<div class="alert alert-dismissible alert-info">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  <strong>INFORMACJA !</strong> '.$desc.'
				</div>
			';
		}

		public function Warn($desc){
			echo '
				<div class="alert alert-dismissible alert-warning">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  <strong>UWAŻAJ !</strong> '.$desc.'
				</div>
			';
		}

		public function Success($desc){
			echo '
				<div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  <strong>OK !</strong> '.$desc.'
				</div>
			';
		}
		
		public function refresh($url){
			Header("Refresh: 2, $url");
		}
	}