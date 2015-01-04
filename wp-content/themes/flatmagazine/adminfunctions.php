<?php

add_action('admin_head', 'ilc_add_tinymce');
function ilc_add_tinymce() {
    $output = '';
    
$iconpack = '<div class="faicon">
<section id="web-application">
<h2 class="page-header">Web Application Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-adjust"></i> fa-adjust</a></div>
<div class="span3"><a href="#"><i class="fa fa-anchor"></i> fa-anchor</a></div>
<div class="span3"><a href="#"><i class="fa fa-archive"></i> fa-archive</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows"></i> fa-arrows</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows-h"></i> fa-arrows-h</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows-v"></i> fa-arrows-v</a></div>
<div class="span3"><a href="#"><i class="fa fa-asterisk"></i> fa-asterisk</a></div>
<div class="span3"><a href="#"><i class="fa fa-automobile"></i> fa-automobile <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-ban"></i> fa-ban</a></div>
<div class="span3"><a href="#"><i class="fa fa-bank"></i> fa-bank <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-bar-chart-o"></i> fa-bar-chart-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-barcode"></i> fa-barcode</a></div>
<div class="span3"><a href="#"><i class="fa fa-bars"></i> fa-bars</a></div>
<div class="span3"><a href="#"><i class="fa fa-beer"></i> fa-beer</a></div>
<div class="span3"><a href="#"><i class="fa fa-bell"></i> fa-bell</a></div>
<div class="span3"><a href="#"><i class="fa fa-bell-o"></i> fa-bell-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-bolt"></i> fa-bolt</a></div>
<div class="span3"><a href="#"><i class="fa fa-bomb"></i> fa-bomb</a></div>
<div class="span3"><a href="#"><i class="fa fa-book"></i> fa-book</a></div>
<div class="span3"><a href="#"><i class="fa fa-bookmark"></i> fa-bookmark</a></div>
<div class="span3"><a href="#"><i class="fa fa-bookmark-o"></i> fa-bookmark-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-briefcase"></i> fa-briefcase</a></div>
<div class="span3"><a href="#"><i class="fa fa-bug"></i> fa-bug</a></div>
<div class="span3"><a href="#"><i class="fa fa-building"></i> fa-building</a></div>
<div class="span3"><a href="#"><i class="fa fa-building-o"></i> fa-building-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-bullhorn"></i> fa-bullhorn</a></div>
<div class="span3"><a href="#"><i class="fa fa-bullseye"></i> fa-bullseye</a></div>
<div class="span3"><a href="#"><i class="fa fa-cab"></i> fa-cab <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-calendar"></i> fa-calendar</a></div>
<div class="span3"><a href="#"><i class="fa fa-calendar-o"></i> fa-calendar-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-camera"></i> fa-camera</a></div>
<div class="span3"><a href="#"><i class="fa fa-camera-retro"></i> fa-camera-retro</a></div>
<div class="span3"><a href="#"><i class="fa fa-car"></i> fa-car</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-down"></i> fa-caret-square-o-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-right"></i> fa-caret-square-o-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-up"></i> fa-caret-square-o-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-certificate"></i> fa-certificate</a></div>
<div class="span3"><a href="#"><i class="fa fa-check"></i> fa-check</a></div>
<div class="span3"><a href="#"><i class="fa fa-check-circle"></i> fa-check-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-check-circle-o"></i> fa-check-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-check-square"></i> fa-check-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-check-square-o"></i> fa-check-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-child"></i> fa-child</a></div>
<div class="span3"><a href="#"><i class="fa fa-circle"></i> fa-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-circle-o"></i> fa-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-circle-o-notch"></i> fa-circle-o-notch</a></div>
<div class="span3"><a href="#"><i class="fa fa-circle-thin"></i> fa-circle-thin</a></div>
<div class="span3"><a href="#"><i class="fa fa-clock-o"></i> fa-clock-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-cloud"></i> fa-cloud</a></div>
<div class="span3"><a href="#"><i class="fa fa-cloud-download"></i> fa-cloud-download</a></div>
<div class="span3"><a href="#"><i class="fa fa-cloud-upload"></i> fa-cloud-upload</a></div>
<div class="span3"><a href="#"><i class="fa fa-code"></i> fa-code</a></div>
<div class="span3"><a href="#"><i class="fa fa-code-fork"></i> fa-code-fork</a></div>
<div class="span3"><a href="#"><i class="fa fa-coffee"></i> fa-coffee</a></div>
<div class="span3"><a href="#"><i class="fa fa-cog"></i> fa-cog</a></div>
<div class="span3"><a href="#"><i class="fa fa-cogs"></i> fa-cogs</a></div>
<div class="span3"><a href="#"><i class="fa fa-comment"></i> fa-comment</a></div>
<div class="span3"><a href="#"><i class="fa fa-comment-o"></i> fa-comment-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-comments"></i> fa-comments</a></div>
<div class="span3"><a href="#"><i class="fa fa-comments-o"></i> fa-comments-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-compass"></i> fa-compass</a></div>
<div class="span3"><a href="#"><i class="fa fa-credit-card"></i> fa-credit-card</a></div>
<div class="span3"><a href="#"><i class="fa fa-crop"></i> fa-crop</a></div>
<div class="span3"><a href="#"><i class="fa fa-crosshairs"></i> fa-crosshairs</a></div>
<div class="span3"><a href="#"><i class="fa fa-cube"></i> fa-cube</a></div>
<div class="span3"><a href="#"><i class="fa fa-cubes"></i> fa-cubes</a></div>
<div class="span3"><a href="#"><i class="fa fa-cutlery"></i> fa-cutlery</a></div>
<div class="span3"><a href="#"><i class="fa fa-dashboard"></i> fa-dashboard <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-database"></i> fa-database</a></div>
<div class="span3"><a href="#"><i class="fa fa-desktop"></i> fa-desktop</a></div>
<div class="span3"><a href="#"><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-download"></i> fa-download</a></div>
<div class="span3"><a href="#"><i class="fa fa-edit"></i> fa-edit <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-ellipsis-h"></i> fa-ellipsis-h</a></div>
<div class="span3"><a href="#"><i class="fa fa-ellipsis-v"></i> fa-ellipsis-v</a></div>
<div class="span3"><a href="#"><i class="fa fa-envelope"></i> fa-envelope</a></div>
<div class="span3"><a href="#"><i class="fa fa-envelope-o"></i> fa-envelope-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-envelope-square"></i> fa-envelope-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-eraser"></i> fa-eraser</a></div>
<div class="span3"><a href="#"><i class="fa fa-exchange"></i> fa-exchange</a></div>
<div class="span3"><a href="#"><i class="fa fa-exclamation"></i> fa-exclamation</a></div>
<div class="span3"><a href="#"><i class="fa fa-exclamation-circle"></i> fa-exclamation-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-exclamation-triangle"></i> fa-exclamation-triangle</a></div>
<div class="span3"><a href="#"><i class="fa fa-external-link"></i> fa-external-link</a></div>
<div class="span3"><a href="#"><i class="fa fa-external-link-square"></i> fa-external-link-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-eye"></i> fa-eye</a></div>
<div class="span3"><a href="#"><i class="fa fa-eye-slash"></i> fa-eye-slash</a></div>
<div class="span3"><a href="#"><i class="fa fa-fax"></i> fa-fax</a></div>
<div class="span3"><a href="#"><i class="fa fa-female"></i> fa-female</a></div>
<div class="span3"><a href="#"><i class="fa fa-fighter-jet"></i> fa-fighter-jet</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-archive-o"></i> fa-file-archive-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-audio-o"></i> fa-file-audio-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-code-o"></i> fa-file-code-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-excel-o"></i> fa-file-excel-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-image-o"></i> fa-file-image-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-movie-o"></i> fa-file-movie-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-pdf-o"></i> fa-file-pdf-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-photo-o"></i> fa-file-photo-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-picture-o"></i> fa-file-picture-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-powerpoint-o"></i> fa-file-powerpoint-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-sound-o"></i> fa-file-sound-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-video-o"></i> fa-file-video-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-word-o"></i> fa-file-word-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-zip-o"></i> fa-file-zip-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-film"></i> fa-film</a></div>
<div class="span3"><a href="#"><i class="fa fa-filter"></i> fa-filter</a></div>
<div class="span3"><a href="#"><i class="fa fa-fire"></i> fa-fire</a></div>
<div class="span3"><a href="#"><i class="fa fa-fire-extinguisher"></i> fa-fire-extinguisher</a></div>
<div class="span3"><a href="#"><i class="fa fa-flag"></i> fa-flag</a></div>
<div class="span3"><a href="#"><i class="fa fa-flag-checkered"></i> fa-flag-checkered</a></div>
<div class="span3"><a href="#"><i class="fa fa-flag-o"></i> fa-flag-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-flash"></i> fa-flash <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-flask"></i> fa-flask</a></div>
<div class="span3"><a href="#"><i class="fa fa-folder"></i> fa-folder</a></div>
<div class="span3"><a href="#"><i class="fa fa-folder-o"></i> fa-folder-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-folder-open"></i> fa-folder-open</a></div>
<div class="span3"><a href="#"><i class="fa fa-folder-open-o"></i> fa-folder-open-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-frown-o"></i> fa-frown-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-gamepad"></i> fa-gamepad</a></div>
<div class="span3"><a href="#"><i class="fa fa-gavel"></i> fa-gavel</a></div>
<div class="span3"><a href="#"><i class="fa fa-gear"></i> fa-gear <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-gears"></i> fa-gears <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-gift"></i> fa-gift</a></div>
<div class="span3"><a href="#"><i class="fa fa-glass"></i> fa-glass</a></div>
<div class="span3"><a href="#"><i class="fa fa-globe"></i> fa-globe</a></div>
<div class="span3"><a href="#"><i class="fa fa-graduation-cap"></i> fa-graduation-cap</a></div>
<div class="span3"><a href="#"><i class="fa fa-group"></i> fa-group <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-hdd-o"></i> fa-hdd-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-headphones"></i> fa-headphones</a></div>
<div class="span3"><a href="#"><i class="fa fa-heart"></i> fa-heart</a></div>
<div class="span3"><a href="#"><i class="fa fa-heart-o"></i> fa-heart-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-history"></i> fa-history</a></div>
<div class="span3"><a href="#"><i class="fa fa-home"></i> fa-home</a></div>
<div class="span3"><a href="#"><i class="fa fa-image"></i> fa-image <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-inbox"></i> fa-inbox</a></div>
<div class="span3"><a href="#"><i class="fa fa-info"></i> fa-info</a></div>
<div class="span3"><a href="#"><i class="fa fa-info-circle"></i> fa-info-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-institution"></i> fa-institution <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-key"></i> fa-key</a></div>
<div class="span3"><a href="#"><i class="fa fa-keyboard-o"></i> fa-keyboard-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-language"></i> fa-language</a></div>
<div class="span3"><a href="#"><i class="fa fa-laptop"></i> fa-laptop</a></div>
<div class="span3"><a href="#"><i class="fa fa-leaf"></i> fa-leaf</a></div>
<div class="span3"><a href="#"><i class="fa fa-legal"></i> fa-legal <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-lemon-o"></i> fa-lemon-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-level-down"></i> fa-level-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-level-up"></i> fa-level-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-life-bouy"></i> fa-life-bouy <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-life-ring"></i> fa-life-ring</a></div>
<div class="span3"><a href="#"><i class="fa fa-life-saver"></i> fa-life-saver <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-lightbulb-o"></i> fa-lightbulb-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-location-arrow"></i> fa-location-arrow</a></div>
<div class="span3"><a href="#"><i class="fa fa-lock"></i> fa-lock</a></div>
<div class="span3"><a href="#"><i class="fa fa-magic"></i> fa-magic</a></div>
<div class="span3"><a href="#"><i class="fa fa-magnet"></i> fa-magnet</a></div>
<div class="span3"><a href="#"><i class="fa fa-mail-forward"></i> fa-mail-forward <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-mail-reply"></i> fa-mail-reply <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-mail-reply-all"></i> fa-mail-reply-all <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-male"></i> fa-male</a></div>
<div class="span3"><a href="#"><i class="fa fa-map-marker"></i> fa-map-marker</a></div>
<div class="span3"><a href="#"><i class="fa fa-meh-o"></i> fa-meh-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-microphone"></i> fa-microphone</a></div>
<div class="span3"><a href="#"><i class="fa fa-microphone-slash"></i> fa-microphone-slash</a></div>
<div class="span3"><a href="#"><i class="fa fa-minus"></i> fa-minus</a></div>
<div class="span3"><a href="#"><i class="fa fa-minus-circle"></i> fa-minus-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-minus-square"></i> fa-minus-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-minus-square-o"></i> fa-minus-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-mobile"></i> fa-mobile</a></div>
<div class="span3"><a href="#"><i class="fa fa-mobile-phone"></i> fa-mobile-phone <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-money"></i> fa-money</a></div>
<div class="span3"><a href="#"><i class="fa fa-moon-o"></i> fa-moon-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-mortar-board"></i> fa-mortar-board <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-music"></i> fa-music</a></div>
<div class="span3"><a href="#"><i class="fa fa-navicon"></i> fa-navicon <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-paper-plane"></i> fa-paper-plane</a></div>
<div class="span3"><a href="#"><i class="fa fa-paper-plane-o"></i> fa-paper-plane-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-paw"></i> fa-paw</a></div>
<div class="span3"><a href="#"><i class="fa fa-pencil"></i> fa-pencil</a></div>
<div class="span3"><a href="#"><i class="fa fa-pencil-square"></i> fa-pencil-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-pencil-square-o"></i> fa-pencil-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-phone"></i> fa-phone</a></div>
<div class="span3"><a href="#"><i class="fa fa-phone-square"></i> fa-phone-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-photo"></i> fa-photo <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-picture-o"></i> fa-picture-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-plane"></i> fa-plane</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus"></i> fa-plus</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus-circle"></i> fa-plus-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus-square"></i> fa-plus-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus-square-o"></i> fa-plus-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-power-off"></i> fa-power-off</a></div>
<div class="span3"><a href="#"><i class="fa fa-print"></i> fa-print</a></div>
<div class="span3"><a href="#"><i class="fa fa-puzzle-piece"></i> fa-puzzle-piece</a></div>
<div class="span3"><a href="#"><i class="fa fa-qrcode"></i> fa-qrcode</a></div>
<div class="span3"><a href="#"><i class="fa fa-question"></i> fa-question</a></div>
<div class="span3"><a href="#"><i class="fa fa-question-circle"></i> fa-question-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-quote-left"></i> fa-quote-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-quote-right"></i> fa-quote-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-random"></i> fa-random</a></div>
<div class="span3"><a href="#"><i class="fa fa-recycle"></i> fa-recycle</a></div>
<div class="span3"><a href="#"><i class="fa fa-refresh"></i> fa-refresh</a></div>
<div class="span3"><a href="#"><i class="fa fa-reorder"></i> fa-reorder <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-reply"></i> fa-reply</a></div>
<div class="span3"><a href="#"><i class="fa fa-reply-all"></i> fa-reply-all</a></div>
<div class="span3"><a href="#"><i class="fa fa-retweet"></i> fa-retweet</a></div>
<div class="span3"><a href="#"><i class="fa fa-road"></i> fa-road</a></div>
<div class="span3"><a href="#"><i class="fa fa-rocket"></i> fa-rocket</a></div>
<div class="span3"><a href="#"><i class="fa fa-rss"></i> fa-rss</a></div>
<div class="span3"><a href="#"><i class="fa fa-rss-square"></i> fa-rss-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-search"></i> fa-search</a></div>
<div class="span3"><a href="#"><i class="fa fa-search-minus"></i> fa-search-minus</a></div>
<div class="span3"><a href="#"><i class="fa fa-search-plus"></i> fa-search-plus</a></div>
<div class="span3"><a href="#"><i class="fa fa-send"></i> fa-send <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-send-o"></i> fa-send-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-share"></i> fa-share</a></div>
<div class="span3"><a href="#"><i class="fa fa-share-alt"></i> fa-share-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-share-alt-square"></i> fa-share-alt-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-share-square"></i> fa-share-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-share-square-o"></i> fa-share-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-shield"></i> fa-shield</a></div>
<div class="span3"><a href="#"><i class="fa fa-shopping-cart"></i> fa-shopping-cart</a></div>
<div class="span3"><a href="#"><i class="fa fa-sign-in"></i> fa-sign-in</a></div>
<div class="span3"><a href="#"><i class="fa fa-sign-out"></i> fa-sign-out</a></div>
<div class="span3"><a href="#"><i class="fa fa-signal"></i> fa-signal</a></div>
<div class="span3"><a href="#"><i class="fa fa-sitemap"></i> fa-sitemap</a></div>
<div class="span3"><a href="#"><i class="fa fa-sliders"></i> fa-sliders</a></div>
<div class="span3"><a href="#"><i class="fa fa-smile-o"></i> fa-smile-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort"></i> fa-sort</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-alpha-asc"></i> fa-sort-alpha-asc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-alpha-desc"></i> fa-sort-alpha-desc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-amount-asc"></i> fa-sort-amount-asc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-amount-desc"></i> fa-sort-amount-desc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-asc"></i> fa-sort-asc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-desc"></i> fa-sort-desc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-down"></i> fa-sort-down <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-numeric-asc"></i> fa-sort-numeric-asc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-numeric-desc"></i> fa-sort-numeric-desc</a></div>
<div class="span3"><a href="#"><i class="fa fa-sort-up"></i> fa-sort-up <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-space-shuttle"></i> fa-space-shuttle</a></div>
<div class="span3"><a href="#"><i class="fa fa-spinner"></i> fa-spinner</a></div>
<div class="span3"><a href="#"><i class="fa fa-spoon"></i> fa-spoon</a></div>
<div class="span3"><a href="#"><i class="fa fa-square"></i> fa-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-square-o"></i> fa-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-star"></i> fa-star</a></div>
<div class="span3"><a href="#"><i class="fa fa-star-half"></i> fa-star-half</a></div>
<div class="span3"><a href="#"><i class="fa fa-star-half-empty"></i> fa-star-half-empty <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-star-half-full"></i> fa-star-half-full <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-star-half-o"></i> fa-star-half-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-star-o"></i> fa-star-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-suitcase"></i> fa-suitcase</a></div>
<div class="span3"><a href="#"><i class="fa fa-sun-o"></i> fa-sun-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-support"></i> fa-support <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-tablet"></i> fa-tablet</a></div>
<div class="span3"><a href="#"><i class="fa fa-tachometer"></i> fa-tachometer</a></div>
<div class="span3"><a href="#"><i class="fa fa-tag"></i> fa-tag</a></div>
<div class="span3"><a href="#"><i class="fa fa-tags"></i> fa-tags</a></div>
<div class="span3"><a href="#"><i class="fa fa-tasks"></i> fa-tasks</a></div>
<div class="span3"><a href="#"><i class="fa fa-taxi"></i> fa-taxi</a></div>
<div class="span3"><a href="#"><i class="fa fa-terminal"></i> fa-terminal</a></div>
<div class="span3"><a href="#"><i class="fa fa-thumb-tack"></i> fa-thumb-tack</a></div>
<div class="span3"><a href="#"><i class="fa fa-thumbs-down"></i> fa-thumbs-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-thumbs-o-down"></i> fa-thumbs-o-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-thumbs-o-up"></i> fa-thumbs-o-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-thumbs-up"></i> fa-thumbs-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-ticket"></i> fa-ticket</a></div>
<div class="span3"><a href="#"><i class="fa fa-times"></i> fa-times</a></div>
<div class="span3"><a href="#"><i class="fa fa-times-circle"></i> fa-times-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-times-circle-o"></i> fa-times-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-tint"></i> fa-tint</a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-down"></i> fa-toggle-down <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-right"></i> fa-toggle-right <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-up"></i> fa-toggle-up <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-trash-o"></i> fa-trash-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-tree"></i> fa-tree</a></div>
<div class="span3"><a href="#"><i class="fa fa-trophy"></i> fa-trophy</a></div>
<div class="span3"><a href="#"><i class="fa fa-truck"></i> fa-truck</a></div>
<div class="span3"><a href="#"><i class="fa fa-umbrella"></i> fa-umbrella</a></div>
<div class="span3"><a href="#"><i class="fa fa-university"></i> fa-university</a></div>
<div class="span3"><a href="#"><i class="fa fa-unlock"></i> fa-unlock</a></div>
<div class="span3"><a href="#"><i class="fa fa-unlock-alt"></i> fa-unlock-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-unsorted"></i> fa-unsorted <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-upload"></i> fa-upload</a></div>
<div class="span3"><a href="#"><i class="fa fa-user"></i> fa-user</a></div>
<div class="span3"><a href="#"><i class="fa fa-users"></i> fa-users</a></div>
<div class="span3"><a href="#"><i class="fa fa-video-camera"></i> fa-video-camera</a></div>
<div class="span3"><a href="#"><i class="fa fa-volume-down"></i> fa-volume-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-volume-off"></i> fa-volume-off</a></div>
<div class="span3"><a href="#"><i class="fa fa-volume-up"></i> fa-volume-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-warning"></i> fa-warning <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-wheelchair"></i> fa-wheelchair</a></div>
<div class="span3"><a href="#"><i class="fa fa-wrench"></i> fa-wrench</a></div>
<p></p></div>
</section>
<section id="file-type">
<h2 class="page-header">File Type Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-file"></i> fa-file</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-archive-o"></i> fa-file-archive-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-audio-o"></i> fa-file-audio-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-code-o"></i> fa-file-code-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-excel-o"></i> fa-file-excel-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-image-o"></i> fa-file-image-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-movie-o"></i> fa-file-movie-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-o"></i> fa-file-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-pdf-o"></i> fa-file-pdf-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-photo-o"></i> fa-file-photo-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-picture-o"></i> fa-file-picture-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-powerpoint-o"></i> fa-file-powerpoint-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-sound-o"></i> fa-file-sound-o <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-file-text"></i> fa-file-text</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-text-o"></i> fa-file-text-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-video-o"></i> fa-file-video-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-word-o"></i> fa-file-word-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-zip-o"></i> fa-file-zip-o <span class="text-muted">(alias)</span></a></div>
<p></p></div>
</section>
<section id="spinner">
<h2 class="page-header">Spinner Icons</h2>
<div class="alert alert-success">
<ul class="fa-ul">
<li>
        <i class="fa fa-info-circle fa-lg fa-li"></i><br>
        These icons work great with the <code>fa-spin</code> class. Check out the<br>
        <a href="" class="alert-link">spinning icons example</a>.
      </li>
</ul></div>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-circle-o-notch"></i> fa-circle-o-notch</a></div>
<div class="span3"><a href="#"><i class="fa fa-cog"></i> fa-cog</a></div>
<div class="span3"><a href="#"><i class="fa fa-gear"></i> fa-gear <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-refresh"></i> fa-refresh</a></div>
<div class="span3"><a href="#"><i class="fa fa-spinner"></i> fa-spinner</a></div>
<p></p></div>
</section>
<section id="form-control">
<h2 class="page-header">Form Control Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-check-square"></i> fa-check-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-check-square-o"></i> fa-check-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-circle"></i> fa-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-circle-o"></i> fa-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-minus-square"></i> fa-minus-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-minus-square-o"></i> fa-minus-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus-square"></i> fa-plus-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus-square-o"></i> fa-plus-square-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-square"></i> fa-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-square-o"></i> fa-square-o</a></div>
<p></p></div>
</section>
<section id="currency">
<h2 class="page-header">Currency Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-bitcoin"></i> fa-bitcoin <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-btc"></i> fa-btc</a></div>
<div class="span3"><a href="#"><i class="fa fa-cny"></i> fa-cny <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-dollar"></i> fa-dollar <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-eur"></i> fa-eur</a></div>
<div class="span3"><a href="#"><i class="fa fa-euro"></i> fa-euro <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-gbp"></i> fa-gbp</a></div>
<div class="span3"><a href="#"><i class="fa fa-inr"></i> fa-inr</a></div>
<div class="span3"><a href="#"><i class="fa fa-jpy"></i> fa-jpy</a></div>
<div class="span3"><a href="#"><i class="fa fa-krw"></i> fa-krw</a></div>
<div class="span3"><a href="#"><i class="fa fa-money"></i> fa-money</a></div>
<div class="span3"><a href="#"><i class="fa fa-rmb"></i> fa-rmb <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-rouble"></i> fa-rouble <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-rub"></i> fa-rub</a></div>
<div class="span3"><a href="#"><i class="fa fa-ruble"></i> fa-ruble <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-rupee"></i> fa-rupee <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-try"></i> fa-try</a></div>
<div class="span3"><a href="#"><i class="fa fa-turkish-lira"></i> fa-turkish-lira <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-usd"></i> fa-usd</a></div>
<div class="span3"><a href="#"><i class="fa fa-won"></i> fa-won <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-yen"></i> fa-yen <span class="text-muted">(alias)</span></a></div>
<p></p></div>
</section>
<section id="text-editor">
<h2 class="page-header">Text Editor Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-align-center"></i> fa-align-center</a></div>
<div class="span3"><a href="#"><i class="fa fa-align-justify"></i> fa-align-justify</a></div>
<div class="span3"><a href="#"><i class="fa fa-align-left"></i> fa-align-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-align-right"></i> fa-align-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-bold"></i> fa-bold</a></div>
<div class="span3"><a href="#"><i class="fa fa-chain"></i> fa-chain <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-chain-broken"></i> fa-chain-broken</a></div>
<div class="span3"><a href="#"><i class="fa fa-clipboard"></i> fa-clipboard</a></div>
<div class="span3"><a href="#"><i class="fa fa-columns"></i> fa-columns</a></div>
<div class="span3"><a href="#"><i class="fa fa-copy"></i> fa-copy <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-cut"></i> fa-cut <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-dedent"></i> fa-dedent <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-eraser"></i> fa-eraser</a></div>
<div class="span3"><a href="#"><i class="fa fa-file"></i> fa-file</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-o"></i> fa-file-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-text"></i> fa-file-text</a></div>
<div class="span3"><a href="#"><i class="fa fa-file-text-o"></i> fa-file-text-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-files-o"></i> fa-files-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-floppy-o"></i> fa-floppy-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-font"></i> fa-font</a></div>
<div class="span3"><a href="#"><i class="fa fa-header"></i> fa-header</a></div>
<div class="span3"><a href="#"><i class="fa fa-indent"></i> fa-indent</a></div>
<div class="span3"><a href="#"><i class="fa fa-italic"></i> fa-italic</a></div>
<div class="span3"><a href="#"><i class="fa fa-link"></i> fa-link</a></div>
<div class="span3"><a href="#"><i class="fa fa-list"></i> fa-list</a></div>
<div class="span3"><a href="#"><i class="fa fa-list-alt"></i> fa-list-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-list-ol"></i> fa-list-ol</a></div>
<div class="span3"><a href="#"><i class="fa fa-list-ul"></i> fa-list-ul</a></div>
<div class="span3"><a href="#"><i class="fa fa-outdent"></i> fa-outdent</a></div>
<div class="span3"><a href="#"><i class="fa fa-paperclip"></i> fa-paperclip</a></div>
<div class="span3"><a href="#"><i class="fa fa-paragraph"></i> fa-paragraph</a></div>
<div class="span3"><a href="#"><i class="fa fa-paste"></i> fa-paste <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-repeat"></i> fa-repeat</a></div>
<div class="span3"><a href="#"><i class="fa fa-rotate-left"></i> fa-rotate-left <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-rotate-right"></i> fa-rotate-right <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-save"></i> fa-save <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-scissors"></i> fa-scissors</a></div>
<div class="span3"><a href="#"><i class="fa fa-strikethrough"></i> fa-strikethrough</a></div>
<div class="span3"><a href="#"><i class="fa fa-subscript"></i> fa-subscript</a></div>
<div class="span3"><a href="#"><i class="fa fa-superscript"></i> fa-superscript</a></div>
<div class="span3"><a href="#"><i class="fa fa-table"></i> fa-table</a></div>
<div class="span3"><a href="#"><i class="fa fa-text-height"></i> fa-text-height</a></div>
<div class="span3"><a href="#"><i class="fa fa-text-width"></i> fa-text-width</a></div>
<div class="span3"><a href="#"><i class="fa fa-th"></i> fa-th</a></div>
<div class="span3"><a href="#"><i class="fa fa-th-large"></i> fa-th-large</a></div>
<div class="span3"><a href="#"><i class="fa fa-th-list"></i> fa-th-list</a></div>
<div class="span3"><a href="#"><i class="fa fa-underline"></i> fa-underline</a></div>
<div class="span3"><a href="#"><i class="fa fa-undo"></i> fa-undo</a></div>
<div class="span3"><a href="#"><i class="fa fa-unlink"></i> fa-unlink <span class="text-muted">(alias)</span></a></div>
<p></p></div>
</section>
<section id="directional">
<h2 class="page-header">Directional Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-angle-double-down"></i> fa-angle-double-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-double-left"></i> fa-angle-double-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-double-right"></i> fa-angle-double-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-double-up"></i> fa-angle-double-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-down"></i> fa-angle-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-left"></i> fa-angle-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-right"></i> fa-angle-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-angle-up"></i> fa-angle-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-down"></i> fa-arrow-circle-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-left"></i> fa-arrow-circle-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-o-down"></i> fa-arrow-circle-o-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-o-left"></i> fa-arrow-circle-o-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-o-right"></i> fa-arrow-circle-o-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-o-up"></i> fa-arrow-circle-o-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-right"></i> fa-arrow-circle-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-circle-up"></i> fa-arrow-circle-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-down"></i> fa-arrow-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-left"></i> fa-arrow-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-right"></i> fa-arrow-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrow-up"></i> fa-arrow-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows"></i> fa-arrows</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows-alt"></i> fa-arrows-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows-h"></i> fa-arrows-h</a></div>
<div class="span3"><a href="#"><i class="fa fa-arrows-v"></i> fa-arrows-v</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-down"></i> fa-caret-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-left"></i> fa-caret-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-right"></i> fa-caret-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-down"></i> fa-caret-square-o-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-right"></i> fa-caret-square-o-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-square-o-up"></i> fa-caret-square-o-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-caret-up"></i> fa-caret-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-circle-down"></i> fa-chevron-circle-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-circle-left"></i> fa-chevron-circle-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-circle-right"></i> fa-chevron-circle-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-circle-up"></i> fa-chevron-circle-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-down"></i> fa-chevron-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-left"></i> fa-chevron-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-right"></i> fa-chevron-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-chevron-up"></i> fa-chevron-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-hand-o-down"></i> fa-hand-o-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-hand-o-left"></i> fa-hand-o-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-hand-o-right"></i> fa-hand-o-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-hand-o-up"></i> fa-hand-o-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-long-arrow-down"></i> fa-long-arrow-down</a></div>
<div class="span3"><a href="#"><i class="fa fa-long-arrow-left"></i> fa-long-arrow-left</a></div>
<div class="span3"><a href="#"><i class="fa fa-long-arrow-right"></i> fa-long-arrow-right</a></div>
<div class="span3"><a href="#"><i class="fa fa-long-arrow-up"></i> fa-long-arrow-up</a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-down"></i> fa-toggle-down <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-right"></i> fa-toggle-right <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-toggle-up"></i> fa-toggle-up <span class="text-muted">(alias)</span></a></div>
<p></p></div>
</section>
<section id="video-player">
<h2 class="page-header">Video Player Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-arrows-alt"></i> fa-arrows-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-backward"></i> fa-backward</a></div>
<div class="span3"><a href="#"><i class="fa fa-compress"></i> fa-compress</a></div>
<div class="span3"><a href="#"><i class="fa fa-eject"></i> fa-eject</a></div>
<div class="span3"><a href="#"><i class="fa fa-expand"></i> fa-expand</a></div>
<div class="span3"><a href="#"><i class="fa fa-fast-backward"></i> fa-fast-backward</a></div>
<div class="span3"><a href="#"><i class="fa fa-fast-forward"></i> fa-fast-forward</a></div>
<div class="span3"><a href="#"><i class="fa fa-forward"></i> fa-forward</a></div>
<div class="span3"><a href="#"><i class="fa fa-pause"></i> fa-pause</a></div>
<div class="span3"><a href="#"><i class="fa fa-play"></i> fa-play</a></div>
<div class="span3"><a href="#"><i class="fa fa-play-circle"></i> fa-play-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-play-circle-o"></i> fa-play-circle-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-step-backward"></i> fa-step-backward</a></div>
<div class="span3"><a href="#"><i class="fa fa-step-forward"></i> fa-step-forward</a></div>
<div class="span3"><a href="#"><i class="fa fa-stop"></i> fa-stop</a></div>
<div class="span3"><a href="#"><i class="fa fa-youtube-play"></i> fa-youtube-play</a></div>
<p></p></div>
</section>
<section id="brand">
<h2 class="page-header">Brand Icons</h2>
<div class="alert alert-success">
<ul class="margin-bottom-none padding-left-lg">
<li>All brand icons are trademarks of their respective owners.</li>
<li>The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome, nor vice versa.</li>
</ul></div>
<div class="alert alert-warning">
<h4><i class="fa fa-warning"></i> Warning!</h4>
<p>Apparently, Adblock Plus can remove Font Awesome brand icons with their �Remove Social<br>
Media Buttons� setting. We will not use hacks to force them to display. Please<br>
<a href="https://adblockplus.org/en/bugs" class="alert-link">report an issue with Adblock Plus</a> if you believe this to be<br>
an error. To work around this, you�ll need to modify the social icon class names.</p></div>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-adn"></i> fa-adn</a></div>
<div class="span3"><a href="#"><i class="fa fa-android"></i> fa-android</a></div>
<div class="span3"><a href="#"><i class="fa fa-apple"></i> fa-apple</a></div>
<div class="span3"><a href="#"><i class="fa fa-behance"></i> fa-behance</a></div>
<div class="span3"><a href="#"><i class="fa fa-behance-square"></i> fa-behance-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-bitbucket"></i> fa-bitbucket</a></div>
<div class="span3"><a href="#"><i class="fa fa-bitbucket-square"></i> fa-bitbucket-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-bitcoin"></i> fa-bitcoin <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-btc"></i> fa-btc</a></div>
<div class="span3"><a href="#"><i class="fa fa-codepen"></i> fa-codepen</a></div>
<div class="span3"><a href="#"><i class="fa fa-css3"></i> fa-css3</a></div>
<div class="span3"><a href="#"><i class="fa fa-delicious"></i> fa-delicious</a></div>
<div class="span3"><a href="#"><i class="fa fa-deviantart"></i> fa-deviantart</a></div>
<div class="span3"><a href="#"><i class="fa fa-digg"></i> fa-digg</a></div>
<div class="span3"><a href="#"><i class="fa fa-dribbble"></i> fa-dribbble</a></div>
<div class="span3"><a href="#"><i class="fa fa-dropbox"></i> fa-dropbox</a></div>
<div class="span3"><a href="#"><i class="fa fa-drupal"></i> fa-drupal</a></div>
<div class="span3"><a href="#"><i class="fa fa-empire"></i> fa-empire</a></div>
<div class="span3"><a href="#"><i class="fa fa-facebook"></i> fa-facebook</a></div>
<div class="span3"><a href="#"><i class="fa fa-facebook-square"></i> fa-facebook-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-flickr"></i> fa-flickr</a></div>
<div class="span3"><a href="#"><i class="fa fa-foursquare"></i> fa-foursquare</a></div>
<div class="span3"><a href="#"><i class="fa fa-ge"></i> fa-ge <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-git"></i> fa-git</a></div>
<div class="span3"><a href="#"><i class="fa fa-git-square"></i> fa-git-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-github"></i> fa-github</a></div>
<div class="span3"><a href="#"><i class="fa fa-github-alt"></i> fa-github-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-github-square"></i> fa-github-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-gittip"></i> fa-gittip</a></div>
<div class="span3"><a href="#"><i class="fa fa-google"></i> fa-google</a></div>
<div class="span3"><a href="#"><i class="fa fa-google-plus"></i> fa-google-plus</a></div>
<div class="span3"><a href="#"><i class="fa fa-google-plus-square"></i> fa-google-plus-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-hacker-news"></i> fa-hacker-news</a></div>
<div class="span3"><a href="#"><i class="fa fa-html5"></i> fa-html5</a></div>
<div class="span3"><a href="#"><i class="fa fa-instagram"></i> fa-instagram</a></div>
<div class="span3"><a href="#"><i class="fa fa-joomla"></i> fa-joomla</a></div>
<div class="span3"><a href="#"><i class="fa fa-jsfiddle"></i> fa-jsfiddle</a></div>
<div class="span3"><a href="#"><i class="fa fa-linkedin"></i> fa-linkedin</a></div>
<div class="span3"><a href="#"><i class="fa fa-linkedin-square"></i> fa-linkedin-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-linux"></i> fa-linux</a></div>
<div class="span3"><a href="#"><i class="fa fa-maxcdn"></i> fa-maxcdn</a></div>
<div class="span3"><a href="#"><i class="fa fa-openid"></i> fa-openid</a></div>
<div class="span3"><a href="#"><i class="fa fa-pagelines"></i> fa-pagelines</a></div>
<div class="span3"><a href="#"><i class="fa fa-pied-piper"></i> fa-pied-piper</a></div>
<div class="span3"><a href="#"><i class="fa fa-pied-piper-alt"></i> fa-pied-piper-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-pied-piper-square"></i> fa-pied-piper-square <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-pinterest"></i> fa-pinterest</a></div>
<div class="span3"><a href="#"><i class="fa fa-pinterest-square"></i> fa-pinterest-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-qq"></i> fa-qq</a></div>
<div class="span3"><a href="#"><i class="fa fa-ra"></i> fa-ra <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-rebel"></i> fa-rebel</a></div>
<div class="span3"><a href="#"><i class="fa fa-reddit"></i> fa-reddit</a></div>
<div class="span3"><a href="#"><i class="fa fa-reddit-square"></i> fa-reddit-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-renren"></i> fa-renren</a></div>
<div class="span3"><a href="#"><i class="fa fa-share-alt"></i> fa-share-alt</a></div>
<div class="span3"><a href="#"><i class="fa fa-share-alt-square"></i> fa-share-alt-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-skype"></i> fa-skype</a></div>
<div class="span3"><a href="#"><i class="fa fa-slack"></i> fa-slack</a></div>
<div class="span3"><a href="#"><i class="fa fa-soundcloud"></i> fa-soundcloud</a></div>
<div class="span3"><a href="#"><i class="fa fa-spotify"></i> fa-spotify</a></div>
<div class="span3"><a href="#"><i class="fa fa-stack-exchange"></i> fa-stack-exchange</a></div>
<div class="span3"><a href="#"><i class="fa fa-stack-overflow"></i> fa-stack-overflow</a></div>
<div class="span3"><a href="#"><i class="fa fa-steam"></i> fa-steam</a></div>
<div class="span3"><a href="#"><i class="fa fa-steam-square"></i> fa-steam-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-stumbleupon"></i> fa-stumbleupon</a></div>
<div class="span3"><a href="#"><i class="fa fa-stumbleupon-circle"></i> fa-stumbleupon-circle</a></div>
<div class="span3"><a href="#"><i class="fa fa-tencent-weibo"></i> fa-tencent-weibo</a></div>
<div class="span3"><a href="#"><i class="fa fa-trello"></i> fa-trello</a></div>
<div class="span3"><a href="#"><i class="fa fa-tumblr"></i> fa-tumblr</a></div>
<div class="span3"><a href="#"><i class="fa fa-tumblr-square"></i> fa-tumblr-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-twitter"></i> fa-twitter</a></div>
<div class="span3"><a href="#"><i class="fa fa-twitter-square"></i> fa-twitter-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-vimeo-square"></i> fa-vimeo-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-vine"></i> fa-vine</a></div>
<div class="span3"><a href="#"><i class="fa fa-vk"></i> fa-vk</a></div>
<div class="span3"><a href="#"><i class="fa fa-wechat"></i> fa-wechat <span class="text-muted">(alias)</span></a></div>
<div class="span3"><a href="#"><i class="fa fa-weibo"></i> fa-weibo</a></div>
<div class="span3"><a href="#"><i class="fa fa-weixin"></i> fa-weixin</a></div>
<div class="span3"><a href="#"><i class="fa fa-windows"></i> fa-windows</a></div>
<div class="span3"><a href="#"><i class="fa fa-wordpress"></i> fa-wordpress</a></div>
<div class="span3"><a href="#"><i class="fa fa-xing"></i> fa-xing</a></div>
<div class="span3"><a href="#"><i class="fa fa-xing-square"></i> fa-xing-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-yahoo"></i> fa-yahoo</a></div>
<div class="span3"><a href="#"><i class="fa fa-youtube"></i> fa-youtube</a></div>
<div class="span3"><a href="#"><i class="fa fa-youtube-play"></i> fa-youtube-play</a></div>
<div class="span3"><a href="#"><i class="fa fa-youtube-square"></i> fa-youtube-square</a></div>
<p></p></div>
</section>
<section id="medical">
<h2 class="page-header">Medical Icons</h2>
<div class="row the-icons">
<div class="span3"><a href="#"><i class="fa fa-ambulance"></i> fa-ambulance</a></div>
<div class="span3"><a href="#"><i class="fa fa-h-square"></i> fa-h-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-hospital-o"></i> fa-hospital-o</a></div>
<div class="span3"><a href="#"><i class="fa fa-medkit"></i> fa-medkit</a></div>
<div class="span3"><a href="#"><i class="fa fa-plus-square"></i> fa-plus-square</a></div>
<div class="span3"><a href="#"><i class="fa fa-stethoscope"></i> fa-stethoscope</a></div>
<div class="span3"><a href="#"><i class="fa fa-user-md"></i> fa-user-md</a></div>
<div class="span3"><a href="#"><i class="fa fa-wheelchair"></i> fa-wheelchair</a></div>
<p></p></div>
</section>
</div>';


$shortitems = array('Typography' => array('
[title]your title text[/title]||<i class="fa fa-text-height"></i> Title','
[highlight color="#F95601"]your text with unlimited highlight colors [/highlight]||<i class="fa fa-pencil-square"></i> Highlight','
[blockquote class="alignleft"]This is a left pullquote.[/blockquote]||<i class="fa fa-quote-left"></i> Blockquote','
[dropcap color="#F95601"]R[/dropcap]||<i class="fa fa-font"></i> Dropcaps','
[welcome_message reverse_button_text="Learn More" url="#" reverse_url="#" button_text="Purchase Now"]<strong>Welcome to the Mega Theme</strong> Fully responsive, powerfull and user friendly for your website... Multi-Pourpose theme for corporate, blog, magazine, portfolio [/welcome_message]||<i class="fa fa-flag-alt"></i> Welcome Message','
[left]||<i class="fa fa-arrow-left"></i> Left align','
[right]||<i class="fa fa-arrow-right"></i> Right align','
[divider]||<i class="fa fa-minus"></i> Divider','
[divider_top]||<i class="fa fa-minus"></i> Divider top','
[read_more text="Read more" title="Read More" url="#"]||<i class="fa fa-angle-double-right"></i> Read More Link','
[clear]||<i class="fa fa-eraser"></i> Clear'),'
Elements' => array('
[accordions]
    [accordion title="title 1"] content [/accordion]
    [accordion title="title 2"] content [/accordion]
    [accordion title="title 3"] content [/accordion]
    [accordion title="title 4"] content [/accordion]
    [accordion title="title 5"] content [/accordion]
[/accordions]||<i class="fa fa-list"></i> Accordion','
[tabs]
[tab title="title 1" icon="fa-picture-o"]
<h4>Lorem ipum dolor sit amet</h4>
[recent_posts count="2" thumbnail="true" desc_length="240"]
[/tab]
[tab title="title 2" icon="fa-html5"]
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
[/tab] 
[tab title="title 3"] Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. [/tab]
[/tabs]||<i class="fa fa-list-alt"></i> Horizontal Tabs','
[vtabs]    
    [tab title="title 1" icon="fa-picture-o"] contents [/tab]
    [tab title="title 2"] contents [/tab]
    [tab title="title 3"] contents [/tab]
[/vtabs]||<i class="fa fa-list-alt"></i> Vertical Tabs','
[toggle title="Title 1"]Content[/toggle]
[toggle title="Title 2"]Content[/toggle]
[toggle title="Title 3"]Content[/toggle]||<i class="fa fa-chevron-down"></i> Toggles','
[table] Your table [/table]||<i class="fa fa-table"></i> Table','
[testimonial customer_image="http://www.startis.ru/wp-content/uploads/2011/07/qs3.jpg" customer="John Doe. Marketing Director STARTIS Inc." url="#"] Your Testimonial Text [/testimonial]||<i class="fa fa-comments"></i> Testimonial'),'
    
Widgets' => array('
[blog_posts count="6" category_id="6" thumbnail="true" moretag="true" readmorelink="true" desc_length="240"]||<i class="fa fa-list-ul"></i> Blog Posts','
[recent_posts count="5" thumbnail="true" thumb_width="200" thumb_height="150" moretag="true" readmorelink="true" desc_length="240" category_id="12345"]||<i class="fa fa-list-ul"></i> Recent Posts','
[recent_posts_carousel count="5" thumbnail="true" thumb_width="220" thumb_height="180" moretag="true" readmorelink="true" desc_length="240" category_id="12345"]||<i class="fa fa-list-ul"></i> Posts Carousel','
[portfolio_items count="6" category_name="photos" thumb_width="234" thumb_height="180"]||<i class="fa fa-th"></i> Recent Portfolio Items','
[portfolio_items_carousel count="6" category_name="photos" thumb_width="220" thumb_height="180"]||<i class="fa fa-th"></i> Portfolio Carousel','
[flickr id="flickr id" count="9" display="latest"]||<i class="fa fa-picture-o"></i> Flickr','
[slider][slide title="Welcome to 7days" text="Yes adidas ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo"][image src="http://www.startis.ru/7dayse/files/2013/06/Kf-zWtSMGkM.jpg" width="595" height="300" retina="true" ][/slide] [slide title="Unique Flat Design News/Magazine theme" text="Perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo"][image src="http://www.startis.ru/7dayse/files/2013/06/lXYbPcIttIA.jpg" width="595" height="300" retina="true"][/slide][/slider]||<i class="fa fa-expand"></i> Content Slider','
[clients] 
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"]
[client client="Client name" client_url="LINK" image="URL"][/clients]||<i class="fa fa-group"></i> Clients carousel'),'

Buttons & images' => array('

[sbutton bgcolor="#ffffff" textcolor="#777777" textshadowcolor="#ffffff" url="#"]support SButton[/sbutton]||<i class="fa fa-square-o"></i> SButton','
[rsbutton bgcolor="#FFB515" textcolor="#FFFFFF" textshadowcolor="#555" url="#"] Custom RS Button[/rsbutton]||<i class="fa fa-square-o"></i> RSButton','
[bigbutton bgcolor="#fbec8e" textcolor="#967d00" textshadowcolor="#ffffff" url="#"]Big Button[/bigbutton]||<i class="fa fa-square-o"></i> BigButton','
[callme text="Call Me Back"]||<i class="fa fa-phone"></i> CallMe Button','
[image src="image url" align="right" width="140" height="70" title="some title" url="#" hover="1"]||<i class="fa fa-picture-o"></i> Images','
[lightbox src="image url" width="210" height="100" title="EG" align="right"]||<i class="fa fa-search-plus"></i> Lightbox images'),'

Page OnLoad Effects' => array('

[onload_effect after_loading="true" name="from_left" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> From Left','
[onload_effect after_loading="true" name="from_right" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> From Right','
[onload_effect after_loading="true" name="from_top" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> From Top','
[onload_effect after_loading="true" name="from_bottom" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> From Buttom','
[onload_effect after_loading="true" name="zoomin" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> Zoom in','
[onload_effect after_loading="true" name="zoomout" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> Zoom Out','
[onload_effect after_loading="true" name="rotate_from_left" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> Rotate From Left','
[onload_effect after_loading="true" name="rotate_from_right" delay="0"] Content [/onload_effect]||<i class="fa fa-magic"></i> Rotate From Right'),'

Styled Boxes' => array('

[note] Box content [/note]||<i class="fa fa-paperclip"></i> Note box','
[success] Box content [/success]||<i class="fa fa-flag"></i> Success box','
[info] Box content [/info]||<i class="fa fa-info-circle"></i> Info box','
[warning] Box content [/warning]||<i class="fa fa-warning"></i> Warning box','
[error] Box content [/error]||<i class="fa fa-times-circle"></i> Error box'));  
    
$menuitems = array('[one_half]Your content[/one_half][one_half_last]Your content[/one_half_last] ||2 Columns 1 | 1' => array('
[one_third]Your content[/one_third] [two_third_last]Your content[/two_third_last] ||2 Columns 1 | 2 ','
[two_third]Your content[/two_third] [one_half_last]Your content[/one_half_last] ||2 Columns 2 | 1 ','
[one_fourth]Your content[/one_fourth] [three_fourth_last] Your content [/three_fourth_last] ||2 Columns 1 | 3 ','
[three_fourth]Your content[/three_fourth] [one_fourth_last] Your content [/one_fourth_last] ||2 Columns 3 | 1 ','
[one_fifth]Your content[/one_fifth] [four_fifth_last] Your content [/four_fifth_last] ||2 Columns 1 | 4 ','
[four_fifth]Your content[/four_fifth] [one_fifth_last] Your content [/one_fifth_last] ||2 Columns 4 | 1 ','
[one_sixth]Your content[/one_sixth] [five_sixth_last] Your content [/five_sixth_last] ||2 Columns 1 | 5 ','
[five_sixth]Your content[/five_sixth] [one_sixth_last] Your content [/one_sixth_last] ||2 Columns 5 | 1 '),'[one_third]Your content[/one_third] [one_third] Your content [/one_third] [one_third_last]Your content[/one_third_last] ||3 Columns 1 | 1 | 1 ' => array('
[one_half]Your content[/one_half] [one_fourth] Your content [/one_fourth] [one_fourth_last]Your content[/one_fourth_last] ||3 Columns 2 | 1 | 1 ','
[one_fourth]Your content[/one_fourth] [one_half] Your content [/one_half] [one_fourth_last]Your content[/one_fourth_last] ||3 Columns 1 | 2 | 1 ','
[one_fourth]Your content[/one_fourth] [one_fourth] Your content [/one_fourth] [one_half_last]Your content[/one_half_last] ||3 Columns 1 | 1 | 2 ','
[three_fifth]Your content[/three_fifth] [one_fifth] Your content [/one_fifth] [one_fifth_last]Your content[/one_fifth_last] ||3 Columns 3 | 1 | 1 ','
[one_fifth]Your content[/one_fifth] [three_fifth] Your content [/three_fifth] [one_fifth_last]Your content[/one_fifth_last] ||3 Columns 1 | 3 | 1 ','
[one_fifth]Your content[/one_fifth] [one_fifth] Your content [/one_fifth] [three_fifth_last]Your content[/three_fifth_last] ||3 Columns 1 | 1 | 3 ','
[two_third]Your content[/two_third] [one_fifth] Your content [/one_fifth] [one_sixth_last]Your content[/one_sixth_last] ||3 Columns 4 | 1 | 1 ','
[one_sixth]Your content[/one_sixth] [two_third] Your content [/two_third] [one_sixth_last]Your content[/one_sixth_last] ||3 Columns 1 | 4 | 1 ','
[one_sixth]Your content[/one_sixth] [one_sixth] Your content [/one_sixth] [two_third_last]Your content[/two_third_last] ||3 Columns 1 | 1 | 4 '),'
[one_fourth]Your content[/one_fourth][one_fourth]Your content[/one_fourth][one_fourth]Your content[/one_fourth][one_fourth_last]Your content[/one_fourth_last] ||4 Columns 1 | 1 | 1 | 1 ' => array('
[two_fifth]Your content[/two_fifth][one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth][one_fifth_last]Your content[/one_fifth_last] ||4 Columns 2 | 1 | 1 | 1 ','
[one_fifth]Your content[/one_fifth][two_fifth]Your content[/two_fifth][one_fifth]Your content[/one_fifth][one_fifth_last]Your content[/one_fifth_last] ||4 Columns 1 | 2 | 1 | 1 ','
[one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth][two_fifth]Your content[/two_fifth][one_fifth_last]Your content[/one_fifth_last] ||4 Columns 1 | 1 | 2 | 1 ','
[one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth][two_fifth_last]Your content[/two_fifth_last] ||4 Columns 1 | 1 | 1 | 2 ','
[one_half]Your content[/one_half][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth_last]Your content[/one_sixth_last] ||4 Columns 3 | 1 | 1 | 1 ','
[one_sixth]Your content[/one_sixth][one_half]Your content[/one_half][one_sixth]Your content[/one_sixth][one_sixth_last]Your content[/one_sixth_last] ||4 Columns 1 | 3 | 1 | 1 ','
[one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_half]Your content[/one_half][one_sixth_last]Your content[/one_sixth_last] ||4 Columns 1 | 1 | 3 | 1 ','
[one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_half_last]Your content[/one_half_last] ||4 Columns 1 | 1 | 1 | 3 '),'
[one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth][one_fifth]Your content[/one_fifth] [one_fifth_last]Your content[/one_fifth_last] ||5 Columns 1 | 1 | 1 | 1 | 1 ' => array('
[one_third]Your content[/one_third][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth] [one_sixth_last]Your content[/one_sixth_last] ||5 Columns 2 | 1 | 1 | 1 | 1 ','
[one_sixth]Your content[/one_sixth][one_third]Your content[/one_third][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth] [one_sixth_last]Your content[/one_sixth_last] ||5 Columns 1 | 2 | 1 | 1 | 1 ','
[one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_third]Your content[/one_third][one_sixth]Your content[/one_sixth] [one_sixth_last]Your content[/one_sixth_last] ||5 Columns 1 | 1 | 2 | 1 | 1 ','
[one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_third]Your content[/one_third] [one_sixth_last]Your content[/one_sixth_last] ||5 Columns 1 | 1 | 1 | 2 | 1 ','
[one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth] [one_third_last]Your content[/one_third_last] ||5 Columns 1 | 1 | 1 | 1 | 2 '),'
[one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth][one_sixth]Your content[/one_sixth] [one_sixth_last]Your content[/one_sixth_last] ||6 Columns ' => '');

$pagesitems = array('2 Columns 1 | 1' => array('
[one_third]Your content[/one_third] [two_third_last]Your content[/two_third_last] ||2 Columns 1 | 2 ','
[two_third]Your content[/two_third] [one_half_last]Your content[/one_half_last] ||2 Columns 2 | 1 ','
2 Columns 1 | 3 ','
2 Columns 3 | 1 ','
2 Columns 1 | 4 ','
2 Columns 4 | 1 ','
2 Columns 1 | 5 ','
2 Columns 5 | 1 '),'
3 Columns 1 | 1 | 1 ' => array('
3 Columns 2 | 1 | 1 ','
3 Columns 1 | 2 | 1 ','
3 Columns 1 | 1 | 2 ','
3 Columns 3 | 1 | 1 ','
3 Columns 1 | 3 | 1 ','
3 Columns 1 | 1 | 3 ','
3 Columns 4 | 1 | 1 ','
3 Columns 1 | 4 | 1 ','
3 Columns 1 | 1 | 4 '),'
4 Columns 1 | 1 | 1 | 1 ' => array('
4 Columns 2 | 1 | 1 | 1 ','
4 Columns 1 | 2 | 1 | 1 ','
4 Columns 1 | 1 | 2 | 1 ','
4 Columns 1 | 1 | 1 | 2 ','
4 Columns 3 | 1 | 1 | 1 ','
4 Columns 1 | 3 | 1 | 1 ','
4 Columns 1 | 1 | 3 | 1 ','
4 Columns 1 | 1 | 1 | 3 '),'
5 Columns 1 | 1 | 1 | 1 | 1 ' => array('
5 Columns 2 | 1 | 1 | 1 | 1 ','
5 Columns 1 | 2 | 1 | 1 | 1 ','
5 Columns 1 | 1 | 2 | 1 | 1 ','
5 Columns 1 | 1 | 1 | 2 | 1 ','
5 Columns 1 | 1 | 1 | 1 | 2 '),'
6 Columns ' => '');

	   if ( get_user_option('rich_editing') == 'true') {
    ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/faw/css/font-awesome.min.css" type="text/css" media="screen" />
   	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/shortcodes.css" type="text/css" media="screen" />
    <script type="text/javascript">
    jQuery(document).ready(function($) {
    <?php $output = 'jQuery(\'#wp-content-editor-container\').append(\'<div id="dropcol" class="shortbox"><ul>';
			foreach ($menuitems as $key => $value) { 
				$output .= '<li>';
                $colkey = explode("||", $key);
				$output .= '<b>'.$colkey[1].'<span class="shorcont">'.$colkey[0].'</span></b>';
                if ($value!='') {
                    $output .= '<ul>';
                    foreach ($value as $val) {
                        $colval = explode("||", $val);
                        $output .= '<li>'.$colval[1].'<span class="shorcont">'.$colval[0].'</span></li>';
                    }
                    $output .= '</ul>';
                }
				$output .= '</li>';
				
			}
    $output = str_replace("\r", "", $output);
    $output = str_replace("\n", "", $output); 
        echo $output.'</ul><span class="closedrop"><i class="fa fa-times"></i>'.__('Close').'</span></div>\');'; ?>
  
<?php $outputshort = 'jQuery(\'#wp-content-editor-container\').append(\'<div id="dropshort" class="shortbox"><ul>';
			foreach ($shortitems as $key => $value) { 
				$outputshort .= '<li>';
				$outputshort .= '<b>'.$key.'</b>';
                if ($value!='') {
                    $outputshort .= '<ul>';
                    $shortval = array();
                    foreach ($value as $val) {
                        $shortval = explode("||", $val);
                        $outputshort .= '<li>'.$shortval[1].'<span class="shorcont">'.$shortval[0].'</span></li>';
                    }
                    $outputshort .= '</ul>';
                }
				$outputshort .= '</li>';
				
			}
    $outputshort = str_replace("\r", "", $outputshort);
    $outputshort = str_replace("\n", "", $outputshort); 
    $iconpack = str_replace("\r", "", $iconpack);
    $iconpack = str_replace("\n", "", $iconpack); 
    
        echo $outputshort.'</ul><span class="closedrop"><i class="fa fa-times"></i>'.__('Close').'</span></div>\');';
        $outputicons = 'jQuery(\'#wp-content-editor-container\').append(\'<div id="dropicons" class="shortbox">'.$iconpack; 
        echo $outputicons.'<span class="closedrop"><i class="fa fa-times"></i>'.__('Close').'</span></div>\');'; ?>
        jQuery('.closedrop').click( function() {
            jQuery('.shortbox').fadeOut();
            });
    });
    </script>
    <?php
    }
}


function register_startis_buttons($buttons) {
	array_push($buttons, "|", "startis_button");
    array_push($buttons, "|", "startis_columns");
    array_push($buttons, "|", "startis_icons");
	return $buttons;
}


function startis_shortcode_buttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_startis_tinymce_plugin");
        add_filter("mce_buttons_3", "register_startis_buttons");
	}
}

add_action('init', 'startis_shortcode_buttons');

function add_startis_tinymce_plugin($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['startis_button'] = get_template_directory_uri().'/js/shortcode.js';  
	return $plugin_array;
}


add_filter( 'the_content', 'shortcode_unautop',100 );
add_filter( 'do_shortcode', 'shortcode_unautop',100 );
    
?>