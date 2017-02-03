<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(isset($pageTitle)){ echo $pageTitle.' - ';} if(isset($pageName)){ echo $pageName.' - ';} echo $title; ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <meta name="description" content="<?php echo $description; ?>" />
    <link href="<?php echo base_url('css/normalize.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.front.css') ?>" rel="stylesheet">
</head>
<body>
	

    <p>------------ 导航 ------------</p>

    <div class="nav">
    <ul>
        <?php foreach ($datas_nav->result() as $row){ ?>
            <li><a href="<?php echo $row->Link; ?>"><?php echo $row->Title; ?></a></li>
        <?php } ?>
        <li><a href="/articles">article</a></li>
    </ul>
    </div>

    <br/>