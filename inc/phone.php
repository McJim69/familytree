<?php

function formatPhone ($number, $country = '')
{
    // Must have a country
    $country = !empty($country) ? strtoupper($country) : getDefaultCountry();

    switch ($country)
    {
        case 'US':

            $number = formatPhoneUs($number);
    }

    return $number;
}

/**
 * formatPhoneUs 
 * 
 * Format a US phone number.
 * 
 * @param string $number 
 * 
 * @return void
 */
function formatPhoneUs ($number)
{
    // Normalize - strip everything but numbers and letters
    $number = preg_replace("/[^0-9A-Za-z]/", "", $number);

    if (strlen($number) == 7)
    {
        $number = preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1-$2", $number);
    }
    elseif (strlen($number) == 10)
    {
        $number = preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "($1) $2-$3", $number);
    }
    elseif (strlen($number) == 11)
    {
        $number = preg_replace("/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1($2) $3-$4", $number);
    }

    return $number;
}
