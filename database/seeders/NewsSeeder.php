<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            News::create([
                'name' => 'News Article',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius ipsam soluta, fuga, rerum mollitia eligendi necessitatibus animi eos ea eveniet similique optio ut dolorem quibusdam placeat non. Debitis illo, quaerat itaque quos doloremque sed aut. Labore nisi architecto explicabo voluptates, quibusdam quae. Commodi eaque nemo blanditiis ducimus, recusandae perferendis reprehenderit veniam tenetur sapiente error praesentium, voluptatem quae adipisci deleniti iste laboriosam illum cum! Totam animi omnis, consequuntur ipsa, sapiente aliquam illo ullam cupiditate voluptate earum corporis praesentium quae nulla ratione enim corrupti est perferendis quidem reprehenderit officiis. Quidem, molestias explicabo. Ea similique sapiente reprehenderit harum veritatis provident omnis neque. Ex.',
            ]);
        }
    }
}
