<?php

return [
    // 公開中の投稿・認証画面で使う入力ルール。
    'required' => ':attributeを入力してください。',
    'string' => ':attributeは文字列で入力してください。',
    'email' => ':attributeは有効なメールアドレスを入力してください。',
    'lowercase' => ':attributeは小文字で入力してください。',
    'unique' => 'この:attributeはすでに登録されています。',
    'confirmed' => ':attributeと確認用の入力が一致しません。',
    'current_password' => '現在のパスワードが正しくありません。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
        'numeric' => ':attributeは:min以上で入力してください。',
        'array' => ':attributeは:min個以上指定してください。',
        'file' => ':attributeは:minKB以上のファイルを指定してください。',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
        'numeric' => ':attributeは:max以下で入力してください。',
        'array' => ':attributeは:max個以内で指定してください。',
        'file' => ':attributeは:maxKB以下のファイルを指定してください。',
    ],
    'password' => [
        'letters' => ':attributeには英字を含めてください。',
        'mixed' => ':attributeには大文字と小文字の両方を含めてください。',
        'numbers' => ':attributeには数字を含めてください。',
        'symbols' => ':attributeには記号を含めてください。',
        'uncompromised' => 'この:attributeは安全ではありません。別の:attributeを指定してください。',
    ],
    'attributes' => [
        'name' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認）',
        'content' => '投稿内容',
        'token' => '再設定用のトークン',
    ],
];
