<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        header('Location: prjbudget.php');
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Project Details</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div id="wb_Form1" style="width:770px;height:900px;z-index:95;margin:0 auto;">
<form name="ProjDetailsForm" method="post" action="" enctype="text/plain" id="Form1">
    <div id="wb_Text1" style="width:129px;height:16px;z-index:1;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Order number:</span>
    </div>
    <input type="text" id="Editbox1" style="width:189px;height:18px;line-height:18px;z-index:0;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text2" style="width:129px;height:16px;z-index:2;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Order date:</span>
    </div>
    <input type="text" id="Editbox2" style="width:189px;height:18px;line-height:18px;z-index:3;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text5" style="width:129px;height:16px;z-index:7;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Physical address:</span>
    </div>
    <textarea name="TextArea1" id="TextArea1" style="width:190px;height:87px;z-index:5;" rows="4" cols="26"></textarea>
    <br><br>
    <div id="wb_Text6" style="width:129px;height:16px;z-index:8;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Province:</span>
    </div>
    <select name="Combobox1" size="1" id="Combobox1" style="width:190px;height:21px;z-index:6;">
        <option value="None">--Province--</option>
        <option value="GP">Gauteng</option>
        <option value="LP">Limpopo</option>
        <option value="WC">Western Cape</option>
        <option value="EC">Eastern Cape</option>
        <option value="NC">Northern Cape</option>
        <option value="MP">Mpumalanga</option>
        <option value="KZ">KwaZulu Natal</option>
    </select>
    <br><br>
    <div id="wb_Text7" style="width:129px;height:16px;z-index:9;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Contact number:</span>
    </div>
    <input type="text" id="Editbox7" style="width:189px;height:18px;line-height:18px;z-index:23;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text8" style="width:129px;height:16px;z-index:13;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Contact person:</span>
    </div>
    <input type="text" id="Editbox6" style="width:189px;height:18px;line-height:18px;z-index:10;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text4" style="width:129px;height:16px;z-index:16;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Position:</span>
    </div>
    <input type="text" id="Editbox4" style="width:189px;height:18px;line-height:18px;z-index:11;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text3" style="width:129px;height:16px;z-index:15;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Company name:</span>
    </div>
    <input type="text" id="Editbox3" style="width:189px;height:18px;line-height:18px;z-index:4;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text9" style="width:129px;height:16px;z-index:17;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Mobile number:</span>
    </div>
    <input type="text" id="Editbox9" style="width:188px;height:18px;line-height:18px;z-index:26;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text10" style="width:129px;height:16px;z-index:18;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">E-mail address:</span>
    </div>
    <input type="text" id="Editbox10" style="width:189px;height:18px;line-height:18px;z-index:27;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text11" style="width:180;height:18px;z-index:14;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Number of employees:</span>
    </div>
    <input type="text" id="Editbox11" style="width:188px;height:18px;line-height:18px;z-index:28;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text12" style="width:129px;height:18px;z-index:19;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Permanent:</span>
    </div>
    <input type="text" id="Editbox12" style="width:189px;height:18px;line-height:18px;z-index:29;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text13" style="width:129px;height:16px;z-index:91;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Temporary:</span>
    </div>
    <input type="text" id="Editbox13" style="width:188px;height:18px;line-height:18px;z-index:35;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text14" style="width:129px;height:16px;z-index:20;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Contract worker:</span>
    </div>
    <input type="text" id="Editbox14" style="width:188px;height:18px;line-height:18px;z-index:36;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text15" style="width:129px;height:16px;z-index:21;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Seasonal wokers:</span>
    </div>
    <input type="text" id="Editbox15" style="width:188px;height:18px;line-height:18px;z-index:38;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text16" style="width:129px;height:16px;z-index:34;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Decline period:</span>
    </div>
    <input type="text" id="Editbox16" style="width:43px;height:18px;line-height:18px;z-index:44;" name="Editbox1" value="">
    <br><br>
    <div id="wb_Text17" style="width:129px;height:16px;z-index:22;text-align:left;float:left">
        <span style="color:#000000;font-family:Arial;font-size:13px;">Industry sector:</span>
    </div>
    <select name="Combobox1" size="1" id="Combobox2" style="width:190px;height:21px;z-index:25;">
        <option value="None">--Industry--</option>
        <option value="01-03">Agriculture, forestry and fishing</option>
        <option value="05-09">Mining and quarrying</option>
        <option value="10-33">Manufacturing</option>
        <option value="35">Electricity, gas, steam and air conditioning supply</option>
        <option value="36-39">Water supply; sewerage, waste management and remediation activities</option>
        <option value="41-43">Construction</option>
        <option value="45-47">Wholesale and retail trade; repair of motor vehicles and motorcycles</option>
        <option value="49-53">Transportation and storage</option>
        <option value="55-56">Accommodation and food service activities</option>
        <option value="58-63">Information and communication</option>
        <option value="64-66">Financial and insurance activities</option>
        <option value="68">Real estate activities</option>
        <option value="69-75">Professional, scientific and technical activities</option>
        <option value="77-82">Administrative and support service activities</option>
        <option value="84">Public administration and defence; compulsory social security</option>
        <option value="85">Education</option>
        <option value="86-88">Human health and social work activities</option>
        <option value="90-93">Arts, entertainment and recreation</option>
        <option value="94-96">Other service activities</option>
        <option value="97-98">Activities of households as employers; undifferentiated goods- and services-producing activities of households for own use</option>
        <option value="99">Activities of extraterritorial organizations and bodies, not economically active people, unemployed people etc.</option>
    </select>
<input type="text" id="Editbox8" style="width:539px;height:18px;line-height:18px;z-index:24;" name="Editbox1" value="">
<select name="Combobox1" size="1" id="Combobox3" style="width:190px;height:21px;z-index:30;">
</select>
<div id="wb_Text19" style="width:217px;height:24px;z-index:31;text-align:left;">
<h4>Company details:</h4></div>
<select name="Combobox1" size="1" id="Combobox4" style="width:190px;height:21px;z-index:32;">
</select>
<div id="wb_Text18" style="width:116px;height:16px;z-index:33;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Division:</span></div>
<select name="Combobox1" size="1" id="Combobox5" style="width:190px;height:21px;z-index:37;">
</select>
<div id="wb_Text22" style="width:196px;height:16px;z-index:39;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Contemplating retrenchments:</span></div>
<div id="wb_Text23" style="width:186px;height:16px;z-index:40;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Number of employees affected:</span></div>
<input type="checkbox" id="Checkbox1" name="" value="on" style="z-index:41;">
<div id="wb_Text28" style="width:47px;height:16px;z-index:42;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Male:</span></div>
<div id="wb_Text29" style="width:56px;height:16px;z-index:43;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Female:</span></div>
<input type="checkbox" id="Checkbox2" name="" value="on" style="z-index:45;">
<input type="text" id="Editbox17" style="width:43px;height:18px;line-height:18px;z-index:46;" name="Editbox1" value="">
<div id="wb_Line1" style="width:0px;height:63px;z-index:47;">
<img src="images/img0004.png" id="Line1" alt=""></div>
<div id="wb_Text30" style="width:129px;height:16px;z-index:48;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>White:</strong></span></div>
<input type="checkbox" id="Checkbox3" name="" value="on" style="z-index:49;">
<div id="wb_Text31" style="width:47px;height:16px;z-index:50;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Male:</span></div>
<div id="wb_Text32" style="width:56px;height:16px;z-index:51;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Female:</span></div>
<input type="text" id="Editbox18" style="width:43px;height:18px;line-height:18px;z-index:52;" name="Editbox1" value="">
<input type="checkbox" id="Checkbox4" name="" value="on" style="z-index:53;">
<input type="text" id="Editbox19" style="width:43px;height:18px;line-height:18px;z-index:54;" name="Editbox1" value="">
<div id="wb_Line2" style="width:0px;height:63px;z-index:55;">
<img src="images/img0005.png" id="Line2" alt=""></div>
<div id="wb_Text33" style="width:129px;height:16px;z-index:56;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Disabled:</strong></span></div>
<input type="checkbox" id="Checkbox5" name="" value="on" style="z-index:57;">
<div id="wb_Text34" style="width:47px;height:16px;z-index:58;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Male:</span></div>
<div id="wb_Text35" style="width:56px;height:16px;z-index:59;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Female:</span></div>
<input type="text" id="Editbox20" style="width:43px;height:18px;line-height:18px;z-index:60;" name="Editbox1" value="">
<input type="checkbox" id="Checkbox6" name="" value="on" style="z-index:61;">
<input type="text" id="Editbox21" style="width:43px;height:18px;line-height:18px;z-index:62;" name="Editbox1" value="">
<div id="wb_Line3" style="width:0px;height:63px;z-index:63;">
<img src="images/img0006.png" id="Line3" alt=""></div>
<div id="wb_Text36" style="width:129px;height:16px;z-index:64;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Age groups:</strong></span></div>
<input type="checkbox" id="Checkbox7" name="" value="on" style="z-index:65;">
<div id="wb_Text37" style="width:47px;height:16px;z-index:66;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">18-35:</span></div>
<div id="wb_Text38" style="width:48px;height:16px;z-index:67;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">36-55:</span></div>
<input type="text" id="Editbox22" style="width:43px;height:18px;line-height:18px;z-index:68;" name="Editbox1" value="">
<input type="checkbox" id="Checkbox8" name="" value="on" style="z-index:69;">
<input type="text" id="Editbox23" style="width:43px;height:18px;line-height:18px;z-index:70;" name="Editbox1" value="">
<input type="checkbox" id="Checkbox9" name="" value="on" style="z-index:71;">
<input type="text" id="Editbox24" style="width:43px;height:18px;line-height:18px;z-index:72;" name="Editbox1" value="">
<div id="wb_Text39" style="width:32px;height:16px;z-index:73;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">55+:</span></div>
<div id="wb_Text43" style="width:147px;height:16px;z-index:74;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">UIF registration number:</span></div>
<div id="wb_Text45" style="width:123px;height:16px;z-index:75;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Service provider:</span></div>
<div id="wb_Text25" style="width:129px;height:16px;z-index:76;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Union name:</span></div>
<div id="wb_Text26" style="width:217px;height:24px;z-index:77;text-align:left;">
<h4>Equity details:</h4></div>
<div id="wb_Text27" style="width:129px;height:16px;z-index:78;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Black:</strong></span></div>
<div id="wb_Text40" style="width:196px;height:16px;z-index:79;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">BEE level:</span></div>
<select name="Combobox1" size="1" id="Combobox7" style="width:190px;height:21px;z-index:80;">
</select>
<div id="wb_Text41" style="width:197px;height:16px;z-index:81;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">How did you find out about TAS:</span></div>
<select name="Combobox1" size="1" id="Combobox8" style="width:190px;height:21px;z-index:82;">
</select>
<div id="wb_Text42" style="width:199px;height:16px;z-index:83;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">UIF contribution:</span></div>
<select name="Combobox1" size="1" id="Combobox9" style="width:190px;height:21px;z-index:84;">
</select>
<input type="text" id="Editbox25" style="width:188px;height:18px;line-height:18px;z-index:85;" name="Editbox1" value="">
<div id="wb_Text44" style="width:199px;height:16px;z-index:86;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">PSA project manager:</span></div>
<select name="Combobox1" size="1" id="Combobox10" style="width:190px;height:21px;z-index:87;">
</select>
<select name="Combobox1" size="1" id="Combobox11" style="width:190px;height:21px;z-index:88;">
</select>
<input type="reset" id="Button1" name="" value="Reset" style="width:96px;height:25px;z-index:89;">
<input type="submit" id="Button2" name="" value="Next" style="width:96px;height:25px;z-index:90;">
<div id="wb_Text20" style="width:217px;height:24px;z-index:92;text-align:left;">
<h4>Contact details:</h4></div>
<div id="wb_Text21" style="width:217px;height:24px;z-index:93;text-align:left;">
<h4>Workforce details:</h4></div>
</form>
</div>
</body>
</html>