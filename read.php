<?php
//ログイン確認
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = 'SELECT * FROM todo_table ORDER BY deadline ASC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["deadline"]}</td>
      <td>{$record["todo"]}</td>";
  if ($_SESSION['is_admin'] === "1") {
    $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>
      <td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
  }
  $output .= "
    </tr>
  ";
}
// foreach ($result as $record) {
//   $output .= "
//     <tr>
//       <td>{$record["deadline"]}</td>
//       <td>{$record["todo"]}</td>
//       <td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>
//       <td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>
//     </tr>
//   ";
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="read.css">
  <title>データベース（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>データベース（一覧画面）<?=$_SESSION['username']?>さん</legend>
    <a href="input.php">入力画面</a>
    <a href="logout.php">ログアウト</a>
    <table>
      <thead>
        <tr>
          <th>締切日</th>
          <th>すること</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>