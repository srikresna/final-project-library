<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      height: 100vh;
    }

    #login-container {
      background-color: #3498db;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 300px;
      margin: 20px auto; /* Center the login container */
    }

    #login-header {
      background-color: #334155;
      padding: 20px;
      text-align: center;
      color: #fff;
    }

    #login-form {
      padding: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    button {
      background-color: #f39c12;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: #e67e22;
    }
  </style>
  <title>Library Login</title>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <br>
        <div id="login-container">
          <div id="login-header">
            <h2>Library Login</h2>
          </div>
          <div id="login-form">
            <form action="<?= BASE_URL; ?>/login/loginProcess" method="POST">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <br>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <br>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
