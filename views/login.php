<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión</title>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

    * {
      margin: 0 !important;
      padding: 0 !important;
      box-sizing: border-box !important;
      font-family: 'Poppins', sans-serif !important;
    }

    section {
      position: relative !important;
      width: 100% !important;
      height: 100vh !important;
      display: flex !important;
    }

    section .imgBx {
      position: relative !important;
      width: 50% !important;
      height: 100% !important;
    }

    section .imgBx:before {
      content: '' !important;
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      width: 100% !important;
      height: 100% !important;
      background: linear-gradient(225deg, #D59F0F, #002B7A) !important;
      z-index: 1 !important;
      mix-blend-mode: screen !important;
    }

    section .imgBx img {
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
    }

    section .contentBx {
      display: flex !important;
      width: 50% !important;
      height: 100% !important;
      justify-content: center !important;
      align-items: center !important;
    }

    .formBx {
      width: 50% !important;
    }

    .formBx h2 {
      color: #607d8b !important;
      font-weight: 600 !important;
      font-size: 1.5em !important;
      text-transform: uppercase !important;
      margin-bottom: 20px !important;
      border-bottom: 4px solid #D59F0F !important;
      display: inline-block !important;
      letter-spacing: 1px !important;
    }

    .formBx .inputBx {
      margin-bottom: 20px !important;
    }

    .formBx .inputBx span {
      font-size: 16px !important;
      margin-bottom: 5px !important;
      display: inline-block !important;
      color: #607d8b !important;
      font-weight: 300 !important;
      font-size: 16px !important;
      letter-spacing: 1px !important;
    }

    .formBx .inputBx input {
      width: 100% !important;
      padding: 10px !important;
      outline: none !important;
      font-weight: 400 !important;
      border: 1px solid #e6e5e5 !important;
      font-size: 16px !important;
      letter-spacing: 1px !important;
      color: #607d8b !important;
      background: transparent !important;
      border-radius: 5px;
    }

    .formBx .inputBx input[type="submit"] {
      background: #002B7A !important;
      color: #fff !important;
      border: 1px solid #e6e5e5 !important;
      font-size: 16px !important;
      font-weight: 500 !important;
      cursor: pointer !important;
    }

    .formBx .remember {
      margin-bottom: 10px;
      color: #607d8b;
      font-weight: 400;
      font-size: 14px;
    }

    .formBx .inputBx p {
      color: #607d8b !important;
    }

    .formBx .inputBx a {
      color: #002B7A !important;
    }

    .formBx h3 {
      color: #607d8b !important;
      text-align: center !important;
      margin: 80px 0 10px !important;
      font-weight: 500 !important;
    }

    .sci {
      display: flex !important;
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
    }

    .sci li {
      list-style: none !important;
      width: 50px !important;
      height: 50px !important;
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      background: #607d8b !important;
      border-radius: 50% !important;
      margin: 0 7px !important;
      cursor: pointer !important;
    }

    .sci li img {
      transform: scale(0.5) !important;
      filter: invert(1) !important;
    }

    @media (max-width: 768px) {
      section .imgBx {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
      }

      section .contentBx {
        z-index: 1 !important;
        width: 100% !important;
      }

      section .contentBx .formBx {
        padding: 40px !important;
        width: 100% !important;
        margin: 50px !important;
        background: #FFF;
      }

      .formBx h3 {
        margin: 30px 0 10px !important;
      }
    }
  </style>
</head>

<body>
  <section>
    <div class="imgBx">
      <img src="./assets/images/fondoFESA.jpg">
    </div>
    <div class="contentBx">
      <div class="formBx">
        <h2>Iniciar sesión</h2>
        <form action="" method="POST">
          <div class="inputBx">
            <span>Nombre de Usuario</span>
            <input type="text" name="user_name" required>
          </div>
          <div class="inputBx">
            <span>Contraseña</span>
            <input type="password" name="password" required>
          </div>
          <br>
          <div class="inputBx">
            <input type="submit" value="Iniciar">
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>