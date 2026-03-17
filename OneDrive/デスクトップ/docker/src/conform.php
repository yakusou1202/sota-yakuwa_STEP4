<?php
$name     = $_POST['name'] ?? '';
$age      = $_POST['age'] ?? '';
$phone    = $_POST['phone'] ?? '';
$email    = $_POST['email'] ?? '';
$address  = $_POST['address'] ?? '';
$question = $_POST['question'] ?? '';
$gender   = $_POST['gender'] ?? '';

$errors = [];

// PHP条件1: name（数字不可）
if (preg_match('/[0-9]/', $name)) {
    $errors[] = "name：名前はひらがな、カタカナ、漢字、英字のみ使用できます。";
}
// PHP条件2: age（0-150）
if (!is_numeric($age) || $age < 0 || $age > 150) {
    $errors[] = "age：年齢は0から150の間で入力してください。";
}
// PHP条件3: phone（半角数字とハイフン）
if (!preg_match('/^[0-9-]+$/', $phone)) {
    $errors[] = "phone：電話番号は半角数字とハイフンのみ使用できます。";
}
// PHP条件4: email形式
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email：メールアドレスの形式が正しくありません。";
}
// PHP条件5: address（数字不可）
if (preg_match('/[0-9]/', $address)) {
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
            <?php foreach ($errors as $error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
            <button onclick="history.back()" class="btn">戻る</button>
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