function show_tip(elem, msg, placement) {

    // Show a Tippy tooltip with given msg and placement next to element.

    // https://atomiks.github.io/tippyjs/

    // 1. Show tip and focus element.

    tippy(elem, { content: msg, placement: placement, arrow: true })
    elem._tippy.show();

    const hasValue = 'value' in elem;
    const isDateInput = elem.type === "date";
    const hasSelectionRange = 'setSelectionRange' in elem;

    if (hasValue && hasSelectionRange && !isDateInput)
        elem.setSelectionRange(0, elem.value.length);

    elem.focus();

    // 2. Bind blur handler to destroy tip when focus is moved away from element.

    function on_blur() {
        if (elem.hasOwnProperty("_tippy")) {
            elem._tippy.destroy();
        }
    }

    $(elem).blur(on_blur);
    $(elem).keypress(on_blur);

}

function downloadBinaryFile(filename, blob) {

    // Download and save binary object as a file with given filename.

    const url = window.URL.createObjectURL(blob);

    const element = document.createElement('a');
    element.style.display = 'none';
    element.href = url;
    element.download = filename;
    document.body.appendChild(element);
    element.click();

    window.URL.revokeObjectURL(url);
    document.body.removeChild(element);

}

function downloadFile(filename, text) {

    // Download "text" as a file with given filename.

    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}

function showUpdatedToast() {

    const title = arabic ? "تم التحديث بنجاح" : "Updated Successfuly";

    const message_en = "Your new settings have been saved.";
    const message_ar = "تم حفظ إعداداتك الجديدة.";
    const message = arabic ? message_ar : message_en;

    toaster.show(title, message, {type: "success"});
}

function pp(obj) {

    // Pretty-print object.

    const obj_copy = JSON.parse(JSON.stringify(obj));

    const obj_s = JSON.stringify(obj_copy, null, 4);

    console.log(obj_s);
}
