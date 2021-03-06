<?php
if (!filter_has_var(INPUT_GET, 'page') || (!is_admin() && !is_subadmin() && '!' === $page_name[0])) exit;
if (is_file($pages_file = 'contents/'. $page_name. '.html'))
{
	ob_start();
	include $pages_file;
	$basetitle = h($page_name);
	$header .=
	'<title>'. $basetitle. ' - '. $site_name. '</title>'. $n;
	$breadcrumb .=
	'<li class="breadcrumb-item active">'. $basetitle. '</li>';
	$article .= '<header>';
	if (isset($author) && is_dir($author_prof = 'users/'. basename($author). '/prof/'))
		$article .= '<a class=mr-3 href="'. $url. '?user='. str_rot13($author). '">'. avatar($author_prof, 20). ' '. handle($author_prof). '</a>';
	if (isset($editor) && is_dir($editor_prof = 'users/'. basename($editor). '/prof/'))
		$article .= '<a class=mr-3 href="'. $url. '?user='. str_rot13($editor). '">'. avatar($editor_prof, 20). ' '. handle($editor_prof). '</a>';
	$article .= '<small class=text-muted>'. sprintf($last_modified, date($time_format, filemtime($pages_file))). '</small>'. $n.
	'<h1 class="'. $h1_title[0]. '">'.
	(is_admin() || (isset($author, $_SESSION['l']) && $author === $_SESSION['l']) ? '!' !== $page_name[0] ?
		'<a class="btn btn-sm btn-danger mr-2" href="'. $url. '&amp;delete='. $page_name. '">'. $btn[4]. '</a>'
	:
		'<a class="btn btn-sm btn-success mr-2" href="'. $url. '&amp;post='. $page_name. '">'. $btn[6]. '</a>'.
		'<a class="btn btn-sm btn-info mr-2" href="'. $url. '&amp;sedit='. $page_name. '">'. $btn[7]. '</a>'
	: '').
	$basetitle. '</h1></header>';
	$pages_content = trim(ob_get_clean());
	$header .= '<meta name=description content="'. get_description($pages_content). '">'. $n;
	$article .= '<article class="article p-5 mb-5 clearfix">'. $pages_content. '</article>'. $n;

	if ($use_social) social(rawurlencode($basetitle. ' - '. $site_name), rawurlencode($url. $page_name));
	if ($use_permalink) permalink($basetitle. ' - '. $site_name, $current_url);
}
elseif ($use_contact && $page_name === $contact_us)
{
	$header .= '<title>'. $contact_us. ' - '. $site_name. '</title>'. $n;
	$breadcrumb .= '<li class="breadcrumb-item active">'. $contact_us. '</li>';
	if ($contact_subtitle)
		$article .= '<h1 class="'. $h1_title[0]. '">'. $contact_us. ' <small class="'. $h1_title[1]. '">'. $contact_subtitle. '</small></h1>'. $n;
	if ($privacy_policy)
		$article .= '<p class="alert alert-warning wrap">'. $privacy_policy. '</p>'. $n;
	ob_start();
	include $form;
	$article .= trim(ob_get_clean());
}
elseif ($dl && $page_name === $download_contents)
{
	$dl_name = d($get_dl);
	if (is_file($dl_file = $downloads_dir. '/'. $dl_name))
	{
		header('Content-Length: '. filesize($dl_file));
		header('Content-Type: '. mime_content_type($dl_file));
		header('Content-Disposition: attachment; filename*='. $encoding. '\'\''. r($dl_name));
		exit(readfile($dl_file));
	}
	$breadcrumb .= ($pages > 1 ? '<li class="breadcrumb-item"><a href="'. $url. r($download_contents). '">'. $download_contents. '</a></li><li class="breadcrumb-item active">'. sprintf($page_prefix, $pages). '</li>' : '<li class="breadcrumb-item active">'. $download_contents. '</li>');
	$header .= '<title>'. $download_contents. ' - '. ($pages > 1 ? sprintf($page_prefix, $pages). ' - ' : ''). $site_name. '</title>'. $n;

	if ($download_subtitle)
		$article .= '<h1 class="'. $h1_title[0]. '">'. $download_contents. ' <small class="'. $h1_title[1]. '">'. $download_subtitle. '</small></h1>'. $n;
	if ($download_notice)
		$article .= '<p class="alert alert-warning wrap">'. $download_notice. '</p>'. $n;
	$dl_files = glob($downloads_dir. '/*', GLOB_NOSORT);

	if ($dl_files)
	{
		foreach ($dl_files as $dfiles)
			$dls_sort[] = ($di_filesize = filesize($dfiles)) > 0 ? filemtime($dfiles). $delimiter. $dfiles. $delimiter. size_unit($di_filesize) : '';

		$dls_sort = array_filter($dls_sort);
		rsort($dls_sort);
		$dls_number = count($dls_sort);
		$page_ceil = ceil($dls_number / $number_of_downloads);
		$max_pages = min($pages, $page_ceil);
		$dls_in_page = array_slice($dls_sort, ($max_pages - 1) * $number_of_downloads, $number_of_downloads);

		if ($dls_number > $number_of_downloads) pager($max_pages, $page_ceil);

		$article .= '<div class=list-group>';

		foreach ($dls_in_page as $dls)
		{
			$dl_uri = explode($delimiter, $dls);
			$article .=
			'<a class="list-group-item bg-transparent d-flex justify-content-between align-items-center" href="'. $url. r($download_contents). '&amp;dl='. rawurlencode(strip_tags(basename($dl_uri[1]))). '" target="_blank">'. $n.
			'<span><span class=mr-3>'. ht($dl_uri[1]). '</span>'. $n.
			'<span class=mr-3>'. date($time_format, $dl_uri[0]). '</span></span>'. $n.
			'<span class="badge badge-primary badge-pill">'. $dl_uri[2]. '</span>'. $n.
			'</a>'. $n;
		}
		$article .= '</div>';

		if ($dls_number > $number_of_downloads) pager($max_pages, $page_ceil);
	}
}
elseif ($use_forum && $page_name === $forum)
	include 'forum.php';
else
	not_found();
