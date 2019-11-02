<?php
namespace App\Console\Commands;

use App\Model\Cocktail;
use App\Model\Tag;
use App\Model\TagCategory;
use App\Services\UtilityService as Utility;
use DB;
use Illuminate\Console\Command;

class CocktailImportJson extends Command
{
    protected $signature = 'db:cocktail-import-json {json}';
    protected $description = 'Cocktail data import at JSON Document';

    public function handle()
    {
        // カクテル情報が記載されたJSONファイルを取得する
        $json_file = $this->argument('json');
        $cocktail_infos_json = file_get_contents($json_file);
        $cocktail_infos = json_decode($cocktail_infos_json, true);

        // プログレスバーセットアップ
        $bar = $this->output->createProgressBar(count($cocktail_infos));

        DB::beginTransaction();
        try {
            $bar->start();
            foreach ($cocktail_infos as $cocktail_info) {
                $bar->advance();

                // 未知のカクテルであれば作成
                $cocktail_name = $cocktail_info['cocktail_name'];
                $cocktail_seikei_name = Utility::fmtSearchStr($cocktail_name);
                $cocktail = Cocktail::firstOrCreate([
                    'search_name' => $cocktail_seikei_name,
                ], [
                    'name' => $cocktail_name,
                ]);

                // 既存のカクテル-タグ関連情報を取得
                $has_tag_ids = [];
                $pivot = Cocktail::with(['tags'])->find($cocktail->id);
                foreach ($pivot->tags as $tag) {
                    $has_tag_ids[] = $tag['id'];
                }

                foreach ($cocktail_info['tags'] as $tag_info) {
                    // 未知のタグ・カテゴリであれば作成
                    $tag_category_name = $tag_info['category_name'];
                    $tag_category_seikei_name = Utility::fmtSearchStr($tag_category_name);
                    $tag_category = TagCategory::firstOrCreate([
                        'search_name' => $tag_category_seikei_name,
                    ], [
                        'name' => $tag_category_name,
                    ]);

                    // 未知のタグであれば作成
                    $tag_name = $tag_info['name'];
                    $tag_seikei_name = Utility::fmtSearchStr($tag_name);
                    $tag = Tag::firstOrCreate([
                        'search_name' => $tag_seikei_name,
                    ], [
                        'name' => $tag_name,
                        'tag_category_id' => $tag_category->id,
                    ]);

                    // 今回増えた関連を追加
                    $has_tag_ids[] = $tag->id;
                }

                // カクテル-タグ関連情報を保存
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
