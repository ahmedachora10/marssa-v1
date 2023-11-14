const validate2 = (function() {

    // Constants

    const RULES = {
        "email": [
            {
                "check": value => contains(value, "@") && contains(value, "."),
                "message": {
                    "en": "Please enter a valid email address",
                    "ar": "الرجاء إدخال عنوان بريد إلكتروني صحيح",
                }
            },
            {
                "check": value => !contains(value, " "),
                "message": {
                    "en": "Email address cannot contain spaces",
                    "ar": "لا يمكن أن يحتوي عنوان البريد الإلكتروني على مسافات",
                }
            },
        ],
        "sku": [
            {
                "check": value => !contains(value, " "),
                "message": {
                    "en": "The SKU cannot contain spaces",
                    "ar": "لا يمكن لوحدة حفظ المخزون أن تحتوي على مسافات",
                }
            },
            {
                // RegEx defined checks for that used characters are all either word characters (includes _ )
                // or one of the allowed non-word special characters: \ | / ( ) . -
                "check": value => !value.match(/[^\w.|()/\\\-]/),
                "message": {
                    "en": "The SKU can only contain these special characters:  \\ | / . - _ ( )",
                    "ar": " يمكن لوحدة حفظ المخزون أن تحتوي فقط على هذه الرموز : \\ | / . - _ ( ) ",
                }
            },
        ],
        "password": [
            {
                "check": value => value.length >= 6,
                "message": {
                    "en": "Please select a longer password (6 chars min)",
                    "ar": "الرجاء إختيار كلمة سر أطول (ستة رموز أو أكثر)",
                }
            },
        ],
        "number": [
            {
                "check": value => !isNaN(Number(value)),
                "message": {
                    "en": "Please enter a number",
                    "ar": "يرجى إدخال رقم",
                }
            }
        ],
        "positive": [
            {
                "check": value => Number(value) >= 0,
                "message": {
                    "en": "Please enter a positive number",
                    "ar": "يرجى إدخال رقم موجب",
                }
            }
        ],
        "integer": [
            {
                "check": value => Number.isInteger(Number(value)),
                "message": {
                    "en": "Please enter an integer",
                    "ar": "يرجى إدخال عدد صحيح",
                }
            }
        ],
        "percentage": [
            {
                "check": value => (parseFloat(value) >= 0) && (parseFloat(value) <= 100),
                "message": {
                    "en": "Please enter a percentage (between 0 and 100)",
                    "ar": "يرجى إدخال نسبة مئوية (رقم من صفر إلى مئة)",
                }
            }
        ],
        "not-zero": [
            {
                "check": value => Number(value) != 0,
                "message": {
                    "en": "This value cannot be zero",
                    "ar": "لا يمكن أن تكون هذه القيمة صفراً",
                }
            }
        ],
        "url": [
            {
                "check": value => value.toLocaleLowerCase().startsWith("http://") || value.toLocaleLowerCase().startsWith("https://"),
                "message": {
                    "en": "URLs must start with http:// or https://",
                    "ar": "يرجى إدخال الرابط كاملا (مع البروتوكول في المقدمة)",
                }
            }
        ],
        "slug": [
            {
                "check": value => slugify(value) == value,
                "message": {
                    "en": "Please use lower alphanumeric and dash characters only",
                    "ar": "يرجى استخدام الحروف الصغيرة والأرقام الإنجليزية فقط",
                }
            }
        ],
        "selection": [
            {
                "check": array => array.length > 0 ,
                "message": {
                    "en": "Please select an option",
                    "ar": "يرجى اختيار أحد الخيارات",
                }
            }
        ],
        "time_24h": [
            {
                "check": checkTime24h,
                "message": {
                    "en": "Please enter time in 24h format (for example 08:00)",
                    "ar": "الرجاء إدخال الوقت بصيغة 24 ساعة (08:00 مثلاً)",
                }
            }
        ]
    };

    const ruleRequired = {
        "check": value => value !== "",
        "message": {
            "en": "This field is required",
            "ar": "هذا الحقل مطلوب",
        }
    }


    // Primitives


    function contains(str, substr) {
        return str.indexOf(substr) != -1;
    }


    // Helper functions


    function slugify(string) {
        const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
        const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
        const p = new RegExp(a.split('').join('|'), 'g')

        return string.toString().toLowerCase()
            .replace(/\s+/g, '-')                    // Replace spaces with -
            .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
            .replace(/&/g, '-and-')                  // Replace & with 'and'
            .replace(/[^\w\-]+/g, '')                // Remove all non-word characters
            .replace(/\-\-+/g, '-')                  // Replace multiple - with single -
            .replace(/^-+/, '')                      // Trim - from start of text
            .replace(/-+$/, '')                      // Trim - from end of text
    }

    function checkTime24h(value) {

        // Return true iff value is a string representing time in 24h format.

        if (value.length != 5)
            return false;

        if (!value.includes(":"))
            return false;

        const parts = value.split(":");

        if (parts.length != 2)
            return false;

        const [hour, minute] = parts.map(Number);

        if (isNaN(hour) || isNaN(minute))
            return false;

        if (hour < 0 || hour > 23)
            return false;

        if (minute < 0 || minute > 59)
            return false;

        return true;

    }


    // Wrappers to get values from flexible descriptions


    function getElementObject(element) {

        // Return element from a flexible specification (String selector or DOM object).

        const isObject = typeof element === "object";
        return isObject ? element : document.querySelector(element);
    }


    function getPosition(tipPosition) {

        // Return position of tip (String) from a flexible specification (String
        // or [English String, Arabic String]).

        const type = typeof tipPosition;

        if (type === "string")
            return tipPosition;

        else
            return arabic ? tipPosition[1]: tipPosition[0];

    }

    function getLocalMessage(message) {

        // Return tip message (String) from a flexible specification (String or
        // {ar: String, en: String}).

        const type = typeof message;

        if (type === "string")
            return message;

        else
            return arabic ? message.ar : message.en;
    }

    function getRules(fieldType) {

        // Return rules (Array) from a flexible specification (String or Array).

        const type = typeof fieldType;

        if (type === "string")
            return RULES[fieldType];

        else
            return fieldType;
    }


    // Helpers


    function getFieldValue(field) {

        // Get field value.

        // If a function field.valueGetter is supplied, it is used to read the
        // field's value. Otherwise, the value is read from the field element.

        const hasGetter = "valueGetter" in field
            && (typeof field.valueGetter === "function");
        const defaultGetter = () => getElementObject(field.element).value;
        return hasGetter ? field.valueGetter() : defaultGetter();

    }


    function isFieldEmpty(field) {
        return getFieldValue(field) === "";
    }


    // Core functions


    function showFieldTip(field, message) {

        const defaultPosition = ["right", "left"];
        const {element, tipElement, tipPosition} = field;

        const position = getPosition(field.tipPosition || defaultPosition);
        const localMessage = getLocalMessage(message);
        const tipElementObject = getElementObject(tipElement || element);

        show_tip(tipElementObject, localMessage, position);
    }


    function checkRule(field, rule) {

        const value = getFieldValue(field);

        if (rule.check(value)) {

            return true;  // pass

        } else {

            // Otherwise, fail ...

            const message = arabic ? rule.message.ar : rule.message.en;

            showFieldTip(field, message);

            return false;

        }

    }

    function validate2(fields) {

        // Check field values

        for (const field of fields) {

            const required = field.required === undefined ? true : field.required;

            if (required && !checkRule(field, ruleRequired))
                return false;  // fail validation (required field is empty)

            const {types = []} = field;

            for (const type of types) {

                if (isFieldEmpty(field) && !required)
                    continue;  // field has no value and is not required so ignore

                const rules = getRules(type);

                const allRulesPass = rules.every(rule => checkRule(field, rule));

                if (!allRulesPass)
                    return false;  // fail validation

            }

        }

        return true;

    }

    return validate2;

})();
