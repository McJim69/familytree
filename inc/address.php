<?php

function formatAddress ($address)
{
    $str = '';

    // Must have a country
    $country = isset($address['country']) ? $address['country'] : getDefaultCountry();

    switch ($country)
    {
        case 'US':
        default:
            $str = formatAddressUs($address);
            break;
    }

    return $str;
}

/**
 * formatAddressUrl 
 * 
 * Turns a formatted address into a url for google maps.
 * 
 * @param string $address 
 * 
 * @return string
 */
function formatAddressUrl ($address)
{
    $url = $address;

    // Space
    $url = preg_replace("/\s/", "%20", $url);

    // <br/>
    $url = preg_replace("/<br\/>/", ",%20", $url);

    return $url;
}

/**
 * formatAddressUs 
 * 
 * Valid Address
 *   1. Country
 *   2. State
 *   3. City
 *   4. City, State
 *   5. Address, City
 *   6. Address, City, State
 *   7. Address, City, State, Zip
 *   8. Address, City, State, Zip Country
 *
 * @param string  $address 
 *
 * @return void
 */
function formatAddressUs ($address)
{
    $str = '';

    // 5 - 8
    if (!empty($address['address']))
    {
        $str .= cleanOutput($address['address']).'<br/>';

        if (!empty($address['city']))
        {
            $str .= cleanOutput($address['city']);

            if (!empty($address['state']))
            {
                $str .= ', '.cleanOutput($address['state']);

                if (!empty($address['zip']))
                {
                    $str .= ' '.cleanOutput($address['zip']);

                    if (!empty($address['country']))
                    {
                        // Convert country code to name
                        $countries = buildCountryList();
                        $country   = cleanOutput($address['country']);
                        $country   = $countries[$country];
                        $country   = ucwords(strtolower($country));

                        $str .= '<br/>'.$country;
                    }
                }
            }
        }
    }
    // 3 or 4
    elseif (!empty($address['city']))
    {
        $str .= cleanOutput($address['city']);

        if (!empty($address['state']))
        {
            $str .= ', '.cleanOutput($address['state']);
        }
    }
    // 2
    elseif (!empty($address['state']))
    {
        $str .= cleanOutput($address['state']);
    }
    // 1
    elseif (!empty($address['country']))
    {
        $str .= cleanOutput($address['state']);
    }

    return $str;
}
