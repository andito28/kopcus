<h2><b>Selamat Datang</b></h2>
<h3><b>Halo {{ $data['nama'] }},</b></h3>
<br>
<p>
    Terima kasih telah melakukan registrasi Aplikasi KOPICHUSEYO.
    Untuk melakukan verifikasi email, silahkan klik tombol dibawah
</p>
@php
    $token = $data['token'];
    $email = $data['email'];
@endphp
<a href="{{ url('/verify/'.$token.'/'.$email) }}" class="btn btn-primary" role="button">Aktivasi Akun Saya</a>
<br>
<br>
<p>Terima kasih,</p>
<br>
<p>KOPICHUSEYO</p>
