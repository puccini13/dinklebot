<?php

class Language {

	private static $supported_langs = array(
		"Deutsch" => "de",
		"English" => "en",
		//"Español" => "es",
		"Français" => "fr",
		//"Italiano" => "it",
		//"Português (Brasil)" => "pt-br",
		"日本語" => "ja"
	);

	public static function get_languages() {
		return self::$supported_langs;
	}

	public static function best() {
		$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
		foreach($languages as $lang) {
			$lang = explode(';', $lang)[0];
			if(in_array($lang, self::$supported_langs)) {
				return $lang;
			}
		}
		return 'en';
	}

	public static function get($language, $string) {
		if (array_key_exists($language, self::$translation) && array_key_exists($string, self::$translation[$language])) {
			return self::$translation[$language][$string];
		} elseif (array_key_exists($string, self::$translation['en'])) {
			return self::$translation['en'][$string];
		} else {
			return $string;
		}
	}

	public static function exists($language) {
		if (in_array($language, self::$supported_langs)) {
			return true;
		} else {
			return false;
		}
	}

	public static function get_missing($language) {
		if (array_key_exists($language, self::$translation)) {
			$result = array();
			foreach(self::$translation['en'] as $key => $string) {
				if (!array_key_exists($key, self::$translation[$language])) {
					array_push($result, array($key => $string));
				}
			}
			return $result;
		} else {
			return null;
		}
	}

	public static $translation = array(
		"en" => array(
			"site_name" => "Dinklebot",
			"site_description" => "Your personal companion for tracking and showing your Guardians",
			"site_styled_description" => "Your <i>personal companion</i> for <strong>tracking</strong> and <strong>showing</strong> your Guardians",
			"site_username" => "Username",
			"site_footer_contact" => "For feedback, suggestions, bug reports or anything related with this website, contact us on <a href='https://www.facebook.com/dinklebotapp'>Facebook</a> or <a href='http://redd.it/33aizq'>Reddit</a>!",
			"site_footer_mention" => "is in no way affiliated with Bungie.",
			"site_footer_language" => "Language",
			"site_thankyou" => "Thank you a lot!",
			"site_thankyou_f" => "You're what makes this website awesome!",
			"info_refresh" => "This information refresh every hour.",
			"info_ends" => "Ends ",
			"info_ends_f" => "",
			"info_modifiers" => "Modifiers",
			"info_rewards" => "Possible Rewards",
			"info_completed" => "Completed",
			"info_completions" => "Completions",
			"info_light_twenty" => "You must be level 20 to gain Light.",
			"info_no_pvp" => "You must participate in the Crucible at least once to obtain medals.",
			"time_played" => "Played ",
			"time_played_f" => "",
			"time_active" => "Active",
			"time_minute" => "m ",
			"time_hour" => "h ",
			"time_day" => "d ",
			"button_share" => "Share",
			"button_permalink" => "Permalink",
			"button_reload" => "Reload",
			"menu_overview" => "Overview",
			"menu_weekly" => "Periodic",
			"menu_equipment" => "Equipment",
			"menu_progression" => "Progression",
			"menu_statistics" => "Statistics",
			"menu_medals" => "Medals",
			"menu_all" => "All",
			"menu_story" => "Story",
			"menu_patrol" => "Patrol",
			"menu_strikes" => "Strike",
			"menu_crucible" => "Crucible",
			"menu_raid" => "Raid",
			"playstation_exclusive" => "Playstation Exclusive",
			"vog_exclusive" => "Vault of Glass Exclusive",
			"crota_exclusive" => "Crota's End Exclusive",
			"iron_exclusive" => "Iron Banner Exclusive",
			"character_prestige" => "Mote of Light",
			"destination_chests_cosmodrome" => "",
			"destination_chests_mars" => "",
			"destination_chests_moon" => "",
			"destination_chests_venus" => "",
			"faction_cryptarch" => "Crypto-Archeology",
			"faction_eris" => "Crota's Bane",
			"faction_event_iron_banner" => "Iron Banner",
			"faction_event_queen" => "Queen",
			"faction_fotc_vanguard" => "Vanguard Reputation",
			"faction_pvp" => "The Crucible",
			"faction_pvp_dead_orbit" => "Dead Orbit",
			"faction_pvp_future_war_cult" => "Future War Cult",
			"faction_pvp_new_monarchy" => "New Monarchy",
			"pvp_iron_banner.loss_tokens" => "Medallions of Iron",
			"pve_coins" => "Vanguard Marks",
			"pvp_coins" => "Crucible Marks",
			"weekly_pve" => "Weekly Vanguard Marks",
			"weekly_pvp" => "Weekly Crucible Marks",
			"medal_value" => "Value",
		),
		"fr" => array(
			"site_name" => "Dinklebot",
			"site_description" => "Votre compagnion personnel pour suivre et montrer vos Gardiens",
			"site_styled_description" => "Votre <i>compagnion personnel</i> pour <strong>suivre</strong> et <strong>montrer</strong> vos Gardiens",
			"site_username" => "Nom d'utilisateur",
			"site_footer_contact" => "Pour des commentaires, suggestions, rapports de bogues ou quoi que ce soit en lien avec ce site, contactez-nous sur <a href='https://www.facebook.com/dinklebotapp'>Facebook</a> ou <a href='http://redd.it/33aizq'>Reddit</a>!",
			"site_footer_mention" => "n'est aucunement affilié à Bungie.",
			"site_footer_language" => "Langue",
			"site_thankyou" => "Merci beaucoup!",
			"site_thankyou_f" => "Vous êtes ce qui rend ce site extraordinaire!",
			"info_refresh" => "Ces informations sont mises à jour toutes les heures.",
			"info_ends" => "Termine ",
			"info_ends_f" => "",
			"info_modifiers" => "Modificateurs",
			"info_rewards" => "Récompenses possibles",
			"info_completed" => "Complété",
			"info_completions" => "Complétions",
			"info_light_twenty" => "Vous devez être niveau 20 pour obtenir de la Lumière.",
			"info_no_pvp" => "Vous devez participer à L'Épreuve au moins une fois pour obtenir des médailles.",
			"time_played" => "A joué ",
			"time_played_f" => "",
			"time_active" => "Actif",
			"time_minute" => " min ",
			"time_hour" => " h ",
			"time_day" => " j ",
			"button_share" => "Partager",
			"button_permalink" => "Permalien",
			"button_reload" => "Mettre à jour",
			"menu_overview" => "Aperçu",
			"menu_weekly" => "Périodique",
			"menu_equipment" => "Équipement",
			"menu_progression" => "Progression",
			"menu_statistics" => "Statistiques",
			"menu_medals" => "Médailles",
			"menu_all" => "Tous",
			"menu_story" => "Histoire",
			"menu_patrol" => "Patrouille",
			"menu_strikes" => "Assaut",
			"menu_crucible" => "L'Épreuve",
			"menu_raid" => "Raid",
			"playstation_exclusive" => "Exclusivité Playstation",
			"vog_exclusive" => "Exclusivité du Caveau de Verre",
			"crota_exclusive" => "Exclusivité de La chute de Cropta",
			"iron_exclusive" => "Exclusivité de La bannière de Fer",
			"character_prestige" => "Particule de Lumière",
			"destination_chests_cosmodrome" => "",
			"destination_chests_mars" => "",
			"destination_chests_moon" => "",
			"destination_chests_venus" => "",
			"faction_cryptarch" => "Cryptoarchéologie",
			"faction_eris" => "Le Fléau de Cropta",
			"faction_event_iron_banner" => "Bannière de Fer",
			"faction_event_queen" => "Reine",
			"faction_fotc_vanguard" => "Estime de l'Avant-Garde",
			"faction_pvp" => "L'Épreuve",
			"faction_pvp_dead_orbit" => "L'Astre Mort",
			"faction_pvp_future_war_cult" => "Culte de la Guerre Future",
			"faction_pvp_new_monarchy" => "Nouvelle Monarchie",
			"pvp_iron_banner.loss_tokens" => "Médallions de Fer",
			"pve_coins" => "Estime de l'Avant-Garde",
			"pvp_coins" => "Estime de l'Épreuve",
			"weekly_pve" => "Estime de l'Avant-Garde hebdomadaire",
			"weekly_pvp" => "Estime de l'Épreuve hebdomadaire",
			"medal_value" => "Valeur",
		),
		"de" => array(
			"info_refresh" => "Diese Informationen jede Stunde actualizieren.",
			"info_ends" => "Enden ",
			"info_ends_f" => "",
			"info_modifiers" => "Modifikatoren",
			"info_rewards" => "Mögliche Belohnungen",
			"info_completed" => "Fertiggestellt",
			"info_completions" => "Fertigstellungen",
			"info_light_twenty" => "Du musst Level 20 sein, um Licht zu erhalten.",
			"info_no_pvp" => "Sie müssen am Schmelztiegel mindestens einmal teilnehmen, um Medaillen zu erhalten.",
			"time_played" => "Spielzeit ",
			"time_played_f" => "",
			"time_active" => "Activ",
			"time_minute" => "Min. ",
			"time_hour" => "Std. ",
			"time_day" => "T. ",
			"button_share" => "Teilen",
			"button_permalink" => "Permalink",
			"button_reload" => "Nachladen",
			"menu_overview" => "Überblick",
			"menu_weekly" => "Periodisch",
			"menu_equipment" => "Ausrüstung",
			"menu_progression" => "Fortschritt",
			"menu_statistics" => "Statistik",
			"menu_medals" => "Medaillen",
			"menu_all" => "Alle",
			"menu_story" => "Story",
			"menu_patrol" => "Patrouille",
			"menu_strikes" => "Strike",
			"menu_crucible" => "Schmelztiegel",
			"menu_raid" => "Raid",
			"playstation_exclusive" => "Playstation exklusiv",
			"vog_exclusive" => "Gläserne Kammer exklusiv",
			"crota_exclusive" => "Crota's Ende exklusiv",
			"iron_exclusive" => "Eisenbanner exklusiv",
			"character_prestige" => "Licht-Partikel",
			"destination_chests_cosmodrome" => "",
			"destination_chests_mars" => "",
			"destination_chests_moon" => "",
			"destination_chests_venus" => "",
			"faction_cryptarch" => "Kryptoarchäologie",
			"faction_eris" => "Crotas Fluch",
			"faction_event_iron_banner" => "Eisenbanner",
			"faction_event_queen" => "Königin",
			"faction_fotc_vanguard" => "Vorhut-Ruf",
			"faction_pvp" => "Der Schmelztiegel",
			"faction_pvp_dead_orbit" => "Toter Orbit",
			"faction_pvp_future_war_cult" => "Kriegskult Der Zukunft",
			"faction_pvp_new_monarchy" => "Neue Monarchie",
			"pvp_iron_banner.loss_tokens" => "Medaillons des Eisen",
			"pve_coins" => "Vorhut-Marken",
			"pvp_coins" => "Schmelztiegel-Marken",
			"weekly_pve" => "Wöchentlicher Vorhut-Marken",
			"weekly_pvp" => "Wöchentlicher Schmelztiegel-Marken",
			"medal_value" => "Wert",
		),
		"ja" => array(
			"site_name" => "Dinklebot",
			"site_description" => "ガーディアンを追跡と陳列するための個人相手",
			"site_styled_description" => "ガーディアンを<strong>追跡と陳列するため</strong>の<i>個人相手</i>",
			"site_username" => "ユーザー名",
			"site_footer_contact" => "手応えや提案やバグレポートなど場合は、<a href='https://www.facebook.com/dinklebotapp'>Facebook</a>または<a href='http://redd.it/33aizq'>Reddit</a>に私達を連絡ください。",
			"site_footer_mention" => "はBungieと連関していません。",
			"site_footer_language" => "言語",
			"site_thankyou" => "ありがとうございました!",
			"site_thankyou_f" => "寄付はすべて大切です。",
			"info_refresh" => "そこの情報は、毎時更新します。",
			"info_ends" => "",
			"info_ends_f" => "で終了",
			"info_modifiers" => "修飾子",
			"info_rewards" => "リワード",
			"info_completed" => "完了した",
			"info_completions" => "補完",
			"info_light_twenty" => "ライトを得るためにレベル2なければなりません。",
			"info_no_pvp" => "メダルを得るためにクルーシブルを参加なければいけません。",
			"time_played" => "",
			"time_played_f" => "プレイした",
			"time_active" => "アクティブ",
			"time_minute" => "分",
			"time_hour" => "時間",
			"time_day" => "日",
			"button_share" => "共有",
			"button_permalink" => "パーマリンク",
			"button_reload" => "リロード",
			"menu_overview" => "ガーディアン",
			"menu_weekly" => "定期的な",
			"menu_equipment" => "装備",
			"menu_progression" => "進捗",
			"menu_statistics" => "統計",
			"menu_medals" => "メダル",
			"menu_all" => "全て",
			"menu_story" => "ストーリー",
			"menu_patrol" => "パトロール",
			"menu_strikes" => "ストライク",
			"menu_crucible" => "クルーシブル",
			"menu_raid" => "レイド",
			"playstation_exclusive" => "Playstationの専属",
			"vog_exclusive" => "ガラスの間の専属",
			"crota_exclusive" => "クロタの最期の専属",
			"iron_exclusive" => "アイアンバナーの専属",
			"character_prestige" => "光のかけら",
			"destination_chests_cosmodrome" => "",
			"destination_chests_mars" => "",
			"destination_chests_moon" => "",
			"destination_chests_venus" => "",
			"faction_cryptarch" => "クリプト考古学",
			"faction_eris" => "クロタの破滅",
			"faction_event_iron_banner" => "アイアンバナー",
			"faction_event_queen" => "女王",
			"faction_fotc_vanguard" => "バンガードの評判",
			"faction_pvp" => "クルーシブル",
			"faction_pvp_dead_orbit" => "デッドオービット",
			"faction_pvp_future_war_cult" => "フューチャーウォー・カルト",
			"faction_pvp_new_monarchy" => "ニューモナーキー",
			"pvp_iron_banner.loss_tokens" => "鉄のメダリオン",
			"pve_coins" => "今週のバンガード",
			"pvp_coins" => "今週のクルーシブル",
			"weekly_pve" => "今週のバンガードの紋章",
			"weekly_pvp" => "今週のクルーシブルの紋章",
			"medal_value" => "価値",
		),
	);

}