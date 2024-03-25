<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // creo la cartella per le immagini nello storage
        Storage::makeDirectory('project_images');
        // creo titolo e slug
        $title = fake()->text(20);
        $slug = Str::slug($title);
        // creo immagini con nome personalizzato e le salvo nello storage
        $image = fake()->image(null, 300, 300);
        $img_url = Storage::putFileAs('project_images', $image, "$slug.png");
        // creo l'array degli id dei tipi
        $type_ids = Type::pluck('id')->toArray();
        $type_ids[] = null;
        return [
            'title' => $title,
            'slug' => $slug,
            'content' => fake()->paragraphs(15, true),
            'type_id' => Arr::random($type_ids),
            'image' => $img_url,
            'is_published' => fake()->boolean(),
        ];
    }
}
