<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InforTask</title>
</head>
<body>
<h2>Login</h2>
  <form action="includes/autenticar.php" method="post">
    <label for="usuario">Usuário:</label>
    <input type="text" id="usuario" name="usuario" required>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <label for="tipo">Tipo de usuário:</label>
    <select id="tipo" name="tipo">
      <option value="admin">Admin</option>
      <option value="professor">Professor</option>
      <option value="aluno">Aluno</option>
    </select>
    <button type="submit">Logar</button>
  </form>
</body>
</html>