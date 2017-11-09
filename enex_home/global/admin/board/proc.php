<?
include $_SERVER["DOCUMENT_ROOT"]."/global.inc.php";
@header("Content-Type: text/html; charset=utf-8");

$boardConfig = new boardConfigClass();


//print_r($_POST); 

$location_code = "false";

if($_REQUEST[code] == "k_location" || $_REQUEST[code] == "i_location"){
	$location_code = "true";
}
if($location_code == "true"){
	$board = new locationClass();
}else{
	$board = new boardClass();
}



// BOARD CONFIG READ
if($_REQUEST[code]) {
    $boardConfig->code = $_REQUEST[code];
    $boardConfig->getBoardConfig();
    if($boardConfig->code == "") {
        echo "<script>alert('CODE 정보가 없습니다.');</script>";
        exit;        
    }
} else {
    echo "<script>alert('CODE 정보가 없습니다.');</script>";
    exit;
}

function send_mail_with_file($from_email,$from_name,$to_email,$subject,$body,$file){
	 if (strlen($to_email)==0) return 0; 
	$mailheaders .= "From: $from_name<$from_email> \r\n"; 
	$mailheaders .= "Reply-To: $from_name<$from_email>\r\n"; 
	$mailheaders .= "Return-Path: $from_name<$from_email>\r\n"; 
	$body = $body."\r\n\r\n";
	if(is_array($_FILES) && count($_FILES)>0 &&  $_FILES['file'][size][0] > 0) {
		$boundary = uniqid("part"); 
		if (strlen($file[type])==0) $file[type] = "application/octet-stream";
		$fp = fopen($_FILES['file'][tmp_name][0], "r");
		$file_content = fread($fp, $_FILES['file'][size][0]);
		fclose($fp);


		$mailheaders .= "MIME-Version: 1.0\r\n"; 
		$mailheaders .= "Content-Type: Multipart/mixed; boundary = \"".$boundary."\"";
 
		$bodytext = "This is a multi-part message in MIME format.\r\n\r\n"; 
		$bodytext .= "--".$boundary."\r\n"; 
		$bodytext .= "Content-Type: text/plain; charset=\"utf-8\"\r\n"; 
		$bodytext .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
		$bodytext .= chunk_split(base64_encode($body))."\r\n\r\n";
		$bodytext .= "--".$boundary."\r\n"; 
		$bodytext .= "Content-Type: ".$file[type]."; name=\"".$file[name][0]."\"\r\n";
		 $bodytext .= "Content-Transfer-Encoding: base64\r\n"; 
		$bodytext .= "Content-Disposition: attachment; filename=\"".$file[name][0]."\"\r\n\r\n";
		 $bodytext .= chunk_split(base64_encode($file_content))."\r\n\r\n";
		$bodytext .= "--".$boundary."--"; 
	} else { 
		
		$mailheaders .= "Content-Type: text/plain; charset=\"utf-8\"\r\n\r\n"; 
		$bodytext = $body . "\r\n\r\n"; 
	} 
	if(!mail($to_email,$subject,$bodytext,$mailheaders)) {return 0;} 
	return 1; 
}

/***************************************************
 ACTION 정의 (mode => write, update, delete, reply) act가 있어야함.
 ***************************************************/
if($_REQUEST[mode] && $_REQUEST[act]) {
    switch($_REQUEST[mode]) {
        case "write" :
        		if( $_REQUEST[code] == "k_prod01" || $_REQUEST[code] == "k_prod02" ) {
        			$_POST[opt5] = implode("," , $_POST[opt5]);
        		}
        		if( $_REQUEST[code] == "h_main") {
        			$_POST[opt2] = $_POST[write_subject];
        		}
            $board->code = $_REQUEST[code];
            $board->title = addslashes($_POST[title]);
            $board->content = addslashes($_POST[content]);
            if($_POST[sub_content]) $board->sub_content = addslashes($_POST[sub_content]);
            $board->write_name = $_POST[write_name]?$_POST[write_name]:$username;
            $board->write_id = $_POST[write_id]?$_POST[write_id]:$userid;
            $board->depth_code = $_POST[depth_code];
            $board->depth_step = $_POST[depth_step]?$_POST[depth_step]:0;
            $board->depth_order = $_POST[depth_order]?$_POST[depth_order]:0;
            $board->password = $_POST[password];
            $board->category = $_POST[category];
            $board->hit_cnt = 0;
            $board->link1 = $_POST[link1];
            $board->link2 = $_POST[link1];
            $board->write_email = $_POST[write_email]?$_POST[write_email]:$email;
            $board->opt1 = addslashes($_POST[opt1]);
            $board->opt2 = addslashes($_POST[opt2]);
            $board->opt3 = addslashes($_POST[opt3]);
            $board->opt4 = addslashes($_POST[opt4]);
            $board->opt5 = addslashes($_POST[opt5]);
            $board->opt6 = addslashes($_POST[opt6]); // 리스트 상단노출 20161227_lkhee
            $board->notice = $_POST[notice];
            $board->recommend_cnt = 0;
            $board->status = (isset($_POST[status]))?$_POST[status]:2; /*1 공지, 2 일반, 0 비노출*/
			if($_POST[arrival]) {$board->arrival =$_POST[arrival];}
            $board->insertBoard();
            
            // 첨부파일 업로드
            if($boardConfig->board_upload_count > 0 && is_array($_FILES)) {
                for($i=0; $i<count($_FILES['file']['name']); $i++) {
                    if($_FILES['file']['name'][$i] != "") {
                        $uploadName = $_FILES["file"][name][$i]?utilClass::gcUpload($_FILES["file"][name][$i],$_FILES["file"][tmp_name][$i],$_FILES["file"][size][$i], $_REQUEST[code]):"";    
                    
                        $board->file_name  = $_FILES["file"][name][$i];
                        $board->file_path  = $uploadName;
                        $board->file_size  = $_FILES["file"][size][$i];
                        $board->file_type  = $_FILES["file"][type][$i];
                        $board->file_order = $i+1;
                        $board->insertBoardFile();
               }} }
       
			/* 2016-07-25 오펠라 컨텐츠 등록 by David */
//			if($_REQUEST[code] == "o_prd_office"){
				$contents = $_POST[content_value];
				$con_subject = $_POST[con_subject];
				$con_order = $_POST[con_order];
				for($i=1;$i < count($contents);$i++){
					$board->comment_title = addslashes($con_subject[$i]);
					$board->comment_content = $contents[$i];
					$board->comment_write_name = "관리자";
					$board->comment_write_id = "admin";
					$board->comment_password = $con_order[$i];
					$board->comment_write_ip = $_SERVER["REMOTE_ADDR"];
					$board->comment_status = $_SERVER["REMOTE_ADDR"];
                    $board->insertBoardComment();
				}	
//			}
			/* 2016-07-25 오펠라 컨텐츠 등록 by David */
            // 오펠라 제품소개의 경우 추가이미지 저장 
            /*
            		[type]
            		(upfile1)제품이미지 : prod_img
            		(upfile2)상세이미지 : dtl_img
            		(upfile3)특징이미지 : ext_img
            		(upfile4)사이즈     : size_img
            		(upfile5)컬러       : color_img
            */

            if( $boardConfig->board_skin == "o_product" ) {
				  $i = 0;
				  if($_FILES['file']['name'][$i] != "") {
					  $uploadName = $_FILES["file"][name][$i]?utilClass::gcUpload($_FILES["file"][name][$i],$_FILES["file"][tmp_name][$i],$_FILES["file"][size][$i], $_REQUEST[code]):"";    
				  
					  $board->file_name  = $_FILES["file"][name][$i];
					  $board->file_path  = $uploadName;
					  $board->file_size  = $_FILES["file"][size][$i];
					  $board->file_type  = $_FILES["file"][type][$i];
					  $board->file_order = $i+1;
					  $board->insertBoardFile();
				  }
					for( $i = 1 ; $i < 7 ; $i++ ) {
					  if($_FILES['upfile'.$i]['name'] != "") {
						  $uploadName = $_FILES["upfile".$i][name]?utilClass::gcUpload($_FILES["upfile".$i][name],$_FILES["upfile".$i][tmp_name],$_FILES["upfile".$i][size], $_REQUEST[code]):"";    
					  
						  $file_name  = $_FILES["upfile".$i][name];
						  $file_path  = $uploadName;
					  } else {
						$file_name = "";
						$file_path = "";
					  }
										  
					if( $i == 1 ) $type  = "prod_img";
					else if( $i == 2 ) $type  = "tdl_img";
					else if( $i == 3 ) $type  = "ext_img";
					else if( $i == 4 ) $type  = "size_img";
					else if( $i == 5 ) $type  = "color_img";
					else if( $i == 6 ) $type  = "layout_img";

					$bidx = $board->idx;	              
					$query = "INSERT INTO gc_board_sub_file( bidx, code, type, file_name, file_path, regdate )
										VALUES( '{$bidx}', '{$_REQUEST[code]}', '{$type}', '{$file_name}', '{$file_path}', now() )";
					mysql_query($query);
					}
            } else if( $boardConfig->board_skin == "o_portfolio" ) {

				  if($_FILES['upfile']['name'] != "") {
					  $uploadName = $_FILES["upfile"][name]?utilClass::gcUpload($_FILES["upfile"][name],$_FILES["upfile"][tmp_name],$_FILES["upfile"][size], $_REQUEST[code]):"";    
				  
					  $file_name  = $_FILES["upfile"][name];
					  $file_path  = $uploadName;
				  } else {
					 $file_name = "";
					 $file_path = "";
				  }             
				  $type  = "logo_img";
				  $bidx = $board->idx;	                  
				   
				  $query = "INSERT INTO gc_board_sub_file( bidx, code, type, file_name, file_path, regdate )
									VALUES( '{$bidx}', '{$_REQUEST[code]}', '{$type}', '{$file_name}', '{$file_path}', now() )";
				 
				  mysql_query($query);
            }
			
			
			if($_REQUEST[finishmove] == "yes"){
	            echo "<script>alert(' finish 등록되었습니다.');location='".$_SERVER['HTTP_REFERER'] ."'</script>";
			}else{
	            echo "<script>alert(' finish end 등록되었습니다.');location='list.php?code=".$_REQUEST[code]."'</script>";
			}
        break;

	    case "location_write" :
            $board->code = $_REQUEST[code];
            $board->opt1 = $_REQUEST[brType];
            $board->title = addslashes($_POST[brName]);
            $board->opt2 = $_REQUEST[brZip];
            $board->content = addslashes($_POST[brAddress]);
            if($_POST[sub_content]) $board->sub_content = addslashes($_POST[brAddress]);
            $board->write_name = $_POST[brTel];
            $board->write_id = $_POST[brOldAddr];
            $board->depth_code = $_POST[sido];
            $board->depth_step = $_POST[gugun];
            $board->insertBoard();
            echo "<script>alert('등록되었습니다.');location='list.php?code=".$_REQUEST[code]."'</script>";
		break;

        case "location_update" :
            $board->idx = $_REQUEST[idx];
            $board->code = $_REQUEST[code];
			$board->opt1 = $_REQUEST[brType];
            $board->title = addslashes($_POST[brName]);
			$board->opt2 = $_REQUEST[brZip];
            $board->content = addslashes($_POST[brAddress]);
            if($_POST[sub_content]) $board->sub_content = addslashes($_POST[brAddress]);
            $board->write_name = $_POST[brTel];
            $board->write_id = $_POST[brOldAddr];
            $board->depth_code = $_POST[sido];
            $board->depth_step = $_POST[gugun];
			$board->updateBoard();

            echo "<script>alert('수정되었습니다.');location='location-write.php?mode=view&idx=".$idx."&code=".$_REQUEST[code]."'</script>";
		break;

        case "update" :
        		if( $_REQUEST[code] == "k_prod01" || $_REQUEST[code] == "k_prod02" ) {
        			$_POST[opt5] = implode("," , $_POST[opt5]);
        		}

				if( $_REQUEST[code] == "h_main") {
        			$_POST[opt2] = $_POST[write_subject];
        		}
            $board->idx = $_REQUEST[idx];
            $board->code = $_REQUEST[code];
            $board->title = addslashes($_POST[title]);
            $board->content = addslashes($_POST[content]);
            if($_POST[sub_content]) $board->sub_content = addslashes($_POST[sub_content]);
            $board->write_name = $_POST[write_name]?$_POST[write_name]:$username;
            $board->write_id = $_POST[write_id]?$_POST[write_id]:$userid;
            $board->depth_code = $_POST[depth_code];
            $board->depth_step = $_POST[depth_step]?$_POST[depth_step]:0;
            $board->depth_order = $_POST[depth_order]?$_POST[depth_order]:0;
            $board->password = $_POST[password];
            $board->category = $_POST[category];
            $board->hit_cnt = 0;
            $board->link1 = $_POST[link1];
            $board->link2 = $_POST[link1];
            $board->write_email = $_POST[write_email]?$_POST[write_email]:$email;
            $board->opt1 = addslashes($_POST[opt1]);
            $board->opt2 = addslashes($_POST[opt2]);
            $board->opt3 = addslashes($_POST[opt3]);
            $board->opt4 = addslashes($_POST[opt4]);
            $board->opt5 = addslashes($_POST[opt5]);
            $board->opt6 = addslashes($_POST[opt6]); // 리스트 상단노출 20161227_이경희
            $board->notice = $_POST[notice];
            $board->recommend_cnt = 0;
            $board->status = (isset($_POST[status]))?$_POST[status]:2; /*1 공지, 2 일반, 0 비노출*/
			
			if(isset($_POST[arrival_ck]) != ''){
				$board->arrival = $_POST[arrival_ck];
			} 
			//if($board->arrival){$board->arrival = (isset($_POST[arrival]))?1:0;}
			
            
			$board->updateBoard();
            
            for($i=0; $i < count($_REQUEST[file_del]);$i++) {
                $board->board_idx  = $_REQUEST[idx];
                $board->file_order = $_REQUEST[file_del][$i];
                $board->deleteBoardFile();
            }
            
            
            // 첨부파일 업로드
            if($boardConfig->board_upload_count > 0 && is_array($_FILES)) {
                //print_r($_FILES);
                for($i=0; $i<count($_FILES['file']['name']); $i++) {
                    if($_FILES['file']['name'][$i] != "") {
                        $uploadName = $_FILES["file"][name][$i]?utilClass::gcUpload($_FILES["file"][name][$i],$_FILES["file"][tmp_name][$i],$_FILES["file"][size][$i], $_REQUEST[code]):"";    
                        //echo $_FILES["file"][name][$i]."<br>";
                        $board->file_name  = $_FILES["file"][name][$i];
                        $board->file_path  = $uploadName;
                        $board->file_size  = $_FILES["file"][size][$i];
                        $board->file_type  = $_FILES["file"][type][$i];
                        $board->file_order = $i+1;
                        $board->insertBoardFile();
                    }
                }
            }



				$contents = $_POST[content_value];
				$con_subject = $_POST[con_subject];
				$con_order = $_POST[con_order];
				$con_idx = $_POST[con_idx];
				$con_idxs = $_POST[con_idxs];

				for($i=1;$i < count($con_idx);$i++){
					$board->comment_title = addslashes($con_subject[$i]);
					$board->comment_content = $contents[$i];
					$board->comment_write_name = "관리자";
					$board->comment_write_id = "admin";
					$board->comment_password = $con_order[$i];
					$board->comment_write_ip = $_SERVER["REMOTE_ADDR"];
					$board->comment_status = $_SERVER["REMOTE_ADDR"];
					if($contents[$i]){
						$query = "SELECT * FROM gc_board_".$boardConfig->code."_comment WHERE idx='".$con_idx[$i]."'";
						$res = mysql_query($query);
						$row = mysql_fetch_array($res);
						if($row["board_idx"]){
							mysql_query("update gc_board_".$boardConfig->code."_comment set title='".$board->comment_title."', content='".$board->comment_content."', password='".$board->comment_password."' WHERE idx='".$con_idx[$i]."'");
						}else{
							$board->insertBoardComment();
						}
					}
	            }

				for($i=1;$i < count($con_idxs);$i++){
					if(empty($con_idx[$i]) !== false){
						  mysql_query("DELETE FROM gc_board_".$boardConfig->code."_comment WHERE idx='".$con_idxs[$i]."'");
					}
				}


            // 오펠라 제품소개의 경우 추가이미지 저장 
            /*
            		[type]
            		(upfile1)제품이미지 : prod_img
            		(upfile2)상세이미지 : dtl_img
            		(upfile3)특징이미지 : ext_img
            		(upfile4)사이즈     : size_img
            		(upfile5)컬러       : color_img
            */
            if( $boardConfig->board_skin == "o_product" ) {
            	$i = 0;
              if($_FILES['file']['name'][$i] != "") {
                  $uploadName = $_FILES["file"][name][$i]?utilClass::gcUpload($_FILES["file"][name][$i],$_FILES["file"][tmp_name][$i],$_FILES["file"][size][$i], $_REQUEST[code]):"";    
              
                  $board->file_name  = $_FILES["file"][name][$i];
                  $board->file_path  = $uploadName;
                  $board->file_size  = $_FILES["file"][size][$i];
                  $board->file_type  = $_FILES["file"][type][$i];
                  $board->file_order = $i+1;
                  $board->insertBoardFile();
              }
              
            	for( $i = 1 ; $i < 7 ; $i++ ) {
	              if($_FILES['upfile'.$i]['name'] != "") {
                  $uploadName = $_FILES["upfile".$i][name]?utilClass::gcUpload($_FILES["upfile".$i][name],$_FILES["upfile".$i][tmp_name],$_FILES["upfile".$i][size], $_REQUEST[code]):"";    
              
                  $file_name  = $_FILES["upfile".$i][name];
                  $file_path  = $uploadName;
	             
	                if( $i == 1 ) $type  = "prod_img";
	                else if( $i == 2 ) $type  = "tdl_img";
	                else if( $i == 3 ) $type  = "ext_img";
	                else if( $i == 4 ) $type  = "size_img";
	                else if( $i == 5 ) $type  = "color_img";
	                else if( $i == 6 ) $type  = "layout_img";
	
	                $bidx = $board->idx;
	                
	                // 기존파일 있으면 삭제
	            		$query = "SELECT * FROM gc_board_sub_file WHERE code='{$_REQUEST[code]}' AND bidx='{$_REQUEST[idx]}' AND type = '{$type}'";
	            		$res = mysql_query($query);
	            		$row = mysql_fetch_array($res);
					        if($row[file_path]) {
					            @unlink($row["file_path"]);
					            mysql_query("DELETE FROM gc_board_sub_file WHERE idx='".$row["idx"]."'");
					        }
					        
					    $rowCount = mysql_num_rows($res);
					    
					    if ($rowCount > 0) {
			                $query = "UPDATE gc_board_sub_file SET
                						file_name = '{$file_name}',
                						file_path = '{$file_path}'
                					WHERE bidx = '$bidx' AND code = '{$_REQUEST[code]}' AND type = '{$type}'";
						    
					    } else {
						    $query = "INSERT INTO gc_board_sub_file( bidx, code, type, file_name, file_path, regdate )
                					VALUES( '{$bidx}', '{$_REQUEST[code]}', '{$type}', '{$file_name}', '{$file_path}', now() )";
					    }	
	                
// 						echo $rowCount.', '.$query; exit();

	                mysql_query($query);
	              }
            	}
            } else if( $boardConfig->board_skin == "o_portfolio" ) {
            	
              $type  = "logo_img";
              $bidx = $board->idx;	                  
                          	
            	//삭제 체크 되어있을경우/.
            	if( $upfile_del > 0 ) {

	              // 기존파일 있으면 삭제
	          		$query = "SELECT * FROM gc_board_sub_file WHERE code='{$_REQUEST[code]}' AND bidx='{$_REQUEST[idx]}' AND type = '{$type}'";
	          		$res = mysql_query($query);
	          		while( $row = mysql_fetch_array($res) ) {
					        if($row[file_path]) {
					            @unlink($row["file_path"]);
					        }
					        mysql_query("DELETE FROM gc_board_sub_file WHERE idx='".$row["idx"]."'");
					      }
            	}
            	
              if($_FILES['upfile']['name'] != "") {
                  $uploadName = $_FILES["upfile"][name]?utilClass::gcUpload($_FILES["upfile"][name],$_FILES["upfile"][tmp_name],$_FILES["upfile"][size], $_REQUEST[code]):"";    
              
                  $file_name  = $_FILES["upfile"][name];
                  $file_path  = $uploadName;
              } else {
              	$file_name = "";
              	$file_path = "";
              }

			if( $file_name != "" ) {
              // 기존파일 있으면 삭제
          		$query = "SELECT * FROM gc_board_sub_file WHERE code='{$_REQUEST[code]}' AND bidx='{$_REQUEST[idx]}' AND type = '{$type}'";
          		$res = mysql_query($query);
          		while( $row = mysql_fetch_array($res) ) {
				        if($row[file_path]) {
				            @unlink($row["file_path"]);
				        }
				        mysql_query("DELETE FROM gc_board_sub_file WHERE idx='".$row["idx"]."'");
				      }


	              $query = "INSERT INTO gc_board_sub_file( bidx, code, type, file_name, file_path, regdate )
	              					VALUES( '{$idx}', '{$_REQUEST[code]}', '{$type}', '{$file_name}', '{$file_path}', now() )";
	              mysql_query($query);

	            }
           }
            echo "<script>alert('수정되었습니다.');location='write.php?mode=view&idx=".$idx."&code=".$_REQUEST[code]."'</script>";
        break;

        case "reply" :
            $board->code = $_REQUEST[code];
   			if($_REQUEST[code] == "k_complaint"){
				$mailFrom = "jyhan@enex.co.kr";
				$mailName = "에넥스";
				$mailTo = $_POST[opt1];
				$fromName = '=?UTF-8?B?'.base64_encode($fromName).'?=';
				$title = '=?UTF-8?B?'.base64_encode("에넥스 답변-".addslashes($_POST[title])).'?=';
				$content = addslashes($_POST[content]);

				$result = send_mail_with_file($mailFrom,$fromName,$mailTo,$title,$content,$arrUpfile);
			}
            $board->title = addslashes($_POST[title]);
            $board->content = addslashes($_POST[content]);
            if($_POST[sub_content]) $board->sub_content = addslashes($_POST[sub_content]);
            $board->write_name = $_POST[write_name]?$_POST[write_name]:$username;
            $board->write_id = $_POST[write_id]?$_POST[write_id]:$userid;
            $board->depth_code = $_POST[depth_code];
            $board->depth_step = $_POST[depth_step]?$_POST[depth_step]:0;
            $board->depth_order = $_POST[depth_order]?$_POST[depth_order]:0;
            $board->password = $_POST[password];
            $board->category = $_POST[category];
            $board->hit_cnt = 0;
            $board->link1 = $_POST[link1];
            $board->link2 = $_POST[link1];
            $board->write_email = $_POST[write_email]?$_POST[write_email]:$email;
            $board->opt1 = addslashes($_POST[opt1]);
            $board->opt2 = addslashes($_POST[opt2]);
            $board->opt3 = addslashes($_POST[opt3]);
            $board->opt4 = addslashes($_POST[opt4]);
            $board->opt5 = addslashes($_POST[opt5]);
            $board->opt6 = addslashes($_POST[opt6]); // 리스트 상단노출 20161227_이경희
            $board->notice = $_POST[notice];
            $board->recommend_cnt = 0;
            $board->status = $board->status = (isset($_POST[status]))?$_POST[status]:2; /*1 공지, 2 일반, 0 비노출*/
			if($board->arrival){$board->arrival = $_POST[arrival];}
            $board->insertBoard();

            // 첨부파일 업로드
            if($boardConfig->board_upload_count > 0 && is_array($_FILES)) {
                //print_r($_FILES);
                for($i=0; $i<count($_FILES['file']['name']); $i++) {
                    if($_FILES['file']['name'][$i] != "") {
                        $uploadName = $_FILES["file"][name][$i]?utilClass::gcUpload($_FILES["file"][name][$i],$_FILES["file"][tmp_name][$i],$_FILES["file"][size][$i], $_REQUEST[code]):"";    
                    
                        $board->file_name  = $_FILES["file"][name][$i];
                        $board->file_path  = $uploadName;
                        $board->file_size  = $_FILES["file"][size][$i];
                        $board->file_type  = $_FILES["file"][type][$i];
                        $board->file_order = $i+1;
                        $board->insertBoardFile();
                    }
                }
            }
            echo "<script>alert('등록되었습니다.');location='list.php?code=".$_REQUEST[code]."'</script>";
        break;
        case "delete" :
            $board->code = $_REQUEST[code];
            $board->idx  = $_REQUEST[idx];
            $board->deleteBoard();
            
            // 오펠라 제품소개, 납품사례 삭제일 경우 추가 삭제 진행
            if( $boardConfig->board_skin == "o_product" || $boardConfig->board_skin == "o_portfolio" ) {
            		$query = "SELECT * FROM gc_board_sub_file WHERE code='{$_REQUEST[code]}' AND bidx='{$_REQUEST[idx]}'";
            		$res = mysql_query($query);
            		while( $row = mysql_fetch_array($res) ) {
					        if($row[file_path]) {
					            @unlink($row["file_path"]);
					        }
            		}
            		$query = "DELETE FROM gc_board_sub_file WHERE code='{$_REQUEST[code]}' AND bidx='{$_REQUEST[idx]}'";
            		mysql_query($query);
            }
            
            echo "<script>alert('삭제되었습니다.');location='list.php?code=".$_REQUEST[code]."'</script>";
        break;
    }
    exit;
}

/***************************************************
 HTML TOP 
 ***************************************************/
// INCLUDE LINK가 있을경우
if($boardConfig->head_link != "") {
    include $_SERVER["DOCUMENT_ROOT"].$boardConfig->head_link;
}

// CONTENT가 있을경우
if($boardConfig->head_content != "") {
    echo $boardConfig->head_content;
}
include_once _INCLUDE_DIR_."/board_top.php";

/***************************************************
 HTML BODY
 ***************************************************/
if($boardConfig->board_skin != "")  {
    // 게시판 코드 설정
    $board->code = $_REQUEST[code];
    if($boardConfig->category_yn == "Y") {
        $board->getBoardCategoryList();
    }
    
    if($_REQUEST[mode] == "list" || $_REQUEST[mode] == "") {
        //게시판 사용 조건
        $board->category_yn        = $boardConfig->category_yn; 
        $board->comment_yn         = $boardConfig->comment_yn;
        $board->reply_yn           = $boardConfig->reply_yn;
        $board->board_upload_count = $boardConfig->board_upload_count;
        
        $board->getBoardList();
        
        // 리스트
        include $_SERVER["DOCUMENT_ROOT"]."/golden_cube/skin/".$boardConfig->board_skin."/list.php";
    } else if($_REQUEST[mode] == "write") {
        // 등록
        include $_SERVER["DOCUMENT_ROOT"]."/golden_cube/skin/".$boardConfig->board_skin."/write.php";
    } else if($_REQUEST[mode] == "edit") {
        if($_REQUEST[idx] == "") exit;
        $board->idx = $_REQUEST[idx];
        $board->getBoardInfo();
        
        // 수정
        include $_SERVER["DOCUMENT_ROOT"]."/golden_cube/skin/".$boardConfig->board_skin."/write.php";
    } else if($_REQUEST[mode] == "reply") {
        $board->idx = $_REQUEST[idx];
        $board->getBoardInfo();
        
        $board->title   = "[RE] ".$board->title;
        $board->content = "\n\n============================[RE]============================\n".$board->content;
        
        // 답변
        include $_SERVER["DOCUMENT_ROOT"]."/golden_cube/skin/".$boardConfig->board_skin."/write.php";
    } else if($_REQUEST[mode] == "delete") {
        // 삭제
        $board->idx = $_REQUEST[idx];
        $board->getBoardDelete();
    } else if($_REQUEST[mode] == "view") {
        if($_REQUEST[idx] == "") exit;
        $board->idx = $_REQUEST[idx];
        
        $board->getBoardInfo();
        
        
        // 상세
        include $_SERVER["DOCUMENT_ROOT"]."/golden_cube/skin/".$boardConfig->board_skin."/view.php";
    } else {
        // 리스트
        include $_SERVER["DOCUMENT_ROOT"]."/golden_cube/skin/".$boardConfig->board_skin."/list.php";
    }
}

/***************************************************
 HTML FOOTER
 ***************************************************/
// INCLUDE LINK가 있을경우
if($boardConfig->footer_link != "") {
    include $_SERVER["DOCUMENT_ROOT"].$boardConfig->footer_link;
}
// CONTENT가 있을경우
if($boardConfig->footer_content != "") {
    echo $boardConfig->footer_content;
}
include_once _INCLUDE_DIR_."/board_footer.php";
?>