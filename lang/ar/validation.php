<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول  :attribute',
    'active_url' => ':attribute ليست عنوان URL صالحًا.',
    'after' => 'يجب أن تكون خاصية :attribute بعد تاريخ :date.',
    'after_or_equal' => 'يجب أن تكون خاصية :attribute بعد أو يساوي تاريخ  :date.',
    'alpha' => ' خاصية :attribute يمكن أن تقبل الأحرف فقط.',
    'alpha_dash' => ' خاصية :attribute يمكن أن تقبل الأحرف والأرقام و - و / فقط.',
    'alpha_num' => ' سمة :attribute يمكن أن تقبل الأحرف والأرقام فقط.',
    'array' => 'سمة :attribute يجب أن تكون مصفوفة.',
    'before' => 'سمة :attribute يجب أن تكون قبل تاريخ :date.',
    'before_or_equal' => 'يجب أن تكون خاصية :attribute قبل أو يساوي تاريخ  :date.',
    'between' => [
        'numeric' => ' :attribute يجب أن تكون بين :min and :max.',
        'file' => ' :attribute يجب أن تكون بين :min and :max كيلو بايت.',
        'string' => ' :attribute يجب أن تكون بين :min and :max أحرف.',
        'array' => ' :attribute يجب أن تكون بين :min and :max عناصر.',
    ],
    'boolean' => 'خاصية :attribute يجب أن يكون حقل صحيحًا أو خطأ.',
    'confirmed' => ' :attribute التأكيد غير متطابق.',
    'date' => ' :attribute هذا ليس تاريخ صحيح.',
    'date_equals' => ' :attribute يجب أن تكون تاريخ يساوي :date.',
    'date_format' => ' :attribute لا يطابق التنسيق :format.',
    'different' => ' :attribute و :other يجب أن تكون مختلف.',
    'digits' => ' :attribute يجب أن :digits أرقام.',
    'digits_between' => ' :attribute يجب ان تكون بين :min and :max أرقام.',
    'dimensions' => ' :attribute أبعاد الصورة غير صالحة.',
    'distinct' => ' :attribute حقل له قيمة مكررة.',
    'email' => ' :attribute يجب أن تكون عنوان بريد إلكتروني صالح.',
    'ends_with' => ' :attribute يجب أن تنتهي بأحد الأمور التالية: :values',
    'exists' => ' selected :attribute غير صالحة.',
    'file' => ' :attribute يجب أن تكون ملف.',
    'filled' => ' :attribute يجب أن يكون للحقل قيمة.',
    'gt' => [
        'numeric' => ' :attribute يجب أن تكون أكبر من :value.',
        'file' => ' :attribute يجب أن تكون أكبر من :value كيلو بايت.',
        'string' => ' :attribute يجب أن تكون أكبر من :value أحرف.',
        'array' => ' :attribute يجب أن تكون أكبر من :value عناصر.',
    ],
    'gte' => [
        'numeric' => ' :attribute يجب أن تكون أكبر من أو يساوي :value.',
        'file' => ' :attribute يجب أن تكون أكبر من أو يساوي :value كيلو بايت.',
        'string' => ' :attribute يجب أن تكون أكبر من أو يساوي :value أحرف.',
        'array' => ' :attribute يجب أن تكون أكبر من أو يساوي :value عناصر.',
    ],
    'image' => ' :attribute يجب أن تكون صورة.',
    'in' => ' selected :attribute غير صالحة.',
    'in_array' => ' :attribute حقل غير موجود في :other.',
    'integer' => ' :attribute يجب أن تكون صحيحا.',
    'ip' => ' :attribute يجب أن تكون عنوان IP صالحًا.',
    'ipv4' => ' :attribute يجب أن تكون عنوان IPv4 صالحًا.',
    'ipv6' => ' :attribute يجب أن تكون عنوان IPv6 صالحًا.',
    'json' => ' :attribute يجب أن تكون سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => ' :attribute يجب أن تكون أصغر من :value.',
        'file' => ' :attribute يجب أن تكون أصغر من :value كيلو بايت.',
        'string' => ' :attribute يجب أن تكون أصغر من :value أحرف.',
        'array' => ' :attribute يجب أن تكون أصغر من :value عناصر.',
    ],
    'lte' => [
        'numeric' => ' :attribute يجب أن تكون أصغر من أو يساوي :value.',
        'file' => ' :attribute يجب أن تكون أصغر من أو يساوي :value كيلو بايت.',
        'string' => ' :attribute يجب أن تكون أصغر من أو يساوي :value أحرف.',
        'array' => ' :attribute يجب أن تكون أصغر من أو يساوي :value عناصر.',
    ],
    'max' => [
        'numeric' => ' :attribute قد لا تكون أكبر من :max.',
        'file' => ' :attribute قد لا تكون أكبر من :max كيلو بايت.',
        'string' => ' :attribute قد لا تكون أكبر من :max أحرف.',
        'array' => ' :attribute قد لا تكون أكبر من :max عناصر.',
    ],
    'mimes' => ' :attribute يجب أن تكون ملف من النوع: :values.',
    'mimetypes' => ' :attribute يجب أن تكون ملف من النوع: :values.',
    'min' => [
        'numeric' => ' :attribute لا بد أن تكون على الأقل :min.',
        'file' => ' :attribute لا بد أن تكون على الأقل :min كيلو بايت.',
        'string' => ' :attribute لا بد أن تكون على الأقل :min أحرف.',
        'array' => ' :attribute لا بد أن تكون على الأقل :min عناصر.',
    ],
    'not_in' => ' selected :attribute غير صالحة.',
    'not_regex' => ' :attribute التنسيق غير صالح.',
    'numeric' => ' :attribute يجب أن تكون رقما.',
    'present' => ' :attribute يجب أن يكون حقل موجودًا.',
    'regex' => ' :attribute التنسيق غير صالح.',
    'required' => ' :attribute حقل مطلوب.',
    'required_if' => ' :attribute حقل مطلوب عندما :other تكون :value.',
    'required_unless' => ' :attribute حقل مطلوب إلا :other تكون في :values.',
    'required_with' => ' :attribute حقل مطلوب عندما :values موجود .',
    'required_with_all' => ' :attribute حقل مطلوب عندما :values موجودة.',
    'required_without' => ' :attribute حقل مطلوب عندما :values غير موجود.',
    'required_without_all' => ' :attribute حقل مطلوب عندما لا شيء من :values موجودة.',
    'same' => ' :attribute و :other يجب أن تتطابق.',
    'size' => [
        'numeric' => ' :attribute يجب أن :size.',
        'file' => ' :attribute يجب أن :size كيلو بايت.',
        'string' => ' :attribute يجب أن :size أحرف.',
        'array' => ' :attribute يجب أن :size عناصر.',
    ],
    'starts_with' => ' :attribute يجب أن تبدأ بأحد الإجراءات التالية: :values',
    'string' => ' :attribute يجب أن تكون سلسلة نصية.',
    'timezone' => ' :attribute يجب أن تكون منطقة صالحة.',
    'unique' => ' :attribute لقد استخدمت بالفعل.',
    'uploaded' => ' :attribute فشل في التحميل.',
    'url' => ' :attribute التنسيق غير صالح.',
    'uuid' => ' :attribute يجب أن تكون UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'bill' => [
            'required' => 'يرجى إرفاق الفاتورة في الطلب',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'username' => 'اسم المستخدم',
        'email' => 'البريد الالكتروني',
        'password' => 'كلمة المرور',
        'store'   => 'المتجر',
        'name'    => 'الاسم',
    ],

];
