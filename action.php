<?php
// セッションを開始する
session_start();
session_regenerate_id();

// セッションに保存されているエラーメッセージを削除する
if(isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

try {
    // 日付が正しいかどうか判断する
    // isDate の定義であって !isDate の定義はしていない
    if (!isDate($_POST['date'])) {
        // 日付が正しくないときは、例外をスローする
        // Exception( エラーオブジェクト) をスローする?????
        // throwは例外の条件がいくつもある時に意味をなしてくる
        // その場合も受けるcatchは一つでよい
        // このように条件が一つの場合はthrowは省略できる
        
        throw new Exception('日付の形式が正しくありません');
    }
} catch (Exception $e) {
    // Exception型である$eの意味
    // よってgetMessege()メソッドが使えるようになる
    $_SESSION['error']['msg'] = $e->getMessage();
    $_SESSION['error']['date'] = $_POST['date'];
    header('Location: ./');
    exit;
}

/**
 * 正しい日付かどうかを確認します
 *
 * @param string $str /区切りの日付の文字列
 * @return boolean
 */
function isDate($str)
{
    // explode() 文字列から配列をつくる explode("区切り文字", 文字列)
    // isDate($str)の()に入った文字列を、/を取り払い、$d  が三つの値の入った配列$dをつくる。
    // checkdate( 年, 月, 日,)   単純に数が入っていればよい????????  bool値返す
    $d = explode('/', $str);
    return checkdate($d[1], $d[2], $d[0]);
}
?>
<!DOCTYPE html>
<html lang="練習問題09-2">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題09-2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">判定結果</div>
                    <div class="card-body">
                        正しい日付です
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>