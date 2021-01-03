function passcodeBox() {
    // Get the checkbox
    var checkBox = document.getElementById("forcePassCode");
    // Get the output text
    var box = document.getElementById("passbox");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
        box.disabled = false;
    } else {
        box.value = "";
        box.disabled = true;
        box.classList.remove("is-valid");
    }
}


function validLongURL() {

    var box = document.getElementById("longurl");
    str = box.value;

    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator



    if (!!pattern.test(str)) {
        box.classList.add("is-valid");
        return true;
    }
    else {
        box.classList.remove("is-valid");
        return false;
    }

}




function validSubmit() {

    var btn = document.getElementById("create");

    var box = document.getElementById("shorturl");
    var str = box.value;

    let flag = true;

    if (str.length) {
        flag = validCustomURL();
        // flag = true;
    }
    else {
        // flag = true;
        box.classList.remove("is-valid");
    }
    // console.log(flag);



    if (validLongURL()) {
        btn.disabled = false;
    }
    else {
        btn.disabled = true;
    }

}

function validCustomURL() {

    var pattern = new RegExp('/^[a-z0-9]+$/i');

    var box = document.getElementById("shorturl");
    var str = box.value;
    str = str.replace(/\W/g, '');
    // str = str.replace(" ", "");

    box.value = str;
    if (!isNaN(str)) {
        box.classList.remove("is-valid");
        return false;
    }


    // if (str.length == 0) {
    //     box.classList.remove("is-valid");
    //     return true;
    // }

    const xhr = new XMLHttpRequest();

    var url = "api.php?custom=" + str;

    xhr.open('GET', url, true);

    var flag = '';
    // What to do when response is ready
    xhr.onload = function () {
        if (this.status === 200) {
            flag = parseInt(this.responseText);

            if (flag) {
                box.classList.add("is-valid");
                return true;
            }
            else {
                box.classList.remove("is-valid");
                return false;
            }
        }
        else {
            console.log("Some error occured");
            return false;
        }
    }

    // send the request
    xhr.send();
}


function validPassCode() {
    var box = document.getElementById("passbox");
    str = box.value;

    if (str.length > 1) {
        box.classList.add("is-valid");
    }
    else {
        box.classList.remove("is-valid");
    }
}



function validPreview() {

    var box = document.getElementById("shorturl");
    // var site = document.getElementById("website");
    var btn = document.getElementById("shorturl-btn");
    str = box.value;
    list = str.split("/");
    custom = "preview.php?link=" + list[list.length - 1];
    btn.href = custom;
}

function copyToClickboard() {
    /* Get the text field */
    var copyText = document.getElementById("shorturl");

    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");
}



