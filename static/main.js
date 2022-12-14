const form = document.getElementById('ajax-form');
const action = window.location.pathname;
let data;
let button = document.getElementById('submit');

function showErrorsOrRedirect(errors)
{
    if (errors)
    {
        for (let key in errors)
        {
            let item = document.getElementById(key);
            item.innerHTML = errors[key];
            let id = key.slice(0, -6);
            item = document.querySelector(`[id=${id}]`)
            item.className = item.className + " is-danger";
        }
    }
    else window.location.replace('/');
}
document.addEventListener('keypress', (event) =>
{
    let keyCode = event.keyCode ? event.keyCode : event.which;
    if (keyCode === 13)
    {
        button.click();
    }

});
button.onclick = function (event)
{
    event.preventDefault();
    const formattedFormData = new FormData(form);
    formattedFormData.append('action', action)
    document.querySelectorAll(`[id$="error"]`).forEach(function (item) {
        item.innerHTML = "";
    })
    document.querySelectorAll(`[class="input is-danger"]`).forEach(function (item) {
        item.className = "input";
    })
    postData(formattedFormData);
};

async function postData(formattedFormData) {
    const response = await fetch("/index.php", {
        method: 'POST',
        body: formattedFormData
    });
    data = await response.json();
    showErrorsOrRedirect(data["errors"]);
}

