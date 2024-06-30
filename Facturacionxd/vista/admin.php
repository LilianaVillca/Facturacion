<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturacion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <style>
    body {
      
      background-color: #c9d6ff;
      /*background: linear-gradient(to right, #4e54c8, #8f94fb);
      background: linear-gradient(to right, #000428, #004e92);  */
      /*background: linear-gradient(to right, #0f0c29, #302b63, #24243e);*/
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: 100vh;
    }
    #container-fluid{
      background-color: #512da8;
    } 
      /*     -----------cambios--------------          */
    
    .bi {
    fill: #1f4136;
    cursor: pointer;
    }
    .bi:hover {
    fill: #5EC57E;
    }

    
    .animate_background{
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;

    }

    .card{
      position: relative;
    }

    .card::after{
      position:absolute;
      top:0px;
      left:0px;
      content:' ';
      background:gray;
      width:100%;
      height:100%;
      filter:blur(10px);
      z-index:-1;
    }

    
    .card-header{
      
  font-family: "Lato", sans-serif;
  font-weight: 600;
  font-style: italic;
 
    }
    
    
    .logo-png{
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-45%);
      width: 50%;
    }
    
    
  </style>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

</head>

<body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  
       
  <div class="position-absolute w-50" style="left:20%;z-index:-1">
       
  <svg id="sw-js-blob-svg" viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg" version="1.1" style="position: fixed;bottom: -1040;right: -4500;width: 800%;height: 800%;">                   
    <defs>                         <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            <stop id="stop1" stop-color="rgba(215, 248, 196, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(215, 248, 196, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M21.2,12.1C14.1,24.5,-14.2,24.6,-21.3,12.1C-28.4,-0.3,-14.2,-25.1,0,-25.1C14.1,-25.2,28.3,-0.3,21.2,12.1Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: all 0.3s ease 0s;" stroke="url(#sw-gradient)"></path>              </svg>
  </div>
  


 <br><br>



<!--    tarjetas    -->
  <!--    los iconos son de color lila por la clase bi de cada icono    -->
  <div class="container">
    <div class="row justify-content-start mt-4">
      <div class="col-md-3">
        <div class="card" fill="currentColor" style="width: 90%;">
          <div class="card-header text-center">Clientes</div>
          <div class="card-body d-flex justify-content-center align-items-center">
            <a class="link-dark" href="facturas.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card" style="width: 90%;">
          <div class="card-header text-center">Articulos</div>
          <div class="card-body d-flex justify-content-center align-items-center">
            <a class="link-dark" href="facturas.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-backpack4-fill" viewBox="0 0 16 16">
                <path d="M8 0a2 2 0 0 0-2 2H3.5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h4v.5a.5.5 0 0 0 1 0V7h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H10a2 2 0 0 0-2-2m1 2a1 1 0 0 0-2 0zm-4 9v2h6v-2h-1v.5a.5.5 0 0 1-1 0V11z" />
                <path d="M14 7.599A3 3 0 0 1 12.5 8H9.415a1.5 1.5 0 0 1-2.83 0H3.5A3 3 0 0 1 2 7.599V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-start mt-4">
      <div class="col-md-3">
        <div class="card" style="width: 90%;">
          <div class="card-header text-center">Ventas</div>
          <div class="card-body d-flex justify-content-center align-items-center">
            <a class="link-dark" href="facturas.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                <path d="M8 1a3 3 0 0 0-3 3v1H3.5A1.5 1.5 0 0 0 2 6.5v8A1.5 1.5 0 0 0 3.5 16h9A1.5 1.5 0 0 0 14 14.5v-8A1.5 1.5 0 0 0 12.5 5H11V4a3 3 0 0 0-3-3zm-2 4V4a2 2 0 0 1 4 0v1H6z" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card" style="width: 90%;">
          <div class="card-header text-center">Facturas</div>
          <div class="card-body d-flex justify-content-center align-items-center">
            <a class="link-dark" href="facturas.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div> <!--cierre de conteiner-->
      
      


  <img class="logo-png" src="logo.png" alt="Logo">

</body>

</html>