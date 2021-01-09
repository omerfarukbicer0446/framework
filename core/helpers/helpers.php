<?php

function redirect($link, $time = '')
{
    if ($time == '') {
        header('Location: ' . $link);
    }else {
        header('Refresh: ' . $time . '; url=' . $link);
    }
}

function post($key, $default = 'Bulunamadı')
{
    if (isset($_POST[$key])) {
        return htmlspecialchars($_POST[$key]);
    }else {
        return htmlspecialchars($default);
    }
}

function get($key, $default = 'Bulunamadı')
{
    if (isset($_GET[$key])) {
        return htmlspecialchars($_GET[$key]);
    }else {
        return htmlspecialchars($default);
    }
}

function session($key)
{
    if (isset($_SESSION[$key])) {
        return htmlspecialchars($_SESSION[$key]);
    }else {
        return false;
    }
}

function permalink($str, $options = array())
 {
     $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
     $defaults = array(
         'delimiter' => '-',
         'limit' => null,
         'lowercase' => true,
         'replacements' => array(),
         'transliterate' => true
     );
     $options = array_merge($defaults, $options);
     $char_map = array(
         // Latin
         'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
         'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
         'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
         'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
         'ß' => 'ss',
         'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
         'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
         'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
         'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
         'ÿ' => 'y',
         // Latin symbols
         '©' => '(c)',
         // Greek
         'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
         'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
         'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
         'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
         'Ϋ' => 'Y',
         'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
         'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
         'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
         'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
         'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
         // Turkish
         'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
         'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
         // Russian
         'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
         'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
         'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
         'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
         'Я' => 'Ya',
         'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
         'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
         'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
         'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
         'я' => 'ya',
         // Ukrainian
         'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
         'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
         // Czech
         'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
         'Ž' => 'Z',
         'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
         'ž' => 'z',
         // Polish
         'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
         'Ż' => 'Z',
         'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
         'ż' => 'z',
         // Latvian
         'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
         'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
         'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
         'š' => 's', 'ū' => 'u', 'ž' => 'z'
     );
     $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
     if ($options['transliterate']) {
         $str = str_replace(array_keys($char_map), $char_map, $str);
     }
     $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
     $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
     $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
     $str = trim($str, $options['delimiter']);
     return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
 }

 function timeAgo($dateTime, $full = false)
{
    // Olsuğumuz bölgenin zaman dilimini yazıyoruz
    date_default_timezone_set(getenv('TIMEZONE'));
    $now = new DateTime;
    $ago = new DateTime($dateTime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    // Tarihin sonuna gelen yazılar
    $end = [
    'y' => 'yıl',
    'm' => 'ay',
    'w' => 'hafta',
    'd' => 'gün',
    'h' => 'saat',
    'i' => 'dakika',
    's' => 'saniye'
    ];

    foreach ($end as $k => &$v) {
    if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
    }else {
        unset($end[$k]);
    }
    }

    if (!$full) $end = array_slice($end, 0, 1);
    return $end ? implode(',', $end) . ' önce' : ' şimdi';
}

function numberConverter($number)
{
    $endNumber = ['B', 'Mn', 'Mr', 'Tn'];
    $numberLen = strlen($number);

    if ($numberLen < 4) {
      $formatNumber = $number;
    }elseif ($numberLen >= 4 && $numberLen <= 6) {
      $number = number_format($number);
      $number = array_filter(explode(',', $number));
      if (substr($number[1], 0, 1) == 0) {
        $formatNumber = $number[0] . ' ' . $endNumber[0];
      }else {
        $formatNumber = $number[0] . ',' . substr($number[1], 0, 1) . ' ' . $endNumber[0];
      }
    }elseif ($numberLen >= 7 && $numberLen <= 9) {
      $number = number_format($number);
      $number = array_filter(explode(',', $number));
      if (substr($number[1], 0, 1) == 0) {
        $formatNumber = $number[0] . ' ' . $endNumber[1];
      }else {
        $formatNumber = $number[0] . ',' . substr($number[1], 0, 1) . ' ' . $endNumber[1];
      }
    }elseif ($numberLen >= 10 && $numberLen <= 12) {
      $number = number_format($number);
      $number = array_filter(explode(',', $number));
      if (substr($number[1], 0, 1) == 0) {
        $formatNumber = $number[0] . ' ' . $endNumber[2];
      }else {
        $formatNumber = $number[0] . ',' . substr($number[1], 0, 1) . ' ' . $endNumber[2];
      }
    }elseif ($numberLen >= 13 && $numberLen <= 15) {
      $number = number_format($number);
      $number = array_filter(explode(',', $number));
      if (substr($number[1], 0, 1) == 0) {
        $formatNumber = $number[0] . ' ' . $endNumber[3];
      }else {
        $formatNumber = $number[0] . ',' . substr($number[1], 0, 1) . ' ' . $endNumber[3];
      }
    }else {
      $formatNumber = $number;
    }
    if (!$formatNumber) {
      $formatNumber = 'Lütfen bir sayı giriniz';
    }
    return $formatNumber;
}

function json(array $data, bool $x = false)
{
    header('Content-Type: application/json');
    if ($x == false) {
        return json_encode($data);
    }else {
        return json_encode($data, true);
    }
    
}