	function ValidateAdminAdd(valid){
    	$("#formAdminAdd").bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
        live: 'enabled',
        message: 'This value is not valid',
        submitButtons: 'button[type="submitForm"]',
        trigger: null,
        fields: {
			CAT: {
				validators: {
					notEmpty: {
						message: 'กรุณาเลือกรายการ'
					}
				}
			},
			Firstname: {
				validators: {
					notEmpty: {
						message: 'กรุณากรอกข้อมูลด้วย'
					}
				}
			},
			Lastname: {
				validators: {
					notEmpty: {
						message: 'กรุณากรอกข้อมูลด้วย'
					}
				}
			},
            Username: {
                message: 'ข้อมูลไม่ถูกต้อง',
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกข้อมูลด้วย'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'ข้อมูลต้องมีจำนวน 6-20 ตัวอักษร'
                    },
                   /*remote: {
                        url: 'remote.php',
                        message: 'The username is not available'
                    },*/
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'ข้อมูลต้องเป็นตัวอักษร หรือตัวเลขเท่านั้น'
                    },
					different: {
						field: 'Password',
						message: 'ข้อมูลต้องไม่ตรงกับ Password'
					}
                }
            },
                'Password': {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        identical: {
                            field: 'Password_con',
                            message: 'ข้อมูลต้องตรงกับยืนยันรหัสผ่าน'
                        },
                        different: {
                            field: 'Username',
                            message: 'ข้อมูลต้องไม่ซ้ำกับ Username'
                        }
                    }
                },
                Password_con: {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        identical: {
                            field: 'Password',
                            message: 'ข้อมูลไม่ตรงกับ Password'
                        },
                        different: {
                            field: 'Username',
                            message: 'ข้อมูลต้องไม่ซ้ำกับ Username'
                        }
                    }
                },
                Email: {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกข้อมูล'
                        },
                        emailAddress: {
                            message: 'รูปแบบอีเมล์ไม่ถูกต้อง'
                        }
                    }
                },
                phone: {
                /*    validators: {
                        phone: {
                            country: function() {
                                return form.querySelector('[name="Thailand"]').value;
                            },
                            message: 'รูปแบบเบอร์โทรไม่ถูกต้อง'
                        }
                    },*/
					validators: {
                    notEmpty: {
                        message: 'กรุณากรอกข้อมูลด้วย'
                    },
                    /*stringLength: {
                        min: 8,
                        max: 10,
                        message: 'ข้อมูลต้องมีจำนวน 8-10 ตัวอักษร'
                    },*/
                    regexp: {
                        regexp: /^[0-9\.]+$/,
                        message: 'ข้อมูลต้องเป็นตัวอักษร หรือตัวเลขเท่านั้น'
                    }
					}
                },
        }
    }).on('error.form.bv', function(e) {
            console.log('error.form.bv');
            // You can get the form instance and then access API
            var $form = $(e.target);
            console.log($form.data('bootstrapValidator').getInvalidFields());
            // If you want to prevent the default handler (bootstrapValidator._onError(e))
            // e.preventDefault();
        })	
		.on('success.form.bv', function(e) {
            console.log('success.form.bv');
            // If you want to prevent the default handler (bootstrapValidator._onSuccess(e))
            // e.preventDefault();
        })
        .on('error.field.bv', function(e, data) {
            console.log('error.field.bv -->', data);
        })
        .on('success.field.bv', function(e, data) {
            console.log('success.field.bv -->', data);
        })
        .on('status.field.bv', function(e, data) {
            // I don't want to add has-success class to valid field container
            data.element.parents('.form-group').removeClass('has-success');
            // I want to enable the submit button all the time
            data.bv.disableSubmitButtons(false);
        });
	
	}
