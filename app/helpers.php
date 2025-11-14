<?php

if (!function_exists('format_bdt')) {
    /**
     * Format amount to BDT currency
     *
     * @param float $amount
     * @param int $decimals
     * @return string
     */
    function format_bdt($amount, $decimals = 2)
    {
        return '৳' . number_format($amount, $decimals);
    }
}

if (!function_exists('parse_bdt')) {
    /**
     * Parse BDT formatted string to float
     *
     * @param string $bdtString
     * @return float
     */
    function parse_bdt($bdtString)
    {
        return (float) str_replace(['৳', ','], '', $bdtString);
    }
}

if (!function_exists('bdt_in_words')) {
    /**
     * Convert BDT amount to words (Bengali)
     *
     * @param float $amount
     * @return string
     */
    function bdt_in_words($amount)
    {
        $numbers = [
            0 => 'শূন্য',
            1 => 'এক',
            2 => 'দুই',
            3 => 'তিন',
            4 => 'চার',
            5 => 'পাঁচ',
            6 => 'ছয়',
            7 => 'সাত',
            8 => 'আট',
            9 => 'নয়',
            10 => 'দশ',
            11 => 'এগারো',
            12 => 'বারো',
            13 => 'তেরো',
            14 => 'চৌদ্দ',
            15 => 'পনেরো',
            16 => 'ষোল',
            17 => 'সতেরো',
            18 => 'আঠারো',
            19 => 'উনিশ',
            20 => 'বিশ',
            30 => 'ত্রিশ',
            40 => 'চল্লিশ',
            50 => 'পঞ্চাশ',
            60 => 'ষাট',
            70 => 'সত্তর',
            80 => 'আশি',
            90 => 'নব্বই',
            100 => 'একশত'
        ];

        // Simple implementation for basic amounts
        if ($amount == 0) return 'শূন্য টাকা';
        if ($amount < 21) return $numbers[(int)$amount] . ' টাকা';

        return number_format($amount, 2) . ' টাকা';
    }
}
