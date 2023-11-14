const validationRuleTemplates = {

    // Email

    "email": [
        {
            must: value => value.length > 0,
            else_text: "Please enter an email address",
            else_ar_text: "الرجاء إدخال عنوان بريد إلكتروني",
        },
        {
            must: value => contains(value, "@") && contains(value, "."),
            else_text: "Please enter a valid email address",
            else_ar_text: "الرجاء إدخال عنوان بريد إلكتروني صحيح",
        },
        {
            must: value => !contains(value, " "),
            else_text: "Email address cannot contain spaces",
            else_ar_text: "لا يمكن أن يحتوي عنوان البريد الإلكتروني على مسافات",
        },
    ],

    // Password

    "password": [
        {
            must: value => value.length > 0,
            else_text: "Please select a password (6 chars min)",
            else_ar_text: "الرجاء إختيار كلمة السر (ستة رموز أو أكثر)",
        },
        {
            must: value => value.length >= 6,
            else_text: "Please select a longer password (6 chars min)",
            else_ar_text: "الرجاء إختيار كلمة سر أطول (ستة رموز أو أكثر)",
        },
    ],

    // First name

    "first-name": [
        {
            must: value => value.length > 0,
            else_text: "Please enter your first name",
            else_ar_text: "الرجاء إدخال اسمك الأول",
        },
    ],

    // Last name

    "last-name": [
        {
            must: value => value.length > 0,
            else_text: "Please enter your last name",
            else_ar_text: "الرجاء إدخال إسم عائلتك",
        },
    ],

    // Generic required field

    "required": [
        {
            must: value => value.length > 0,
            else_text: "Please fill this field",
            else_ar_text: "يرجى تعبئة هذا الحقل",
        },
    ],

};
