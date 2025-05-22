<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力値の取得とサニタイズ
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $best_page = $_POST["best_page"];
    $improve_page = $_POST["improve_page"];
    $game_feedback = isset($_POST["game_feedback"]) ? implode(", ", $_POST["game_feedback"]) : "";
    $game_feedback_other = htmlspecialchars($_POST["game_feedback_other"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "tck2563850@tck.o-hara.ac.jp";

    // メールの件名と本文
    $subject = "【お問い合わせフォーム】" . $name . "様より";
    $body = <<<EOT
名前: $name
メールアドレス: $email

良かったページ: $best_page
改良が必要なページ: $improve_page
ゲームの感想: $game_feedback
その他の感想: $game_feedback_other

メッセージ:
$message
EOT;

    $headers = "From: $email";

    // メール送信
    if (mail($to, $subject, $body, $headers)) {
        echo "送信が完了しました。ありがとうございました！";
    } else {
        echo "送信に失敗しました。もう一度お試しください。";
    }
}
?>
