@ECHO OFF

mkdir EXPORT
call .\vendor\bin\doctrine-module orm:convert-mapping --force --from-database annotation ./EXPORT/
call .\vendor\bin\doctrine-module orm:generate-entities ./EXPORT/ --generate-annotations=true

pause 