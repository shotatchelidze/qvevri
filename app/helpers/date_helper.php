<?php
function multilanguage_date($date)
{

    $language_ge = [
        'Jan' => 'იანვარი',
        'Feb' => 'თებერვალი',
        'Mar' => 'მარტი',
        'Apr' => 'აპრილი',
        'May' => 'მაისი',
        'Jun' => 'ივლისი',
        'Jul' => 'ივნისი',
        'Aug' => 'აგვისტო',
        'Sep' => 'სექტემბერი',
        'Oct' => 'ოქტომბერი',
        'Nov' => 'ნოემბერი',
        'Dec' => 'დეკემბერი'
    ];

    $language_ru = [
        'Jan' => 'Январь',
        'Feb' => 'Февраль',
        'Mar' => 'Март',
        'Apr' => 'Апрель',
        'May' => 'Май',
        'Jun' => 'Июнь',
        'Jul' => 'Июль',
        'Aug' => 'Август',
        'Sep' => 'Сентябрь',
        'Oct' => 'Октябрь',
        'Nov' => 'Ноябрь',
        'Dec' => 'Декабрь'
    ];


    $month = date('M', strtotime($date));
    $language_month = $month;

    // switch_ში არ მუშაობს isset ი აბრუნებს underfined $_GET['lang']_ს
    if (isset($_GET['lang'])) {

        switch (true) {
            case $_GET['lang'] == 'ge':
                $language_month = $language_ge[$month];
                break;
            case $_GET['lang'] == 'ru':
                $language_month = $language_ru[$month];
                break;
            default:
                $language_month = $month;
        }
    }

    $day = date("d");
    $year = date("Y");
    $date = "$day $language_month, $year";
    
    return $date;
}
