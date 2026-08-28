
document.addEventListener("DOMContentLoaded", function () {
    loadingPage.classList.add("fade");
    setTimeout(function () {
        loadingPage.classList.add("none");
    }, 1000)
});

$('#formSearch').submit(function (e) {
    e.preventDefault();

    let dataForm = new FormData(this);

    searchValue = $('#formSearch')[0].querySelector("input").value;

    newSearchAjax(searchValue, currentIndicator);
});

