<?php

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	Post::truncate();
    	Category::truncate();
        Tag::truncate();

    	$category = new Category;
    	$category->name = "Categoria 1";
    	$category->save();



    	$category = new Category;
    	$category->name = "Categoria 2";
    	$category->save();


        $post = new Post;
        $post->title = "Mi primera noticia";
        $post->url = Str::slug("Mi primera noticia");
        $post->excerpt ="Extracto de mi primera noticia";
        $post->body = "<p>Contenido de mi primera noticia</p>";
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id =1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));

        $post = new Post;
        $post->title = "Mi segunda noticia";
        $post->url = Str::slug("Mi segunda noticia");
        $post->excerpt ="Extracto de mi segunda noticia";
        $post->body = "<p>Contenido de mi segunda noticia</p>";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id =1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 2']));

        $post = new Post;
        $post->title = "Mi tercera noticia";
        $post->url = Str::slug("Mi tercera noticia");
        $post->excerpt ="Extracto de mi tercera noticia";
        $post->body = "<p>Contenido de mi tercera noticia</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id =1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 3']));

        $post = new Post;
        $post->title = "Mi cuarta noticia";
        $post->url = Str::slug("Mi cuarta noticia");
        $post->excerpt ="Extracto de mi cuarta noticia";
        $post->body = "<p>Contenido de mi cuarta noticia</p>";
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id =2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 4']));
    }
}
