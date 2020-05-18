<?php
function pagination($page_name){

    $controller = new Controller;
    $paginationModel = $controller->model('Pagination_admin');
    
    $number_of_results = $paginationModel->recordCount($page_name);

    // define how many results you want per page
    if (!isset($_POST['result_per_page'])) {
        $results_per_page = (int) $paginationModel->getResultPerPage($page_name);
        if (!$results_per_page) {
            die('Something went wrong reload page');
        }
    } else {
        $results_per_page = (int) $_POST['result_per_page'];
        // Save result per page in db
        if (!$paginationModel->updateResultPerPage($results_per_page, $page_name)) die("something went worng reload page");
    }

    // determine number of total pages available
    $number_of_pages = ceil($number_of_results / $results_per_page);
    // determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = filter_var($_GET['page'], FILTER_VALIDATE_INT);
        if ($page === false) {
            $page = 1;
        }
    }
    // determine the sql LIMIT starting number for the results on the displaying page
    $this_page_first_result = ($page - 1) * $results_per_page;

    return $result = ['this_page_first_result' => $this_page_first_result,'number_of_pages' => $number_of_pages, 'results_per_page' => $results_per_page];

}