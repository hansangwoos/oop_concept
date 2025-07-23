<?php 

// 문제 설명
/*
RPG 게임의 캐릭터를 관리하는 클래스를 만들어보세요!
요구사항:

캐릭터의 이름, 레벨, 직업을 저장 (public)
**체력(HP)**과 **마나(MP)**는 private으로 관리
체력과 마나는 0 이상이어야 하고, 최대치를 넘을 수 없음
공격받기, 스킬 사용, 회복 메서드 구현
캐릭터 상태 확인 메서드 (살았는지/죽었는지)

상세 조건:

체력(HP): 0~100 사이
마나(MP): 0~50 사이
공격받으면 체력 감소
스킬 사용하면 마나 감소
체력이 0이 되면 "죽음" 상태
*/


class GameCharacter {
    public $name;
    public $level;
    public $job;

    private $hp;
    private $mp;

    public function __construct($name, $level, $job) {
        $this->name = $name;
        $this->level = $level;
        $this->job = $job;
        $this->hp = 100;
        $this->mp = 50;
    }

    public function takeDamage($damage){
        if($damage < 100 ){
            $this->hp = $this->hp-$damage;
        }else {
            return "최대 대미지는 100이상 설정할 수 없습니다";
        }
    }
    public function useSkill($manaCost) {
        if($this->mp >= $manaCost){
            $this->mp = $this->mp-$manaCost;
        }else {
            return "마나가 무족합니다";
        }
    }
    public function heal($hpRecover, $mpRecover) {
        $msg = '';
        if($hpRecover && $this->hp+$hpRecover < 100){
            $this->hp = $this->hp+$hpRecover;
        }else {
            return $msg .="최력회복을 한계를 초과했습니다";
        }
         if($mpRecover && $this->mp+$mpRecover < 50){
            $this->mp = $this->mp+$mpRecover;
        }else {
            return $msg .="최력회복을 한계를 초과했습니다";
        }
    }
    
    public function getStatus(){
        if($this->hp > 0){
            return [
                "hp"=> $this->hp,
                "mp"=> $this->mp,
            ];
        }else {
            return "캐릭터가 사망했습니다";
        }
    }
        // 살아있는지 확인
    public function isAlive() {
        if($this->hp > 0){
            return "생존";
        }else {
            return "죽음";
        }
    }

    
    public function getNmae(){
        return $this->name;
    }
}

$character = new GameCharacter("용사", 10, "전사");

// 테스트 코드
$character = new GameCharacter("용사", 10, "전사");

echo "=== 초기 상태 ===\n";
echo "<br>";
print_r($character->getStatus());
echo "<br>";
echo "\n=== 전투 시작! ===\n";
echo "<br>";
echo $character->takeDamage(30) . "\n";        // 30 데미지
echo "<br>";
echo $character->useSkill(20) . "\n";          // 20 마나 소모
echo "<br>";
echo $character->heal(10, 15) . "\n";          // 체력 10, 마나 15 회복
echo "<br>";

echo "\n=== 현재 상태 ===\n";
echo "<br>";
print_r($character->getStatus());
echo "<br>";
echo "\n=== 치명적 공격! ===\n";
echo "<br>";
echo $character->takeDamage(100) . "\n";       // 100 데미지
echo "<br>";
echo $character->isAlive() ? "살아있음" : "죽음" . "\n";

?>