<?php 

// 고충 편 
// 개념이나 이해가 되지 않았던것을 풀어보자

// public / private /protected 를 언제 써야할까 

// 정말 간단한 판단기준이 있다
// 처음엔 무조건 private 으로 작성 ! 

// 모든걸 일단 private으로 만들고
// 외부에서 써야하는 것만 public으로 후에 바꾼다
class Test{
    private $name;
    
    private function calculateTest(){

    }
}

//               예제                \\
class Phone{

    // 모든것을 private으로
    private $brand;           // 브랜드명
    private $model;           // 모델명
    private $battery;         // 배터리 잔량
    private $isLocked;        // 잠금 상태
    private $contacts;        // 연락처 목록
    
     private function chargeBattery() {}      // 배터리 충전
    private function connectToNetwork() {}   // 네트워크 연결
    private function playRingtone() {}      // 벨소리 재생
    
    // 2단계: 외부에서 써야 하는 것만 public으로!
    public function __construct($brand, $model) {}  // 생성자
    public function makeCall($number) {}            // 전화 걸기
    public function sendMessage($number, $text) {}  // 문자 보내기
    public function unlock($password) {}            // 잠금 해제
    public function getBatteryLevel() {}            // 배터리 확인
}

// private으로 한것들 :
/*
$bettery -> 외부에서 조작 하면 안됨
$isLocked -> 보안상 중요한 정보
$playRingtone -> 내부에서만 사용하는 기능
$connectToNetwork -> 사용자가 직접 쓰는게 아님
*/ 

// public으로 한것들 : 
/*
makeCall() -> 사용자가 직접 써야하는 기능
getBatteryLevel() -> 사용자가 직접 확인해야하는 기능
unlock() -> 사용자가 직접 써야하는 기능
*/


// 사용판단의 근거는 원초적인 개념보단 
// 쉽게 생각 할 필요가 있는것같다고 생각을 한다
// 3단계의 판단으로 구분하는데

// 1 : 누가 이걸 사용할까 ?
// 2 : 이게 망가지면 어떻게 될까 ?
// 3 : 이게 바뀌면 다른것도 바뀌어야 할까 ?

// 이렇게 3단계로 생각을 해본다면 내가 선언하거나 만드는 속성이나 메서드를 public 인지 private 인지 쉽게 정할 수 있다
// 사용자가 직접 해야하는가 ? ->YES = public
// 외부에서 함부러 바꾸면 위험한가 ? -> YES = private
// 잘모르겠으면 일단 private 나중에 바꾸면 됨

// 초기, 초반에는 protected 를 사용할 일이 없다
// 상속을 많이 써봐야 protected의 필요성을 느낀다





?>