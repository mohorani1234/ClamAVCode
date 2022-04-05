{\rtf1\ansi\ansicpg1252\cocoartf2625
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fnil\fcharset0 Menlo-Regular;}
{\colortbl;\red255\green255\blue255;\red38\green38\blue38;\red242\green242\blue242;}
{\*\expandedcolortbl;;\cssrgb\c20000\c20000\c20000;\cssrgb\c96078\c96078\c96078;}
\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\deftab720
\pard\pardeftab720\partightenfactor0

\f0\fs32 \cf2 \cb3 \expnd0\expndtw0\kerning0
\outl0\strokewidth0 \strokec2 <?php\
$upload_dir = '/var/www/uploads/';\
\
if($_POST)\{\
  $error = '';\
  //print_r($_FILES);\
  if($_FILES['file']['size'] == 0 || !is_file($_FILES['file']['tmp_name']))\{\
     $error .= 'Please select a file for upload!';\
  \} else \{\
    cl_setlimits(5, 1000, 200, 0, 10485760);\
    if($malware = cl_scanfile($_FILES['file']['tmp_name'])) $error .= 'We have Malware: '.$malware.'<br>ClamAV version: '.clam_get_version();\
  \}\
  if($error == '')\{\
    rename($_FILES['file']['tmp_name'], $upload_dir.$_FILES['file']['name']);\
  \}\
\}\
?>\
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\
<html>\
<head>\
<title>File-Upload</title>\
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">\
</head>\
\
<body>\
<form method="post" action="upload.php" name="fileupload" enctype="multipart/form-data">\
<table width="100%" border="0" cellspacing="0" cellpadding="2">\
  <tr><td><b>File Upload</b></td></tr>\
  <tr><td>\'a0</td></tr>\
  <?php\
  if(isset($error))\{\
    if($error != '')\{\
  ?>\
  <tr><td><?php echo cl_info(); ?></tr>\
  <tr><td><b>Error:</b> <?php echo $error; ?></td></tr>\
  <?php\
    \} else \{\
  ?>\
  <tr><td><b>File <?php echo $_FILES['file']['name']; ?> has successfully been uploaded to <?php echo $upload_dir; ?>!</b></td></tr>\
  <?php\
    \}\
  \}\
  ?>\
  <tr><td>\
    <table width="500" border="0" cellspacing="0" cellpadding="2">\
      <tr>\
        <td width="126">File:</td>\
        <td width="366"><input type="file" name="file" size="30" value="" maxlength="255"></td>\
      </tr>\
      <tr>\
        <td>\'a0</td>\
        <td><input name="Upload" type="submit" value="Upload"> <input name="Cancel" type="reset" value="Cancel"></td>\
      </tr>\
    </table>\
  </td></tr>\
</table>\
</form>\
</body>\
</html>\
}