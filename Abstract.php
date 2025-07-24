<?php 
// Abstract class 추상 클래스
// 미완성 클래스

// =================================
// ✅ 진짜 추상클래스가 필요한 경우: 결제 시스템
// =================================

echo "<h3>=== ✅ 진짜 추상클래스가 필요한 경우 ===</h3>\n";

abstract class PaymentProcessor {
    protected $amount;
    protected $currency;
    protected $transactionId;
    
    // 🔄 결제 처리 순서를 강제하는 템플릿
    public function processPayment($amount, $currency = 'KRW') {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->transactionId = $this->generateTransactionId();
        
        echo "💳 결제 처리 시작: {$amount} {$currency}\n";
        
        // 1단계: 입력 검증 (각자 다름)
        if (!$this->validateInput()) {
            throw new Exception("입력 검증 실패");
        }
        
        // 2단계: 결제 전 준비 (각자 다름)
        $this->preparePayment();
        
        // 3단계: 실제 결제 처리 (각자 다름)
        $result = $this->executePayment();
        
        // 4단계: 결제 후 처리 (공통)
        $this->logTransaction($result);
        
        // 5단계: 후처리 (각자 다름)
        $this->afterPayment($result);
        
        echo "✅ 결제 완료: {$this->transactionId}\n";
        return $result;
    }
    
    // 공통 기능들
    protected function generateTransactionId() {
        return 'TXN_' . date('Ymd_His') . '_' . rand(1000, 9999);
    }
    
    protected function logTransaction($result) {
        echo "📝 거래 기록: {$this->transactionId} - " . ($result ? "성공" : "실패") . "\n";
    }
    
    // 🚨 각 결제 방식마다 반드시 다르게 구현해야 하는 것들
    abstract protected function validateInput();      // 카드번호 vs 계좌번호 vs...
    abstract protected function preparePayment();     // 카드사 연결 vs 은행 연결 vs...
    abstract protected function executePayment();     // 실제 결제 로직
    abstract protected function afterPayment($result); // 영수증 vs SMS vs...
}

// 신용카드 결제
class CreditCardPayment extends PaymentProcessor {
    private $cardNumber;
    private $expiryDate;
    private $cvv;
    
    public function __construct($cardNumber, $expiryDate, $cvv) {
        $this->cardNumber = $cardNumber;
        $this->expiryDate = $expiryDate;
        $this->cvv = $cvv;
    }
    
    protected function validateInput() {
        echo "🔍 신용카드 정보 검증...\n";
        return strlen($this->cardNumber) === 16 && strlen($this->cvv) === 3;
    }
    
    protected function preparePayment() {
        echo "🏦 카드사 연결 중...\n";
    }
    
    protected function executePayment() {
        echo "💳 신용카드 결제 실행: {$this->amount}{$this->currency}\n";
        return true; // 실제로는 카드사 API 호출
    }
    
    protected function afterPayment($result) {
        if ($result) {
            echo "📧 신용카드 결제 영수증 이메일 발송\n";
        }
    }
}

// 계좌이체 결제
class BankTransferPayment extends PaymentProcessor {
    private $accountNumber;
    private $bankCode;
    
    public function __construct($accountNumber, $bankCode) {
        $this->accountNumber = $accountNumber;
        $this->bankCode = $bankCode;
    }
    
    protected function validateInput() {
        echo "🔍 계좌 정보 검증...\n";
        return !empty($this->accountNumber) && !empty($this->bankCode);
    }
    
    protected function preparePayment() {
        echo "🏛️ 은행 시스템 연결 중...\n";
    }
    
    protected function executePayment() {
        echo "🏦 계좌이체 실행: {$this->amount}{$this->currency}\n";
        return true; // 실제로는 은행 API 호출
    }
    
    protected function afterPayment($result) {
        if ($result) {
            echo "📱 계좌이체 완료 SMS 발송\n";
        }
    }
}


echo "<h3>=== 💳 결제 테스트 ===</h3>\n";

$cardPayment = new CreditCardPayment("1234567812345678", "12/25", "123");
$cardPayment->processPayment(50000);

echo "\n";

$bankPayment = new BankTransferPayment("110-123-456789", "004");
$bankPayment->processPayment(30000);


?>