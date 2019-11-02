<?php
namespace App\Services;

class UtilityService extends Service
{
    public static function fmtSearchStr(string $string): string
    {
        // 置換させる文字列を指定(連想配列)
        $replace_table = [
            'ァ' => 'ア',
            'ィ' => 'イ',
            'ゥ' => 'ウ',
            'ェ' => 'エ',
            'ォ' => 'オ',
            'ヵ' => 'カ',
            'ャ' => 'ヤ',
            'ュ' => 'ユ',
            'ョ' => 'ヨ',
            'ヮ' => 'ワ',
        ];

        // 削除する文字列を指定(配列)
        $remove_table = [
            /*
            半角, 全角 */
            '-', 'ー',
            '•', '・',
            '.',
            '_', '＿',
            '/', '／',
        ];
        $remove_table = array_fill_keys($remove_table, '');

        $formatting_table = array_merge($replace_table, $remove_table);
        $before = array_keys($formatting_table);
        $after = array_values($formatting_table);
        $formatted_string = str_replace($before, $after, $string);

        return $formatted_string;
    }
}
