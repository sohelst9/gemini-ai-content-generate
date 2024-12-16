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


        
    }
}
