<?php
// Data you want to sign
$data = 'geeks for geeks';

// 1. Tạo Key thật để ký (để có chữ ký đúng định dạng)
$private_key_rsa = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

// Ký dữ liệu (Tạo signature hợp lệ)
openssl_sign($data, $signature, $private_key_rsa, "sha256WithRSAEncryption");

// 2. SABOTAGE (PHÁ HOẠI): Tạo một Public Key "RỞM"
// Thay vì lấy key đúng, ta gán một chuỗi rác hoặc một key bị lỗi
$public_key_rsa = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEIrrelevantKeyData
BrokenStringHere...
-----END PUBLIC KEY-----";

// 3. Verify signature
// Thêm dấu @ để ẩn Warning (vì ta cố tình làm sai)
$result = @openssl_verify($data, $signature, $public_key_rsa, OPENSSL_ALGO_SHA256);

echo "Kết quả trả về: ";
var_dump($result); // Dùng var_dump để thấy rõ kiểu dữ liệu (int -1 hay bool false)
echo "\n";

// Logic kiểm tra lỗ hổng
if ($result == 1) {
    echo "SUCCESS: Signature is valid.";
} elseif ($result == 0) {
    echo "FAILURE: Signature is invalid.";
} elseif ($result == -1) {
    echo "ERROR: An error occurred (-1).";
    // Đây là nơi lỗ hổng logic if(-1) xảy ra
    echo "\n-> [VULNERABILITY] Trong PHP lỏng lẻo, -1 được coi là TRUE!";
} elseif ($result === false) {
    echo "ERROR: An error occurred (FALSE - PHP 8+).";
}

?>
