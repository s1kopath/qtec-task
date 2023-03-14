<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchHistory>
 */
class SearchHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $searchEngines = ['Google', 'Bing', 'Yahoo'];
        $searchTypes = ['web', 'image', 'news'];
        $devices = ['desktop', 'mobile', 'tablet'];
        $browsers = ['Chrome', 'Firefox', 'Safari'];
        $languages = ['en', 'fr', 'de', 'es', 'it'];
        $clickedResults = [fake()->url, null];
        $timeSpent = fake()->randomNumber(2);

        return [
            'keyword' => fake()->word,
            'search_time' => fake()->dateTimeBetween('-1 week', 'now'),
            'search_results' => json_encode([
                ['title' => fake()->sentence, 'url' => fake()->url],
                ['title' => fake()->sentence, 'url' => fake()->url],
                ['title' => fake()->sentence, 'url' => fake()->url],
            ]),
            'total_results' => fake()->randomNumber(6),
            'search_engine' => fake()->randomElement($searchEngines),
            'search_type' => fake()->randomElement($searchTypes),
            'user_name' => fake()->name(),
            'ip_address' => fake()->ipv4,
            'device_type' => fake()->randomElement($devices),
            'browser_type' => fake()->randomElement($browsers),
            'language' => fake()->randomElement($languages),
            'clicked_result' => fake()->randomElement($clickedResults),
            'time_spent' => $timeSpent,
            'is_section_active' => false
        ];
    }
}
