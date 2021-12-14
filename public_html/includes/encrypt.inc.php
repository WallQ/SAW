<?php

function encryptData($data)
{
    $key = 'ww7LB8FP&]4Cmff>}j~YRG`t[Twx_z,cSe*wsQ]C(U2L<XchzdJp5Tbm8TgNVP9*nDvEJCDeqFEB#/^Z9<pY[eGc[m9F%BK,pf5}Stw>`?F~J~v(U#3@C<t}%^wBJ/{>@R-AhUJ.K*#tT}4t<b*rj>%";2$;9=>Mbk6x#c8NaNR5uWQh"}n*d5U8#ptu->Z25u/`5f%q;_s/<\@Y5%s-#stvK]Nkt#Ypg*jG#_d>R~J8t#Bd@WMm^R!_u~^<fD6C';
    $cipher = "AES-128-CBC";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $options = OPENSSL_RAW_DATA;
    $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options, $iv);
    $as_binary = true;
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);

    return $ciphertext;
}

function decryptData($data)
{
    $key = 'ww7LB8FP&]4Cmff>}j~YRG`t[Twx_z,cSe*wsQ]C(U2L<XchzdJp5Tbm8TgNVP9*nDvEJCDeqFEB#/^Z9<pY[eGc[m9F%BK,pf5}Stw>`?F~J~v(U#3@C<t}%^wBJ/{>@R-AhUJ.K*#tT}4t<b*rj>%";2$;9=>Mbk6x#c8NaNR5uWQh"}n*d5U8#ptu->Z25u/`5f%q;_s/<\@Y5%s-#stvK]Nkt#Ypg*jG#_d>R~J8t#Bd@WMm^R!_u~^<fD6C';
    $c = base64_decode($data);
    $cipher = "AES-128-CBC";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($c, 0, $ivlen);
    $sha2len = 32;
    $hmac = substr($c, $ivlen, $sha2len);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $options = OPENSSL_RAW_DATA;
    $plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    if (hash_equals($hmac, $calcmac))  return $plaintext;
}
