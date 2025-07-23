<?php 
/*
🎯 전체 시나리오
한 명의 학생이 여러 과목의 성적을 관리하는 시스템을 만들어보세요!
📊 요구사항: StudentGrades 클래스
학생 정보:

학생 이름, 학번 (public)
과목별 성적 목록 (private) - 배열로 관리
총 학점 (private)

🎯 기능 요구사항
1. 성적 추가 기능 (addSubject($subjectName, $score, $credit))

과목명, 점수, 학점을 입력받음
점수는 0~100 사이만 허용
학점은 1~4 사이만 허용
같은 과목 중복 등록 방지

2. 성적 수정 기능 (updateScore($subjectName, $newScore))

기존 과목의 점수만 수정
없는 과목이면 "과목을 찾을 수 없습니다" 메시지

3. 과목 삭제 기능 (removeSubject($subjectName))

과목 전체 삭제
총 학점도 다시 계산

4. 학점 계산 기능 (calculateGPA())

A(90이상): 4.0
B(80이상): 3.0
C(70이상): 2.0
D(60이상): 1.0
F(60미만): 0.0
가중평균으로 계산 (학점 * 평점) / 총학점

5. 성적표 출력 (getReport())

모든 과목의 상세 정보
총 학점, 평균 학점 포함

6. 우등생 확인 (isHonorStudent())

평균 학점 3.5 이상이면 우등생
모든 과목이 C 이상이어야 함
*/


class StudentGrades {
    public $student_name;
    public $student_number;
    private $score_array;
    private $total_score;

    public function __construct($student_name, $student_number) {
        $this->student_name = $student_name;
        $this->student_number = $student_number;    
        $this->score_array = [
            "수학"=>['score' => 0,"credit" => 0],
            "영어"=>['score' => 0,"credit" => 0],
            "과학"=>['score' => 0,"credit" => 0],
            "체육"=>['score' => 0,"credit" => 0],
        ];
        $this->total_score = 0;
    }

    public function addSubject($subjectName,$score,$credit){
        if($this->score_array[$subjectName]){
            
            if($this->score_array[$subjectName]["score"] != 0 || $this->score_array[$subjectName['credit'] != 0]){
                if($score > 0 && $score <= 100){
                    $this->score_array[$subjectName]["score"] = $score;
                }
                if($credit >= 1 && $credit <= 4){
                    $this->score_array[$subjectName]["credit"] = $credit;
                }
            }else {
                return "이미 등록된 과목입니다";
            }
        }else {
            return "없는 과목입니다.";
        }
    }

    public function updateScroe($subjectName,$newscore){
        if($this->score_array[$subjectName]){
            if($newscore > 0 && $newscore <= 100){
            $this->score_array[$subjectName]["score"] = $newscore;
            }else {
                return "과목을 찾을 수 없습니다.";
            }
        }
    }

    public function removeSubject( $subjectName ){
        if($this->score_array[$subjectName]){
            unset($this->score_array[$subjectName]);
        }
    }

    public function calculateGPA(){
        if(is_array($this->score_array)){

            $total_point = 0;
            $total_credit = 0;

            foreach($this->score_array as $key => $value){
                if($value['score']){
                    $gradePoint = $this->getGradePoint($value['score']);
                }

                $total_point +=  $value['crdit']*$gradePoint;
                $total_credit += $value['credit'];
            }

            return $total_credit > 0 ? $total_point/$total_credit :0.0;
        }
    }

    public function getGradePoint($score){
        if ($score >= 90) return 4.0;      // A
        if ($score >= 80) return 3.0;      // B  
        if ($score >= 70) return 2.0;      // C
        if ($score >= 60) return 1.0;      // D
        return 0.0;               
    }

    public function getReport(){
        
    }
}

?>