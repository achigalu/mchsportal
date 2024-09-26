<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examination Numbers in PDF</title>
    <link rel="stylesheet" href="{{ public_path('assets/css/domPDF.css') }}" type="text/css"> 
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
            <img src="{{ public_path('assets/images/users/3.jpg') }}" alt="Examination Number PDF" height="90" width="90" />
            </td>
            <td class="w-half">
                <h2>MCHS Invoice ID: 834847473</h2>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>Mike Banda</div>
                    <div>C/O Masintha CCAP. BOX 87, LILONGWE</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>MCHS</div>
                    <div>Cental Office</div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products">
            <tr>
                <th>CLASS</th>
                <th>CAMPUS</th>
                <th>NO of Students</th>
            </tr>
            <tr class="items">
                
                    <td style="text-align: center;">
                        {{$pclass}}
                    </td>
                    <td style="text-align: center;">
                       {{$pcampus}} 
                    </td>
                    <td style="text-align: center;">
                      {{$count}} 
                    </td>
                
            </tr>
            </tr>
            <tr class="items">
                
                    <td style="text-align: center;">
                        {{$pclass}}
                    </td>
                    <td style="text-align: center;">
                       {{$pcampus}} 
                    </td>
                    <td style="text-align: center;">
                      {{$count}} 
                    </td>
                
            </tr>
            </tr>
            <tr class="items">
                
                    <td style="text-align: center;">
                        {{$pclass}}
                    </td>
                    <td style="text-align: center;">
                       {{$pcampus}} 
                    </td>
                    <td style="text-align: center;">
                      {{$count}} 
                    </td>
                
            </tr>
        </table>
    </div>
 
    <div class="total">
        Total: MK 800,000
    </div>
 
    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; MCHS Accounts</div>
    </div>
</body>
</html>