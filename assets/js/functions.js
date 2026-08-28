let currentIndicator = 1,
    numberOfPages,
    searchValue = "";


function confirm(functionName, idStudent) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            functionName(idStudent);
        }

    });
}

function deleteStudent(idStudent) {

    $.ajax({
        url: "backend/deleteStudent.php",
        type: "POST",
        data: { tableName: "students", id: idStudent },
        success: function (data$) {
            console.log(data$);
            Swal.fire({
                title: "Deleted!",
                text: "the Student has been deleted.",
                icon: "success"
            });

            $(`table tbody tr[data-id="${idStudent}"]`).remove();

            let totalOfTr = document.querySelectorAll("table tbody tr");

            if (!(totalOfTr.length > 0)) {
                --currentIndicator;
                newSearchAjax(searchValue, currentIndicator);
            }

        },
        error: function (error) {
            console.log(error);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: error["responseJSON"]["message"],
            });


        }
    })


}

function pagination(total, page) {
    $("ul.pagination").html("");
    let currentPage = page;
    let liHTML = "";
    numberOfPages = Math.ceil(total / 10);

    let valueOfSearch = $('#formSearch input')[0].value;
    if (total !== 0) {

        for (let i = 0; i <= numberOfPages + 1; i++) {


            if (i == 0) {
                let isDisabled = (currentPage == 1) ? "disabled" : "";
                let prevPage = (currentPage == 1) ? 1 : currentPage - 1;

                liHTML += `<li class='page-item'><span data-pagination="prev" onclick='paginationClick("prev")' class='btn me-2 pages-links prev ${isDisabled}'>Previous</span></li>`;
            } else if (i == numberOfPages + 1) {
                let isDisabled = (currentPage == numberOfPages) ? "disabled" : "";
                let nextPage = (currentPage == numberOfPages) ? numberOfPages : currentPage + 1;

                liHTML += `<li class='page-item'><span data-pagination="next" onclick='paginationClick("next")' class='btn pages-links next ${isDisabled}'>Next</span></li>`;
            } else {
                let isActive = (i === currentPage) ? "active" : "";

                liHTML += `<li class='page-item'><span data-pagination="${i}" onclick='paginationClick(${i})' class='btn me-2 pages-links  ${isActive}'>${i}</span></li>`;
            }
        }
    }


    $("ul.pagination").append(liHTML);

}

function newSearchAjax(search, indicatorNumber = 1) {

    $.ajax({
        url: 'backend/search.php',
        type: 'POST',
        data: {
            "search": search,
            "page": indicatorNumber
        },
        success: function (data$) {
            let searchStudents$ = data$.search,
                htmlTrTable$ = '';


            $("#StudentSystem .table-responsive > table tbody").html("");

            if (searchStudents$.length > 0) {
                searchStudents$.forEach((student, index) => {

                    let shortPass = student.password.slice(0, 15);

                    htmlTrTable$ += `
                <tr data-id='${student.id}'>
                    <th scope='row'>${student.id}</th>
                    <td>${student.first_name} ${student.last_name}</td>
                    <td>${student.email}</td>
                    <td>${shortPass}...</td>
                    <td>${student.age}</td>
                        <td>${student.phone}</td>
                        <td>
                            <div class='buttons'>
                                <a href='editStudent.php?id=${student['id']}' class='btn btn-info text-light me-1'>Edit</a>
                                <button class='btn btn-danger' onclick='confirm(deleteStudent,${student.id})'>Delete</button>
                            </div>
                        </td>
                        </tr>`;

                });

                pagination(data$["total"], indicatorNumber);

                $("#StudentSystem .table-responsive >h6").addClass("d-none");
                $("#StudentSystem .table-responsive >h6").removeClass("d-block");
                $("#StudentSystem .table-responsive >table").removeClass("d-none");
            } else {
                pagination(data$["total"], indicatorNumber);

                $("#StudentSystem .table-responsive >table").addClass("d-none");
                $("#StudentSystem .table-responsive >h6").removeClass("d-none");
                $("#StudentSystem .table-responsive >h6").addClass("d-block");
            }

            $("#StudentSystem .table-responsive >table tbody").html(htmlTrTable$);

        },
        error: function (error) {
            Swal.fire({
                icon: "error",
                title: "You Are Write That Search You",
                text: error["responseJSON"]["message"],
            });
        },
    });

}

function paginationClick(contentBtn) {

    let indicator = document.querySelector(`li .pages-links[data-pagination="${contentBtn}"]`) ?? undefined;

    console.log(indicator);


    if (indicator.classList.contains("active") || indicator.classList.contains("disabled")) return;


    if (contentBtn == "prev") {
        currentIndicator = (currentIndicator > 1) ? --currentIndicator : 1;

        newSearchAjax(searchValue, currentIndicator);

    } else if (contentBtn == "next") {

        currentIndicator = (currentIndicator >= numberOfPages) ? numberOfPages : ++currentIndicator;

        newSearchAjax(searchValue, currentIndicator);
    } else {
        let activeIndicator = document.querySelector(`li .pages-links.active`);

        currentIndicator = contentBtn;


        setTimeout(function () {
            activeIndicator.classList.remove("active");
            indicator.classList.add("active");
        }, 10);


        newSearchAjax(searchValue, contentBtn);
    }


}