<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

  <style>
    :root{
      --brand: #0f4a63;
      --brand-2:#1f6d8d;
      --ink: #1e293b;
      --muted:#64748b;
      --line:#e2e8f0;
      --cta:#167aa2;
      --cta-hover:#136b8f;
      --radius:14px;
      --shadow: 0 12px 30px rgba(15,74,99,.15);
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color:var(--ink);
      background:#f8fafc;
    }

    .wrap{
      min-height:100vh;
      display:flex;
      align-items:stretch;
    }

    /* LEFT COLUMN */
    .left{
      flex:1 1 45%;
      background: url('images/login_new.png') center center/cover no-repeat;
      position:relative;
      display:flex;
      align-items:flex-end;
      justify-content:center;
      padding:32px;
      color:#fff;
    }

    .left .footer{
      font-size:10px;
      {{-- background:rgba(0,0,0,0.4); --}}
      padding:10px 16px;
      border-radius:8px;
    }

    /* RIGHT COLUMN (larger) */
    .right{
      flex:1 1 55%;
      background:#fff;
      display:flex; 
      align-items:center; 
      justify-content:center;
      padding:64px 32px;
    }

    .card{
      width:min(520px, 95%);
      background:#fff;
      border:1px solid var(--line);
      border-radius:var(--radius);
      box-shadow: var(--shadow);
      padding:40px;
    }

    .brandrow{
      display:flex; align-items:center; gap:12px; margin-bottom:8px;
    }

    .brandrow .appmark{
      width:38px; height:38px; border-radius:10px;
      background:linear-gradient(180deg, #e6f2f7, #d5eaf3);
      border:1px solid #cfe3ee;
      position:relative;
    }

    .brandrow .appmark::after{
      position:absolute; inset:0;
      display:grid; place-items:center;
      color:#167aa2; font-weight:700; font-size:20px;
    }

    .title{
      font-size:22px; font-weight:700; color:var(--brand);
    }

    .subtitle{
      color:var(--muted); font-size:14px; margin-bottom:20px;
    }

    .field{ margin-bottom:14px; }
    .label{ display:block; font-size:13px; color:#334155; margin:0 0 6px; }

    .input{
      width:100%;
      padding:12px 14px;
      border:1px solid var(--line);
      border-radius:10px;
      font-size:15px;
      outline:none;
      transition: box-shadow .2s, border-color .2s;
      background:#fff;
    }
    .input:focus{
      border-color:#b6d6e5;
      box-shadow: 0 0 0 4px rgba(22,122,162,.10);
    }

    .row{
      display:flex; align-items:center; justify-content:space-between;
      gap:12px; margin:6px 0 16px;
      font-size:13px;
    }

    .row a{ color:#167aa2; text-decoration:none; }
    .row a:hover{ text-decoration:underline; }

    .btn{
      width:100%;
      background:var(--cta);
      color:#fff;
      border:0;
      padding:12px 16px;
      border-radius:12px;
      font-weight:600;
      letter-spacing:.2px;
      cursor:pointer;
      transition: transform .04s ease, background .2s ease;
    }

    .btn:hover{ background:var(--cta-hover); }
    .btn:active{ transform: translateY(1px); }

    .small{
      margin-top:14px; font-size:13px; color:var(--muted);
      text-align:center;
    }

    @media (max-width: 980px){
      .left{ display:none; }
      .right{ flex-basis:100%; padding:24px; }
      .card{ width:min(560px, 94vw); }
    }
  </style>
</head>
<body>
  <main class="wrap">
    <!-- LEFT: background image only -->
    <aside class="left">
      <div class="footer" style="text-align: center;">
        <img src="{{ url('images/logo_white.png') }}" style="width: 150px;" alt="">
        <br>
        © 2025 One Health Network Patient Clinix Management Platform
        <br>One Health Network • All Rights Reserved
      </div>
    </aside>

    <!-- RIGHT: login form -->
    <section class="right">
      <form class="card" method="post" action="{{ route('login') }}">
        @csrf
        <div class="brandrow">
          <div class="appmark">
              <img src="{{ url('images/login_icon.png') }}" style="width: 40px;" alt="">
          </div>
          <div class="title">Login&nbsp;To Your Account</div>
        </div>
        <p class="subtitle">Sign in to continue your preventive healthcare journey.</p>

        <div class="field">
          <label class="label" for="username">Username</label>
          <input class="input" id="username" name="username" type="text" placeholder="Enter your username" required>
        </div>

        <div class="field">
          <label class="label" for="password">Password</label>
          <input class="input" id="password" name="password" type="password" placeholder="Enter your password" required>
        </div>

        <div class="row">
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
            {{-- <input type="checkbox" name="remember"> Remember me --}}
          </label>
          <a onclick="forgotPassword()">Forgot password?</a>
        </div>

        <button class="btn" type="submit">Login</button>

        <div class="small">
          Don’t have an account? <a href="#" style="color:#167aa2; text-decoration:none;">Create one</a>
        </div>
      </form>
    </section>
  </main>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

  <script>
    @if($errors->all())
        Swal.fire({
            icon: 'error',
              html: `
                  @foreach ($errors->all() as $error)
                      {{ $error }}<br/>
                  @endforeach
              `,
        });
    @endif

      function forgotPassword(){
          Swal.fire({
              title: 'Enter your email address',
              input: 'email',
          }).then(result => {
              if(result.value){
                  swal.showLoading();
                  $.ajax({
                      url: '{{ route('forgotPassword') }}',
                      data: {email: result.value},
                      success: result => {
                          Swal.fire({
                              title: result,
                          })
                      }
                  })
              }
          })
      }
  </script>
</body>
</html>
