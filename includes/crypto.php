<?php
function encryptData($data)
{
    $key = 'YQUaTz9-4W4xyurv';
    $cipher = 'AES-128-CBC';
    $algorithm = 'sha256';
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $options = OPENSSL_RAW_DATA;
    $cipherTextRaw = openssl_encrypt($data, $cipher, $key, $options, $iv);
    $as_binary = true;
    $hmac = hash_hmac($algorithm, $cipherTextRaw, $key, $as_binary);
    $cipherText = base64_encode($iv . $hmac . $cipherTextRaw);

    return $cipherText;
}

function decryptData($data)
{
    $key = 'YQUaTz9-4W4xyurv';
    $cipher = 'AES-128-CBC';
    $algorithm = 'sha256';
    $cipherText = base64_decode($data);
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = substr($cipherText, 0, $ivLength);
    $sha2Length = 32;
    $hmac = substr($cipherText, $ivLength, $sha2Length);
    $cipherTextRaw = substr($cipherText, $ivLength + $sha2Length);
    $options = OPENSSL_RAW_DATA;
    $plainText = openssl_decrypt($cipherTextRaw, $cipher, $key, $options, $iv);
    $as_binary = true;
    $calcmac = hash_hmac($algorithm, $cipherTextRaw, $key, $as_binary);
    if (hash_equals($hmac, $calcmac)) {
        return $plainText;
    }
}
