<h1>Lupa password</h1>
<p>Profile<br></p>
<p>
Username Anda : {{$data->username}} <br>
Email Anda : {{$data->email}}<br>
</p>
<br>
<b>
Berikut link untuk mengatur ulang password anda
<a href="{{ route('reset.password.get', [$token, $email]) }}">Reset</a>
</b>