<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MyCustom Package Text
    |--------------------------------------------------------------------------
    |
    | バリデーションで使用する単語・メッセージの定義
    |
    */

    /**
     * バリデーションエラーメッセージ
     * 
     * バリデーションルール => バリデーションエラーメッセージ
     * 
     */
    "accepted"             => ":attributeを承認してください。",
    "accepted_if"          => ":otherが:valueの場合は:attributeを承認してください。",
    "active_url"           => ":attributeが有効なURLではありません。",
    "after"                => ":attributeには:dateより後の日付を指定してください。",
    "after_or_equal"       => ":attributeには:date以降の日付を指定してください。",
    "alpha"                => ":attributeはアルファベットのみがご利用できます。",
    "alpha_dash"           => ":attributeはアルファベットとダッシュ(-)及び下線(_)がご利用できます。",
    "alpha_num"            => ":attributeはアルファベット数字がご利用できます。",
    "array"                => ":attributeは配列でなくてはなりません。",
    "ascii"                => ":attributeにはアスキー文字を指定してください",
    "before"               => ":attributeには:dateより前の日付をご利用ください。",
    "before_or_equal"      => ":attributeには:date以前の日付をご利用ください。",
    "between"              => [
        "array"   => ":attributeは:min個から:max個の間で指定してください。",
        "file"    => ":attributeは:minkBから:maxkBの間で指定してください。",
        "numeric" => ":attributeは:minから:maxの間で指定してください。",
        "string"  => ":attributeは:min文字から:max文字の間で指定してください。",
    ],
    "boolean"              => ":attributeにはtrueかfalseを指定してください。",
    "confirmed"            => ":attributeと確認フィールドとが一致していません。",
    "current_password"     => "パスワードが正しくありません。",
    "date"                 => ":attributeには有効な日付を指定してください。",
    "date_equals"          => ":attributeには:dateと同じ日付けを指定してください。",
    "date_format"          => ":attributeは:format形式で指定してください。",
    "decimal"              => ":attributeは小数点第:decimal位以下の桁数が必要です。",
    "declined"             => ":attributeを承認しないでください。",
    "declined_if"          => ":otherが:valueの場合は:attributeをしないでください。",
    "different"            => ":attributeと:otherには異なった内容を指定してください。",
    "digits"               => ":attributeは:digits桁で指定してください。",
    "digits_between"       => ":attributeは:min桁から:max桁の間で指定してください。",
    "dimensions"           => ":attributeの図形サイズが正しくありません。",
    "distinct"             => ":attributeには異なった値を指定してください。",
    "doesnt_end_with"      => ":attributeは:valuesのいずれかで終わらせることは出来ません。",
    "doesnt_start_with"    => ":attributeは:valuesのいずれかで始めることは出来ません。",
    "email"                => ":attributeには有効なメールアドレスを指定してください。",
    "ends_with"            => ":attributeには:valuesのどれかで終わる値を指定してください。",
    "enum"                 => ":attributeは指定できません。",
    "exists"               => "選択された:attributeは正しくありません。",
    "file"                 => ":attributeにはファイルを指定してください。",
    "filled"               => ":attributeに値を指定してください。",
    "gt"                   => [
        "array"   => ":attributeには:value個より多くのアイテムを指定してください。",
        "file"    => ":attributeには:value kBより大きなファイルを指定してください。",
        "numeric" => ":attributeには:valueより大きな値を指定してください。",
        "string"  => ":attributeは:value文字より長く指定してください。",
    ],
    "gte"                  => [
        "array"   => ":attributeには:value個以上のアイテムを指定してください。",
        "file"    => ":attributeには:value kB以上のファイルを指定してください。",
        "numeric" => ":attributeには:value以上の値を指定してください。",
        "string"  => ":attributeは:value文字以上で指定してください。",
    ],
    "image"                => ":attributeには画像ファイルを指定してください。",
    "in"                   => "選択された:attributeは正しくありません。",
    "in_array"             => ":attributeには:otherの値を指定してください。",
    "integer"              => ":attributeは整数で指定してください。",
    "ip"                   => ":attributeには有効なIPアドレスを指定してください。",
    "ipv4"                 => ":attributeには有効なIPv4アドレスを指定してください。",
    "ipv6"                 => ":attributeには有効なIPv6アドレスを指定してください。",
    "json"                 => ":attributeには有効なJSON文字列を指定してください。",
    "lowercase"            => ":attributeは大文字でなければなりません。",
    "lt"                   => [
        "array"   => ":attributeには:value個より少ないアイテムを指定してください。",
        "file"    => ":attributeには:value kBより小さなファイルを指定してください。",
        "numeric" => ":attributeには:valueより小さな値を指定してください。",
        "string"  => ":attributeは:value文字より短く指定してください。",
    ],
    "lte"                  => [
        "array"   => ":attributeには:value個以下のアイテムを指定してください。",
        "file"    => ":attributeには:value kB以下のファイルを指定してください。",
        "numeric" => ":attributeには:value以下の値を指定してください。",
        "string"  => ":attributeは:value文字以下で指定してください。",
    ],
    "mac_address"          => ":attributeに有効なMACアドレスを指定してください。",
    "max"                  => [
        "array"   => ":attributeは:max個以下指定してください。",
        "file"    => ":attributeには:max kB以下のファイルを指定してください。",
        "numeric" => ":attributeには:max以下の数字を指定してください。",
        "string"  => ":attributeは:max文字以下で指定してください。",
    ],
    "max_digits"           => ":attributeは:digits桁以下で指定してください。",
    "mimes"                => ":attributeには:valuesタイプのファイルを指定してください。",
    "mimetypes"            => ":attributeには:valuesタイプのファイルを指定してください。",
    "min"                  => [
        "array"   => ":attributeは:min個以上指定してください。",
        "file"    => ":attributeには:min kB以上のファイルを指定してください。",
        "numeric" => ":attributeには:min以上の数字を指定してください。",
        "string"  => ":attributeは:min文字以上で指定してください。",
    ],
    "min_digits"           => ":attributeは:digits桁以上で指定してください。",
    "missing"              => ":attributeを指定しないでください。",
    "missing_if"           => ":otherが:valueの場合:attributeを指定しないでください。",
    "missing_unless"       => ":otherが:valuesでない場合:attributeを指定しないでください。",
    "missing_with"         => ":valuesを指定する場合は:attributeを指定しないでください。",
    "missing_with_all"     => ":valuesを指定する場合は:attributeを指定しないでください。",
    "multiple_of"          => ":attributeには:valueの倍数を指定してください。",
    "not_in"               => "選択された:attributeは正しくありません。",
    "not_regex"            => ":attributeの形式が正しくありません。",
    "numeric"              => ":attributeには数字を指定してください。",
    "password"             => [
        "letters"       => ":attributeには少なくとも1つの文字が含まれている必要があります。",
        "mixed"         => ":attributeには少なくとも大文字小文字を1つずつ含まれている必要があります。",
        "numbers"       => ":attributeには少なくとも1つの数字が含まれている必要があります。",
        "symbols"       => ":attributeには少なくとも1つの記号が含まれている必要があります。",
        "uncompromised" => ":attributeはパスワード漏洩が確認されているため使用できません。",
    ],
    "present"              => ":attributeが存在していません。",
    "prohibited"           => ":attributeは入力禁止です。",
    "prohibited_if"        => ":otherが:valueの場合:attributeは入力禁止です。",
    "prohibited_unless"    => ":otherが:valueでない場合:attributeは入力禁止です。",
    "prohibits"            => "attributeは:otherの入力を禁じています。",
    "regex"                => ":attributeに正しい形式を指定してください。",
    "required"             => ":attributeは必ず指定してください。",
    "required_array_keys"  => ":attributeには:values のキーを含めてください。",
    "required_if"          => ":otherが:valueの場合:attributeも指定してください。",
    "required_if_accepted" => ":otherが承認されている場合:attributeも指定してください。",
    "required_unless"      => ":otherが:valuesでない場合:attributeを指定してください。",
    "required_with"        => ":valuesを指定する場合は:attributeも指定してください。",
    "required_with_all"    => ":valuesを指定する場合は:attributeも指定してください。",
    "required_without"     => ":valuesを指定しない場合は:attributeを指定してください。",
    "required_without_all" => ":valuesのどれも指定しない場合は:attributeを指定してください。",
    "same"                 => ":attributeと:otherには同じ値を指定してください。",
    "size"                 => [
        "array"   => ":attributeは:size個指定してください。",
        "file"    => ":attributeのファイルは:sizeキロバイトでなくてはなりません。",
        "numeric" => ":attributeは:sizeを指定してください。",
        "string"  => ":attributeは:size文字で指定してください。",
    ],
    "starts_with"          => ":attributeには:valuesのどれかで始まる値を指定してください。",
    "string"               => ":attributeは文字列を指定してください。",
    "timezone"             => ":attributeには有効なゾーンを指定してください。",
    "unique"               => ":attributeの値は既に存在しています。",
    "uploaded"             => ":attributeのアップロードに失敗しました。",
    "uppercase"            => ":attributeは大文字でなければなりません。",
    "url"                  => ":attributeに正しい形式を指定してください。",
    "ulid"                 => ":attributeに有効なULIDを指定してください。",
    "uuid"                 => ":attributeに有効なUUIDを指定してください。",


    /**
     * カスタムバリデーションエラーメッセージ
     * 
     *  custom => [
     *      属性名 => [
     *          カスタムバリデーションルール名 => カスタムバリデーションエラーメッセージ
     *      ]
     *  ]
     * 
     */
    "custom" => [
        "attribute-name" => [
            "rule-name" => "custom-message",
        ],
    ],


    /**
     * カスタムバリデーション属性
     * 
     *  attributes => [
     *      属性名 => 属性名翻訳結果
     *  ]
     * 
     */
    "attributes" => [
        "access"                 => "アクセス",
        "additional"             => "追加項目",
        "address"                => "住所",
        "authentication_code"    => "認証コード",
        "color"                  => "色",
        "comment"                => "コメント",
        "description"            => "説明",
        "email"                  => "メールアドレス",
        "end_date"               => "終了日",
        "facebook_id"            => "Facebook ID",
        "flg"                    => "フラグ",
        "id"                     => "ID",
        "instagram_id"           => "Instagram ID",
        "is_valid"               => "有効フラグ",
        "limit"                  => "リミット",
        "line_id"                => "LINE ID",
        "month"                  => "対象月",
        "name"                   => "名",
        "page"                   => "ページ",
        "password_confirmation"  => "パスワード(確認用)",
        "password"               => "パスワード",
        "post_code"              => "郵便番号",
        "prefecture"             => "都道府県",
        "relation"               => "関係性",
        "role"                   => "役割",
        "start_date"             => "開始日",
        "status"                 => "ステータス",
        "tel"                    => "電話番号",
        "title"                  => "タイトル",
        "token"                  => "トークン",
        "twitter_id"             => "Twitter ID",
        "type"                   => "タイプ",
        "user_id"                => "対象ユーザー",
        "youtube_id"             => "Youtube ID",

        /* unique */
    ],

];
