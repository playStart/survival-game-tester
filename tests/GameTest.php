<?php
use PhpParser\Builder\Param;
use PHPUnit\Framework\TestCase;
use App\Game;

class GameTest extends TestCase
{
    public function testPlay() {
        $game = Game::createOnce(10, 10);
        $game->play();

        $this->assertNotNull($game->col_num);

        $this->assertNotNull($game->row_num);

        //print_r($game->getPlayerDataList());
        $logs = $game->getPlayDataListLog();
        $result = array_pop($logs); // 마지막 플래이어
        $result = array_filter($result, function ($val) {
            return $val['hp'] > 0;
        });
        if(count($result) > 0) {
            $winner = array_pop($result);
            echo "{$winner['id']} 승리";
        } else {
            echo "무승부";
        }
        

    }
}