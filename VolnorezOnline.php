<?php
/*
Plugin Name: VolnorezOnline
Plugin URI: http://volnorez.com
Description: This widget gives you the ability to show Top radio stations for Volnorez.com, located at http://www.volnorez.com.
Version: 0.8
Author: Greed
Author URI: http://volnorez.com
*/

/*  Copyright 2012  Greed  (email: Greed1989@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function	VolnorezOnline() {
	echo '<span id="VolnorezOnline" style="display:none;">';
		$data = get_option('VolnorezOnline');
		$nIDLastGenre = false;
		if( isset($_COOKIE['interface']) )
		{
			$cName = 'VolnorezOnline_genre';
			if( strpos($_COOKIE['interface'], $cName)!==false )
			{
				$_COOKIE['interface'] = str_replace('\\','',$_COOKIE['interface']);
				$aCookie = json_decode($_COOKIE['interface']);
				if( isset( $aCookie->$cName ) ) $nIDLastGenre = $aCookie->$cName;
			}
		}
		if( isset($data['title']) && $data['title']!='' ) echo '<p id="VolnorezOnline_WidgetTitle"><b>'.$data['title'].'</b></p>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_PluginURL" value="' . plugin_url() . '"/>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_Count" value="' . $data['count'] . '"/>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_LastGenre" value="' . $nIDLastGenre . '"/>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_GenreID" value="' . $data['genre_id'] . '"/>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_Language" value="' . $data['language'] . '"/>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_GenreList" value="' . $data['genre_list'] . '"/>';
		echo '<input type="hidden" id="VolnorezOnlineConfig_Autoplay" value="' . $data['autoplay'] . '"/>';
		echo '<div id="VolnorezOnline_Container">';
		echo '</div>';
	echo '</span>';
}

function	VolnorezOnline_register_widget() {
     register_sidebar_widget('VolnorezOnline', 'VolnorezOnline');
     register_widget_control('VolnorezOnline', 'control');
}

function	control()
{
	$data = get_option('VolnorezOnline');
	// Title
	echo '<p>';
		echo '<b>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Заголовок виджета':'Widget tile') . ':</b>';
		echo '<br />';
		echo '<input name="VolnorezOnline_Title" type="text" value="' . $data['title'] . '" />';
	echo '</p>';
	// Station count
	echo '<p>';
		echo '<b>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Количество станций':'Amount stations') . ':</b>';
		echo '<br />';
		echo '<input name="VolnorezOnline_Count" type="text" value="' . $data['count'] . '" />';
		echo '<br />';
		echo '<em>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Количество станций одновременно находящихся на странице':'The number of stations simultaneously located on page') . '</em>';
	echo '</p>';
	// Language
	echo '<p>';
		echo '<b>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Язык':'Language') . '</b>';
		echo '<br />';
		echo '<select name="VolnorezOnline_Language">';
			echo '<option value="RUSSIAN" ' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'selected':'') . '>Русский</option>';
			echo '<option value="ENGLISH" ' . (( isset($data['language']) && $data['language'] == 'ENGLISH' )?'selected':'') . '>English</option>';
		echo '</select>';
	echo '</p>';
	// Genre
	echo '<p>';
		echo '<b>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Жанр':'Genre') . '</b>';
		echo '<br />';
		echo '<select name="VolnorezOnline_GenreID" class="VolnorezOnline_GenreID">';
			echo '<option value="All" ' . (( !isset($data['genre_id']) || $data['genre_id'] < 1 || $data['genre_id'] > 16 )?'selected':'') . '>All</option>';
			echo '<option value="1" ' . (( isset($data['genre_id']) && $data['genre_id'] == '1' )?'selected':'') . '>Pop</option>';
			echo '<option value="2" ' . (( isset($data['genre_id']) && $data['genre_id'] == '2' )?'selected':'') . '>Electronic music</option>';
			echo '<option value="3" ' . (( isset($data['genre_id']) && $data['genre_id'] == '3' )?'selected':'') . '>Rap (Hip Hop)</option>';
			echo '<option value="4" ' . (( isset($data['genre_id']) && $data['genre_id'] == '4' )?'selected':'') . '>Games</option>';
			echo '<option value="5" ' . (( isset($data['genre_id']) && $data['genre_id'] == '5' )?'selected':'') . '>Communication, Books, Sports, Humor</option>';
			echo '<option value="6" ' . (( isset($data['genre_id']) && $data['genre_id'] == '6' )?'selected':'') . '>Rock</option>';
			echo '<option value="7" ' . (( isset($data['genre_id']) && $data['genre_id'] == '7' )?'selected':'') . '>Ambient, Lounge, Dream</option>';
			echo '<option value="8" ' . (( isset($data['genre_id']) && $data['genre_id'] == '8' )?'selected':'') . '>Chanson, Romance, Bards</option>';
			echo '<option value="9" ' . (( isset($data['genre_id']) && $data['genre_id'] == '9' )?'selected':'') . '>Religious music</option>';
			echo '<option value="10" ' . (( isset($data['genre_id']) && $data['genre_id'] == '10' )?'selected':'') . '>Blues</option>';
			echo '<option value="11" ' . (( isset($data['genre_id']) && $data['genre_id'] == '11' )?'selected':'') . '>Jazz</option>';
			echo '<option value="12" ' . (( isset($data['genre_id']) && $data['genre_id'] == '12' )?'selected':'') . '>Classical</option>';
			echo '<option value="13" ' . (( isset($data['genre_id']) && $data['genre_id'] == '13' )?'selected':'') . '>Country</option>';
			echo '<option value="14" ' . (( isset($data['genre_id']) && $data['genre_id'] == '14' )?'selected':'') . '>Ska, Rokstedi, Reggae</option>';
			echo '<option value="15" ' . (( isset($data['genre_id']) && $data['genre_id'] == '15' )?'selected':'') . '>Latin American Music</option>';
			echo '<option value="16" ' . (( isset($data['genre_id']) && $data['genre_id'] == '16' )?'selected':'') . '>Folk Music</option>';
		echo '</select>';
	echo '</p>';
	// Show genre list
	echo '<p>';
		echo '<input class="VolnorezOnline_CheckboxGenreList" type="checkbox" name="VolnorezOnline_GenreList" ' . ( ( isset($data['genre_id']) && $data['genre_id'] != 'All')? 'disabled':'') . ' ' . (( isset($data['genre_list']) && $data['genre_list'] == 'on' && $data['genre_id'] == 'All' )?'checked':'') . '/>';
		echo ' <b>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Показывать список жанров?':'Show genre list?') . '</b>';
	echo '</p>';
	// Autoplay
	echo '<p>';
		echo '<input type="checkbox" name="VolnorezOnline_Autoplay" ' . (( isset($data['autoplay']) && $data['autoplay'] == 'on' )?'checked':'') . '/>';
		echo ' <b>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Автостарт':'Autostart') . '</b>';
		echo '<br />';
		echo '<em>' . (( isset($data['language']) && $data['language'] == 'RUSSIAN' )?'Запускать трансляцию первой станции автоматически?':'Run broadcast first station automatically?') . '</em>';
	echo '</p>';
	
	if ( isset($_POST['VolnorezOnline_Title']) ||
		isset($_POST['VolnorezOnline_Count']) ||
		isset($_POST['VolnorezOnline_Language']) ||
		isset($_POST['VolnorezOnline_GenreList']) ||
		isset($_POST['VolnorezOnline_GenreID']) ||
		isset($_POST['VolnorezOnline_Autoplay']) ){
		$data['title'] = attribute_escape($_POST['VolnorezOnline_Title']);
		$data['count'] = attribute_escape($_POST['VolnorezOnline_Count']);
		$data['language'] = attribute_escape($_POST['VolnorezOnline_Language']);
		$data['genre_list'] = attribute_escape($_POST['VolnorezOnline_GenreList']);
		$data['genre_id'] = attribute_escape($_POST['VolnorezOnline_GenreID']);
		$data['autoplay'] = attribute_escape($_POST['VolnorezOnline_Autoplay']);
		update_option('VolnorezOnline', $data);
	}
}

// GET PLUFIN URL
function	plugin_url()
{
	return plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) ) . '/';
}

function	VolnorezOnline_JS()
{
	wp_enqueue_script( 'jquery' );
	if( !is_admin() ) wp_enqueue_script('volnorez_online_user_js', plugin_url() . 'js/java.js', array('jquery'));
	else wp_enqueue_script('volnorez_online_admin_js', plugin_url() . 'js/admin_java.js', array('jquery'));
}

function VolnorezOnline_Head()
{
	// Регистрируем стили для плагина:
	wp_register_style( 'volnorez-style', plugin_url() . 'css/style.css', array(), '20120208', 'all' );
	wp_enqueue_style( 'volnorez-style' );
}
add_action( 'wp_enqueue_scripts', 'VolnorezOnline_Head' );

add_action( 'wp_head', 'VolnorezOnline_Head' );
add_action( 'init', 'VolnorezOnline_JS' );
add_action( 'init', 'VolnorezOnline_register_widget');
?>