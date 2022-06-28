<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Queste categorie senza Faker */
        $tags = ['Laravel', 'HTML', 'CSS', 'JAVASCRIPT', 'PHP', 'MYSQL', 'VS CODE'];
        /* Ciclo forEach */
        foreach($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($newTag->name);
            $newTag->save();
        }
    }
}
