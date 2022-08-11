	function SwalUpdateAdmin(dataid,dataname,linkLoad,linkUrl,Mode){
    
			     $.ajax({
			   		url: linkUrl,
			    	type: 'POST',
			       	data: 'mode='+Mode+'&id='+dataid,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('อัพเดทข้อมูล!', response.message, response.status);
					setTimeout(function () {
					readObjid(linkLoad);
					}, 1000);
			     })
			     .fail(function(){
					 setTimeout(function () {
			     	swal('มีปัญหา...', response.message, 'error');
					}, 1000);
			     });
	
	}


	function SwalDelete(dataid,dataname,linkLoad,linkUrl,OP){
            var confirm_text = "ต้องการลบ ["+dataname+"] ใช่หรือไม่?";
			swal({
					title: "ยืนยันการลบข้อมูล",
					text: confirm_text,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: linkUrl,
			    	type: 'POST',
			       	data: 'OP='+OP+'&id='+dataid,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('ลบข้อมูล!', response.message, response.status);
					setTimeout(function () {
					readObjid(linkLoad);
					}, 1000);
			     })
			     .fail(function(){
					 setTimeout(function () {
			     	swal('มีปัญหา...', response.message, 'error');
					}, 1000);
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
	}
	
	function readObjid(linkLoad){
		//$('#load-products').load('read.php');	
		//load();
		window.location = linkLoad;
	}

	
	function SwalDeleteAll(dataid,dataname,linkLoad,linkUrl,OP){
            var confirm_text = "ต้องการลบข้อมูลที่เลือกใช่หรือไม่?";
			swal({
					title: "ยืนยันการลบข้อมูล",
					text: confirm_text,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: linkUrl,
			    	type: 'POST',
			       	data: 'OP='+OP+'&id='+dataid,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('ลบข้อมูล!', response.message, response.status);
					setTimeout(function () {
					readAllObjid(linkLoad);
					}, 1000);
			     })
			     .fail(function(){
					setTimeout(function () {
			     	swal('มีปัญหา...', response.message, 'error');
					}, 1000);
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
	}
	
	function readAllObjid(linkLoad){
		//$('#load-products').load('read.php');	
		//load();
		window.location = linkLoad;
	}

