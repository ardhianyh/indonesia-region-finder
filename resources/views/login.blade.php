<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Page</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f0f0f0;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin: 0;
      }

      .login-container {
         background-color: #fff;
         border-radius: 10px;
         padding: 20px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         max-width: 300px;
         width: 100%;
      }

      h1 {
         text-align: center;
      }

      form {
         display: flex;
         flex-direction: column;
      }

      .form-group {
         margin: 10px 0;
         display: flex;
         flex-direction: column;
      }

      label {
         font-weight: bold;
      }

      input {
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         margin-top: 10px;
      }

      hr {
         margin: 20px 0;
      }

      button {
         border: none;
         padding: 10px;
         border-radius: 5px;
         cursor: pointer;
         font-weight: bold;
         transition: background-color 0.3s;
         width: 100%;
      }

      button.primary {
         background-color: #007bff;
         color: #fff;
      }

      button.primary:hover {
         background-color: #0056b3;
      }

      .google-button {
         display: flex;
         align-items: center;
         background-color: #fff;
         border: 1px solid #ccc;
         border-radius: 5px;
         padding: 10px;
         margin: 10px 0;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .google-button:hover {
         background-color: #f2f2f2;
      }

      .google-icon {
         width: 24px;
         height: 24px;
         margin-right: 10px;
      }

      @media (max-width: 480px) {
         .login-container {
            width: 90%;
         }
      }
   </style>
</head>

<body>
   <div class="login-container">
      <h1>Login</h1>
      <form method="POST" action="/login">
         @csrf
         <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Enter your email" required>
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
         </div>
         <button class="primary" type="submit">Login</button>
      </form>
   </div>

</body>

</html>