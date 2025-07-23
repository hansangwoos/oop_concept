<?php

// 기존 레거시 코드 일 떄 

$user_name = "홍길동";
$user_email = "hgd@naver.com";
$user_age = 25;

function send_email($name,$email,$message){
    echo "{$name} - {$email} 에게 {$message} 메일 발송합니다.";
}

send_email($user_name,$user_email,"안녕하세요");

// 위의 레거시코드의 문제점
// 1. 사용자가 100명이면 변수가 300개가 된다.
// 2. 사용자 관련 함수들이 흩어져 있음. 
// 3. 데이터와 기능이 분리되어 있음


/** 객체지향의 해결책 */

class user {

    private $name;
    private $email;
    private $message;

    function __construct($name,$email,$message){
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function send_email(){
        if($this->dateEmail()){
            echo "{$this->name} - {$this->email} 에게 {$this->message} 메일 발송합니다.";
        }
    }

    private function dateEmail(){
        return filter_var($this->email, FILTER_SANITIZE_EMAIL);
    }
};

// 사용 
$uesr1 = new user("홍길동","hgd@naver.com","안녕하세요");
$user2 = new user("박휘순","phs@naver.com","안녕할게요");

// 장점 : 
// 1. 사용자가 100명이여도 User 클래스 하나로해결
// 2. 사용자 관련 모든 기능을 한번에 
// 3. 데이터와 기능이 하나의 단위로 묶임




?>