<?php
#require_once 'inwidget/classes/Autoload.php';
require_once 'inwidget/classes/InstagramScraper.php';
require_once 'inwidget/classes/Unirest.php';
require_once 'inwidget/classes/InWidget.php';

try {

    // Options may change through class constructor. For example:

    $config = array(
        'LOGIN' => 'krasnodar_print',
        'HASHTAG' => 'фотообоиназаказ',
        'ACCESS_TOKEN' => '',
        'authLogin' => '',
        'authPassword' => '',
        'tagsBannedLogins' => 'adastra_frescos',
        'tagsFromAccountOnly' => false,
        'imgRandom' => true,
        'imgCount' => 100,
        'cacheExpiration' => 6,
        'cacheSkip' => false,
        'cachePath' =>  $_SERVER['DOCUMENT_ROOT'].'/inwidget/cache/',
        'skinDefault' => 'modern-black',
        'skinPath'=> '/inwidget/skins/',
        'langDefault' => 'ru',
        'langAuto' => false,
        'langPath' => $_SERVER['DOCUMENT_ROOT'].'/inwidget/langs/',
    );
    $inWidget = new \inWidget\Core($config);

    // Also, you may change default values of properties


    $inWidget->width = 'auto';	// widget width in pixels
    $inWidget->inline = 100; // number of images in single line
    $inWidget->view = 100; // number of images in widget
    $inWidget->toolbar = false;	// show profile avatar, statistic and action button
    $inWidget->preview = 'large'; // quality of images: small, large, fullsize
    $inWidget->adaptive = false; // enable adaptive mode
    $inWidget->skipGET = true; // skip GET variables to avoid name conflicts
    $inWidget->setOptions(); // apply new values


    $inWidget->getData();

}
catch (\Exception $e) {
    echo $e->getMessage();
}
?>
<?php 
/**
 * Project:     inWidget: show pictures from instagram.com on your site!
 * File:        template.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of MIT license
 * http://inwidget.ru/MIT-license.txt
 * 
 * @link http://inwidget.ru
 * @copyright 2014-2018 Alexandr Kazarmshchikov
 * @author Alexandr Kazarmshchikov
 * @package inWidget
 *
 */

if(!$inWidget instanceof \inWidget\Core) {
	throw new \Exception('inWidget object was not initialised.');
}

?>
<?
		$i = 0;
		$count = $inWidget->countAvailableImages($inWidget->data->images);
		if($count>0) {
			if($inWidget->config['imgRandom'] === true) shuffle($inWidget->data->images);
				foreach ($inWidget->data->images as $key=>$item){
					if($inWidget->isBannedUserId($item->authorId) === true) continue;
					switch ($inWidget->preview){
						case 'large':
							$thumbnail = $item->large;
							break;
						case 'fullsize':
							$thumbnail = $item->fullsize;
							break;
						default:
							$thumbnail = $item->small;
					}?>
					<a href="<?=$thumbnail?>" class="gall_link catalog_link" data-fancybox="gallery01">
                            <img src="<?=$thumbnail?>" alt="Фотообои">
                            <i class="fas fa-search-plus zoom_icon"></i>
                        </a>
        <?
					$i++;
					if($i >= $inWidget->view) break;
				}
		}
		else {
			if(!empty($inWidget->config['HASHTAG'])) {
				$inWidget->lang['imgEmptyByHash'] = str_replace(
					'{$hashtag}', 
					$inWidget->config['HASHTAG'], 
					$inWidget->lang['imgEmptyByHash']
				);
			}
		}
	?>