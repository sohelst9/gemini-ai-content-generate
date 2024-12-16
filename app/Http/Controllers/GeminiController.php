<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GeminiController extends Controller
{
    //--index
    public function index()
    {
        $game = Game::latest()->first();
        return view('welcome', compact('game'));
    }

    //--gemini_content
    public function gemini_content(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $game_name = $request->input('prompt');
        $gameSlug = Str::slug($game_name);
        $model = 'gemini-1.5-flash-latest';
        $game_category = 'Platformer';
        $game_category_name = 'Platformer Games';
        $game_created_at = '2024-12-13';

        $relatedGames = [
            (object) ['slug' => 'super-mario-odyssey', 'name' => 'Super Mario Odyssey'],
            (object) ['slug' => 'donkey-kong-country', 'name' => 'Donkey Kong Country'],
            (object) ['slug' => 'mario-bros', 'name' => 'Super Mario Bros'],
            (object) ['slug' => 'zelda-breath-of-the-wild', 'name' => 'The Legend of Zelda: Breath of the Wild'],
            (object) ['slug' => 'donkey-kong', 'name' => 'Donkey Kong'],
            (object) ['slug' => 'luigi-mansion', 'name' => 'Luigi’s Mansion'],
            (object) ['slug' => 'mario-kart', 'name' => 'Mario Kart'],
            (object) ['slug' => 'splatoon', 'name' => 'Splatoon'],
            (object) ['slug' => 'star-fox', 'name' => 'Star Fox'],
            (object) ['slug' => 'pokemon-sword', 'name' => 'Pokemon Sword and Shield'],
            (object) ['slug' => 'hyrule-warriors', 'name' => 'Hyrule Warriors'],
            (object) ['slug' => 'metroid-dread', 'name' => 'Metroid Dread'],
            (object) ['slug' => 'bayonetta', 'name' => 'Bayonetta 3'],
            (object) ['slug' => 'pikmin', 'name' => 'Pikmin 3 Deluxe'],
            (object) ['slug' => 'splatoon-2', 'name' => 'Splatoon 2'],
            (object) ['slug' => 'kirby', 'name' => 'Kirby and the Forgotten Land'],
            (object) ['slug' => 'fire-emblem-three-houses', 'name' => 'Fire Emblem: Three Houses'],
            (object) ['slug' => 'paper-mario', 'name' => 'Paper Mario: The Origami King'],
            (object) ['slug' => 'mario-party', 'name' => 'Mario Party Superstars'],
            (object) ['slug' => 'animal-crossing', 'name' => 'Animal Crossing: New Horizons'],
            (object) ['slug' => 'yoshi-craft', 'name' => 'Yoshi’s Crafted World'],
            (object) ['slug' => 'minecraft', 'name' => 'Minecraft'],
            (object) ['slug' => 'rocket-league', 'name' => 'Rocket League'],
            (object) ['slug' => 'brawl-halla', 'name' => 'Brawlhalla'],
            (object) ['slug' => 'fortnite', 'name' => 'Fortnite'],
            (object) ['slug' => 'apex-legends', 'name' => 'Apex Legends'],
            (object) ['slug' => 'overwatch-2', 'name' => 'Overwatch 2'],
            (object) ['slug' => 'league-of-legends', 'name' => 'League of Legends'],
            (object) ['slug' => 'counter-strike', 'name' => 'Counter-Strike: Global Offensive'],
            (object) ['slug' => 'valorant', 'name' => 'Valorant']
        ];

        $bestGames = [
            (object) ['slug' => 'the-legend-of-zelda-breath-of-the-wild', 'name' => 'The Legend of Zelda: Breath of the Wild'],
            (object) ['slug' => 'mario-kart-8-deluxe', 'name' => 'Mario Kart 8 Deluxe'],
            (object) ['slug' => 'super-mario-odyssey', 'name' => 'Super Mario Odyssey'],
            (object) ['slug' => 'animal-crossing-new-horizons', 'name' => 'Animal Crossing: New Horizons'],
            (object) ['slug' => 'splatoon-2', 'name' => 'Splatoon 2'],
            (object) ['slug' => 'pokemon-sword', 'name' => 'Pokemon Sword and Shield'],
            (object) ['slug' => 'metroid-dread', 'name' => 'Metroid Dread'],
            (object) ['slug' => 'fire-emblem-three-houses', 'name' => 'Fire Emblem: Three Houses'],
            (object) ['slug' => 'kirby-forgotten-land', 'name' => 'Kirby and the Forgotten Land'],
            (object) ['slug' => 'bayonetta-3', 'name' => 'Bayonetta 3'],
            (object) ['slug' => 'yoshi-craft', 'name' => 'Yoshi’s Crafted World'],
            (object) ['slug' => 'pikmin-3', 'name' => 'Pikmin 3 Deluxe'],
            (object) ['slug' => 'super-smash-bros-ultimate', 'name' => 'Super Smash Bros Ultimate'],
            (object) ['slug' => 'the-witcher-3', 'name' => 'The Witcher 3: Wild Hunt'],
            (object) ['slug' => 'mortal-kombat-11', 'name' => 'Mortal Kombat 11'],
            (object) ['slug' => 'overwatch-2', 'name' => 'Overwatch 2'],
            (object) ['slug' => 'fortnite', 'name' => 'Fortnite'],
            (object) ['slug' => 'apex-legends', 'name' => 'Apex Legends'],
            (object) ['slug' => 'league-of-legends', 'name' => 'League of Legends'],
            (object) ['slug' => 'counter-strike-global-offensive', 'name' => 'Counter-Strike: Global Offensive'],
            (object) ['slug' => 'valorant', 'name' => 'Valorant'],
            (object) ['slug' => 'rocket-league', 'name' => 'Rocket League'],
            (object) ['slug' => 'brawlhalla', 'name' => 'Brawlhalla'],
            (object) ['slug' => 'minecraft', 'name' => 'Minecraft'],
            (object) ['slug' => 'super-quick-dash', 'name' => 'Super Quick Dash'],
            (object) ['slug' => 'gang-beasts', 'name' => 'Gang Beasts'],
            (object) ['slug' => 'fall-guys', 'name' => 'Fall Guys']
        ];

        $_categories = [
            (object) ['slug' => 'platformer', 'title' => 'Platformer'],
            (object) ['slug' => 'action', 'title' => 'Action'],
            (object) ['slug' => 'adventure', 'title' => 'Adventure'],
            (object) ['slug' => 'shooter', 'title' => 'Shooter'],
            (object) ['slug' => 'strategy', 'title' => 'Strategy'],
            (object) ['slug' => 'puzzle', 'title' => 'Puzzle'],
            (object) ['slug' => 'racing', 'title' => 'Racing'],
            (object) ['slug' => 'fighting', 'title' => 'Fighting'],
            (object) ['slug' => 'role-playing', 'title' => 'Role-Playing'],
            (object) ['slug' => 'simulation', 'title' => 'Simulation'],
            (object) ['slug' => 'sports', 'title' => 'Sports'],
            (object) ['slug' => 'music', 'title' => 'Music'],
            (object) ['slug' => 'multiplayer', 'title' => 'Multiplayer'],
            (object) ['slug' => 'horror', 'title' => 'Horror'],
            (object) ['slug' => 'indie', 'title' => 'Indie'],
            (object) ['slug' => 'sandbox', 'title' => 'Sandbox'],
            (object) ['slug' => 'battle-royale', 'title' => 'Battle Royale'],
            (object) ['slug' => 'mmorpg', 'title' => 'MMORPG'],
            (object) ['slug' => 'open-world', 'title' => 'Open World'],
            (object) ['slug' => 'escape-room', 'title' => 'Escape Room'],
            (object) ['slug' => 'city-builder', 'title' => 'City Builder'],
            (object) ['slug' => 'tower-defense', 'title' => 'Tower Defense'],
            (object) ['slug' => 'survival', 'title' => 'Survival'],
            (object) ['slug' => 'farming', 'title' => 'Farming'],
            (object) ['slug' => 'hacking', 'title' => 'Hacking'],
            (object) ['slug' => 'space', 'title' => 'Space'],
            (object) ['slug' => 'stealth', 'title' => 'Stealth'],
            (object) ['slug' => 'story-driven', 'title' => 'Story Driven'],
            (object) ['slug' => 'virtual-reality', 'title' => 'Virtual Reality'],
            (object) ['slug' => 'survival-horror', 'title' => 'Survival Horror'],
            (object) ['slug' => 'social', 'title' => 'Social']
        ];

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
                return back();
            }

            return response()->json([
                'error' => 'Failed to generate content',
                'details' => $response->json(),
            ], $response->status());
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
