<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        header('Location: prjdetails.php');
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Program Details</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="../styles/style.css">
</head>
<body style="text-align:center">
<div id="wb_Form1" style="width:570px;height:267px;z-index:13;margin:0 auto;">
<form name="PrgDetailsForm" method="post" action="" enctype="text/plain" id="Form1">
    <div id="wb_Text1" style="width:148px;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Financial Year:</span>
    </div>
    <input type="text" id="Editbox1" style="width:198px;height:23px;line-height:23px;z-index:1;" name="Editbox1" value="2017/2018" readonly="readonly">
    <br><br>
    <div id="wb_Text2" style="width:148px;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Budget:</span>
    </div>
    <input type="text" id="Editbox2" style="width:198px;height:23px;line-height:23px;z-index:3;" name="Editbox2" value="R19,000,000.00" readonly="readonly">
    <div id="wb_Text3" style="width:122px;height:24px;z-index:4;text-align:left;">
        <h4>Targets:</h4>
    </div>
    <div id="wb_Text4" style="width:148px;height:16px;z-index:5;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">No of projects:</span>
    </div>
    <input type="text" id="Editbox3" style="width:198px;height:23px;line-height:23px;z-index:6;" name="Editbox3" value="">
    <br><br>
    <div id="wb_Text5" style="width:148px;height:16px;z-index:7;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">No of jobs:</span>
    </div>
    <input type="text" id="Editbox4" style="width:198px;height:23px;line-height:23px;z-index:8;" name="Editbox4" value="">
    <br><br>
    <div id="wb_Text6" style="width:148px;height:16px;z-index:9;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Average jobs per project:</span>
    </div>
    <input type="text" id="Editbox5" style="width:198px;height:23px;line-height:23px;z-index:10;" name="Editbox5" value="">
    <br><br>
    <div style="margin: 0 auto;">
        <input type="reset" id="Button1" name="" value="Reset" style="width:96px;height:25px;z-index:11;">
        <input type="submit" id="Button2" name="" value="Next" style="width:96px;height:25px;z-index:14;">
    </div>
</form>
</div>
</body>
</html>