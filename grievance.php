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


///////////////////////////////////////////////////////////////



// 추상클래스 
// abstract class PaymentProcessor
// 추상 클라스는 직접 객체생성이 되지않는다. 
// 추상 클래스가 필요한 경우는
// 1. 템플릿 메서드 구현 - 처리 순서를 강제해야할 떄
// 2. 부분 구현 - 일부는 공통, 일부는 강제 구현
// 3. 프레임워크 설계 - 확장포인트를 명확히 해야할 때 



////////////////////////////////////////////////////////////////

// 클래스 멤버. 
// static : 정적 
// 서로 데이터를 공유해야할 경우 이러한 데이터를 static 멤버라고 함
// static 멤버는 변수와 메서드가 존재하며
// class::변수명 / class::메소드명 으로 접근한다 !
// 여기서 :: <- 이건 스코프 해결 연산자라고 함
// 정적메소드란 객체로부터가 아닌 클래스로부터 호출되는 메소드를 의마한다
// 이 정적 메소드는 어떤 객체 속성에도 접근성을 갖지 않는다 

// 클래스 소속의 멤버를 만든다 ~ 
// static 이없는 것들은 인스턴스의 것 

//  예시 ! 

class A {
    static function print_hello(){
        echo "Hello world";
    }
}

A::print_hello(); // A 클래스의 static 형 print_hello(). hello world 출력

// 이해가 안되어 다른 예시로 

class Person{
    private static $count = 0;
    private $name;

    public function __construct($name){
        $this->name = $name;
        self::$count++;
    }

    public function enter(){
        echo "Enter".$this->name." ".self::$count;
    }

    static function getCount(){
        return self::$count;
    }
    // 앞에 static 이 붙으면 인스턴스의 것이 아닌
    // class의 것이라는 약속 이다
}

// 위에 static $count를 안하고 그냥 private $count 를 하면
// 아래와 같은 카운트들은 그저 1로만 출력이된다

$p1 = new Person("상우");
$p1->enter();

$p2 = new Person("길동");
$p2->enter();

$p3 = new Person("철수");
$p3->enter();

// 출력 결과

// 상우 1
// 길동 2
// 철수 3

//  만약 $count가 정적변수가 아니였으면 출력결과의 숫자들은 모두다 1을 가지게 된다
// 여기서 총 객체 즉 인스턴스가 몇번 불러왔는지 count 값을 알고싶으면

// echo $p4->getCount(); 이렇게 쓴다기보다

echo Person::getCount(); // 이렇게 쓰는게 훨씬 낫다 
// 이렇게 사용하려면 물론 메서드에 static 이 붙어야한다 
// 정적 메서드가 됐을때에는 클래스에서 직접 불러올 수 있다 

?>