<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Katakana implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value contains only Katakana characters
        if (!preg_match('/^[ァ-ヶー\s]+$/u', $value)) {
            $fail('カタカナ文字のみを入力してください。');
        }
    }
}
