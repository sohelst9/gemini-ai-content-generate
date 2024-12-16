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



       
            
    }
}
