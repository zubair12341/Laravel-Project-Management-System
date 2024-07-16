<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
</head>
<body>
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#0fad00">Success</h2>
        <img src="https://cdn2.iconfinder.com/data/icons/greenline/512/check-512.png" style="height: 150px">
        <h3>Dear, {{$employee->first_name.' '.$employee->last_name}}</h3>
        <p style="font-size:20px;color:#5C5C5C;">Thank you for completing your profile.We have sent you an email "{{$employee->email}}" with your details
Please go to your above email now and login.</p>
        <a href="http://hrm.secureserverinternal.com/" class="btn btn-success"> � � Log in  � � </a>
    <br><br>
        </div>
        
	</div>
</div>

</body>
</html>