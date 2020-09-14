@echo off
:label
    php -f C:\xampp\htdocs\QuizSys\cron.php
timeout 60
GOTO :label