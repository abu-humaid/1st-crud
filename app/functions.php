<?php

  // File upload Filesystem

  function fileUpload($file, $location ='', $file_format = ['jpg','png','gif'], $file_type = null ){
      // File Info
       $file_name = $file['name'];
       $file_name_temp = $file['tmp_name'];

      // File name extension
      $file_array = explode('.', $file_name);
      $file_extension = strtolower(end($file_array));

      // File type default value
      if( !isset($file_type['type'])){
        $file_type['type'] = 'image';
      }
      if( !isset($file_type['file_name'])){
        $file_type['file_name'] = '';
      }
      if( !isset($file_type['fname'])){
        $file_type['fname'] = '';
      }
      if( !isset($file_type['lname'])){
        $file_type['lname'] = '';
      }

      // File name with type
      if( $file_type['type'] == 'image' ){
        // File name generate
        $file_name = md5(time().rand()).'.'.$file_extension;
      }elseif( $file_type['type'] == 'file' ) {
        $file_name=date('d_m_Y_g_h_s').'_'.$file_type['file_name'].'_'.$file_type['fname'].'_'.$file_type['lname'].'.'.$file_extension;
      }

      // File upload 
      $mess ='';
      if( in_array($file_extension, $file_format)== false){
        $mess = '<p class="alert alert-danger"> Invalid file format !! <button class="close" data-dismiss="alert">&times;</button> </p>' ;
      }else {
        // File upload to dir
        move_uploaded_file($file_name_temp, $location . $file_name);
      }

      return [
        'mess' => $mess,
        'file_name' => $file_name
      ];


  }















?>
