<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
  echo '<title>Nightlist - ' . $page_title . '</title>';
?>

  <link rel="stylesheet" type="text/css" href="styles.css" />
  
  <script src="javascripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {
                e.preventDefault();
                $("fieldset#signin_menu").toggle();
                $(".signin").toggleClass("menu-open");
            });

            $("fieldset#signin_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.signin").length==0) {
                    $(".signin").removeClass("menu-open");
                    $("fieldset#signin_menu").hide();
                }
            });            

        });
</script>

<script type="text/javascript">
        $(document).ready(function() {

            $(".account").click(function(e) {
                e.preventDefault();
                $("fieldset#account_menu").toggle();
                $(".account").toggleClass("menu-open");
            });

            $("fieldset#account_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.account").length==0) {
                    $(".account").removeClass("menu-open");
                    $("fieldset#account_menu").hide();
                }
            });            

        });
</script>
</head>
<body>
<div id="wrap">
<div id="main">