<?php
include 'includes/functions.php';
include 'includes/config.php';
$atom_files = glob('{contents/*/[!!]*/index.html,contents/[!!]*.html}', GLOB_BRACE + GLOB_NOSORT);
if ($atom_files)
{
	header('Content-Type: application/xml; charset='. $encoding);
	$xml = new DOMDocument('1.0', $encoding);
	$insert = $xml->firstChild;
	$style = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/css" href="'. $css. '"');
	$xml->insertBefore($style, $insert);
	echo $xml->saveXML(),
	'<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="', $lang, '">', $n,
	'<title type="text">', $site_name, '</title>', $n,
	'<updated>', date(DATE_ATOM, getlastmod()), '</updated>', $n,
	'<id>', $url, '</id>', $n,
	'<link rel="alternate" type="text/html" hreflang="', $lang, '" href="', $url, '" />', $n,
	'<link rel="self" type="application/atom+xml" href="', $url, 'atom.php" />', $n,
	'<rights>Copyright ', date('Y'), ', ', $site_name, '.</rights>', $n,
	'<generator>kinaga</generator>', $n;
	$session_txt = './'. sha1(__DIR__). '.txt';
	usort($atom_files, 'sort_time');
	foreach ($atom_files as $key => $atoms)
	{
		if ($number_of_feeds === $key) break;
		$atom_title = get_title($atoms);
		$atom_categ = get_categ($atoms);
		$atom_filetime = filemtime($atoms);
		$atom_description = get_description(file_get_contents($atoms));
		if ($atom_categ)
		{
			$atom_link_title = h($atom_title);
			$id = $url. r($atom_categ. '/'. $atom_title);
		}
		if ('index' === $atom_title)
		{
			$atom_link_title = $home;
			$id = $url;
		}
		if ('contents' === $atom_title)
		{
			$atom_link_title = h($atom_title);
			$id = $url. r($atom_title);
		}
		if (is_dir($atom_imgs_dir = 'contents/'. $atom_categ. '/'. $atom_title. '/images'))
		{
			if ($glob_atom_imgs = glob($atom_imgs_dir. '/*'))
				$atom_image = ($size = @getimagesize($glob_atom_imgs[0])) ?
				'<a href="'. $id. '"><img src="'. $url. r($glob_atom_imgs[0]). '" width="'. ($size[0] > 500 ? 500 : $size[0]). '" alt="'. $atom_link_title. '" /></a>' : '';
			else
				$atom_image = '';
		}
		else
			$atom_image = '';
		if (is_dir($atom_background_imgs_dir = 'contents/'. $atom_categ. '/'. $atom_title. '/background-images'))
		{
			if ($glob_atom_background_imgs = glob($atom_background_imgs_dir. '/*'))
				$atom_background_image = ($size = @getimagesize($glob_atom_background_imgs[0])) ?
				'<a href="'. $id. '"><img src="'. $url. r($glob_atom_background_imgs[0]). '" width="'. (500 < $size[0] ? 500 : $size[0]). '" alt="'. $atom_link_title. '" /></a>' : '';
			else
				$atom_background_image = '';
		}
		else
			$atom_background_image = '';
		echo
		'<entry>', $n,
		'<title>', $atom_link_title, '</title>', $n,
		'<link rel="alternate" type="text/html" href="', $id, '" />', $n,
		'<id>', $id, '</id>', $n,
		'<updated>', date(DATE_ATOM, $atom_filetime), '</updated>', $n,
		'<content type="xhtml" xml:lang="', $lang, '">', $n,
		'<div xmlns="http://www.w3.org/1999/xhtml">', $n,
		'<p>', $atom_description, ' <a class="stretched-link" href="', $id, '">', $btn[9], '</a></p>', $n,
		$atom_image, $atom_background_image, $n,
		'</div>', $n,
		'</content>', $n,
		'<author><name>', (is_file($author_txt = 'contents/'. $atom_categ. '/'. $atom_title. '/author.txt') && is_dir($author_prof = 'users/'. basename(file_get_contents($author_txt)). '/prof/') ? handle($author_prof) : $site_name), '</name></author>', $n,
		'</entry>', $n;
	}
	echo '</feed>';
}
