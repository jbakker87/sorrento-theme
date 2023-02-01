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
}
