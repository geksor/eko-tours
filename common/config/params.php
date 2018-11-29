<?php
$contactFile = __DIR__. '/contact.json';
if (!is_file($contactFile)){
    file_put_contents($contactFile, '{}');
}
$contact = json_decode(file_get_contents($contactFile), true);

$homePageFile = __DIR__. '/home-page.json';
if (!is_file($homePageFile)){
    file_put_contents($homePageFile, '{}');
}
$homePage = json_decode(file_get_contents($homePageFile), true);

$commPageFile = __DIR__. '/comm-page.json';
if (!is_file($commPageFile)){
    file_put_contents($commPageFile, '{}');
}
$commPage = json_decode(file_get_contents($commPageFile), true);

$timetableFile = __DIR__. '/timetable-page.json';
if (!is_file($timetableFile)){
    file_put_contents($timetableFile, '{}');
}
$timetablePage = json_decode(file_get_contents($timetableFile), true);

$aboutFile = __DIR__. '/about-page.json';
if (!is_file($aboutFile)){
    file_put_contents($aboutFile, '{}');
}
$aboutPage = json_decode(file_get_contents($aboutFile), true);

$touristFile = __DIR__. '/tourist-page.json';
if (!is_file($touristFile)){
    file_put_contents($touristFile, '{}');
}
$touristPage = json_decode(file_get_contents($touristFile), true);

$toursFile = __DIR__. '/tours-page.json';
if (!is_file($toursFile)){
    file_put_contents($toursFile, '{}');
}
$toursPage = json_decode(file_get_contents($toursFile), true);

$accomFile = __DIR__. '/accom-page.json';
if (!is_file($accomFile)){
    file_put_contents($accomFile, '{}');
}
$accomPage = json_decode(file_get_contents($accomFile), true);

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'Contact' => $contact,
    'HomePage' => $homePage,
    'CommPage' => $commPage,
    'TimetablePage' => $timetablePage,
    'AboutPage' => $aboutPage,
    'TouristPage' => $touristPage,
    'ToursPage' => $toursPage,
    'AccomPage' => $accomPage,
];
