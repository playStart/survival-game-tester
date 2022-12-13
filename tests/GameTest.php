<?php
use PHPUnit\Framework\TestCase;
use App\Game;

class GameTest extends TestCase
{
    public function testPlay() {
        $game = Game::createOnce(10, 10);
        $game->play();

        $this->assertNotNull($game->col_num);
        $this->assertNotNull($game->row_num);

        $logs = $game->getPlayDataListLog();
        $result = array_pop($logs); // 마지막 플래이어
        echo $this->getWinner($result);
    }

    public function testMultiPlay() {
        $winner = [];
        // TODO GAME 의 createOnce 메소드 수정 필요
        for ($i = 1; $i < 100; $i ++) {
            $game = Game::createOnce(10, 10);
            $game->play();
            $logs = $game->getPlayDataListLog();
            $result = array_pop($logs); // 마지막 플래이어
            $win = $this->getWinner($result);
            $winner[$win] = empty($winner[$win]) ? 1 : $winner[$win]+1;
        }
        print_r($winner);

        // 그래도 승률이 약 40%정도 됨

    }

    public function getWinner($lastLog) {
        $result = array_filter($lastLog, function ($val) {
            return $val['hp'] > 0;
        });
        if(count($result) > 0) {
            $winner = array_pop($result);
            return $winner['id'];
        } else {
            return 'tie';
        }
    }
}