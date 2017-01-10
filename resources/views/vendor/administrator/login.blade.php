<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- bootstrap 3.0.2 -->
    <link href="<?= asset($assets . '/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="<?= asset($assets . '/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- iCheck -->
    <link href="<?= asset($assets . '/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition login-page">
@include('administrator::partials.messages')

<div class="login-box">
    <div class="login-logo">
        <a href="/"><i class="fa fa-home"></i></a>&#160;<span>{!! config('administrator.title') !!}</span>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        {!! Form::open() !!}

        <div class="input-group has-feedback">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {!! Form::text($identity, null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}
        </div>
        <br>
        <div class="input-group has-feedback">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            {!! Form::password($credential, ['class' => 'form-control', 'placeholder' => 'Password']) !!}
        </div>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-offset-8 col-xs-4">
                <br>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.login-box-body -->
</div>

<script src="<?= asset($assets . '/plugins/jQuery/jQuery-2.2.0.min.js') ?>"></script>

<script src="<?= asset($assets . '/js/bootstrap.min.js') ?>"></script>

<script src="<?= asset($assets . '/plugins/iCheck/icheck.min.js') ?>"></script>
</body>
</html>