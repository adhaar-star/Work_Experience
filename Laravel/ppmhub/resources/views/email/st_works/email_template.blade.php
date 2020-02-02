<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .invoice-box{
            max-width:800px;
            margin:auto;
            border:1px solid #eee;
            box-shadow:0 0 10px rgba(0, 0, 0, .15);
            font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
        }

        .invoice-box .header{
            text-align:center;
            padding:15px  20px;
            border-bottom: 1px solid #87c940;
            background-color: #000;

        }
        .invoice-box .content{
            padding:10px 20px;
        }

        .invoice-box .footer{
            padding: 10px 20px;
            font-size: 12px;
            margin-top: 10px;
            border-top: 1px solid #87c940;

        }

        .invoice-box .footerLeft{

        }

        .invoice-box .footerRight{
            text-align: right;
        }

    </style>
</head>

<body>
<div class="invoice-box">
    <div class="header">
        <img src="http://ppmhub.dev/vendors/common/img/ppm_logo.png" style="width:100%; max-width:220px;">
        <p style="font-size: 12px; text-align: center; margin: 0;">
            Address
        </p>
    </div>
    <div class="content">
        <?php  echo $messageData;?>
    </div>
    <div class="footer">
        <table style="width: 100%">
            <tr>
                <td class="footerLeft"> © 2017 ppmhub | By : <a target="_blank" href="http://www.ppmhub.com.au/">ppmhub</a></td>
                <td class="footerRight"> Email:  admin@ppmhub.com.au</td>
            </tr>
        </table>
    </div>


</div>
</body>
</html>