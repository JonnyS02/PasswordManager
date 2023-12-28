<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PassSafe Pro</title>
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#f4f4f4">
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="0" width="600"
                   style="border-collapse: collapse; margin: 20px; background-color: #ffffff; border-radius: 10px; overflow: hidden;">
                <tr>
                    <td style="padding: 20px; text-align: center;">
                        <h1 style="font-size: 3.5em">
                            <span style="color: black;font-family: 'Brush Script MT', cursive;font-weight: bold;">PassSafe</span>
                            <sup><span style="font-family: 'Agency FB',serif; color: white; background-color: #00bcff;padding-left: 5px;padding-right: 5px;border-radius: 5px">Pro</span></sup>
                            <span style="color: black;font-family: 'Brush Script MT', cursive;font-weight: bold;"><?php if (isset($name)) echo $name; ?></span>
                            <div class="diver" style="border-radius: 5px 5px 0 0;width: 100%; background-color: rgba(255,183,0,0.9);padding-top: 10px;"></div>
                            <div class="diver" style="width: 100%; background-color: rgba(255,128,0,0.9);padding-top: 10px;"></div>
                            <div class="diver" style="border-radius: 0 0 5px 5px;width: 100%; background-color: rgba(255,77,0,0.9);padding-top: 10px;"></div>
                        </h1>
                        <p style="color: #666666; font-size: 16px; margin-top: 20px;">
                            <?php if (isset($content)) echo $content; ?>
                        </p>
                        <table cellpadding="5" cellspacing="0" border="0" width="70%"  style="margin-top: 20px;margin-left: 15%;margin-right: 15%;">
                            <tr>
                                <td bgcolor="#0d6dfc" align="center" style="color: #FFFFFF; font-weight: bold; border-radius: 5px;">
                                    <a href="<?php if (isset($link)) echo $link; ?>" style="color: #ffffff; text-decoration: none; display: inline-block; padding: 10px 20px; font-size: 18px;"><?php if (isset($do)) echo $do; ?> </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
