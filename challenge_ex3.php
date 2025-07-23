<?php 
// 문제 3: 간단한 계산기 클래스

/**
 요구사항:

두 개의 숫자를 private으로 저장
더하기, 빼기, 곱하기, 나누기 메서드 구현
0으로 나누기 방지
결과를 문자열로 예쁘게 출력

상세 조건:

계산 결과는 소수점 2자리까지만 표시
0으로 나누려고 하면 "0으로 나눌 수 없습니다" 메시지
각 계산마다 "A + B = C" 형태로 출력
 */
class Calculator {
    private $num1;  
    private $num2;
    
    public function __construct($num1, $num2) {
       $this->num1 = $num1;
       $this->num2 = $num2;
    }
    
    public function add() {
        $result = 0;

        $result = $this->num1 + $this->num2; 

        return "{$this->num1} + {$this->num2} = {$result}";
    }
    
    public function subtract() {
        $result = 0;
        $result = $this->num1 - $this->num2; 

        return "{$this->num1} - {$this->num2} = {$result}";
    }
    
    public function multiply() {
        $result = 0;
        $result = $this->num1 * $this->num2; 

        return "{$this->num1} * {$this->num2} = {$result}";
    }
    
    public function divide() {
        // 나누기 기능 (0으로 나누기 체크!)
        if($this->num1 > 0 && $this->num2 >0 ){
            $result = 0;
            $result = $this->num1 / $this->num2; 
            $result = number_format($result,2);
            return "{$this->num1} * {$this->num2} = {$result}";
        }else {
            return "0으로 나눌 수 없습니다";
        }
    }
    
    public function getAllResults() {
        $result = [
            "plus" => $this->add(),
            "minus" => $this->subtract(),
            "multiply" => $this->multiply(),
            "divide" => $this->divide(),
        ];

        return $result;
    }
}

// 테스트 코드
$calc = new Calculator(10, 3);

echo "=== 🧮 계산기 테스트 ===\n";
echo $calc->add() . "\n";
echo $calc->subtract() . "\n";
echo $calc->multiply() . "\n";
echo $calc->divide() . "\n";

echo "\n=== 📊 전체 결과 ===\n";
echo $calc->getAllResults();

// 0으로 나누기 테스트
$calc2 = new Calculator(15, 0);
echo "\n=== ⚠️ 예외 상황 ===\n";
echo $calc2->divide() . "\n";
?>

