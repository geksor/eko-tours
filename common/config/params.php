<?php
//$contactFile = __DIR__. '/contact.json';
//if (!is_file($contactFile)){
//    file_put_contents($contactFile, '{}');
//}
//$contact = json_decode(file_get_contents($contactFile), true);

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
//    'Contact' => $contact,
];
