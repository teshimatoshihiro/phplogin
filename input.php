<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>入力画面</title>
</head>

<body>
  <form action="create.php" method="POST">
    <fieldset>
      <legend>入力画面</legend>
      <a href="read.php">一覧画面</a>
      <a href="logout.php">ログアウト</a>
      <div>
          すること: <input type="text" name="todo">
      </div>
      <div>
        締め切り日: <input type="date" name="deadline">
      </div>
      <div>
        <button>登録</button>
      </div>
    </fieldset>
  </form>

</body>

</html>