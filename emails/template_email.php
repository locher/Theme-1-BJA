<?php
function bja_email($message){

return('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]--><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<!--[if (gte mso 9)|(IE)]>
<style type="text/css">
table {border-collapse: collapse;}
 </style>
<![endif]-->
<style type="text/css">
/* Basics */
 body {margin: 0 !important; padding: 0; background-color: #ffffff; }
 .full-width-image img {width: 100%; max-width: 600px; height: auto; }
 table {border-spacing: 0; font-family: Arial, sans-serif; color: #333333; }
 td {padding: 0; }
 img {border: 0; }
 div[style*="margin: 16px 0"] {margin:0 !important; }
 .wrapper {width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
 .webkit {max-width: 600px; margin: 0 auto; }
 .outer {Margin: 0 auto; width: 100%; max-width: 600px; }
 .full-width-image img {width: 100%; max-width: 600px; height: auto; }
 .inner {padding: 40px; }
 p {Margin: 0; }
 a {color: #ee6a56; text-decoration: underline; }
 .h1 {font-size: 21px; font-weight: bold; Margin-bottom: 18px; }
 .h2 {font-size: 18px; font-weight: bold; Margin-bottom: 12px; }
 /* One column layout */
 .one-column .contents {text-align: left; }
 .one-column p {font-size: 14px; Margin-bottom: 10px; }
 /*Two column layout*/
 .two-column {text-align: center; font-size: 0; }
 .two-column .column {width: 100%; max-width: 300px; display: inline-block; vertical-align: top; }
 .contents {width: 100%; }
 .two-column .contents {font-size: 14px; text-align: left; }
 .two-column img {width: 100%; max-width: 280px; height: auto; }
 .two-column .text {padding-top: 10px; }
 /*Three column layout*/
 .three-column {text-align: center; font-size: 0; padding-top: 10px; padding-bottom: 10px; }
 .three-column .column {width: 100%; max-width: 200px; display: inline-block; vertical-align: top; }
 .three-column .contents {font-size: 14px; text-align: center; }
 .three-column img {width: 100%; max-width: 180px; height: auto; }
 .three-column .text {padding-top: 10px; }
 /*Media Queries*/
 @media screen and (max-width: 400px) {
.two-column .column, .three-column .column {max-width: 100% !important; }
 .two-column img {max-width: 100% !important; }
 .three-column img {max-width: 50% !important; }
 }
 @media screen and (min-width: 401px) and (max-width: 620px) {
.three-column .column {max-width: 33% !important; }
 .two-column .column {max-width: 50% !important; }
 }
/* Left sidebar layout */
 .left-sidebar {text-align: center; font-size: 0; }
 .left-sidebar .column {width: 100%; display: inline-block; vertical-align: middle; }
 .left-sidebar .left {max-width: 100px; }
 .left-sidebar .right {max-width: 500px; }
 .left-sidebar .img {width: 100%; max-width: 80px; height: auto;}
 .left-sidebar .contents {font-size: 14px; text-align: center; }
 .left-sidebar a {color: #85ab70; }
/* Right sidebar layout */
 .right-sidebar {text-align: center; font-size: 0; }
 .right-sidebar .column {width: 100%; display: inline-block; vertical-align: middle; }
 .right-sidebar .left {max-width: 100px; }
 .right-sidebar .right {max-width: 500px; }
 .right-sidebar .img {width: 100%; max-width: 80px; height: auto; }
 .right-sidebar .contents {font-size: 14px; text-align: center; }
 .right-sidebar a {color: #70bbd9; }

</style>
</head>
<body>
<center class="wrapper">
<div class="webkit">


    <!--[if (gte mso 9)|(IE)]>
    <table width="600" align="center">
    <tr>
    <td>
    <![endif]-->
    <table class="outer" align="center" style="background-color:#f7f7f7">

    <tbody><tr class="psingle">
    <td class="one-column" style="height:5px; background-color:#b2548b;"> 
    </td>
</tr><tr class="psingle">
    <td class="one-column">
        <table width="100%">
            <tbody><tr>
                <td class="inner contents">
                   <p style="color: #b2548b; font-size:30px;"><strong>Bonjour,</strong></p>
                    '.$message.'
                </td>
            </tr>
        </tbody></table>
    </td>
</tr><tr class="psingle">
    <td class="one-column" style="background-color:#b2548b;">
        <table width="100%">
            <tbody><tr>
                <td class="inner contents">
                    <p>
                        Bonjour Amour
                    </p>
                </td>
            </tr>
        </tbody></table>
    </td>
</tr></tbody></table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->

    </div>
</center>
</body>
</html>
');
}

?>