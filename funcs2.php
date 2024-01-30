<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() conn=connectの意味で名付けてる
function db_conn(){
    try {
        //localhostの場合
        $db_name = "gs_db3";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "";          //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト

        //localhost以外(さくらサーバーなど)の場合参照するようにかき分ける処理。デプロイ用にコメントアウト中
        // if($_SERVER["HTTP_HOST"] != 'localhost'){
        //     $db_name = "gshycheese_gs_db";  //データベース名
        //     $db_id   = "gshycheese";  //アカウント名（さくらコントロールパネルに表示されています）
        //     $db_pw   = "sirabasu0310";  //パスワード(さくらサーバー最初にDB作成する際に設定したパスワード)
        //     $db_host = "mysql57.gshycheese.sakura.ne.jp"; //例）mysql**db.ne.jp...
        // }
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
//*** function化を使う！*****************
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}


//リダイレクト関数: redirect($file_name)
function redirect($file_name) {
    // 個々の書き方再確認
    header("Location: ".$file_name);
    exit();
}






