<?php $link = route('get_unscribe',['token' => $subscribe->token]) ?>
<!DOCTYPE html>
<html style="min-height: 100%; height:100%">
<head>
    <title>Subscribed!</title>
</head>
<body style="@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,500,700&subset=latin,cyrillic-ext); font-family: 'Open Sans', sans-serif; min-height: 100%; height:100%;background-color:  #f6f6f6;">
    <table style="width: 100%; height: 100%;">
        <tbody>
            <tr>
                <td style="">
                    <table style="text-align: center; width:100%; max-width: 650px; margin: auto; ">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ URL::to('/assets/images/logo2.png') }}" height="107" width="93" style="margin-bottom: 40px;">
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #fff; padding: 55px 0;">
                                    <h1 style="color: #424242; font-size: 26px; font-weight: 500; margin-bottom: 30px;">Vă multumim pentru înscriere!</h1>
                                    <h6 style="color:#9e9e9e; font-weight: 300; font-size: 16px; margin-top: 0;">Pentru a dezabonare. dați un click pe buttonul de mai jos.</h6>
                                    <a href="{{ $link }}" style=" background-color: #ff6f00; color:#fff; text-decoration: none; line-height: 30px; display:inline-block; min-width:155px; font-size: 15px; font-weight: 500; ">Unsubscribe</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: 300; font-size: 13px; margin-top: 40px">&copy; Amma 2015. Toate drepturile sunt rezervate.</p>
                                    <p><img src="{{ URL::to('/assets/images/logo3.png') }}" height="21" width="21"></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
