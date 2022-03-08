<?php

namespace App\Http\Controllers;

use App\Models\{Authors, Quotes, TagsList, TagsNames};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddQuoteController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/add-quotes",
     *     @OA\Response(response="200", description="Добавляет цитату в базу данных")
     * )
    */
    public function add(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();

        $tags = [];
        foreach ($data['tags'] as $tag) {
            $tags[] = TagsNames::where('tag', trim($tag))->first();
        }

        $author = Authors::firstOrCreate(['author' => $data['author']]);

        $quote = Quotes::create([
            'author_id' => $author->id,
            'text' => $data['quote']
        ]);

        foreach ($tags as $tag) {
            TagsList::create(['tag_id' => $tag->id, 'quote_id' => $quote->id]);
        }

        DB::commit();
    }

    /**
     * @OA\Post(
     *     path="/api/check-author",
     *     @OA\Response(response="200", description="Проверяет, есть ли автор в базе данных")
     * )
    */
    public function checkAuthor(Request $request)
    {
        $data = $request->all();

        $authors = Authors::where('author', 'like', "%{$data['author']}%")->get();

        if ($authors) {
            return response()->json($authors);
        }
    }
}