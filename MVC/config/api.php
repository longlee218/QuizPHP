<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$GLOBALS['img_default'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAYAAAA8AXHiAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsIAAA7CARUoSoAAAALiSURBVHhe7d3BThtHAIBht4gDB16ikZJbyfs/RUh6Ts69VCqcEZWVRbEiQhzY32Vnvk9CzIKEsOZndsyu7N/+/uff+x2s7PflM6xKWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIZ7s/Evnz/vbm5ulqPtePvu3e7i4mI52r5hwrr+8GEZbdvl5eXujzdvlqPtGuJUOEpUe7e3t8to2+yxXqER/lCGOBUeTsTV+/fLaFs+Xl/v7u+/TcVWH8eDza9Yd3d3y2jb/ry6WkZjcCokISwS04S134c99kFjirCeCkhcjeHDOiYcca3PHouEsFZk5ftGWCt5iEpcXwlrBd/HJC5hvdiPIpo9ruHDOuaa23Ovy/0snpnjmmLFeiqcKqoHs8a1+bsb9heh//r0aTk6zV0Bz4nlmN/r8Oee4nGU7LF+0XNXoNlWLmH9gpfGMVNcwjrSWlHMEtf0YR0z0WvHMENcU4f1MMFPTXQVwehxTRvW9xP72ESPPvmlKcP6UTCHXxfVy0wX1s+C2X9fVC83VViCOZ1pwhLVaU0RlqhOb/iwRPX/mG7zzmkIi4SwSAiLhLBIuIP0FTl8BusOUniEsEhsPqyzs7Nl9NXhyy1uyWj/yB3uNUhHYY/F6rYe1d4QYe0n4vz8fDnathGi2hvmnSl4XZwKSQiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsAjsdv8B1ZDQyfvNmO8AAAAASUVORK5CYII=';
