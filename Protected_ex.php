<?php
// protected 를 활용 실전 예제 느낌 EX 

class Animal {
    public $name;               // 누구나 볼 수 있는 이름
    public $species;            // 누구나 볼 수 있는 종족
    
    protected $health;          // 가족(자식)만 알 수 있는 건강 상태
    protected $energy;          // 가족(자식)만 알 수 있는 에너지
    protected $lastFeedTime;    // 가족(자식)만 알 수 있는 마지막 급식 시간
    
    private $medicalRecord;     // 수의사(이 클래스)만 알 수 있는 의료 기록
    
    public function __construct($name, $species) {
        $this->name = $name;
        $this->species = $species;
        $this->health = 100;        // 건강한 상태로 시작
        $this->energy = 100;        // 에너지 가득한 상태
        $this->lastFeedTime = date('H:i');
        $this->medicalRecord = [];  // 의료 기록 초기화
        
        echo " {$this->species} '{$this->name}'이(가) 동물원에 입소했습니다!\n";
    }
    
    //  Protected 메서드 - 자식들만 사용 가능
    protected function updateHealth($amount) {
        $this->health += $amount;
        if ($this->health > 100) $this->health = 100;
        if ($this->health < 0) $this->health = 0;
        
        echo " {$this->name}의 건강 상태: {$this->health}/100\n";
    }
    
    protected function updateEnergy($amount) {
        $this->energy += $amount;
        if ($this->energy > 100) $this->energy = 100;
        if ($this->energy < 0) $this->energy = 0;
        
        echo " {$this->name}의 에너지: {$this->energy}/100\n";
    }
    
    protected function checkTime() {
        $currentTime = date('H:i');
        $timeDiff = strtotime($currentTime) - strtotime($this->lastFeedTime);
        return floor($timeDiff / 3600); // 시간 단위로 반환
    }
    
    //  Private 메서드 - 이 클래스에서만 사용
    private function addMedicalRecord($record) {
        $this->medicalRecord[] = date('Y-m-d H:i') . ": " . $record;
    }
    
    // 공통 기본 행동들
    public function sleep() {
        echo " {$this->name}이(가) 잠을 잡니다...\n";
        $this->updateEnergy(30);    // Protected 메서드 사용
        $this->addMedicalRecord("정상적인 수면"); // Private 메서드 사용
    }
    
    public function getPublicInfo() {
        return " 이름: {$this->name}, 종족: {$this->species}";
    }
    
    // 자식 클래스에서 반드시 구현해야 할 메서드 (기본 구현 제공)
    public function eat() {
        echo " {$this->name}이(가) 사료를 먹습니다.\n";
        $this->updateEnergy(20);
        $this->lastFeedTime = date('H:i');
    }
}

//  개 클래스 - Protected 활용
class Dog extends Animal {
    public function __construct($name) {
        parent::__construct($name, "개"); // 부모 생성자 호출
    }
    
    public function bark() {
        // ✅ Protected 메서드 사용 가능
        if ($this->energy < 20) {
            echo " {$this->name}은(는) 너무 피곤해서 짖을 수 없습니다.\n";
            return;
        }
        
        echo "🐕 {$this->name}: 멍멍! 멍멍!\n";
        $this->updateEnergy(-10); // 에너지 소모
    }
    
    public function play() {
        //  Protected 속성에 직접 접근 가능
        if ($this->health < 50) {
            echo " {$this->name}은(는) 건강이 좋지 않아 놀 수 없습니다.\n";
            return;
        }
        
        echo " {$this->name}이(가) 신나게 놉니다!\n";
        $this->updateEnergy(-20);
        $this->updateHealth(5); // 적당한 운동은 건강에 좋음
    }
    
    // 개만의 특별한 식사 방식
    public function eat() {
        //  Protected 메서드로 상태 체크
        $hoursSinceLastMeal = $this->checkTime();
        
        if ($hoursSinceLastMeal < 4) {
            echo " {$this->name}은(는) 아직 배부릅니다. (마지막 식사: {$this->lastFeedTime})\n";
            return;
        }
        
        echo " {$this->name}이(가) 꼬리를 흔들며 사료를 먹습니다!\n";
        $this->updateEnergy(25);    // 개는 에너지 회복량이 많음
        $this->updateHealth(3);     // 건강도 약간 회복
        $this->lastFeedTime = date('H:i');
    }
}

//  고양이 클래스 - Protected 활용
class Cat extends Animal {
    public function __construct($name) {
        parent::__construct($name, "고양이");
    }
    
    public function meow() {
        if ($this->energy < 15) {
            echo " {$this->name}은(는) 너무 피곤해서 울 수 없습니다.\n";
            return;
        }
        
        echo " {$this->name}: 야옹~ 야옹~\n";
        $this->updateEnergy(-5); // 고양이는 에너지 소모가 적음
    }
    
    public function hunt() {
        if ($this->health < 70 || $this->energy < 40) {
            echo " {$this->name}은(는) 컨디션이 좋지 않아 사냥할 수 없습니다.\n";
            return;
        }
        
        echo " {$this->name}이(가) 사냥 본능을 발휘합니다!\n";
        $this->updateEnergy(-30);
        $this->updateHealth(10); // 사냥은 좋은 운동
    }
    
    // 고양이만의 까다로운 식사
    public function eat() {
        echo " {$this->name}이(가) 음식 냄새를 맡아봅니다...\n";
        
        // 랜덤으로 음식을 거부할 수 있음
        if (rand(1, 10) <= 3) {
            echo " {$this->name}이(가) 음식이 마음에 들지 않는다며 거부합니다!\n";
            return;
        }
        
        echo " {$this->name}이(가) 우아하게 식사합니다.\n";
        $this->updateEnergy(15);    // 고양이는 에너지 회복이 적음
        $this->updateHealth(2);
        $this->lastFeedTime = date('H:i');
    }
}

// =================================
// 🎮 Protected의 마법 체험하기
// =================================

echo "<h2> Protected 접근제어자 체험</h2>\n\n";

echo "<h3>===  동물 친구들 입소 ===</h3>\n";
$dog = new Dog("바둑이");
$cat = new Cat("나비");

echo "\n<h3>=== 공개 정보 확인 ===</h3>\n";
echo $dog->getPublicInfo() . "\n";
echo $cat->getPublicInfo() . "\n";

echo "\n<h3>=== 식사 시간 (각자 다른 방식) ===</h3>\n";
$dog->eat();
echo "\n";
$cat->eat();

echo "\n<h3>===  활동 시간 ===</h3>\n";
$dog->bark();
$dog->play();
echo "\n";
$cat->meow();
$cat->hunt();

echo "\n<h3>===  휴식 시간 ===</h3>\n";
$dog->sleep();
echo "\n";
$cat->sleep();

echo "\n<h3>===  Protected 접근 테스트 ===</h3>\n";
echo " 자식 클래스에서 protected 메서드 사용: 가능!\n";
echo " 자식 클래스에서 protected 속성 접근: 가능!\n";
echo " 외부에서 protected에 접근하려고 하면: 오류 발생!\n";

//  이런 코드들은 오류가 발생합니다:
// echo $dog->health;           // protected 속성
// $dog->updateHealth(10);      // protected 메서드
// echo $dog->medicalRecord;    // private 속성

echo "\n<h3>===  Protected의 장점 ===</h3>\n";
echo " 부모 클래스의 내부 구현을 자식이 활용 가능\n";
echo " 외부에서는 접근 불가능하여 데이터 보안 유지\n";
echo " 상속 관계에서만 공유되는 '가족의 비밀'\n";
echo " 코드 재사용성과 캡슐화의 완벽한 조화! \n";

?>