<?php
// oop 심화 : 상속(inheritance)
// 왜 상속이 필요할까 
// 가장 기본적이고 누구나 설명하는 동물원시스템을 만든다고 생각해보자

// class Dog{
//     public $name;
//     public $age;
//     public $weight;

//     public function eat(){
//         echo "{$this->name} 이 사료를 먹는다";
//     }
    
//     public function sleep(){
//         echo "{$this->name} 가 잔다";
//     }
    
//     public function bark(){
//         echo "{$this->name} 멍멍";
//     }
// }

// class Cat{
//     public $name;
//     public $age;
//     public $weight;

//      public function eat() {         // 🔄 개와 똑같음
//         echo "{$this->name}이(가) 사료를 먹습니다.\n";
//     }
    
//     public function sleep() {       // 🔄 개와 똑같음
//         echo "{$this->name}이(가) 잠을 잡니다.\n";
//     }
    
//     public function meow() {
//         echo "{$this->name}: 야옹!\n";
//     }
// }

// 코드가 중복되고 동물이 100마리라면 같은 코드만 100개를 써야한다
// 나중에 eat 메서드를 수정하려면 모든 클래스를 일일히 다 수정해야 함
// 이럴 때 상속으로 해결
//  공통부분을 부모클래스로 차이점들만 자식클래스로 구현하자 

// 부모 클래스
class Animal{
    public $name;
    public $age;
    public $weight;

    public function __construct($name, $age, $weight){
        $this->name = $name;
        $this->age = $age;
        $this->weight = $weight;
    }
    // 모든 동물이 공통으로 하는 부분 
    public function eat() {         
        echo "{$this->name}이(가) 사료를 먹습니다.\n";
    }
    
    public function sleep() {       
        echo "{$this->name}이(가) 잠을 잡니다.\n";
    }
    public function getInfo(){
        echo "이름 : {$this->name} 나이 : {$this->age} 몸무게 : {$this->weight}";
    }
}

// 자식클래스 [개]
class Dog extends Animal {
    // 부모의 모든 속성과 메서드를 자동으로 물려받는다

    // 개만의 메서드(행동)
    public function bark(){
        echo "{$this->name} 멍멍";
    }

    // 부모 메서드를 개선 (오버라이드)
    public function eat(){
        parent::eat();
        echo "꼬리를 흔들며 좋아한다";
    }
}

// 상속의 핵심개념들 !!!!!!

// extends 키워드
// class Dog extends Animal
//       자식          부모
// "Dog는 Animal을 확장한다"= 개는 동물이다

// Parent:: 키워드
// parent::eat() // 부모의 eat() 메서드 호출
// "부모님이 하던 방식으로 먼저 해줘 ~ "

// 오버라이드(override) 키워드
// 부모의 메서드를 자식이 다시 정의
// public function eat(){
//     // 자식만의 방식으로 구현
// }

//         상속을 쓰는 이유             \\
/*
1. 코드 재사용 금지 DRY 원칙
D : Don't
R : Repaet
Y : Yourself
같은 코드를 두 번 쓰지마라

2. 유지보수 편리
Animal 클래스의 getInfo()만 수정하면 
모든 동물 클래스에 자동 적용

3. 확장용이
새로운 동물(토끼,햄스터 등등) 을 추가 할 때
Animal을 상속 받으면 기본 기능은 자동으로 가짐

4. 일관성 유지
모든 동물이 같은 방식으로 정보를 관리
-> 시스템 전체가 일관됨


*/
?>