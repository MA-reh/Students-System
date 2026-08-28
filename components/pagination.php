<?php

require_once __DIR__ . "/../backend/getStudents.php";

$currentPage = 1;
$numberOfPages = ceil(getStudentsCount() / 10);

$liHTML = "";




for ($i = 0; $i <= $numberOfPages + 1; $i++) {

    if ($i == 0) {
        $isDisabled = ($currentPage == 1) ? "disabled" : "";
        $prevPage = ($currentPage == 1) ? 1 : $currentPage - 1;

        $liHTML .= " <li class='page-item'><span data-pagination='prev' onclick='paginationClick(`prev`)' class='btn me-2 pages-links prev {$isDisabled}'>Previous</span></li> <br>";
    } else if ($i == $numberOfPages + 1) {
        $isDisabled = ($currentPage == $numberOfPages) ? "disabled" : "";
        $nextPage = ($currentPage == $numberOfPages) ? $numberOfPages : $currentPage + 1;


        $liHTML .= "<li class='page-item'><span data-pagination='next' onclick='paginationClick(`next`)' class='btn pages-links next {$isDisabled}'>Next</span></li> <br>";
    } else {
        $isActive = ($i === (int)$currentPage) ? "active" : "";

        $liHTML .= "<li class='page-item'><span data-pagination='{$i}' onclick='paginationClick({$i})' class='btn me-2 pages-links {$isActive}'>{$i}</span></li> <br>";
    }
}


echo $liHTML;

