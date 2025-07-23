<?php 
// 실전예제 challenge 1

// ; 문제 1: 학생 관리 시스템
// ; 요구사항:

// ; 학생의 이름, 학번, 나이를 저장
// ; 성적을 private으로 관리 (0~100점만 허용)
// ; 성적 입력, 조회 메서드 만들기
// ; 학점 계산 메서드 (90이상 A, 80이상 B, 70이상 C, 60이상 D, 미만 F)


class Student {
    // 속성들 (변수들)
    public $name;        // 이름 - 외부에서 볼 수 있어도 됨
    public $studentId;   // 학번 - 외부에서 볼 수 있어도 됨  
    public $age;         // 나이 - 외부에서 볼 수 있어도 됨
    private $score;      // 성적 - 보호해야 함
    
    // 생성자 (학생을 만들 때 필요한 정보)
    public function __construct($name, $studentId, $age) {
        $this->name = $name;
        $this->studentId = $studentId;
        $this->age = $age;
        $this->score = 0;
    }
    
    // 성적 입력 메서드
    public function setScore($score) {
        // 여기에 성적 설정 코드
        if($this->score > 0 && $this->score <= 100){
            $this->score=$score; // 성적 저장
        }else {
            return "성적은 0~100점 사이여야 합니다";
        }
    }
    
    // 성적 조회 메서드  
    public function getScore() {
        // 여기에 성적 조회 코드
        return $this->score;
    }
    
    // 이름 조회 메서드
    public function getName() {
        return $this->name;
    }
    
    // 학점 계산 메서드
    public function getGrade() {
        // 여기에 학점 계산 코드
       if ($this->score >= 90) {
            return "A";
        } elseif ($this->score >= 80) {
            return "B";
        } elseif ($this->score >= 70) {
            return "C";
        } elseif ($this->score >= 60) {
            return "D";
        } else {
            return "F";
        }
        
    }
}

// 테스트 코드
$student = new Student("김철수", "2024001", 20);
$student->setScore(85);
echo $student->getName() . "의 학점: " . $student->getGrade(); // "김철수의 학점: B"

?>