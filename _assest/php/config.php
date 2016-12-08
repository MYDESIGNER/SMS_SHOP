<?php

	$version = 'ALPHA 0.1';

	# Konfiguracja sms shopa dla serwerów minecraft.

	# Konfiguracja podstawowa:
		$config['nazwa'] = 'MINECRAFT'; # Nazwa twojego serwera
		$config['title'] = 'SKLEP MINECRAFT'; # Tytuł strony

	# Konfiguracja sklepu:
		# Tutaj wpisujemy dane z naszego operatora SMS PREMIUM czyli MICROSMS.
		$config['user_id'] = '376'; # ID usera znajduje się w kokpicie w panelu microsms.
		$config['sms_id'] = '1074'; # ID naszego kanału SMS, także znajduje się on w panelu microsms.
		$config['sms_tresc'] = 'MSMS.BARTOZ'; # Prefiks który użytkownik musi wpisać aby wysłać sms.


		# Konfiguracja dalsza sklepu: #### DO ZROBIENIA
		$config['logs_save'] = TRUE; # Czy logi ze sklepu mają się zapisywać.  TRUE = TAK / FALSE = NIE
									# Zalecam true.
									# Z false nie mamy na stronie kto ostatnio zakupił usługe.
	
	# Konfiguracja serwera:
		$server['server_ip'] = 'localhost';	# Ip naszego serwera do połączenia się z nim.
		$server['server_port_rcon'] = 'port_servera';	# Port rcon który ustawiamy w server.properties
		$server['server_password'] = 'password';	# Haslo rcon które także ustawiamy w server.properties


	# Przedmioty w sklepie:

		$item = array(
			array('number' => '7055', 
				'price' => '0.5', 
				'name' => '64 x Diamenty', 
				'img' => 'http://hydra-media.cursecdn.com/minecraft-nl.gamepedia.com/6/64/Diamant.png?version=7d3c5d09d4fa90e818187b2b4eb1696a', 
				'cmd' => 'say {GRACZ} kupil DIAMENTY !', 
				'opis' => '
				<b>Tutaj dajemy jakiś 
				opis dla wybranej oferty</b>',
				'id' => '1', # ID NIE MOŻE SIĘ POWTARZAĆ
			),

			array('number' => '7055', 
				'price' => '0.5', 
				'name' => '32 x Diamenty', 
				'img' => 'http://hydra-media.cursecdn.com/minecraft-nl.gamepedia.com/6/64/Diamant.png?version=7d3c5d09d4fa90e818187b2b4eb1696a', 
				'cmd' => 'say {GRACZ} kupil DIAMENTY !', 
				'opis' => '
				<b>Tutaj dajemy jakiś 
				opis dla wybranej oferty</b>',
				'id' => '2',  # ID NIE MOŻE SIĘ POWTARZAĆ
			),
		);

		/*
			VIRABLES:
			{GRACZ} - NICK GRACZA
		*/
