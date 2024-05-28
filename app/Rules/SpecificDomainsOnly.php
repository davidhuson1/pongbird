<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SpecificDomainsOnly implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = substr($value, strpos($value, '@') + 1);

        $domains = [
            'rentbird.nl',
            'rentbird.com',
        ];

        if (!in_array($domain, $domains)) {
            $fail('The :attribute must be from one of the following domains: ' . implode(', ', $domains));
        }
    }
}
