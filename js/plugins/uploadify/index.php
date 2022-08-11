<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>uploadfify by itangmo.com</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="js/jquery.uploadify-3.1.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/uploadify.css">
    </head>
    <body>
        <script type="text/javascript">
            $(document).ready(function() {	
                load(); 
                function load(){ //function load()
                    $.get(
                        'show.php', //แสดงผลรูปที่เพิ่งอัพโหลดไปโดยผ่านไฟล์ show.php
                        {},
                        function(data){
                            $("#show").html(data); //ให้ไปแสดงผลที่ div id show
                        }
                    );		
                }
                $('#file_upload').uploadify({
                        'auto'     : true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
                        'swf'      : 'images/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
                        'uploader' : 'uploadify.php', //เมื่อ submit แล้วให้ action ไปที่ไฟล์ไหน
                        'fileSizeLimit' : '1024KB',//อัพโหลดได้ครั้งละไม่เกิน 1024kb
                        'fileTypeExts' : '*.gif; *.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
                        'multi'    : true,//เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
                        'queueSizeLimit' : 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
                        'onUploadComplete' : function() { //เมื่ออัพโหลดเสร็จแล้วให้เรียกใช้งาน function load()
                            load();
                        }
                });
            });
        </script>
        <style>
            .upload {
                margin: 0 auto;
                width: 960px;
            }
        </style>
        <div class="upload">
            <p>
                <a href="http://www.itangmo.com">Uploadify by itangmo.com</a>
            </p>
            <ul>
                <li>อัพโหลดได้เฉพาะ .gif , .jpg , .png</li>
                <li>อัพโหลดได้ไม่เกินครั้งละ 300kb</li>
                <li>อัพโหลดได้ไม่เกินครั้งละ 5 ไฟล์</li>
            </ul>
            <form>
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple="true">
            </form>
        </div>
        <div id="show">

        </div>
    </body>
</html>
