<?php
$name     = $_POST['name'] ?? '';
$age      = $_POST['age'] ?? '';
$phone    = $_POST['phone'] ?? '';
$email    = $_POST['email'] ?? '';
$address  = $_POST['address'] ?? '';
$question = $_POST['question'] ?? '';
$gender   = $_POST['gender'] ?? '';

$errors = [];

// --- nameのバリデーション ---
// 1. 未入力チェック
if ($name === '') {
    $errors[] = "name：名前を入力してください。";
} 
// 2. 文字種チェック（ひらがな、カタカナ、漢字、英字のみ許可。記号と数字はエラー）
elseif (!preg_match('/^[ぁ-んァ-ヶー一-龠ａ-ｚＡ-Ｚa-zA-Z]+$/u', $name)) {
    $errors[] = "name：名前はひらがな、カタカナ、漢字、英字のみ使用できます。";
}

// --- ageのバリデーション ---
if ($age === '') {
    $errors[] = "age：年齢を入力してください。";
} elseif (!is_numeric($age) || $age < 0 || $age > 150) {
    $errors[] = "age：年齢は0から150の間で入力してください。";
}

// --- phoneのバリデーション ---
if ($phone === '') {
    $errors[] = "phone：電話番号を入力してください。";
} elseif (!preg_match('/^[0-9-]+$/', $phone)) {
    $errors[] = "phone：電話番号は半角数字とハイフンのみ使用できます。";
}

// --- emailのバリデーション ---
if ($email === '') {
    $errors[] = "email：メールアドレスを入力してください。";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email：メールアドレスの形式が正しくありません。";
}

// --- addressのバリデーション ---
// 1. 未入力チェック
if ($address === '') {
    $errors[] = "address：住所を入力してください。";
}
// 2. 文字種チェック（nameと同様）
elseif (!preg_match('/^[ぁ-んァ-ヶー一-龠ａ-ｚＡ-Ｚa-zA-Z]+$/u', $address)) {
    $errors[] = "address：住所はひらがな、カタカナ、漢字、英字のみ使用できます。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>入力内容確認</h1>

        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p style="color: red; font-weight: bold;">
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
            <button onclick="history.back()" class="btn">戻って修正する</button>

        <?php else: ?>
            <p>名前: <?php echo htmlspecialchars($name); ?></p>
            <p>年齢: <?php echo htmlspecialchars($age); ?></p>
            <p>電話番号: <?php echo htmlspecialchars($phone); ?></p>
            <p>メールアドレス: <?php echo htmlspecialchars($email); ?></p>
            <p>住所: <?php echo htmlspecialchars($address); ?></p>
            <p>質問: <?php echo htmlspecialchars($question); ?></p>
            <p>性別: <?php echo htmlspecialchars($gender); ?></p>
            <button class="btn">送信する</button>
        <?php endif; ?>
    </div>
</body>
</html>