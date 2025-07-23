<?php

// oop_index.php 에서 사용하던 public 하고 private 는 무엇일까?
// 접근제어자 : access_modifier
// public / private / protected

// 예시 : 

class House {
    public $adders;  // 집주소 - 누구나 볼 수 있음
    private $safePassword; // 집 비밀번호 - 집 주인만 알아야 함
    protected $familyRule; // 가족 규칙 - 가족들 끼리만 알아야 함

    public function __construct($adders,$password){
        $this->adders = $adders; // 누구나 볼 수 있는 정보
        $this->safePassword = $password; // 비밀 정보
        $this->familyRule = "밤 10시 이후 조용히 하기";
    }

    // public 메서드 = 누구나 사용 가능 ( 현관문 역할)
    public function visitHouse(){
        echo "안녕하세요 {$this->adders} 에 오신걸 환영합니다.";
    }

    // private 메서드 = 이 클래스 내부에서 만 사용(개인 방)
    private function openSafe(){
        echo "현관문을 엽니다 현관 비밀번호 : {$this->safePassword}";
        return "집 내부";
    }

    // public 메서드로 안전하게 현관 접근
    public function getImportant($password){
        if($password === $this->safePassword){
            return $this->openSafe(); // private 메서드 호출
        }else {
            return "비밀번호가 틀립니다. 경보작동!";
        }
    }

    // protected 메서드 = 가족(자식클래스)들만 사용 가능
    protected function getFamilyRule(){
        return $this->familyRule;
    }   

}


//  사용
$myHouse = new House("서울시 강남구","12345");

// public 으로 외부에서 접근 가능
echo $myHouse->adders."\n"; // 서울기 강남구 출력 - 가능 ! 
$myHouse->visitHouse(); // 환영 메시지 출력 - 가능 !

// private 는 외부에서 접근 불가
// echo $myHouse->safePassword;  // 오류 접근할 수 없음.
// $myHouse->openSafe(); // 오류 접근할 수 없음.


// public 메서드를 통해서만 접근 가능
$myHouse->getImportant("12345"); // 성공
$myHouse->getImportant("123"); // 실패 


?>