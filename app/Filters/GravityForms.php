<?php

namespace App\Filters;

class GravityForms
{
    public function nlPhoneFormat(array $phoneFormats): array
    {
        $phoneFormats['gf_standard'] = $phoneFormats['standard'];
        $phoneFormats['standard']    = [
            'label'       => 'NL',
            'mask'        => false,
            'regex'       => '/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/',
            'instruction' => '(###) ###-####',
        ];
    
        return $phoneFormats;
    }

    public function AddDecicionButton($email, $notification, $entry): array
    {
        if ('Nieuwe online reservering vanaf de website' != $entry['subject'])
        {
            return $email;
        }

        $result = preg_match('/<([^>]+)>/', $email['headers']['From'], $matches);

        if (1 == $result)
        {
            $userEmail = $matches[1];

            // Add the HTML code for the buttons
            $email['message'] .= 
            '<div style="text-align: center; padding: 20px;">
                <a href="' . \home_url() . '/wp-json/wp/v2/confirm/reservation/email/' . $userEmail . '" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-right: 10px;">Reservering bevestigen</a>
            </div>'; 
        }

        return $email;
    }
}
