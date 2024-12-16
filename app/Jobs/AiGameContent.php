<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Game;

class AiGameContent implements ShouldQueue
{
    use Queueable;

    public $gameName;
    public $relatedGames;
    public $bestGames;
    public $categories;
    public $game_created_at;
    public $game_category;
    public $game_category_name;
    public $gameSlug;

    public function __construct($gameName, $relatedGames, $bestGames, $categories, $game_created_at, $game_category, $game_category_name, $gameSlug)
    {
        $this->gameName = $gameName;
        $this->relatedGames = $relatedGames;
        $this->bestGames = $bestGames;
        $this->categories = $categories;
        $this->game_created_at = $game_created_at;
        $this->game_category = $game_category;
        $this->game_category_name = $game_category_name;
        $this->gameSlug = $gameSlug;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $game_name = $this->gameName;
        $relatedGames = $this->relatedGames;
        $bestGames = $this->bestGames;
        $_categories = $this->categories;
        $game_created_at = $this->game_created_at;
        $game_category = $this->game_category;
        $game_category_name = $this->game_category_name;
        $gameSlug = $this->gameSlug;



        $prompt = "Provide information on {$game_name}. Write short descriptions following this structure:

            Make it as heading2 {$game_name} Play Online (Writing at least 50 words)
            Make it as heading2 How to Play {$game_name} (Writing at least 50 words)
            Make it as heading2 Game Modes in {$game_name} (Writing at least 50 words)
            Make it as heading2 Features of {$game_name} (Writing at least 50 words)
            Make it as heading2 Details about {$game_name} (Writing at least 50 words)
            Make it as heading3 Controls (Writing at least 50 words)
            Make it as heading3 Release Date (content: The game was released at {$game_created_at})
            Make it as heading3 Publisher (content: {$game_name} is published by <a href='https://naptechgames.com' target='_blank'>NapTech games</a>)
            Make it as heading3 Platforms (Writing at least 50 words)
            Make it as heading3 Ratings (Writing at least 50 words)
            Make it as heading2 Related Games (Writing at least 50 words)
            <p>If you’re a fan of {$game_name}, you'll love these other platformer games like <a href='https://naptechgames.com/game/{$relatedGames[0]->slug}'>{$relatedGames[0]->name}</a> and <a href='https://naptechgames.com/game/{$relatedGames[1]->slug}'>{$relatedGames[1]->name}</a>.</p>";
    
                    foreach ($relatedGames as $relatedGame) {
                        $prompt .= "<li><a href='https://naptechgames.com/game/{$relatedGame->slug}' target='_blank'>{$relatedGame->name}</a></li>";
                    }
    
                    $prompt .= "Make it as heading2 Best Games (Writing at least 50 words)
            <p>Explore the top-rated <a href='https://naptechgames.com/best-games'>Best Games</a> by NapTech Games, handpicked by our community of players. These games offer the best in entertainment, challenge, and fun, ensuring hours of enjoyment. </p>";
    
                    foreach ($bestGames as $bestGame) {
                        $prompt .= "<li><a href='https://naptechgames.com/game/{$bestGame->slug}' target='_blank'>{$bestGame->name}</a></li>";
                    }
    
                    $prompt .= "Make it as heading2 Game Category List of NapTech Games
            <p> Tired of playing the same old games? Beyond the excitement of <a href='https://naptechgames.com/category/{$game_category}'>{$game_category_name}</a>, NapTech Games offers a massive collection of games to satisfy every gaming craving. Whether you're a fan of fast-paced action or thrilling adventures, there's a game for everyone.</p>";
    
                    $categoryCount = count($_categories);
                    $counter = 0;
                    foreach ($_categories as $randomcategory) {
                        $counter++;
                        $prompt .= " <a href='https://naptechgames.com/category/{$randomcategory->slug}'>{$randomcategory->title}</a>";
                        if ($counter < $categoryCount && $counter < 5) {
                            $prompt .= ",";
                        }
                    }
    
                    $prompt .= ". Make it as heading2 Conclusion (Writing at least 50 words)
            Make it as heading2 FAQ - {$game_name} (Writing at least 50 words)
    
            Note: Try to use bullet points and use relevant keywords in the content. Try to make the content SEO-friendly. MUST skip all the sources write a short description under the details heading.
    
            Looking for more exciting games? <a href='https://naptechgames.com' target='_blank'>NapTech Games</a> offers a vast collection of games across various genres. Find your next favorite game today!";
    
    
            try {
                // Make the API request
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . env('GEMINI_API_KEY'), [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt],
                            ],
                        ],
                    ],
                ]);
    
                if ($response->successful()) {
                    $responseData = $response->json();
    
                    $generatedContent = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No content found';
                    $markdownContent = Str::markdown($generatedContent);
    
                    // Save the content in the database
                    $game = new Game();
                    $game->name = $game_name;
                    $game->slug = $gameSlug;
                    $game->description = $markdownContent;
                    $game->save();
                }
    
                // Handle API errors
                // return response()->json([
                //     'error' => 'Failed to generate content',
                //     'details' => $response->json(),
                // ], $response->status());
            } catch (\Exception $e) {
                // Handle exceptions
                // return response()->json([
                //     'error' => 'An error occurred',
                //     'message' => $e->getMessage(),
                // ], 500);
            }
            
    }
}
