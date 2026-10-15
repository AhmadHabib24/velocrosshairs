<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MathCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $expected = session('captcha_answer');

        if ($expected === null || (int) $value !== (int) $expected) {
            $fail('Incorrect captcha answer, please try again.');
        }
    }
}
