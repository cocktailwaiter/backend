<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Cocktail;
use App\Model\Tag;
use App\Services\CocktailService;
use DB;
use Master;

class CocktailImport extends Command
{
    protected $signature = 'db:cocktail-import {csv}';
    protected $description = 'Cocktail data import at CSV';

    public function handle()
    {
        $csv_file = $this->argument('csv');
        $file = new \SplFileObject(storage_path($csv_file));
        $file->setFlags(
            \SplFileObject::READ_CSV |          // CSV 列として行を読み込む
            \SplFileObject::READ_AHEAD |        // 先読み/巻き戻しで読み出す。
            \SplFileObject::SKIP_EMPTY |        // 空行は読み飛ばす
            \SplFileObject::DROP_NEW_LINE       // 行末の改行を読み飛ばす
        );

        $insert_list = [];
        foreach ($file as $line) {
            // 1要素目はカクテル名
            $cocktail_name = $line[0];

            // 2要素目以降はタグ名
            $tag_names = [];
            unset($line[0]);
            foreach ($line as $tag_name) {
                $tag_names[] = $tag_name;
            }

            $insert_list[] = [
                'cocktail_name' => $cocktail_name,
                'tag_name' => $tag_names,
            ];
        }

        // プログレスバーセットアップ
        $bar = $this->output->createProgressBar(count($insert_list));

        DB::beginTransaction();
        try {
            $bar->start();
            foreach ($insert_list as $insert) {
                $bar->advance();

                // 未知のカクテルであれば作成
                $cocktail = Cocktail::firstOrCreate(['name' => $insert['cocktail_name']]);

                // 既に関連しているカクテル-タグ情報を取得
                $has_tag_ids = [];
                $pivot = Cocktail::with(['tags'])->find($cocktail->id);
                foreach ($pivot->tags as $tag) {
                    $has_tag_ids[] = $tag['id'];
                }
                foreach ($insert['tag_name'] as $tag_name) {
                    // 未知のタグであれば作成
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    // 今回増えた関連を追加
                    $has_tag_ids[] = $tag->id;
                }
                // カクテル-タグ関連を保存
                $cocktail->tags()->sync($has_tag_ids);
            }
            $bar->finish();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
    }
}
