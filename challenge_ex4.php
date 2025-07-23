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
        $this->score_array = [];
        $this->total_score = 0;
    }

    public function addSubject($subjectName,$score,$credit){
        // 1 중복체크
        if(array_key_exists($subjectName,$this->score_array)){
            return "이미 등록된 과목입니다 {$subjectName}";
        }
        // 2 점수검증
        if($score < 0 || $score > 100){
            return "점수는 0~100 사이여야 합니다.";
        }
        // 3 학점검증
        if($credit < 1|| $credit > 5){
            return "학점은 1~5 사이여야 합니다.";
        }
        // 4 과목추가
        $this->score_array[$subjectName] = [
            "score" => $score,
            "credit" => $credit,
        ];
        
        
        return "{$subjectName} 과목이 추가 되었습니다 {$score} 점, {$credit} 학점";
    }

    public function updateScore($subjectName,$newscore)
    {
        if(!array_key_exists($subjectName,$this->score_array)){
            return "과목을 찾을 수 없습니다.";
        }

         if($newscore < 0 || $newscore > 100){
            return "점수는 0~100 사이여야 합니다.";
        }

        // 점수 업데이트
        $old_array = $this->score_array[$subjectName]['score'];
        $this->score_array[$subjectName]['score'] = $newscore;

        return "{$subjectName}의 점수가 {$old_array}에서 {$newscore}로 수정 되었습니다";
    }

    public function removeSubject( $subjectName ){
        if (!array_key_exists($subjectName, $this->score_array)) {
            return "과목을 찾을 수 없습니다: {$subjectName}";
        }
        
        unset($this->score_array[$subjectName]);
        return "{$subjectName} 과목이 삭제되었습니다";
    }

    public function calculateGPA(){
        if(empty($this->score_array)){
            return "0.0";
        }

        $total_point = 0;
        $total_credit = 0;

        foreach($this->score_array as $key => $val){
            $gradePoint = $this->getGradePoint($val["score"]);
            $total_point += $val['credit']*$gradePoint;
            $total_credit += $val['credit'];
        }

        return $total_credit > 0 ? round($total_point / $total_credit, 2) : 0.0;
    }

    public function getGradePoint($score){
        if ($score >= 90) return 4.0;      // A
        if ($score >= 80) return 3.0;      // B  
        if ($score >= 70) return 2.0;      // C
        if ($score >= 60) return 1.0;      // D
        return 0.0;               
    }

    public function getReport(){
        $report = "=== {$this->student_name}({$this->student_number}) 성적표 ===\n";
        
        if (empty($this->score_array)) {
            return $report . "등록된 과목이 없습니다.\n";
        }

        $totalCredit = 0;

        foreach($this->score_array as $key => $val){
            $grade = $this->getGradePoint($val['score']);
            $report .= "{$key} : {$val['score']} 점 {$val['credit']} 학점 {$grade} 등급";
            $totalCredit += $val['credit'];
        }

        $gpa = $this->calculateGPA();
        
        $report .= "------------------------\n";
        $report .= "총 학점: {$totalCredit}학점\n";
        $report .= "평균 학점: {$gpa}\n";
        
        return $report;

    }

    public function isHonorStudent() {
        if (empty($this->score_array)) {
            return false;
        }
        
        // 1. 평균 학점 3.5 이상 체크
        $gpa = $this->calculateGPA();
        if ($gpa < 3.5) {
            return false;
        }
        
        // 2. 모든 과목이 C(70점) 이상인지 체크
        foreach ($this->score_array as $subject => $data) {
            if ($data['score'] < 70) {
                return false;
            }
        }
        
        return true;
    }
}


//   🎮 테스트 코드
echo "<h2>🎓 학생 성적 관리 시스템 테스트</h2>";

$student = new StudentGrades("홍길동", "20240401");

echo "<h3>=== 과목 추가 테스트 ===</h3>";
echo "<p>" . $student->addSubject("수학", 95, 3) . "</p>";
echo "<p>" . $student->addSubject("영어", 88, 2) . "</p>";
echo "<p>" . $student->addSubject("과학", 76, 3) . "</p>";
echo "<p>" . $student->addSubject("수학", 90, 3) . "</p>"; // 중복 테스트
echo "<p>" . $student->addSubject("체육", 150, 2) . "</p>"; // 잘못된 점수

echo "<h3>=== 성적 수정 테스트 ===</h3>";
echo "<p>" . $student->updateScore("영어", 92) . "</p>";
echo "<p>" . $student->updateScore("음악", 85) . "</p>"; // 없는 과목

echo "<h3>=== 성적표 ===</h3>";
echo "<pre>" . $student->getReport() . "</pre>";

echo "<h3>=== 학점 계산 ===</h3>";
echo "<p>평균 학점: " . $student->calculateGPA() . "</p>";
echo "<p>우등생 여부: " . ($student->isHonorStudent() ? "✅ 우등생입니다!" : "❌ 더 열심히 하세요!") . "</p>";

echo "<h3>=== 과목 삭제 테스트 ===</h3>";
echo "<p>" . $student->removeSubject("과학") . "</p>";
echo "<pre>" . $student->getReport() . "</pre>";


?>