<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InforTask - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      
      @media (min-width: 768px) {
        .gradient-form {
          height: 100vh !important;
        }
      }
      @media (min-width: 769px) {
        .gradient-custom-2 {
          border-top-right-radius: .3rem;
          border-bottom-right-radius: .3rem;
        }
      }
    </style>
</head>
<body>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="logo.png"
                    style="width: 185px;" alt="logo">
                </div>

                <form action="includes/autenticar.php" method="post">
                 

                  <div class="form-outline mb-4">
                   
                    <input type="text" id="usuario" name="usuario" class="form-control"
                      placeholder="Digite seu usuário" required />
                  </div>

                  <div class="form-outline mb-4">
            
                    <input type="password" id="senha" name="senha" class="form-control"
                      placeholder="Digite sua senha" required />
                  </div>

                  <div class="form-outline mb-4">
           
                    <select id="tipo" name="tipo" class="form-select" required>
                      <option value="admin">Admin</option>
                      <option value="professor">Professor</option>
                      <option value="alunos">Aluno</option>
                    </select>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
  <button class="btn btn-primary w-100 fa-lg  mb-3" type="submit">
    Logar
  </button>
</div>
                  
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class=" px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Bem-vindo ao InforTask</h4>
                <p class="small mb-0">
                  
                  Gerencie tarefas, alunos e professores de forma prática e eficiente. Acesse como administrador, professor ou aluno e tenha o controle na palma da mão.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
